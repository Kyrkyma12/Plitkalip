<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Size;
use App\Models\Color;
use App\Models\Product;
use Illuminate\Http\Request;
use function Symfony\Component\String\b;

class ShopController extends Controller
{
//    public function index(Request $request)
//    {
//        $size = $request->query('size') ? $request->query('size') : 12;
//        $o_column = "";
//        $o_order = "";
//        $order = $request->query('order') ? $request->query('order') : -1;
//        $f_brands = $request->query('brands');
//        $f_categories = $request->query('categories');
//        $f_colors = $request->query('colors');
//        $f_sizes = $request->query('sizes');
//        $min_price = $request->query('min') ? $request->query('min') : 1;
//        $max_price = $request->query('max') ? $request->query('max') : 500;
//        switch ($order) {
//            case 1:
//                $o_column = "created_at";
//                $o_order = "DESC";
//                break;
//            case 2:
//                $o_column = "created_at";
//                $o_order = "ASC";
//                break;
//            case 3:
//                $o_column = "sale_price";
//                $o_order = "ASC";
//                break;
//            case 4:
//                $o_column = "sale_price";
//                $o_order = "DESC";
//                break;
//            default:
//                $o_column = "id";
//                $o_order = "DESC";
//        }
//        $brands = Brand::orderBy('name', 'ASC')->get();
//        $colors = Color::orderBy('name', 'ASC')->get();
//        $sizes = Size::orderBy('name', 'ASC')->get();
//        $categories = Category::orderBy('name', 'ASC')->get();
//        $products = Product::where(function ($query) use ($f_brands) {
//            $query->whereIn('brand_id', explode(',', $f_brands))->orWhereRaw("'".$f_brands."'=''");
//        })
//            ->where(function ($query) use ($f_categories) {
//                $query->whereIn('category_id', explode(',', $f_categories))->orWhereRaw("'".$f_categories."'=''");
//            })->where(function ($query) use ($f_colors) {
//                $query->whereIn('color_id', explode(',', $f_colors))->orWhereRaw("'".$f_colors."'=''");
//            })->where(function ($query) use ($f_sizes) {
//                $query->whereIn('size_id', explode(',', $f_sizes))->orWhereRaw("'".$f_sizes."'=''");
//            })
//            ->where(function($query) use ($min_price, $max_price){
//                $query->whereBetween('regular_price', [$min_price, $max_price])
//                    ->orWhereBetween('sale_price', [$min_price, $max_price]);
//            })
//            ->orderBy($o_column, $o_order)->paginate($size);
//
//        return view('shop', compact('products', 'size', 'order', 'brands', 'colors', 'sizes', 'f_brands', 'f_sizes', 'f_colors', 'categories', 'f_categories', 'min_price', 'max_price'));    }

    public function index(Request $request)
    {
        $size = $request->query('size') ? (int)$request->query('size') : 12;
        $o_column = "";
        $o_order = "";
        $order = $request->query('order') ? (int)$request->query('order') : -1;
        $f_brands = $request->query('brands', '');
        $f_categories = $request->query('categories', '');
        $f_colors = $request->query('colors', '');
        $f_sizes = $request->query('sizes', '');
        $min_price = $request->query('min') ? (float)$request->query('min') : 1;
        $max_price = $request->query('max') ? (float)$request->query('max') : 100000;

        // Если order = -1 (значение по умолчанию), используем случайный порядок
        if ($order == -1) {
            $products = Product::where(function ($query) use ($f_brands) {
                if ($f_brands) {
                    $query->whereIn('brand_id', explode(',', $f_brands));
                }
            })
                ->where(function ($query) use ($f_categories) {
                    if ($f_categories) {
                        $query->whereIn('category_id', explode(',', $f_categories));
                    }
                })
                ->where(function ($query) use ($f_colors) {
                    if ($f_colors) {
                        $query->whereIn('color_id', explode(',', $f_colors));
                    }
                })
                ->where(function ($query) use ($f_sizes) {
                    if ($f_sizes) {
                        $query->whereIn('size_id', explode(',', $f_sizes));
                    }
                })
                ->where(function($query) use ($min_price, $max_price) {
                    $query->whereBetween('regular_price', [$min_price, $max_price])
                        ->orWhereBetween('sale_price', [$min_price, $max_price]);
                })
                ->inRandomOrder() // Добавляем случайную сортировку
                ->paginate($size);
        } else {
            // Стандартная логика сортировки для других случаев
            switch ($order) {
                case 1:
                    $o_column = "created_at";
                    $o_order = "DESC";
                    break;
                case 2:
                    $o_column = "created_at";
                    $o_order = "ASC";
                    break;
                case 3:
                    $o_column = "sale_price";
                    $o_order = "ASC";
                    break;
                case 4:
                    $o_column = "sale_price";
                    $o_order = "DESC";
                    break;
                default:
                    $o_column = "id";
                    $o_order = "DESC";
            }

            $products = Product::where(function ($query) use ($f_brands) {
                if ($f_brands) {
                    $query->whereIn('brand_id', explode(',', $f_brands));
                }
            })
                ->where(function ($query) use ($f_categories) {
                    if ($f_categories) {
                        $query->whereIn('category_id', explode(',', $f_categories));
                    }
                })
                ->where(function ($query) use ($f_colors) {
                    if ($f_colors) {
                        $query->whereIn('color_id', explode(',', $f_colors));
                    }
                })
                ->where(function ($query) use ($f_sizes) {
                    if ($f_sizes) {
                        $query->whereIn('size_id', explode(',', $f_sizes));
                    }
                })
                ->where(function($query) use ($min_price, $max_price) {
                    $query->whereBetween('regular_price', [$min_price, $max_price])
                        ->orWhereBetween('sale_price', [$min_price, $max_price]);
                })
                ->orderBy($o_column, $o_order)
                ->paginate($size);
        }

        $selectedCategoryIds = $request->query('categories')
            ? explode(',', $request->query('categories'))
            : [];

        $categories = Category::withCount('products')->orderBy('name', 'ASC')->get();

        if (!empty($selectedCategoryIds)) {
            $brands = Brand::whereIn('category_id', $selectedCategoryIds)
                ->withCount('products')
                ->orderBy('name', 'ASC')
                ->get();

            $sizes = Size::whereIn('category_id', $selectedCategoryIds)
                ->withCount('products')
                ->orderBy('name', 'ASC')
                ->get();
        } else {
            $brands = Brand::withCount('products')->orderBy('name', 'ASC')->get();
            $sizes = Size::withCount('products')->orderBy('name', 'ASC')->get();
        }

        $colors = Color::withCount('products')->orderBy('name', 'ASC')->get();

        return view('shop', compact(
            'products', 'size', 'order', 'brands', 'f_brands', 'categories', 'f_categories',
            'colors', 'f_colors', 'sizes', 'f_sizes', 'min_price', 'max_price'
        ));
    }



    public function productDetails($product_slug)
    {

        $product = Product::where('slug', $product_slug)->first();
        $rproducts = Product::where('slug','<>',$product_slug)->get()->take(8);
        return view('details', compact('product', 'rproducts'));
    }
}
