<!DOCTYPE html>
<html>
    <head>
        <!-- Basic -->
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- Mobile Metas -->
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <!-- Site Metas -->
        <meta name="keywords" content="" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <link rel="shortcut icon" href="{{asset('images/favicon.png')}}" type="">
        <title>Famms - Fashion HTML Template</title>
        <!-- bootstrap core css -->
        <link rel="stylesheet" type="text/css" href="{{asset('home/css/bootstrap.css')}}" />
        <!-- font awesome style -->
        <link href="{{asset('home/css/font-awesome.min.css')}}" rel="stylesheet" />
        <!-- Custom styles for this template -->
        <link href="{{asset('home/css/style.css')}}" rel="stylesheet" />
        <!-- responsive style -->
        <link href="{{asset('home/css/responsive.css')}}" rel="stylesheet" />
     </head>
  
  
 <style>
    .center{
        margin:auto;
        width:auto;
        border:2px solid white;
        padding-top:30px;
        padding-bottom:30px;
        text-align: center;
    }
    table,th,td{
        border: 1px solid black;

    }

    .font_size{
        text-align: center;
        font-size: 40px;
       padding-top: 20px; 

    }
    .img_size{
        width:150px;
        height:150px;
    }
    .th_color{
        background: skyblue;
    }
    .th_dg{
        padding:30px;
    }
  </style>
   <body>
    @if (Session::has('message'))
    <div class="alert alert-success text-center">
        <a href="/" class="close" data-dismiss="alert" aria-label="close">×</a>
        <p>{{ Session::get('message') }}</p>
    </div>
@endif
      <div class="hero_area">
         <!-- header section strats -->
         @include('home.header')
   
      <div class="center">
        <h1 class = "font_size">Cart</h1>

        <table>
            <tr class = "th_color">
                <th class = "th_dg">Product Title</th>
                <th class = "th_dg">Product Quantity</th>
                <th class = "th_dg">Price</th>
                <th class = "th_dg">Image</th>
                <th class = "th_dg">Action</th>

            </tr>
            <?php $totalprice = 0; ?>
            @foreach($cart as $cart)
            <tr>
                <td>{{$cart->product_title}}</td>
                <td>{{$cart->product_quantity}}</td>
                <td>{{$cart->price}}</td>
                <td><img class = "img_size" src="/product/{{$cart->product_image}}"></td>
                <td><a onclick="return  confirm('Are you sure')" class = "btn btn-danger"href="{{url('remove_cart',$cart->id)}}">Remove Product</a></td>
              
            </tr>
            <?php $totalprice = $totalprice + $cart->price?>
            @endforeach
        </table> 
                     {{"Total Price : ". $totalprice}}


                     <div>
                        <h1>
                            Proceed to Order
                        </h1>
                        <a class = "btn btn-danger"href="{{url('cash_order')}}">Cash on Delivery</a>
                        <a class = "btn btn-danger"href="{{url('stripe',$totalprice)}}">Pay using Card</a>

                     </div>


    </div>


   
  <!-- footer end -->
      <div class="cpy_">
         <p class="mx-auto">© 2021 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a><br>
         
            Distributed By <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>
         
         </p>
      </div>
      
      <!-- jQery -->
      <script src="{{asset('home/js/jquery-3.4.1.min.js')}}"></script>
      <!-- popper js -->
      <script src="{{asset('home/js/popper.min.js')}}"></script>
      <!-- bootstrap js -->
      <script src="{{asset('home/js/bootstrap.js')}}"></script>
      <!-- custom js -->
      <script src="{{asset('home/js/custom.js')}}"></script>
   </body>
</html>