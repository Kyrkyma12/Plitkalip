<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Slide;
use App\Rules\RussianPhoneRule;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $slides = Slide::where('status',1)->get()->take(3);
        $categories = Category::orderBy('name')->get();
        $sproducts = Product::whereNotNull('sale_price')->where('sale_price', '<>', '')->inRandomOrder()->get()->take(8);
        $fproducts = Product::where('featured',1)->get()->take(8);
        return view('index', compact('slides', 'categories', 'sproducts', 'fproducts'));
    }

    public function contact()
    {
        return view('contact');
    }

    public function location()
    {
        return view('location');
    }
    public function gost()
    {
        return view('gost');
    }
    public function vacancies()
    {
        return view('vacancies');
    }
    public function contactStore(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:100',
            'email'   => 'required|email|max:255',
            'phone'   => [
                'required',
                'string',
                'regex:/^\+7 \(\d{3}\) \d{3}-\d{2}-\d{2}$/'
            ],
            'comment' => 'required|string|max:1000',
        ], [
            'name.required'    => 'Пожалуйста, укажите ваше имя.',
            'email.required'   => 'Укажите корректный email.',
            'email.email'      => 'Email должен быть в формате example@mail.ru',
            'phone.required'   => 'Телефон обязателен для заполнения.',
            'phone.regex'      => 'Введите российский номер в формате: +7 (XXX) XXX-XX-XX',
            'comment.required' => 'Напишите ваш комментарий.',
        ]);

        $contact = new Contact();
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->phone = $request->phone;
        $contact->comment = $request->comment;
        $contact->save();

        return redirect()->back()->with('success', 'Ваше сообщение отправлено!');
    }
    public function search(Request $request)
    {
        $query = $request->input('query');
        $results = Product::where('name', 'LIKE', "%{$query}%")->get()->take(8);
        return response()->json($results);
    }

    public function aboutUs()
    {
        return view('aboutus');
    }
}
