<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

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
    public function getCart()
    {
        // session()->forget('cart');
        return session('cart', []);
    }
    public function addToCart(Request $request)
    {
        // Lấy dữ liệu giỏ hàng từ session
        $product = Product::find($request->product_id);
        $cart = session()->get('cart', []);
        $itemFound = false;

        foreach ($cart as $key => $item) {
            if (
                $item['id'] == $request->product_id &&
                $item['size'] == $request->product_size &&
                $item['color'] == $request->product_color
            ) {
                // Các thông tin sản phẩm trùng khớp, tăng số lượng
                $cart[$key]['quantity'] += $request->product_quantity;
                $itemFound = true;
                break;
            }
        }

        if (!$itemFound) {
            // Nếu sản phẩm không tồn tại trong giỏ hàng, thêm mới
            $newItem = [
                'uuid' => Str::uuid(),
                'id' => $request->product_id,
                'name' => $product->name,
                'size' => $request->product_size,
                'color' => $request->product_color,
                'quantity' => $request->product_quantity,
                'cover' => $request->product_cover,
                'price' => $request->product_price,
                'slug' => $request->product_slug,
            ];

            $cart[] = $newItem;
        }


        // Lưu dữ liệu giỏ hàng vào session
        session()->put('cart', $cart);

        return
            $cart;
    }
    public function removeFromCart(Request $request)
    {


        $cart = session()->get('cart', []);

        // Tìm sản phẩm cần xóa trong giỏ hàng
        foreach ($cart as $key => $item) {
            if (
                $item['uuid'] == $request->uuid
            ) {
                // Xóa sản phẩm khỏi giỏ hàng
                unset($cart[$key]);
                break; // Thoát khỏi vòng lặp sau khi xóa sản phẩm
            }
        }

        // Cập nhật lại giỏ hàng trong session
        session()->put('cart', $cart);
        return $cart;
    }
    public function updateCart(Request $request)
    {
        session()->put('cart', $request->cartData);
        return $request->cartData;
    }
    public function checkout()
    {
        return view('client.checkout');
    }
    public function order(Request $request)
    {
    }
    public function contact()
    {
        return view('client.contact');
    }
}
