<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Color;
use App\Models\Size;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Slide;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;
use Illuminate\Support\Facades\File;

class AdminController extends Controller
{
    public function index()
    {
        $orders = Order::orderBy('created_at', 'desc')->get()->take(10);
        $dashboardDatas = DB::select("Select sum(total) as TotalAmount,
        sum(if(status= 'ordered', total, 0)) As TotalOrderedAmount,
        sum(if(status= 'delivered', total, 0)) As TotalDeliveredAmount,
        sum(if(status= 'canceled', total, 0)) As TotalCanceledAmount,
        Count(*) As Total,
        sum(if(status= 'ordered', 1, 0)) As TotalOrdered,
        sum(if(status= 'delivered', 1, 0)) As TotalDelivered,
        sum(if(status= 'canceled', 1, 0)) As TotalCanceled
        From orders");

        $monthlyDatas = DB::select("SELECT M.id as MonthNo, M.name As MonthName,
        IFNULL(D.TotalAmount, 0) As TotalAmount,
        IFNULL(D.TotalOrderedAmount, 0) As TotalOrderedAmount,
        IFNULL(D.TotalDeliveredAmount, 0) As TotalDeliveredAmount,
        IFNULL(D.TotalCanceledAmount, 0) As TotalCanceledAmount FROM month_names M
        LEFT JOIN (Select DATE_FORMAT(created_at, '%b') As MonthName,
        MONTH(created_at) As MonthNo,
        sum(total) As TotalAmount,
        sum(if(status= 'ordered', total, 0)) As TotalOrderedAmount,
        sum(if(status= 'delivered', total, 0)) As TotalDeliveredAmount,
        sum(if(status= 'canceled', total, 0)) As TotalCanceledAmount
        From orders WHERE YEAR(created_at)=YEAR(NOW()) GROUP BY YEAR(created_at), MONTH(created_at), DATE_FORMAT(created_at, '%b')
        Order By MONTH(created_at)) D On D.MonthNo=M.id");

        $AmountM = implode(',', collect($monthlyDatas)->pluck('TotalAmount')->toArray());
        $orderedAmountM = implode(',', collect($monthlyDatas)->pluck('TotalOrderedAmount')->toArray());
        $deliveredAmountM = implode(',', collect($monthlyDatas)->pluck('TotalDeliveredAmount')->toArray());
        $canceledAmountM = implode(',', collect($monthlyDatas)->pluck('TotalCanceledAmount')->toArray());

        $TotalAmount = collect($monthlyDatas)->sum('TotalAmount');
        $TotalOrderedAmount = collect($monthlyDatas)->sum('TotalOrderedAmount');
        $TotalDeliveredAmount = collect($monthlyDatas)->sum('TotalDeliveredAmount');
        $TotalCanceledAmount = collect($monthlyDatas)->sum('TotalCanceledAmount');

        return view('admin.index', compact('orders', 'dashboardDatas', 'AmountM', 'orderedAmountM', 'deliveredAmountM', 'canceledAmountM', 'TotalAmount', 'TotalOrderedAmount', 'TotalDeliveredAmount', 'TotalCanceledAmount'));
    }


//    Brand

    public function brands()
    {
        $brands = Brand::orderBy('id', 'DESC')->paginate(10);
        return view('admin.brands', compact('brands'));
    }

    public function brandAdd()
    {
        $categories = Category::select('id', 'name')->orderBy('name')->get();
        return view('admin.brand-add',  compact('categories'));
    }

    public function brandStore(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:brands,slug',
            'image' => 'mimes:jpg,jpeg,png|max:2048',
            'category_id' => 'required',
        ]);

        $brand = new Brand();
        $brand->name = $request->name;
        $brand->slug = Str::slug($request->name);
        $brand->category_id = $request->category_id;
        $image = $request->file('image');
        $file_extention = $request->file('image')->extension();
        $file_name = Carbon::now()->timestamp.'.'.$file_extention;

        $this->GenerateBrandThumbnailsImage($image, $file_name);

        $brand->image = $file_name;
        $brand->save();

        return redirect()->route('admin.brands')->with('status', 'Brand has  been added successfully');
    }

