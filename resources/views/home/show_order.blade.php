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

      <style>
        .center{
           margin:auto;
           width:80%;
           padding-top: 50px;
           padding-left: 150px;
           text-align: center;
        }

        table,th,td{
            border: 2px solid black;
        }
        .th_dg{
            padding:10px;
            font-size: 20px;
            background-color: skyblue;
            font-weight: bold;
        }
      </style>
   </head>
   <body>
  
         <!-- header section strats -->
         @include('home.header')
        

         <div class = "center">
            <table>

<tr>
    <th class = "th_dg">Product Title</th>
    <th class = "th_dg">Quantity</th>
    <th class = "th_dg">Price</th>
    <th class = "th_dg">Payment Status</th>
    <th class = "th_dg">Delivery Status</th>
    <th class = "th_dg">Image</th>
    <th class = "th_dg">Cancel</th>
</tr>

@foreach($order as $order)
<tr>
    <td>{{$order->product_title}}</td>
    <td>{{$order->product_quantity}}</td>
    <td>{{$order->price}}</td>
    <td>{{$order->payment_status}}</td>
    <td>{{$order->delivery_status}}</td>
    <td><img height ="150px" width = "150px" src="/product/{{$order->product_image}}"></td>
    @if($order->delivery_status == "processing")
    <td><a onclick = "return confirm('Are you sure ?') "class = "btn btn-danger" href="{{url('cancel_order',$order->id)}}">Cancel</a></td>
    @else
    <td>NO ACTION</td>
    @endif


</tr>
@endforeach



            </table>


         </div>


    
      <!-- why section -->
      
      <!-- jQery -->
      
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