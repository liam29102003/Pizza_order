@extends('user.layouts.master')

@section('name')
    <span class="content ms-2">
                                            <a class="js-acc-btn" href="{{route('user#profile')}}">{{Auth::user()->name}}</a>
                                        </span>
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
@section('category')
    <div class="col-lg-3 d-none d-lg-block">
                <a class="btn d-flex align-items-center justify-content-between bg-primary w-100" data-toggle="collapse" href="#navbar-vertical" style="height: 70px; padding: 0 30px;">
                    <h6 class="text-dark m-0"><i class="fa fa-bars mr-2"></i>Categories</h6>
                    <i class="fa fa-angle-down text-dark"></i>
                </a>
                <nav class="collapse position-absolute navbar navbar-vertical navbar-light align-items-start p-0 bg-light" id="navbar-vertical" style="width: calc(100% - 30px); z-index: 999;">
                    <div class="navbar-nav w-100">
                        <div class="nav-item dropdown dropright bg-dark">
                         <a href="{{route('user#home')}}" class="nav-item nav-link text-light">All</a>

                        @foreach ($categories as $category)
                         <a href="{{route('user#filter',$category->id)}}" class="nav-item nav-link text-light">{{$category->name}}</a>
                        @endforeach
                    </div>
                </nav>
            </div>