    public function brandEdit($id)
    {
        $brand = Brand::find($id);
        $categories = Category::select('id', 'name')->orderBy('name')->get();
        return view('admin.brands-edit', compact('brand', 'categories'));
    }

    public function brandUpdate(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:brands,slug,'.$request->id,
            'image' => 'mimes:jpg,jpeg,png|max:2048',
            'category_id' => 'required',

        ]);

        $brand = Brand::find($request->id);
        $categories = Category::select('id', 'name')->orderBy('name')->get();
        $brand->name = $request->name;
        $brand->slug = Str::slug($request->slug);
        $brand->category_id = $request->category_id;

        if($request->hasFile('image'))
        {
            if(File::exists(public_path('uploads/brands'.'/'.$brand->image)))
            {
                File::delete(public_path('uploads/brands'.'/'.$brand->image));
            }

            $image = $request->file('image');
            $file_extention = $request->file('image')->extension();
            $file_name = Carbon::now()->timestamp.'.'.$file_extention;

            $this->GenerateBrandThumbnailsImage($image, $file_name);

            $brand->image = $file_name;
        }

        $brand->save();

        return redirect()->route('admin.brands')->with('status', 'Brand has been updated successfully');
    }

    public function GenerateBrandThumbnailsImage($image, $imageName)
    {
        $destinationPath = public_path('uploads/brands');
        $img = Image::read($image->path());
        $img->cover(124,124,"top");
        $img->resize(124, 124,function($constraint){
            $constraint->aspectRatio();
        })->save($destinationPath.'/'.$imageName);
    }

    public function brandDelete($id)
    {
        $brand = Brand::find($id);

        if (File::exists(public_path('uploads/brands'.'/'.$brand->image)))
        {
            File::delete(public_path('uploads/brands'.'/'.$brand->image));
        }

        $brand->delete();
        return redirect()->route('admin.brands')->with('status', 'Brand has been deleted successfully');
    }


//    brand

// Colors

    public function colors()
    {
        $colors = Color::orderBy('id', 'DESC')->paginate(10);
        return view('admin.colors', compact('colors'));
    }

    public function colorAdd()
    {
        return view('admin.color-add');
    }

    public function colorStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:255',
        ]);

        $color = new Color();
        $color->name = $request->name;
        $color->slug = Str::slug($request->name); // Создаем slug из имени
        $color->code = $request->code;


        $color->save();

        return redirect()->route('admin.colors')->with('status', 'Color has been added successfully');
    }

    public function colorEdit($id)
    {
        $color = Color::find($id);
        return view('admin.colors-edit', compact('color'));
    }

    public function colorUpdate(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:255',
        ]);

        $color = Color::find($request->id);
        $color->name = $request->name;
        $color->slug = Str::slug($request->name); // Обновляем slug из имени
        $color->code = $request->code;
        $color->save();

        return redirect()->route('admin.colors')->with('status', 'Color has been updated successfully');
    }


    public function colorDelete($id)
    {
        $color = Color::find($id);

        if ($color) {
            $color->delete();
            return redirect()->route('admin.colors')->with('status', 'Color has been deleted successfully');
        }

        return redirect()->route('admin.colors')->with('error', 'Color not found');
    }

//    colors


// size
    public function sizes()
    {
        $sizes = Size::orderBy('id', 'DESC')->paginate(10);
        return view('admin.sizes', compact('sizes'));
    }

    public function sizeAdd()
    {
        $categories = Category::select('id', 'name')->orderBy('name')->get();
        return view('admin.size-add', compact('categories'));
    }

    public function sizeStore(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required',
            'category_id' => 'required',
        ]);

        $size = new Size();
        $size->name = $request->name;
        $size->slug = Str::slug($request->name);
        $size->category_id = $request->category_id;

        $size->save();

        return redirect()->route('admin.sizes')->with('status', 'Brand has  been added successfully');
    }

    public function sizeEdit($id)
    {
        $size = Size::find($id);
        $categories = Category::select('id', 'name')->orderBy('name')->get();
        return view('admin.sizes-edit', compact('size', 'categories'));
    }

    public function sizeUpdate(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:sizes,slug,'.$request->id, // Исправлено здесь
            'category_id' => 'required',
        ]);

        $size = Size::find($request->id);
        $size->name = $request->name;
        $size->slug = Str::slug($request->slug);
        // $size->code = Str::code($request->code); // Уберите эту строку, т.к. Str::code не существует
        $size->category_id = $request->category_id;

        $size->save();

        return redirect()->route('admin.sizes')->with('status', 'Size has been updated successfully');
    }


    public function sizeDelete($id)
    {
        $size = Size::find($id);

        $size->delete();
        return redirect()->route('admin.sizes')->with('status', 'Size has been deleted successfully');
    }

