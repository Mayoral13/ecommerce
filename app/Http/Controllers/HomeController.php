<?php

namespace App\Http\Controllers;
use Stripe;
use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Reply;
use App\Models\Comment;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function redirect(){
        $user = Auth::id();
       
        if($user){
            $total_product = Product::all()->count();
            $total_order = Order::all()->count();
            $total_user = User::all()->count();
            $order = Order::all();
            $total_revenue = 0;

            foreach($order as $order){

                $total_revenue += $order->price;
            }

            $total_delivered = Order::where('delivery_status','=','delivered')->get()->count();
            $total_processing = Order::where('delivery_status','=','processing')->get()->count();

          return view('admin.home',compact('total_product','total_order','total_user',
          'total_revenue','total_delivered','total_processing'));
        }else{
                $product = Product::paginate(3);
                $comment = Comment::orderby('id','desc')->get();
                $reply = Reply::all();
              return view('home.userpage',compact('product','comment','reply'));
        }
    }

    public function index(){
        $product = Product::paginate(3);
        $comment = Comment::orderby('id','desc')->get();
        $reply = Reply::all();
        return view('home.userpage',compact('product','comment','reply'));
    }

    public function logout(){
        Session::flush();
        
        Auth::logout();

        return redirect('/');
    }

    public function profile(){
        return redirect('user/profile');
    }

    public function product_details($id){
        $products = Product::find($id);
        return view('home.product_details',compact('products'));
   
    }

    public function add_cart(Request $req,$id){
        if(Auth::id()){
           $user = Auth::user();
           $user_id = $user->id;
          $product = Product::find($id);
          $product_exist_id = Cart::where('product_id','=',$id)->where('user_id','=',$user_id)->get('id')->first();
          if($product_exist_id){
            $cart = Cart::find($product_exist_id)->first();
            $quantity = $cart->product_quantity;
            $cart->product_quantity = $quantity + $req->quantity;
            if($product->discount_price != null){
                $cart->price = $product->discount_price * $cart->product_quantity;
              }else{
                $cart->price = $product->price * $cart->product_quantity;
              }
            $cart->save();
            return redirect()->back();

          }else{

            $cart = new Cart;
          $cart->name = $user->name;
          $cart->email = $user->email;
          $cart->phone = $user->phone;
          $cart->address = $user->address;
          $cart->product_title = $product->title;
          $cart->product_quantity = $req->quantity;
          $cart->product_image = $product->image;
          $cart->product_id = $product->id;
          $cart->user_id = $user->id;
          if($product->discount_price != null){
            $cart->price = $product->discount_price * $req->quantity;
          }else{
            $cart->price = $product->price * $req->quantity;
          }
          
          $cart->save();
          return redirect()->back();
          }
          

        

        }else{
            return redirect('register');
        }
    }

    public function show_cart(){
        if(Auth::id()){
        $id = Auth::user()->id;
        $cart = Cart::where('user_id','=',$id)->get();
        return view('home.show_cart',compact('cart')); 
        }else{
            return redirect('register');
        }
        
    }
    public function remove_cart($id){
        $cart = Cart::find($id);
        $cart->delete();
        return redirect()->back(); 
    }
    public function cash_order(){
        $user = Auth::user();
        $userid = $user->id;
        $data = Cart::where('user_id','=',$userid)->get();
        foreach($data as $data){

            $order = new Order;
            $order->name = $data->name;
            $order->email = $data->email;
            $order->phone = $data->phone;
            $order->address = $data->address;
            $order->product_title = $data->product_title;
            $order->product_quantity = $data->product_quantity;
            $order->product_image = $data->product_image;
            $order->product_id = $data->product_id;
            $order->user_id = $data->user_id;
            $order->price = $data->price;
            $order->payment_status = 'cash on delivery';
            $order->delivery_status = 'processing';
            $order->save();

            $cart_id = $data->id;
            $cart= Cart::find($cart_id);
            $cart->delete();

        }
        return redirect()->back()->with('message','Order Recieved');
    }

    public function stripe(Request $req){
        $totalprice = $req->totalprice;
        return view('home.stripe',compact('totalprice'));
    }


    public function stripePost(Request $request,$totalprice)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
    
        Stripe\Charge::create ([
                "amount" => $totalprice * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Thanks for Payment" 
        ]);
      
        Session::flash('success', 'Payment successful!');
        $user = Auth::user();
        $userid = $user->id;
        $data = Cart::where('user_id','=',$userid)->get();
        foreach($data as $data){

            $order = new Order;
            $order->name = $data->name;
            $order->email = $data->email;
            $order->phone = $data->phone;
            $order->address = $data->address;
            $order->product_title = $data->product_title;
            $order->product_quantity = $data->product_quantity;
            $order->product_image = $data->product_image;
            $order->product_id = $data->product_id;
            $order->user_id = $data->user_id;
            $order->price = $data->price;
            $order->payment_status = 'Paid Using Card';
            $order->delivery_status = 'processing';
            $order->save();
            $cart_id = $data->id;
            $cart= Cart::find($cart_id);
            $cart->delete();
        }

        return back();
    }

    public function show_order(){
        if(Auth::id()){
            $user = Auth::user();
            $userid = $user->id;
            $order = Order::where('user_id','=',$userid)->get(); 
        return view('home.show_order',compact('order'));
        }
        else{
            return redirect('register');
        }
    }
    public function cancel_order($id){
     $order = Order::find($id);
     if($order){
        $order->delivery_status = "Canceled";
        $order->save();
        return redirect()->back();
     }else{
        return redirect()->back();
     }
    }


     public function add_comment(Request $req){
        if(Auth::id()){
            $data = $req->comment;
            $user = Auth::user();
            $userid = $user->id;
            $username = $user->name;
            $comment = new Comment;
            $comment->name = $username;
            $comment->comment = $data;
            $comment->user_id = $userid;
            $comment->save();
            return redirect()->back();
        }
        else{
            return redirect('register');
        }
     }

     public function add_reply(Request $req){
        if(Auth::id()){
            $reply = new Reply;
            $reply->name = Auth::user()->name;
             $reply->user_id = Auth::user()->id;
             $reply->comment_id = $req->commentId;
             $reply->reply = $req->reply;
             $reply->save();
            return redirect()->back();
        }
        else{
            return redirect('register');
        }
     }
     public function product_search(Request $req){
        $search = $req->search;
        $product = Product::where('title','LIKE',"%$search%")->orWhere('description','LIKE',"%$search%")->orWhere('category','LIKE',"%$search%")->paginate();
        $comment = Comment::orderby('id','desc')->get();
        $reply = Reply::all();
        return view('home.userpage',compact('product','comment','reply'));
    }

    public function product(){
        $product = Product::paginate(3);
        $comment = Comment::orderby('id','desc')->get();
        $reply = Reply::all();
        return view('home.all_product',compact('product','comment','reply'));
    }

    public function search_product(Request $req){
        $search = $req->search;
        $product = Product::where('title','LIKE',"%$search%")->orWhere('description','LIKE',"%$search%")->orWhere('category','LIKE',"%$search%")->paginate();
        $comment = Comment::orderby('id','desc')->get();
        $reply = Reply::all();
        return view('home.all_product',compact('product','comment','reply'));
    }

}

 