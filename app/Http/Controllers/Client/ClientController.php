<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function home()
    {
        $sliders = Slider::orderBy('created_at', 'DESC')->get();
        return view('client.index', compact('sliders'));
    }
    public function shop()
    {
        $products = Product::orderBy('created_at', 'DESC')->get();
        return view('client.shop', compact('products'));
    }
    public function productDetail($slug)
    {
        $product = Product::where('slug', $slug)->first();
        $relateds = Product::where('category_id', $product->category_id)->where('id', '<>', $product->id)->limit(4)->get();
        return view('client.product-detail', compact('product', 'relateds'));
    }
    public function about()
    {
        return view('client.about');
    }

    public function blog()
    {
        $posts = Post::orderBy('created_at', "DESC")->paginate(10)->withQueryString();

        return view('client.blog', compact('posts'));
    }
    public function blogDetail($slug)
    {
        $post = Post::where('slug', $slug)->first();
        $previous = Post::where('id', '<', $post->id)->first();
        $next = Post::where('id', '>', $post->id)->first();
        return view('client.blog-detail', compact('post', 'previous', 'next'));
    }
    public function cart()
    {
        return view('client.shopping-cart');
    }
    public function addToCart($slug)
    {
        dump($slug);
    }
    public function checkout()
    {
        return view('client.checkout');
    }
    public function contact()
    {
        return view('client.contact');
    }
}
