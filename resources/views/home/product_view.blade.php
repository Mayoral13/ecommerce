<section class="product_section layout_padding">
    <div class="container">
       <div class="heading_container heading_center">
          

          <div>
      <form action="{{url('search_product')}}" method="GET">
               @csrf
               <input style = "width:500px"type="search" name="search" placeholder="Search">
            <input type="submit" value="Search">
            </form>
          </div>
       </div>
       
       <div class="row">
         @foreach($product as $products)
          <div class="col-sm-6 col-md-4 col-lg-4">
             <div class="box">
                <div class="option_container">
                   <div class="options">
                      <a href="{{url('product_details',$products->id)}}" class="option1">
                      Product Details
                      </a>
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
                <div class="img-box">
                   <img src=" product/{{$products->image}}" alt="">
                </div>
                <div class="detail-box">
                   <h5>
                     {{$products->title}}
                   </h5>
                   @if($products->discount_price != null)
                   <h6 style = "color:red">
                     ${{$products->discount_price}}
                   </h6>

                   <h6 style = "text-decoration:line-through;color:blue">
                     ${{$products->price}}
                   </h6>
                   @else
                   <h6 style = "color:blue">
                     ${{$products->price}}
                   </h6>
                   @endif
                   
                   
             </div>
          </div>
       </div>

        @endforeach
        <div style = "padding-top:50px">
                 {!!$product->withQueryString()->links('pagination::bootstrap-5')!!}    

        </div>


    </div>

 </section>