<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Color;
use App\Models\Favourite;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Post;
use App\Models\Product;
use App\Models\Size;
use App\Models\Slider;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class ClientController extends Controller
{
    public function home()
    {
        $sliders = Slider::orderBy('created_at', 'DESC')->get();
        return view('client.index', compact('sliders'));
    }

    public function shop(Request $request)
    {
        $categoriesParent = Category::where('category_id', 0)->get();
        $sizes = Size::all();
        $colors = Color::all();

        $query = Product::query();
        if ($request->has('keywords') && $request->keywords != null) {
            $query->where('name', 'like', '%' . $request->keywords . '%');
        }
        if ($request->has('category') && $request->category != null) {
            $query->where('category_id', $request->category);
        }
        if ($request->has('size') && $request->size != null) {
            $query->where('sizes', 'like', '%' . $request->size . '%');
        }
        if ($request->has('color') && $request->color != null) {
            $query->where('colors', 'like', '%' . $request->color . '%');
        }
        if ($request->has('sort') && $request->sort != null) {
            $query->orderBy('price', $request->sort);
        }

        $products = $query->orderBy('created_at', 'DESC')->paginate(10);
        return view('client.shop', compact('products', 'categoriesParent', 'sizes', 'colors'));
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

    public function favourite()
    {
        $favourites = Favourite::where('userID', Auth::user()->id)->get();

        return view('client.favourite', compact('favourites'));
    }

    public function getFavourite()
    {
        $favourites = Favourite::where('userID', Auth::user()->id)->get();
        foreach ($favourites as $favourite) {
            $favourite['product'] = $favourite->product;
            $favourite['product']['category'] = $favourite['product']->category;
            $favourite['product']['priceOld'] = number_format($favourite['product']['price']);
            $favourite['product']['priceNew'] = number_format(((100 - $favourite['product']['sale']) / 100) * $favourite['product']['price']);
        }
        return $favourites;
    }

    public function addProductToFavourite(Request $request)
    {
        if ($request->has('id')) {
            $check = Favourite::where('productID', $request->id)->where('userID', Auth::user()->id)->first();
            if ($check) {
                return true;
            }
            return Favourite::insert(['userID' => Auth::user()->id, 'productID' => $request->id]);
        }
        return false;
    }

    public function removeProductFromFavourite(Request $request)
    {
        if ($request->has('id')) {
            return Favourite::where('productID', $request->id)->where('userID', Auth::user()->id)->delete();
        }
        return false;
    }

    public function blog()
    {
        $posts = Post::orderBy('created_at', 'DESC')->paginate(10)->withQueryString();

        return view('client.blog', compact('posts'));
    }

    public function blogDetail($slug)
    {
        $post = Post::where('slug', $slug)->first();
        $previous = Post::where('id', '<', $post->id)->first();
        $next = Post::where('id', '>', $post->id)->first();
        $relateds = Post::where('slug', '<>', $slug)->limit(3)->get();
        $tags = Tag::all();
        return view('client.blog-detail', compact('post', 'previous', 'next', 'relateds', 'tags'));
    }

    public function cart()
    {
        return view('client.shop-cart');
    }

    public function getCart()
    {
        $cart = Cart::where('userID', Auth::user()->id)->get();
        foreach ($cart as $item) {
            $item['product'] = $item->product;
        }
        return $cart;
    }

    public function addToCart(Request $request)
    {
        // Lấy dữ liệu giỏ hàng từ session
        $product = Product::find($request->product_id);
        if ($product) {
            return false;
        }

        $checkProductInCart = Cart::where('userID', Auth::user()->id)
            ->where('productID', $request->productID)
            ->where('size', $request->size)
            ->where('color', $request->color)
            ->first();

        if ($checkProductInCart) {
            return Cart::where('id', $checkProductInCart->id)->where('userID', Auth::user()->id)->update(['quantity' => $checkProductInCart->quantity + $request->quantity]);
        } else {
            return Cart::insert(['userID' => Auth::id(),
                'productID' => $request->productID, 'size' => $request->size, 'color' => $request->color, 'quantity' => $request->quantity]);
        }
    }

    public function removeFromCart(Request $request)
    {
        return Cart::where('id', $request->id)->where('userID', Auth::user()->id)->delete();
    }

    public function updateCart(Request $request)
    {
        if ($request->has('cart')) {
            foreach ($request->cart as $item) {
                Cart::where('id', $item['id'])->where('userID', Auth::id())->where('productID', $item['productID'])->update(['quantity' => $item['quantity']]);
            }
            return true;
        }
    }

    public function cartTotal()
    {
        $total = 0;
        $cart = Cart::where('userID', Auth::user()->id)->get();
        foreach ($cart as $item) {
            if ($item->product->sale > 0) {
                $total += (((100 - $item->product->sale) / 100) * $item->product->price) * $item->quantity;
            } else {
                $total += $item->quantity * $item->product->price;
            }
        }
        return $total;
    }

    public function checkout()
    {
        $total = $this->cartTotal();
        if ($total == 0) {
            return back();
        }
        $total = number_format($total);
        return view('client.checkout', compact('total'));
    }

    public function placeOrder(Request $request)
    {
        $cart_total = $this->cartTotal();
        $data = $request->validate([
            'full_name' => 'required|max:50',
            'address' => 'required',
            'email' => 'required|email',
            'phone_number' => 'required|numeric',
        ], [
            'full_name.required' => 'Vui lòng nhập trường này',
            'phone_number.numeric' => 'Vui lòng nhập đúng định dạng',
            'phone_number.required' => 'Vui lòng nhập trường này',
            'address.required' => 'Vui lòng nhập trường này',
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Vui lòng nhập đúng định dạng',
        ]);
        $data['notes'] = $request->notes;

        $cart = Cart::where('userID', Auth::user()->id)->get();

        $quantity = 0;
        foreach ($cart as $item) {
            $quantity += $item['quantity'];
        }

        $data = [
            'userID' => Auth::user()->id,
            'name' => $request->full_name,
            'email' => $request->email,
            'phone' => $request->phone_number,
            'address' => $request->address,
            'notes' => $request->notes,
            'total' => $cart_total,
            'quantity' => $quantity,
            'status' => 1,
            'payment' => 1,
        ];
        $order = Order::create($data);
        if ($order) {
            $orderDetail = [];
            foreach ($cart as $item) {
                if ($item->product->sale > 0) {
                    $price = ((100 - $item->product->sale) / 100) * $item->product->price;
                } else {
                    $price = $item->product->price;
                }
                $orderDetail[] = ['orderID' => $order->id,
                    'productID' => $item->productID,
                    'size' => $item->size,
                    'color' => $item->color,
                    'quantity' => $item->quantity, 'price' => $price];
            }
            $orderDetail = OrderDetail::insert($orderDetail);
            if ($orderDetail) {
                foreach ($cart as $item) {
                    Cart::where('id', $item->id)->delete();
                }
                return true;
            }
        }
    }

    public function contact()
    {
        return view('client.contact');
    }

    public function login()
    {
        if (Auth::check()) {
            return back();
        }
        return view('client.login');
    }

    public function handleLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ], [
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Vui lòng nhập đúng định dạng',
            'password.required' => 'Vui lòng nhập mật khẩu',
        ]);
        if (Auth::attempt($credentials, $request->remember)) {
            $request->session()->regenerate();
            return redirect()->route('client.index');
        }

        return back()->withErrors([
            'password' => 'Tài khoản hoặc mật khẩu chưa chính xác!',
        ])->onlyInput('password');
    }

    public function register()
    {
        if (Auth::check()) {
            return back();
        }
        return view('client.register');
    }

    public function handleRegister(Request $request)
    {
        $validate = $request->validate([
            'full_name' => 'required|max:50',
            'phone_number' => 'required|numeric',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6'
        ], [
            'full_name.required' => 'Vui lòng nhập trường này',
            'phone_number.numeric' => 'Vui lòng nhập đúng định dạng',
            'phone_number.required' => 'Vui lòng nhập trường này',
            'full_name.max' => 'Tối đa :max kí tự',
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Vui lòng nhập đúng định dạng',
            'email.unique' => 'Email này đã được sử dụng',
            'password.required' => 'Vui lòng nhập mật khẩu',
            'password.min' => 'Mật khẩu phải lớn hơn hoặc bằng :min kí tự',
            'password.confirmed' => 'Xác nhận trường mật khẩu không khớp.',
            'password_confirmation.required' => 'Vui lòng xác nhận mật khẩu',
            'password_confirmation.min' => 'Mật khẩu phải lớn hơn hoặc bằng :min kí tự',
        ]);
        $validate['group_id'] = 2;
        $validate['password'] = Hash::make($validate['password']);

        unset($validate['password_confirmation']);
        $check = User::insert($validate);
        if ($check) {
            Session()->put(['emailRegister' => $request->email]);
            return redirect()->route('client.login');
        }
        return back()->withErrors([
            'password' => 'Tạo tài khoản thất bại, vui lòng thử lại!',
        ])->onlyInput('password');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('client.login');
    }
}
