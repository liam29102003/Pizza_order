@extends('user.layouts.master')
@section('name')
    <span class="content ms-3 mt-2">
                                            <a class="js-acc-btn" href="{{route('user#profile')}}">{{Auth::user()->name}}</a>
                                        </span>
@endsection
@section('category')
    <div class="col-lg-3 d-none d-lg-block">
                <div class="btn d-flex align-items-center justify-content-between bg-primary w-100"  style="height: 70px; padding: 0 30px;">
                    <h4 class="text-dark m-0 " style="font-weight: 900">Product Details</h4>
                </div>

            </div>
@endsection
@section('logout')
     <div class="mt-2" style=>
       <form action="{{route('logout')}}" method="post" class="">
           @csrf
       <button class="btn btn-dark" style="margin-left:5px"><i class="fa-solid fa-right-from-bracket" style="margin-right:5px" ></i><span class="text-warning">Logout</span>
           </button>
       </form>
     </div>

@endsection
@section('content')
    <div class="container-fluid pb-5">
        <div class="row px-xl-5">
            <div class="col-lg-5 mb-30">
                <div id="product-carousel" class="carousel slide" data-ride="carousel">
                    <div class="bg-light">
                        <div class="">
                            <img class="w-100 h-100" src="{{asset('storage/'.$products->image)}}" alt="Image">
                        </div>
<input type="hidden" class="form-control bg-secondary border-0 text-center" value="{{$products->id}}" id='productId'>
                            <input type="hidden" class="form-control bg-secondary border-0 text-center" value="{{Auth::user()->id}}" id= 'userId'>
                    </div>

                </div>
            </div>

            <div class="col-lg-7 h-auto mb-30">
                <div class="h-100 bg-light p-30">
                    <h2 class="text-warning">{{$products->name}}</h2>
                    <div class="d-flex mb-3">
                        <small class="pt-1">{{$products->view_count + 1}}&nbsp;views</small>
                    </div>
                    <h3 class="font-weight-semi-bold mb-4">{{$products->price}} kyats</h3>

                    <p class="">{{$products->description}}</p>
                    <h5 class="mb-4">Waiting-time&nbsp;->&nbsp;{{$products->waiting_time}}&nbsp;Minutes</h5>
                    <div class="d-flex align-items-center mb-4 pt-2">
                        <div class="input-group quantity mr-3" style="width: 130px;">
                            <div class="input-group-btn">
                                <button class="btn btn-primary btn-minus">
                                    <i class="fa fa-minus"></i>
                                </button>
                            </div>
                            <input type="text" class="form-control bg-secondary border-0 text-center" value="1" id='productCount'>

                            <div class="input-group-btn">
                                <button class="btn btn-primary btn-plus">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <button class="btn btn-primary px-3" id = "addCart"><i class="fa fa-shopping-cart mr-1"></i> Add To
                            Cart</button>
                    </div>
                    <div class="d-flex pt-2">
                        <strong class="text-dark mr-2">Share on:</strong>
                        <div class="d-inline-flex">
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-pinterest"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="container-fluid py-5">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">You May Also Like</span></h2>
        <div class="row px-xl-5">
            <div class="col">
                <div class="owl-carousel related-carousel">
                    @foreach($allproducts as $allproduct)
                    <div class="product-item bg-light" >
                        <div class="product-img position-relative overflow-hidden ">
                            <img class="img-fluid w-100" src="{{asset('storage/'.$allproduct->image)}}" alt=""style='height:200px'>
                            <div class="product-action">
                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                <a class="btn btn-outline-dark btn-square" href="{{route('user#pizzaDetail',$allproduct->id)}}"><i class="far fa-info"></i></a>
                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-sync-alt"></i></a>
                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-search"></i></a>
                            </div>
                        </div>
                        <div class="text-center py-4">
                            <a class="h6 text-decoration-none text-truncate" href="">{{$allproduct->name}}</a>
                            <div class="d-flex align-items-center justify-content-center mt-2">
                                <h5>$123.00</h5><h6 class="text-muted ml-2"><del>$123.00</del></h6>
                            </div>
                            <div class="d-flex align-items-center justify-content-center mb-1">
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small>(99)</small>
                            </div>
                        </div>
                    </div>
                    @endforeach




                </div>
            </div>
        </div>
    </div>
@endsection
@section('scriptSource')
<script>
    $(document).ready(function()
    {
        $.ajax({
                type : 'get',
                url : 'http://localhost/Pizza/public/ajax/view',
                data:{'id' : $('#productId').val()},
                dataType : 'json',
        });
        $('#addCart').click(function()
        {
            console.log($('#userId').val());
            console.log($('#productId').val());
            console.log($('#productCount').val());

            $source = {
                'userId' : $('#userId').val(),
                'productId' : $('#productId').val(),
                'count' : $('#productCount').val(),
            };
             $.ajax({
                type : 'get',
                url : 'http://localhost/Pizza/public/ajax/pizza/addCart',
                data:$source,
                dataType : 'json',
                success : function(response){
                    if(response.status == 'success')
                    {
                        window.location.href = 'http://localhost/Pizza/public/user/userHome'
                    }
                }})
        })

    })
    </script>
@endsection
