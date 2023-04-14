<!DOCTYPE html>
<html lang="en">
@include('admin.style')
  <body>
    <div class="container-scroller">
      <div class="row p-0 m-0 proBanner" id="proBanner">
        <div class="col-md-12 p-0 m-0">
          <div class="card-body card-body-padding d-flex align-items-center justify-content-between">
            <div class="ps-lg-1">
              <div class="d-flex align-items-center justify-content-between">
                <p class="mb-0 font-weight-medium me-3 buy-now-text">Free 24/7 customer support, updates, and more with this template!</p>
                <a href="https://www.bootstrapdash.com/product/corona-free/?utm_source=organic&utm_medium=banner&utm_campaign=buynow_demo" target="_blank" class="btn me-2 buy-now-btn border-0">Get Pro</a>
              </div>
            </div>
            <div class="d-flex align-items-center justify-content-between">
              <a href="https://www.bootstrapdash.com/product/corona-free/"><i class="mdi mdi-home me-3 text-white"></i></a>
              <button id="bannerClose" class="btn border-0 p-0">
                <i class="mdi mdi-close text-white me-0"></i>
              </button>
            </div>
          </div>
        </div>
      </div>
      <style>
        .center{
            margin:auto;
            width:90%;
            border:2px solid white;
            margin-top:30px;
            text-align: center;
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

@if (Session::has('deletion'))
<div class="alert alert-success text-center">
    <a href="/" class="close" data-dismiss="alert" aria-label="close">×</a>
    <p>{{ Session::get('deletion') }}</p>
</div>
@endif
      <!-- partial:partials/_sidebar.html -->
      @include('admin.sidebar')
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_navbar.html -->
        @include('admin.navbar')
        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">
                <h1 class = "font_size">All Products</h1>

                <table class = "center">
                    <tr class = "th_color">
                        <th class = "th_dg">Product Title</th>
                        <th class = "th_dg">Description</th>
                        <th class = "th_dg">Quantity</th>
                        <th class = "th_dg">Category</th>
                        <th class = "th_dg">Price</th>
                        <th class = "th_dg">Discount Price</th>
                        <th class = "th_dg">Product Image</th>
                        <th class = "th_dg">Delete</th>
                        <th class = "th_dg">Edit</th>

                    </tr>
                    @foreach($product as $product)
                    <tr>
                        <td>{{$product->title}}</td>
                        <td>{{$product->description}}</td>
                        <td>{{$product->category}}</td>
                        <td>{{$product->quantity}}</td>
                        <td>{{$product->price}}</td>
                        <td>{{$product->discount_price}}</td>
                        <td><img class = "img_size" src="/product/{{$product->image}}"></td>
                        <td><a onclick = "return confirm('Are you sure')"  class = "btn btn-danger" href="{{url('delete_product',$product->id)}}">Delete</a></td>
                        <td><a class = "btn btn-warning" href="{{url('edit_product',$product->id)}}">Edit</a></td>
                      
                    </tr>
                    @endforeach
                </table>

            </div>
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.script')
      </body>
</html>