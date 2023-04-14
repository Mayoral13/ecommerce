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
      @if (Session::has('product'))
      <div class="alert alert-success text-center">
          <a href="/" class="close" data-dismiss="alert" aria-label="close">×</a>
          <p>{{ Session::get('product') }}</p>
      </div>
  @endif
      
      <style type = "text/css">
      .div_center{
        text-align:center;
        padding-top:40px;
      }
      .font_size{
        font-size:40px;
        padding-bottom: 40px;
      }
      .text_color{
        color:black;
        padding-bottom: 20px;
      }
      label{
        display:inline-block;
        width:200px;
      }

      .design{

        padding-bottom:10px;
      }
      </style>
      <!-- partial:partials/_sidebar.html -->
      @include('admin.sidebar')
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_navbar.html -->
        @include('admin.navbar')
        <!-- partial -->
        <!-- main-panel ends -->
        <div class="main-panel">
            <div class="content-wrapper">

              <div class="div_center">
                <h1 class = "font_size">Add Product</h1>
<form action="{{url('/add_product')}}" method="POST" enctype="multipart/form-data">
    @csrf            
    <div class = "design">
                <label for="title">Product Title</label>
                <input class = "text_color"  required ="" type="text" name="title" placeholder="Title">
                </div>
                
                <div class = "design">
                <label for="description">Product Description</label>
                <input class = "text_color" required ="" type="text" name="description" placeholder="Description">
                </div>

                <div class = "design">
                <label for="price">Product Price</label>
                <input class = "text_color" required ="" type="number" name="price" placeholder="Price">
                </div>

                <div class = "design">
                <label for="quantity">Product Quantity</label>
                <input class = "text_color" required ="" type="number" name="quantity" min ="0" placeholder="Quantity">
                </div>

                <div class = "design">
                <label for="discount">Discount Price</label>
                <input class = "text_color" type="number" name="discount" placeholder="Discount">
                </div>

                <div class = "design">
                <label for="category">Product Category</label>
                <select class = "text_color" name="category" id="" required ="">
                    <option value="" selected ="">Add a category</option>
                    @foreach($category as $category)
                    <option value="{{$category->category_name}}">{{$category->category_name}}</option>
                    @endforeach
                </select>      
                </div>

                <div class = "design">
                    <label for="image">Product Image</label>
                    <input type="file" name="image" required ="">
                    </div>

                    <div class = "design">
                        <input type="submit" value="Add Product" class = "btn btn-primary">
                    </div>

    </form>
            </div>  
            </div>
        </div>
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.script')
      </body>
</html>