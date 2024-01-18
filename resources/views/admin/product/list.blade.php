@extends('admin.layouts.master')
@section('search')
<form class="form-header" action="{{route('admin#productList')}}" method="get">
    @csrf
    <input class="au-input au-input--xl" type="text" name="search" placeholder="Search for categories" value="{{request('search')}}"/>
    <button class="au-btn--submit" type="submit">
        <i class="zmdi zmdi-search"></i>
    </button>
</form>

@endsection
@section('content')
<div class="main-content" style="padding-top: 7%" >
    <div class="section__content section__content--p30 ">
        <div class="container-fluid ">
            <div class="col-md-12">
                <!-- DATA TABLE -->
                <div class="table-data__tool">
                    <div class="table-data__tool-left">
                        @if(request('search'))

                        <h3 class="">Search Key: <button class="btn btn-success" >"{{request('search')}}"</button></h3>
        
                        @endif
                    </div>
                    <div class="table-data__tool-right">
                        <button class="btn btn-success">
                            Total-{{$products->total()}}
                        </button>
                        <a href="{{route('admin#addProduct')}}">
                            <button class="btn btn-success">
                                <i class="zmdi zmdi-plus"></i>add product
                            </button>
                        </a>
                        <button class="btn btn-success">
                            CSV download
                        </button>

                    </div>
                </div>
                @if(session('productSuccess'))
                <div class=" alert alert-success alert-dismissible fade show" role="alert">
                    {{session('productSuccess')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                 @if(session('deleteSuccess'))
                <div class=" alert alert-danger alert-dismissible fade show" role="alert">
                    {{session('deleteSuccess')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                 @if(session('updateSuccess'))
                <div class=" alert alert-warning alert-dismissible fade show" role="alert">
                    {{session('updateSuccess')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
              
                
                <div class="card mt-0">
                    <div class="card-header p-2 text-center">
                        <h4 class="title-1 ">Product List</h2>

                    </div>
                    <div class="card-body">
                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2 border">
                        <thead class="border bg-success text-white">
                            <tr>
                                <th class="text-center text-white">Image</th>

                                <th class="text-center text-white">name</th>
                                <th class="text-center text-white">Price</th>
                                <th class="text-center text-white">category</th>
                                <th class="text-center text-white">view count</th>
                                {{-- <th>status</th> --}}
                                {{-- <th>price</th> --}}
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>@if(count($products) === 0)

                                <tr><td colspan="5" class="text-center "><small>There is no data</small>
                                    </td></tr>

                            @else
                            @foreach ($products as $product)
                            <tr class="tr-shadow">
                                <td class="col-2 text-center"><img class= "img-thumbnail" src="{{asset('storage/'.$product->image)}}" alt=""></td>

                                <td class="text-center">{{$product->name}}</td>
                                <td class="text-center">{{$product->price}}</td>
                                <td class="text-center">{{$product->category_name}}</td>
                                <td class="text-center">{{$product->view_count}}</td>

                                <td>
                                    <div class="table-data-feature">
                                        <a href="{{route('admin#detailProduct',$product->id)}}">
                                        <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                            <i class="fa-solid fa-info"></i>
                                        </button>
                                        </a>
                                        <a href="{{route('admin#editProduct',$product->id)}}">
                                        <button class="item ms-2" data-toggle="tooltip" data-placement="top" title="Edit">
                                            <i class="zmdi zmdi-edit"></i>
                                        </button>
                                        </a>
                                        <a href="{{route('admin#productDelete',$product->id)}}">
                                        <button class="item ms-2" data-toggle="tooltip" data-placement="top" title="Delete">
                                            <i class="zmdi zmdi-delete"></i>
                                        </button>
                                        </a>

                                    </div>
                                </td>
                            </tr>

                            <tr class="spacer"></tr>
                            @endforeach
@endif

                        </tbody>
                    </table>
                   
                </div>
                <!-- END DATA TABLE -->
            </div>
            <div class="card-footer">
                <div class="">
                    {{$products->appends(request()->query())->links()}}
                </div>
            </div>
            </div>
        </div>
    </div>
</div>
@endsection