//    size
    public function categories()
    {
        $categories =  Category::orderBy('id', 'DESC')->paginate(10);
        return view('admin.categories', compact('categories'));
    }

    public function categoryAdd()
    {
        return view('admin.category-add');
    }

    public function GenerateCategoryThumbnailsImage($image, $imageName)
    {
        $destinationPath = public_path('uploads/categories');
        $img = Image::read($image->path());
        $img->cover(300,270,"top")
        ->save($destinationPath.'/'.$imageName);
    }

    public function categoryStore(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:categories,slug',
            'image' => 'mimes:jpg,jpeg,png|max:2048',
        ]);

        $category = new Category();
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $image = $request->file('image');
        $file_extention = $request->file('image')->extension();
        $file_name = Carbon::now()->timestamp.'.'.$file_extention;

        $this->GenerateCategoryThumbnailsImage($image, $file_name);

        $category->image = $file_name;
        $category->save();

        return redirect()->route('admin.categories')->with('status', 'Category has  been added successfully');
    }

    public function categoryEdit($id)
    {
        $category = Category::find($id);
        return view('admin.category-edit', compact('category'));
    }

    public function categoryUpdate(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:brands,slug,'.$request->id,
            'image' => 'mimes:jpg,jpeg,png|max:2048',
        ]);

        $category = Category::find($request->id);
        $category->name = $request->name;
        $category->slug = Str::slug($request->slug);
        if($request->hasFile('image'))
        {
            if(File::exists(public_path('uploads/categories'.'/'.$category->image)))
            {
                File::delete(public_path('uploads/categories'.'/'.$category->image));
            }

            $image = $request->file('image');
            $file_extention = $request->file('image')->extension();
            $file_name = Carbon::now()->timestamp.'.'.$file_extention;

            $this->GenerateCategoryThumbnailsImage($image, $file_name);

            $category->image = $file_name;
        }

        $category->save();

        return redirect()->route('admin.categories')->with('status', 'Category has been updated successfully');
    }

    public function categoryDelete($id)
    {
        $category = Category::find($id);
        if (File::exists(public_path('uploads/categories'.'/'.$category->image)))
        {
            File::delete(public_path('uploads/categories'.'/'.$category->image));
        }
        $category->delete();
        return redirect()->route('admin.categories')->with('status', 'Category has been deleted successfully');
    }

    public function products()
    {
        $products = Product::orderBy('created_at', 'DESC')->paginate(10);
        return view('admin.products', compact('products'));
    }

    public function productAdd()
    {
        $categories = Category::select('id', 'name')->orderBy('name')->get();
        $brands = Brand::select('id', 'name')->orderBy('name')->get();
        $colors = Color::select('id', 'name')->orderBy('name')->get();
        $sizes = Size::select('id', 'name')->orderBy('name')->get();
        return view ('admin.products-add', compact('categories', 'brands', 'colors', 'sizes'));
    }

    public function productStore(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:products,slug',
            'short_description' => 'required',
            'description' => 'required',
            'regular_price' => 'required',
            'sale_price' => 'required',
            'SKU' => 'required',
            'width' => 'required',
            'stock_status' => 'required',
            'featured' => 'required',
            'is_on_sale' => 'required',
            'quantity' => 'required',
            'image' => 'required|mimes:jpg,jpeg,png|max:2048',
            'category_id' => 'required',
            'brand_id' => 'required',
            'color_id' => 'nullable|exists:colors,id', // Поле не обязательно
            'size_id' => 'nullable|exists:sizes,id',
        ]);

        $product = new Product();
        $product->name = $request->name;
        $product->slug = Str::slug($request->name);
        $product->short_description = $request->short_description;
        $product->description = $request->description;
        $product->regular_price = $request->regular_price;
        $product->sale_price = $request->sale_price;
        $product->SKU = $request->SKU;
        $product->width = $request->width;
        $product->stock_status = $request->stock_status;
        $product->featured = $request->featured;
        $product->is_on_sale = $request->is_on_sale;
        $product->quantity = $request->quantity;
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->color_id = $request->color_id;
        $product->size_id = $request->size_id;

        $current_timestamp = Carbon::now()->timestamp;

        if($request->file('image'))
        {
            $image = $request->file('image');
            $imageName = $current_timestamp.'.'.$image->extension();
            $this->GenerateProductThumbnailImage($image, $imageName);
            $product->image = $imageName;
        }

        $gallery_arr = array();
        $gallery_images = "";
        $counter = 1;

        if($request->hasFile('images'))
        {
            $allowedfileExtensions = ["jpg", "jpeg", "png"];
            $files = $request->file('images');
            foreach($files as $file)
            {
                $gextension = $file->getClientOriginalExtension();
                $gcheck = in_array($gextension, $allowedfileExtensions);

                if($gcheck)
                {
                    $gfileName = $current_timestamp."-".$counter.".".$gextension;
                    $this->GenerateProductThumbnailImage($file, $gfileName);
                    array_push($gallery_arr, $gfileName);
                    $counter++;
                }
            }
            $gallery_images = implode(",", $gallery_arr);
        }

        $product->images = $gallery_images;
        $product->save();
        return redirect()->route('admin.products')->with('status', 'Product has been added successfully');
    }

    public function GenerateProductThumbnailImage($image, $imageName)
    {
        $destinationPathThumbnail = public_path('uploads/products/thumbnails');
        $destinationPath = public_path('uploads/products');
        $img = Image::read($image->path());

        $img->save($destinationPath.'/'.$imageName);

        $img->save($destinationPathThumbnail.'/'.$imageName);
    }




    public function productEdit($id)
    {
        $product = Product::find($id);
        $categories = Category::select('id', 'name')->orderBy('name')->get();
        $brands = Brand::select('id', 'name')->orderBy('name')->get();
        $colors = Color::select('id', 'name')->orderBy('name')->get();
        $sizes = Size::select('id', 'name')->orderBy('name')->get();

        return view('admin.products-edit', compact('product', 'categories', 'brands', 'colors', 'sizes'));
    }

    public function productUpdate(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:products,slug,'.$request->id,
            'short_description' => 'required',
            'description' => 'required',
            'regular_price' => 'required',
            'sale_price' => 'required',
            'SKU' => 'required',
            'stock_status' => 'required',
            'featured' => 'required',
            'is_on_sale' => 'required',
            'quantity' => 'required',
            'image' => 'mimes:jpg,jpeg,png|max:2048',
            'category_id' => 'required',
            'brand_id' => 'required',
            'color_id' => 'nullable|exists:colors,id', // Поле не обязательно
            'size_id' => 'nullable|exists:sizes,id',
        ]);

        $product = Product::find($request->id);
        $product->name = $request->name;
        $product->slug = Str::slug($request->name);
        $product->short_description = $request->short_description;
        $product->description = $request->description;
        $product->regular_price = $request->regular_price;
        $product->sale_price = $request->sale_price;
        $product->SKU = $request->SKU;
        $product->stock_status = $request->stock_status;
        $product->featured = $request->featured;
        $product->is_on_sale = $request->is_on_sale;
        $product->quantity = $request->quantity;
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->color_id = $request->color_id;
        $product->size_id = $request->size_id;

        $current_timestamp = Carbon::now()->timestamp;

        if($request->file('image'))
        {
            if(File::exists(public_path('uploads/products').'/'.$product->image))
            {
                File::delete(public_path('uploads/products').'/'.$product->image);
            }

            if(File::exists(public_path('uploads/products/thumbnails').'/'.$product->image))
            {
                File::delete(public_path('uploads/products/thumbnails').'/'.$product->image);
            }

            $image = $request->file('image');
            $imageName = $current_timestamp.'.'.$image->extension();
            $this->GenerateProductThumbnailImage($image, $imageName);
            $product->image = $imageName;
        }

        $gallery_arr = array();
        $gallery_images = "";
        $counter = 1;

        if($request->hasFile('images'))
        {
            foreach(explode(',', $product->images) as $ofile)
            {
                if(File::exists(public_path('uploads/products').'/'.$ofile))
                {
                    File::delete(public_path('uploads/products').'/'.$ofile);
                }

                if(File::exists(public_path('uploads/products/thumbnails').'/'.$ofile))
                {
                    File::delete(public_path('uploads/products/thumbnails').'/'.$ofile);
                }
            }

            $allowedfileExtensions = ["jpg", "jpeg", "png"];
                $files = $request->file('images');
            foreach($files as $file)
            {
                $gextension = $file->getClientOriginalExtension();
                $gcheck = in_array($gextension, $allowedfileExtensions);

                if($gcheck)
                {
                    $gfileName = $current_timestamp."-".$counter.".".$gextension;
                    $this->GenerateProductThumbnailImage($file, $gfileName);
                    array_push($gallery_arr, $gfileName);
                    $counter++;
                }
            }
            $gallery_images = implode(",", $gallery_arr);
            $product->images = $gallery_images;
        }

        $product->save();
        return redirect()->route('admin.products')->with('status', 'Product has been updated successfully');
    }

    public function productDelete($id)
    {
        $product = Product::find($id);

        if (File::exists(public_path('uploads/products').'/'.$product->image))
        {
            File::delete(public_path('uploads/products').'/'.$product->image);
        }
        if (File::exists(public_path('uploads/products/thumbnails').'/'.$product->image))
        {
            File::delete(public_path('uploads/products/thumbnails').'/'.$product->image);
        }

        foreach(explode(',', $product->images) as $ofile)
        {
            if(File::exists(public_path('uploads/products').'/'.$ofile))
            {
                File::delete(public_path('uploads/products').'/'.$ofile);
            }

            if(File::exists(public_path('uploads/products/thumbnails').'/'.$ofile))
            {
                File::delete(public_path('uploads/products/thumbnails').'/'.$ofile);
            }
        }

        $product->delete();
        return redirect()->route('admin.products')->with('status', 'Product has been deleted successfully');
    }

    public function coupons()
    {
        $coupons = Coupon::orderBy('expiry_date', 'DESC')->paginate(12);
        return view('admin.coupons', compact('coupons'));
    }

    public function couponAdd()
    {
        return view('admin.coupon-add');
    }

    public function couponStore(Request $request)
    {
        $request->validate([
            'code' => 'required',
            'type' => 'required',
            'value' => 'required|numeric',
            'expiry_date' => 'required|date',
            'cart_value' => 'required|numeric',
        ]);

        $coupon = new Coupon();
        $coupon->code = $request->code;
        $coupon->type = $request->type;
        $coupon->value = $request->value;
        $coupon->cart_value = $request->cart_value;
        $coupon->expiry_date = $request->expiry_date;
        $coupon->save();
        return redirect()->route('admin.coupons')->with('status', 'Coupon has been added successfully!');
    }

    public function couponEdit($id)
    {
        $coupon = Coupon::find($id);
        return view('admin.coupon-edit', compact('coupon'));
    }

    public function couponUpdate(Request $request)
    {
        $request->validate([
            'code' => 'required',
            'type' => 'required',
            'value' => 'required|numeric',
            'expiry_date' => 'required|date',
            'cart_value' => 'required|numeric',
        ]);

        $coupon = Coupon::find($request->id);
        $coupon->code = $request->code;
        $coupon->type = $request->type;
        $coupon->value = $request->value;
        $coupon->cart_value = $request->cart_value;
        $coupon->expiry_date = $request->expiry_date;
        $coupon->save();
        return redirect()->route('admin.coupons')->with('status', 'Coupon has been updated successfully!');
    }

    public function couponDelete($id)
    {
        $coupon = Coupon::find($id);
        $coupon->delete();
        return redirect()->route('admin.coupons')->with('status', 'Coupon has been deleted successfully!');
    }

    public function orders()
    {
        $orders = Order::orderBy('created_at', 'DESC')->paginate(12);
        return view('admin.orders', compact('orders'));
    }

    public function orderDetails($order_id)
    {
        $order = Order::find($order_id);
        $orderItems = OrderItem::where('order_id', $order_id)->orderBy('id')->paginate();
        $transaction = Transaction::where('order_id', $order_id)->first();
        return view('admin.order-details', compact('order', 'orderItems', 'transaction'));
    }

    public function updateOrderStatus(Request $request)
    {
        $order = Order::find($request->order_id);
        $order->status = $request->order_status;

        if($request->order_status == 'delivered')
        {
            $order->delivered_date = Carbon::now();
        }
        elseif($request->order_status == 'canceled')
        {
            $order->canceled_date = Carbon::now();
        }

        $order->save();

        if($request->order_status == 'delivered')
        {
            $transaction = Transaction::where('order_id', $request->order_id)->first();
            $transaction->status = 'approved';
            $transaction->save();
        }

        return back()->with('status', 'Status changed successfully!');
    }

    public function slides()
    {
        $slides = Slide::orderBy('id', 'DESC')->paginate(12);
        return view('admin.slides', compact('slides'));
    }

    public function slideAdd()
    {
        return view('admin.slide-add');
    }

    public function GenerateSlideThumbnailsImage($image, $imageName)
    {
        $destinationPath = public_path('uploads/slides');
        $img = Image::read($image->path());
        $img->save($destinationPath.'/'.$imageName);
    }

    public function slideStore(Request $request)
    {
        $request->validate([
            'tagline' => 'required',
            'title' => 'required',
            'subtitle' => 'required',
            'link' => 'required',
            'status' => 'required',
            'image' => 'required|mimes:jpeg,png,jpg|max:2048',
        ]);

        $slide = new Slide();
        $slide->tagline = $request->tagline;
        $slide->title = $request->title;
        $slide->subtitle = $request->subtitle;
        $slide->link = $request->link;
        $slide->status = $request->status;

        $image = $request->file('image');
        $file_extention = $request->file('image')->extension();
        $file_name = Carbon::now()->timestamp.'.'.$file_extention;
        $this->GenerateSlideThumbnailsImage($image, $file_name);
        $slide->image = $file_name;
        $slide->save();
        return redirect()->route('admin.slides')->with('status', 'Slide has been added successfully!');
    }

    public function slideEdit($id)
    {
        $slide = Slide::find($id);
        return view('admin.slide-edit', compact('slide'));
    }

    public function slideUpdate(Request $request)
    {
        $request->validate([
            'tagline' => 'required',
            'title' => 'required',
            'subtitle' => 'required',
            'link' => 'required',
            'status' => 'required',
            'image' => 'mimes:jpeg,png,jpg|max:2048',
        ]);

        $slide = Slide::find($request->id);
        $slide->tagline = $request->tagline;
        $slide->title = $request->title;
        $slide->subtitle = $request->subtitle;
        $slide->link = $request->link;
        $slide->status = $request->status;

        if($request->hasFile('image'))
        {
            if(File::exists(public_path('uploads/slides').'/'.$slide->image))
            {
                File::delete(public_path('uploads/slides').'/'.$slide->image);
            }
            $image = $request->file('image');
            $file_extention = $request->file('image')->extension();
            $file_name = Carbon::now()->timestamp.'.'.$file_extention;
            $this->GenerateSlideThumbnailsImage($image, $file_name);
            $slide->image = $file_name;
        }

        $slide->save();
        return back()->route('admin.slides')->with('status', 'Slide has been updated successfully!');
    }

    public function slideDelete($id)
    {
        $slide = Slide::find($id);
        if(File::exists(public_path('uploads/slides').'/'.$slide->image))
        {
            File::delete(public_path('uploads/slides').'/'.$slide->image);
        }

        $slide->delete();
        return redirect()->route('admin.slides')->with('status', 'Slide has been deleted successfully!');
    }

    public function contact()
    {
        $contacts = Contact::orderBy('created_at', 'DESC')->paginate(10);
        return view('admin.admin-contact', compact('contacts'));
    }

    public function contactDelete($id)
    {
        $contact = Contact::find($id);
        $contact->delete();
        return redirect()->route('admin.contact')->with('status', 'Contact has been deleted successfully!');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $results = Product::where('name', 'LIKE', "%{$query}%")->get()->take(8);
        return response()->json($results);
    }

    public function profile()
    {
        $user = auth()->user();
        return view('admin.admin-profile', compact('user'));
    }

    public function profileEdit()
    {
        return view('admin.admin-profile-edit');
    }
}
