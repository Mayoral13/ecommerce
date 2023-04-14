<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order Details</title>
</head>
<body>
    <h1>Order Details</h1>
    <h3>Customer Name : {{$order->name}}</h3>
    <h3>Customer Email : {{$order->email}}</h3>
    <h3>Customer Phone : {{$order->phone}}</h3>
    <h3>Customer address :{{$order->address}}</h3>
    <h3>Total Price : ${{$order->price}}</h3>
    <h3>Product Title : {{$order->product_title}}</h3>
    <h3>Product Quantity : {{$order->product_quantity}}</h3>
    <h3>Customer ID : {{$order->user_id}}</h3>
    <h3>Payment Status : {{$order->payment_status}}</h3>
    <h3>Delivery Status : {{$order->delivery_status}}</h3>
    <h3>Order Time : {{$order->created_at}}</h3>
    <br><br>
    <h3>Product Image</h3>

    <img height = "250" width = "250" src="/product/{{$order->product_image}}" alt="">
</body>
</html>