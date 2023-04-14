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
            font-size: 30px;
           padding-top: 20px; 

        }
        .img_size{
            width:150px;
            height:150px;
        }
        .th_color{
            background: skyblue;
            border:2px solid white;
        }
        .th_dg{
            padding:10px;
            border:2px solid white
            
        }
        td{
          border:2px solid white
        }
      </style>
      <!-- partial:partials/_sidebar.html -->
      @include('admin.sidebar')
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_navbar.html -->
        @include('admin.navbar')
        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">
                <h1  style = "padding-bottom:10px"  class = "font_size">All Orders</h1>

                <div style = "padding-left:400px;">
                  <form action="{{url('search')}}"method = "GET">
                    <input style = "color:black" type="search" name = "search" placeholder = "SEARCH">

                    <input type="submit" value="Search" class = "btn btn-outline-primary">
                  </form>
                </div>
                <table class = "center">
                    <tr class = "th_color">
                        <th class = "th_dg">Name</th>
                        <th class = "th_dg">Email</th>
                        <th class = "th_dg">Address</th>
                        <th class = "th_dg">Product Title</th>
                        <th class = "th_dg">Product Quantity</th>                        
                        <th class = "th_dg">Product Price</th>
                        <th class = "th_dg">User Id</th>
                        <th class = "th_dg">Product Image</th>
                        <th class = "th_dg">Payment Status</th>
                        <th class = "th_dg">Delivery Status</th>          
                        <th class = "th_dg">Deliver</th>
                        <th class = "th_dg">Print PDF</th>



                    </tr>
                    @forelse($order as $orders)
                    <tr>
                        <td>{{$orders->name}}</td>
                        <td>{{$orders->email}}</td>
                        <td>{{$orders->address}}</td>
                        <td>{{$orders->product_title}}</td>
                        <td>{{$orders->product_quantity}}</td>
                        <td>{{$orders->price}}</td>
                        <td>{{$orders->user_id}}</td>
                        <td><img src="/product/{{$orders->product_image}}" alt=""></td>
                        <td>{{$orders->payment_status}}</td>
                        <td>{{$orders->delivery_status}}</td>
                        <td>

                          @if($orders->delivery_status == 'processing') 

                          <a onclick = "return confirm('Are you sure ?')"href="{{url('delivered',$orders->id)}}" class = "btn btn-warning" value ="">Deliver</a>
                          @else <a href="" class = "btn btn-success" value ="">Delivered</a>

                        @endif
                        </td>     
                        <td>
                          <a href="{{url('print_pdf',$orders->id)}}" class = "btn btn-secondary">Print PDF</a>
                        </td>

                    </tr>
                    @empty
                    <tr>
                      <td colspan = "16">
                     NO DATA FOUND
                      </td>
                    </tr>
                  
                      
                   
                    @endforelse
               
                </table>
                <div style = "padding-top:50px">
 
         </div> 

            </div>
        {!!$order->withQueryString()->links('pagination::bootstrap-5')!!}

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