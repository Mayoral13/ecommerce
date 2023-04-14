<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;


class AdminController extends Controller
{
    public function view_category(){
        if(Auth::id()){
        $data = Category::all();
        return view('admin.category',compact('data'));
        }else{
            return redirect('register');
        }
    }
    public function add_category(Request $req){
        if(Auth::id()){
       $data = new Category;
       $data->category_name = $req->name;
       $data->save();
       return redirect()->back()->with('message','Category Added');
        }else{
            return redirect('register');
        }

   }
   public function delete_category($id){
    if(Auth::id()){
    $data = Category::find($id);
    $data->delete();
    return redirect()->back()->with('delete','Category Deleted');
    }else{
        return redirect('register');
    }

}
   public function view_product(){
    if(Auth::id()){
    $category = Category::all();

    return view('admin.product',compact('category'));
    }else{
        return redirect('register');
    }
   }

   public function add_product(Request $req){
    if(Auth::id()){
    $data = new Product;
    $data->title = $req->title;
    $data->description = $req->description;
//    $data->image = $req->image; wrong format
    $data->category = $req->category;
    $data->quantity = $req->quantity;
    $data->price = $req->price;
    $data->discount_price = $req->discount;
    //START OF SAVING IMAGE
    $image = $req->image;
    $imagename = time().'.'.$image->getClientOriginalExtension();
    $req->image->move('product',$imagename);
    $data->image = $imagename;
    //END OF SAVING IMAGE
    $data->save();
    return redirect()->back()->with('product','Product Added Successuflly');
    }else{
        return redirect('register');
    }

}

public function show_product(){
    if(Auth::id()){
    $product = Product::all();
    return view('admin.show_product',compact('product'));
    }else{
        return redirect('register');
    }
}
public function edit_product($id){
    if(Auth::id()){
    $product = Product::find($id);
    $category = Category::all();

    return view('admin.edit_product',compact('category','product'));
}else{
    return redirect('register');
}
}

public function delete_product($id){
    if(Auth::id()){
    $product = Product::find($id);
    $product->delete();
    return redirect()->back()->with('deletion','Product Deleted');
    }else{
        return redirect('register');
    }
}

public function edit_product_save(Request $req,$id){
    if(Auth::id()){
    $data = Product::find($id);
    $data->title = $req->title;
    $data->description = $req->description;
//    $data->image = $req->image; wrong format
    $data->category = $req->category;
    $data->quantity = $req->quantity;
    $data->price = $req->price;
    $data->discount_price = $req->discount;
    $image = $req->image;
    //START OF SAVING IMAGE
    if($image){
    $imagename = time().'.'.$image->getClientOriginalExtension();
    $req->image->move('product',$imagename);
    $data->image = $imagename;  
    }
 
    //END OF SAVING IMAGE
    $data->save();
    return redirect()->back()->with('Edit','Product Edited Successuflly') ;
}else{
    return redirect('register');
}

}
public function order(){
    if(Auth::id()){
 $order = Order::paginate(5);
 return view('admin.order',compact('order'));
}else{
    return redirect('register');
}
}


public function delivered($id){
    if(Auth::id()){
$order = Order::find($id);
    $order->delivery_status = "delivered";
    $order->payment_status = "paid";
    $order->save();
    return redirect()->back();
    }else{
        return redirect('register');
    }
}
public function print_pdf($id){
    if(Auth::id()){
    $order = Order::find($id);
    $pdf = Pdf::loadView('admin.pdf',compact('order'));
    return $pdf->download('order_details.pdf');
}else{
    return redirect('register');
}
}
public function search(Request $req){
    if(Auth::id()){
    $search = $req->search;
    $order = Order::where('name','LIKE',"%$search%")->orWhere('phone','LIKE',"%$search%")->orWhere('product_title','LIKE',"%$search%")->get();
    return view('admin.order',compact('order'));

}else{
    return redirect('register');
}   
}

}
