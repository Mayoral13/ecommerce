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
    #product{
        margin: auto;
        width:50%; 
        padding:30px;
    }
   </style>
   <body>
      <div class="hero_area">
         <!-- header section strats -->
         @include('home.header')
         <!-- end header section -->
         <!-- slider section -->
       
         <!-- end slider section -->


      <div class="col-sm-6 col-md-4 col-lg-4" id = "product">
        <div class="box">
           <div class="option_container">
           </div>
           <div class="img-box" style = "padding-bottom:20px">
              <img src="/product/{{$products->image}}" alt="">
           </div>
           <div class="detail-box">
              <h5>
                {{$products->title}}
              </h5>
              @if($products->discount_price != null)
              <h6 style = "color:red">
               Discount Price : ${{$products->discount_price}}
              </h6>

              <h6 style = "text-decoration:line-through;color:blue">
                Product Price : ${{$products->price}}
              </h6>
              @else
              <h6 style = "color:blue">
                Product Price :${{$products->price}}
              </h6>
              @endif
              <h6>Product Category : {{$products->category}}</h6>
              <h6>Product Details : {{$products->description}}</h6>
              <h6> Available Quantity : {{$products->quantity}}</h6>
              <form action="{{url('/add_cart',$products->id)}}"method = "POST">
                @csrf
                <div class = "row">
                   <div class = "col-md-4">
                <input type="number" style = "width:100px" name="quantity" id="" value = "1" min = "1" max = "{{$products->quantity}}">
                   </div>
                   <div class = "col-md-4">
                <input type="submit" value="Add To Cart">
                   </div>
                </div>
                
              </form>              
        </div>
     </div>
      </div>
      <!-- why section -->
   
      <!-- footer start -->
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