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
@if (session()->has('Edit'))
<script>
alert("Product Edited Successfully")
</script>
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
                <h1 class = "font_size">Edit Product</h1>
<form action="{{url('/edit_product_save',$product->id)}}" method="POST" enctype="multipart/form-data">
    @csrf            
    <div class = "design">
                <label for="title">Product Title</label>
                <input value = "{{$product->title}}" class = "text_color"  required ="" type="text" name="title" placeholder="Title">
                </div>
                
                <div class = "design">
                <label for="description">Product Description</label>
                <input  value = "{{$product->description}}" class = "text_color" required ="" type="text" name="description" placeholder="Description">
                </div>

                <div class = "design">
                <label for="price">Product Price</label>
                <input  value = "{{$product->price}}" class = "text_color" required ="" type="number" name="price" placeholder="Price">
                </div>

                <div class = "design">
                <label for="quantity">Product Quantity</label>
                <input  value = "{{$product->quantity}}" class = "text_color" required ="" type="number" name="quantity" min ="0" placeholder="Quantity">
                </div>

                <div class = "design">
                <label for="discount">Discount Price</label>
                <input  value = "{{$product->discount_price}}" class = "text_color" type="number" name="discount" placeholder="Discount">
                </div>

                <div class = "design">
                <label for="category">Product Category</label>
                <select class = "text_color" name="category" id="" required ="">
                    <option value=" {{$product->category}}" selected ="">{{$product->category}}</option>
                    @foreach($category as $category)
                    <option value="{{$category->category_name}}">{{$category->category_name}}</option>
                    @endforeach
                </select>      
                </div>

                <div class = "design">
                    <label for="image">Current Product Image</label>
                    <img style = "margin:auto" height = "150" width = "150" src="/product/{{$product->image}}">                    </div>
                
            
                <div class = "design">
                    <label for="image">Change Image</label>
                    <input type="file" name="image">
                    </div>

                    <div class = "design">
                        <input type="submit" value="Edit Product" class = "btn btn-primary">
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