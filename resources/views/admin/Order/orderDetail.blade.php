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
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <!-- DATA TABLE -->
                <div class="table-data__tool">
                    <div class="table-data__tool-left">
                        <div class="overview-wrap">
                            {{-- <h2 class="title-1">Order Detail</h2> --}}
                        </div>
                    </div>
                    <div class="table-data__tool-right">
                        <button class="au-btn au-btn-icon au-btn--green au-btn--small" disabled>
                            {{-- Total-{{$products->total()}} --}}
                        </button>
                        <a href="{{route('admin#addProduct')}}">
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                <i class="zmdi zmdi-plus"></i>add product
                            </button>
                        </a>
                        <button class="au-btn au-btn-icon au-btn--green au-btn--small">
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
                @if(request('search'))

                <h3 class="">Search Key: <button class="btn btn-success" disabled>"{{request('search')}}"</button></h3>

                @endif
                <div class="table-responsive table-responsive-data2">
                    <div class="card">
                        <div class="card-header text-center">
                            <h3>Order Info</h3>
                        </div>
                        <div class="card-body">
                            <div class="card p-3">
                            <div class="row">
                                <div class="col-6">
                                    <span class="me-2"><i class="fa-solid fa-user me-2"></i>Name: </span> <b>{{$data[0]->user_name}}</b>
                                </div>
                                <div class="col-6">
                                    <span class="me-2"><i class="fa-solid fa-barcode me-2"></i>Order Code :</span> <b>{{$data[0]->order_code}}</b>
                                </div>
                                
                                
                            </div>
                            <div class="row mt-3">
                                <div class="col-6">
                                    <span class="me-2"><i class="fa-solid fa-calendar-days me-2"></i>Order Date: </span> <b>{{$data[0]->created_at->Format('j-F-Y')}}</b>
                                </div>
                                <div class="col-6">
                                    <span class="me-2"><i class="fa-solid fa-tag me-2"></i>Total: </span> <b>{{$data[0]->total_price }} Kyats</b>
                                </div>
                            </div>
                        </div>
                        

                            <table class="table table-data2">
                                <thead>
                                    <tr>
                                        <th class="text-center">Image</th>
        
                                        <th class="text-center">Order ID</th>
                                        <th class="text-center">name</th>
                                        <th class="text-center">Amount</th>
                                        <th class="text-center">Qty</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>@if(count($data) === 0)
        
                                        <tr><td colspan="5" class="text-center "><small>There is no data</small>
                                            </td></tr>
        
                                    @else 
                                    @foreach ($data as $product)
                                    <tr class="tr-shadow">
                                        <td class="col-2 text-center"><img class= "img-thumbnail" src="{{asset('storage/'.$product->image)}}" alt=""></td>
        
                                        <td class="text-center">{{$product->id}}</td>
        
                                        <td class="text-center">{{$product->name}}</td>
                                        <td class="text-center">{{$product->total}}</td>
                                        <td class="text-center">{{$product->qty}}</td>
        
                                        {{-- <td>
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
                                        </td> --}}
                                    </tr>
        
                                    <tr class="spacer"></tr>
                                    @endforeach
         @endif
        
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer text-center">
                            <small class="text-warning"><i class="fa-solid fa-triangle-exclamation me-2"></i>Included delivery fee</small>

                        </div>
                    </div>
                   
                    <div>
                         {{-- {{$products->appends(request()->query())->links()}}  --}}
                    </div>
                </div>
                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
</div>
@endsection
