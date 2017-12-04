<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Like;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Admin\SubCategory;
use App\Admin\Category;
use App\Admin\Product;
use App\Order;
use App\Admin\Page;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    // show all products
    public function index()
    {
        $categories = Category::all();
        $subCategories = SubCategory::all();
        $products = Product::where('active', true)->paginate(9);

        return view('store.index')->with('categories', $categories)->with('subCategories', $subCategories)->with('products', $products);
    }
    // show product
    public function show($id)
    {   if( ctype_digit ($id))
        {
            $product = Product::find($id);
            $categories = Category::all();
            $subCategories = SubCategory::all();

            $oldCart = Session::has('cart') ? Session::get('cart') : null;
            $cart = new Cart($oldCart);
        }
        else
        {
            return view('errors.404');
        }

        if(isset($product))
        {
            return view('store.show')->with('categories', $categories)->with('subCategories', $subCategories)->with('product', $product)->with('cart', $cart);
        }
        else
        {
            return view('errors.404');
        }
    }

    public function getLikeProduct($id)
    {

        $oldLikes = Like::where('product_id', $id);

        $userInfo = \Auth::user();

        if (isset($userInfo))
        {
            $userInfo = $userInfo->id;
        }
        else
        {
            $userInfo = \Request::ip();
        }

        $ala = 'Chupise neshto';

        foreach($oldLikes as $oldLike)
        {

            $ala = $oldLike;

            if($oldLike->user_ip == $userInfo)
            {
                $ala = "Wece si go laiknal";
            }
            else
            {
                $ala = "Zapis";
            }
        }

/*
        $like = new Like;
        $like->product_id = $id;
        $like->user_ip = $userInfo;
        $like->likes  = true;
        $like->save();

        $allLikes = count(Like::all());
        return $allLikes;
*/
        return $ala;
    }

    // shopping_cart
    public function getCart()
    {
        if(!Session::has('cart'))
        {
            return view('store.shopping-cart');
        }

        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);

        return view('store.shopping-cart')->with('products', $cart->items)->with('totalPrice', $cart->totalPrice);
    }
    // checkout
    public function getCheckout()
    {
        if(!Session::has('cart')){
            return view('store.shopping-cart');
        }

        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);

        return view('store.checkout')->with('cart', $cart);
    }
    // checkout
    public function postCheckout(Request $request)
    {
        $this->validate($request, [
            'name'      => 'required',
            'last_name' => 'required',
            'email'     => 'required',
            'phone'     => 'required',
            'address'  => 'required',
            'delivery_method'  => 'required',
            'payment_method'  => 'required',
        ]);

        if(!Session::has('cart'))
        {
            return redirect()->route('shop.shoppingCart');
        }

        $oldCart = Session::get('cart');

        $cart = new Cart($oldCart);

        $order = new Order();
        $order->user_id         = $request->input('user_id');
        $order->name            = $request->input('name');
        $order->last_name       = $request->input('last_name');
        $order->email           = $request->input('email');
        $order->phone           = $request->input('phone');
        $order->address         = $request->input('address');
        $order->delivery_method = $request->input('delivery_method');
        $order->payment_method  = $request->input('payment_method');
        $order->company         = $request->input('company');
        $order->bulstat         = $request->input('bulstat');
        $order->note            = $request->input('note');
        $order->cart = base64_encode(serialize($cart));

        if(isset(Auth::user()->name))
        {
            Auth::user()->orders()->save($order);
        }
        else
        {
            $order->save();
        }

        Session::forget('cart');

        return redirect()->route('store.index');
    }

    // show-pages
    public function getShowPages(Request $request)
    {
        $active_page = Page::where('active_page', true)->get();
        $page = $active_page->where('url_page', $request->input('show'))->first();

        return view('store.show-pages')->with('page', $page);
    }
    // show users orders
    public function viewUserOrders($id)
    {
        if (Auth::check())
        {
            $userOrders = Order::where('user_id', $id)->orderBy('created_at', 'desc')->paginate(9);;

            return view('store.view-user-orders')->with('user_orders', $userOrders);
        }
        else
        {
          echo "process denied";
        }
    }

    // add & remove products
    public function getAddToCart(Request $request)
    {
        $product = Product::find($request->input('product_id'));
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($product, $product->id, $request->input('product_quantity'));
        $request->session()->put('cart', $cart);
        $cart_product = [$cart->totalPrice, $cart->totalQty, $cart->items];

        return $cart_product;
    }

    public function getRemoveItem($id)
    {

        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->removeItem($id);

        if (count($cart->items) > 0)
        {
            Session::put('cart', $cart);
        }
        else
        {
            Session::forget('cart');
        }

        $cart_product = [$cart->totalPrice, $cart->totalQty, $cart->items];

        return $cart_product;
    }

    // search products
    public function search(Request $request)
    {
        $categories = Category::all();
        $subCategories = SubCategory::all();

        $search_keyword = $request->input('keyword');
        $search_category = $request->input('category');
        $name = mb_strtolower($search_keyword);
        $name_pattern = preg_replace('/\s+/', '|', $name);
        $get_products = Product::where('active', true);

        if (isset($search_keyword) && isset($search_category))
        {
            $products_of_category = $get_products->where('identifier', $search_category)->paginate(9);
            $products = $this->get_filter_product($products_of_category, $name_pattern);
        }
        elseif(isset($search_keyword))
        {
            $products = $this->get_filter_product($get_products, $name_pattern)->paginate(9);
        }
        else
        {
            $products = $get_products->where('identifier', $search_category)->paginate(9);
        }

        if(empty($products))
        {
            $products = $get_products->where('recommended', true)->paginate(9);
        }

        return view('store.index')->with('categories', $categories)->with('subCategories', $subCategories)->with('products', $products);
    }

    public function get_filter_product($get_products, $name_pattern)
    {
        $searched_products = array();
        foreach ($get_products as $key => $product)
        {
            $product_description = json_decode($product->description, true);
            if(preg_match('/'.$name_pattern.'/', mb_strtolower($product_description['title_product'])))
            {
                array_push($searched_products,  $get_products[$key]);
            }
        }

        return $searched_products;
    }
}