@endsection
@section('content')
 <div class="container-fluid">
        <div class="row px-xl-5">
            <!-- Shop Sidebar Start -->
            <div class="col-lg-3 col-md-4">
                <!-- Price Start -->
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter by price</span></h5>
                <div class="bg-light p-4 mb-30 text-center" >
                    <form action='{{route("user#filterPrice")}}' method="post">
                        @csrf
                        <div><input type="number" name='minPrice'  class="form-control" placeholder="Min Price">
                        </div>
                        <h1 class="">-</h1>
                        <div><input type="number" name='maxPrice' class="form-control" placeholder="Max Price">
                        </div>
                        <div>
                        <input type="submit" value="Filter" class="btn btn-warning mt-3 text-white rounded" name='submitPrice'>
                    </div>
                    </form>
                </div>
                <!-- Price End -->

                <!-- Color Start -->
                {{-- <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter by color</span></h5>
                <div class="bg-light p-4 mb-30">
                    <form>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" checked id="color-all">
                            <label class="custom-control-label" for="price-all">All Color</label>
                            <span class="badge border font-weight-normal">1000</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="color-1">
                            <label class="custom-control-label" for="color-1">Black</label>
                            <span class="badge border font-weight-normal">150</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="color-2">
                            <label class="custom-control-label" for="color-2">White</label>
                            <span class="badge border font-weight-normal">295</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="color-3">
                            <label class="custom-control-label" for="color-3">Red</label>
                            <span class="badge border font-weight-normal">246</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="color-4">
                            <label class="custom-control-label" for="color-4">Blue</label>
                            <span class="badge border font-weight-normal">145</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between">
                            <input type="checkbox" class="custom-control-input" id="color-5">
                            <label class="custom-control-label" for="color-5">Green</label>
                            <span class="badge border font-weight-normal">168</span>
                        </div>
                    </form>
                </div> --}}
                <!-- Color End -->

                <!-- Size Start -->
                {{-- <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter by size</span></h5>
                <div class="bg-light p-4 mb-30">
                    <form>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" checked id="size-all">
                            <label class="custom-control-label" for="size-all">All Size</label>
                            <span class="badge border font-weight-normal">1000</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="size-1">
                            <label class="custom-control-label" for="size-1">XS</label>
                            <span class="badge border font-weight-normal">150</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="size-2">
                            <label class="custom-control-label" for="size-2">S</label>
                            <span class="badge border font-weight-normal">295</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="size-3">
                            <label class="custom-control-label" for="size-3">M</label>
                            <span class="badge border font-weight-normal">246</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="size-4">
                            <label class="custom-control-label" for="size-4">L</label>
                            <span class="badge border font-weight-normal">145</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between">
                            <input type="checkbox" class="custom-control-input" id="size-5">
                            <label class="custom-control-label" for="size-5">XL</label>
                            <span class="badge border font-weight-normal">168</span>
                        </div>
                    </form>
                </div>
                <div class="">
                    <button class="btn btn btn-warning w-100">Order</button>
                </div> --}}
                <!-- Size End -->
            </div>
            <!-- Shop Sidebar End -->


            <!-- Shop Product Start -->
            <div class="col-lg-9 col-md-8">
                <div class="row pb-3">
                    <div class="col-12 pb-1">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div>
                                <a href="{{route('user#cart')}}">
                                <button class="btn btn-sm btn-dark rounded"><i class="fa-solid fa-cart-plus">

                                </i>
                                <span class="position-absolute translate-middle badge rounded   bg-warning">
                                    {{count($cart)}}
                                </span>
                                </button>
                                </a>
                                <a href="{{route('user#history')}}" class="ms-2">
                                <button class="btn btn-sm btn-dark rounded"><i class="fa-solid fa-clock-rotate-left"></i>

                                </i>
                                <span class="position-absolute translate-middle badge rounded   bg-warning">
                                    {{count($data)}}
                                </span>
                                </button>
                                </a>
                                {{-- <button class="btn btn-sm btn-light ml-2"><i class="fa fa-bars"></i></button> --}}
                            </div>
                            <div class="ml-2">
                                <div class="btn-group">
                                    {{-- <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">Sorting</button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="#" value=>Latest</a>
                                        <a class="dropdown-item" href="#">Popularity</a>
                                        <a class="dropdown-item" href="#">Best Rating</a>
                                    </div> --}}
                                    <select  id="sortingOption" class="form-select">
                                        <option value="asc">Sorting</option>
                                        <option value="asc">Ascending</option>
                                        <option value="desc">Descending</option>

                                    </select>
                                </div>
                                {{-- <div class="btn-group ml-2">
                                    <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">Showing</button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="#">10</a>
                                        <a class="dropdown-item" href="#">20</a>
                                        <a class="dropdown-item" href="#">30</a>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
</div>
                    <div class="row" id='dataList'>
                        @if(count($products) !== 0)
                    {{-- <a href="detail.html"> --}}
                        @foreach ($products as $product)



                                                <div class="col-lg-4 col-md-6 col-sm-6 pb-1" >
<div class="product-item bg-dark mb-4 ">
                                <div class="product-img position-relative overflow-hidden">
                                    <img class="img-fluid w-100" src="{{asset('storage/'.  $product->image)}}" alt="" style="height: 200px">
                                    <div class="product-action">
                                        <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                        <a class="btn btn-outline-dark btn-square" href="{{route('user#pizzaDetail',$product->id)}}"><i class="fa-solid fa-info"></i></a>
                                        <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-sync-alt"></i></a>
                                        <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-search"></i></a>
                                    </div>
                                </div>
                                <div class="text-center text-light py-4">
                                    <a class="h6 text-decoration-none text-light " href="">{{$product->name}}</a>
                                    <div class="d-flex align-items-center justify-content-center mt-2">
                                        <h5 class='text-light'>{{$product->price}} kyats</h5><h6 class="text-muted ml-2"><del>25000</del></h6>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-center mb-1">
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                    </div>
                                </div>
                            </div>
                            </div>
                            @endforeach
                            @else
                            <div class="col-6 offset-3 shadow p-3">                            <h3 class="text-center text-muted">There is no product</h3>
</div>
                            @endif

                        </div>
                    {{-- </a> --}}
{{$products->appends(request()->query())->links()}}




            </div>

            </div>
            <!-- Shop Product End -->
        </div>
    </div>

@endsection
@section('scriptSource')
     <script>
        $('#sortingOption').change(function(){
            $eventOption = $('#sortingOption').val();
            console.log($eventOption);

        if($eventOption == 'asc')
        {
            
            $.ajax({
                type : 'get',
                url : 'http://localhost/Pizza/public/ajax/pizza/list',
                data:{'status':'asc'},
                dataType : 'json',
                success : function(response){
                    
                    console.log(response['data'][0].name);
                    response = response['data'];
                    $list = '';
                    for($i=0;$i<response.length;$i++)
                    {
                        $list += `
                                                <div class="col-lg-4 col-md-6 col-sm-6 pb-1" >
<div class="product-item bg-dark mb-4 ">
                                <div class="product-img position-relative overflow-hidden">
                                    <img class="img-fluid w-100" src="{{asset('storage/${response[$i].image}')}}" alt="" style="height: 200px">
                                    <div class="product-action">
                                        <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                        <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                        <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-sync-alt"></i></a>
                                        <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-search"></i></a>
                                    </div>
                                </div>
                                <div class="text-center text-light py-4">
                                    <a class="h6 text-decoration-none text-light " href="">${response[$i].name}</a>
                                    <div class="d-flex align-items-center justify-content-center mt-2">
                                        <h5 class='text-light'>${response[$i].price} kyats</h5><h6 class="text-muted ml-2"><del>25000</del></h6>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-center mb-1">
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                    </div>
                                </div>
                            </div>

                            </div>
                            `
                    };
                    $('#dataList').html($list);
                }
            })
        }
        else if($eventOption == 'desc')
        {
              $.ajax({
                type : 'get',
                url : 'http://localhost/Pizza/public/ajax/pizza/list',
                data:{'status':'desc'},
                dataType : 'json',
                success : function(response){
                    response = response['data'];
                    $list = '';
                    for($i=0;$i<response.length;$i++)
                    {
                        $list += `<div class="col-lg-4 col-md-6 col-sm-6 pb-1" >

                        <div class="product-item bg-dark mb-4 ">
                                <div class="product-img position-relative overflow-hidden">
                                    <img class="img-fluid w-100" src="{{asset('storage/${response[$i].image}')}}" alt="" style="height: 200px">
                                    <div class="product-action">
                                        <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                        <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-info"></i></a>
                                        <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-sync-alt"></i></a>
                                        <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-search"></i></a>
                                    </div>
                                </div>
                                <div class="text-center text-light py-4">
                                    <a class="h6 text-decoration-none text-light " href="">${response[$i].name}</a>
                                    <div class="d-flex align-items-center justify-content-center mt-2">
                                        <h5 class='text-light'>${response[$i].price} kyats</h5><h6 class="text-muted ml-2"><del>25000</del></h6>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-center mb-1">
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                    </div>
                                </div>
                            </div>

                            </div>
                            `
                    };
                    $('#dataList').html($list);
                }
            })
        }
        })
    </script>
@endsection
