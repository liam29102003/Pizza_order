@extends('admin.layouts.master')
@section('search')
<form class="form-header" action="{{route('admin#list')}}" method="get">
    @csrf
    <input class="au-input au-input--xl" type="text" name="search" placeholder="Search for categories" value="{{request('search')}}"/>
    <button class="au-btn--submit" type="submit">
        <i class="zmdi zmdi-search"></i>
    </button>
</form>

@endsection
@section('content')
<div class="main-content  " style="padding-top: 7%">
    <div class="section__content section__content--p30  mt-0">
        <div class="container-fluid ">
            <div class="col-md-12">
                <!-- DATA TABLE -->
                <div class="table-data__tool  mt-0">
                    <div class="table-data__tool-left">
                        <div class="overview-wrap">
                            @if(request('search'))

                            <h3 class="">Search Key: <button class="btn btn-success" >"{{request('search')}}"</button></h3>
            
                            @endif
                        </div>
                    </div>
                    <div class="table-data__tool-right">
                        <button class="btn btn-success" >
                            Total-{{$categories->total()}}
                        </button>
                        <a href="{{route('admin#addCategory')}}">
                            <button class="btn btn-success">
                                <i class="zmdi zmdi-plus me-2"></i>add category
                            </button>
                        </a>
                        <button class="btn btn-success">
                            CSV download
                        </button>

                    </div>
                </div>
                @if(session('createSuccess'))
                <div class=" alert alert-success alert-dismissible fade show" role="alert">
                    {{session('createSuccess')}}
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
                        <h4 class="title-1 ">Category List</h2>

                    </div>
                    <div class="card-body">
                        <div class="table-responsive table-responsive-data2">
                            <table class="table table-data2 border" >
                                <thead class="border bg-success text-white">
                                    <tr class="text-white">
                                        <th class="text-white">Id</th>
        
                                        <th class="text-white">name</th>
                                        {{-- <th>email</th> --}}
                                        {{-- <th>description</th> --}}
                                        <th class="text-white">created_date</th>
                                        {{-- <th>status</th> --}}
                                        {{-- <th>price</th> --}}
                                        <th></th>
                                    </tr>
                                    
                                </thead>
                                
                                <tbody>@if(count($categories) === 0)
        
                                        <tr><td colspan="4" class="text-center "><small>There is no data</small>
                                            </td></tr>
        
                                    @else
                                    @foreach ($categories as $category)
                                    <tr class="tr-shadow">
                                        <td>{{$category->id}}</td>
        
                                        <td>{{$category->name}}</td>
                                        <td>{{$category->created_at->format('j-F-y')}}</td>
                                        <td>
                                            <div class="table-data-feature">
                                                <a href="{{route('admin#editCategory',$category->id)}}">
                                                <button class="item bg-success " data-toggle="tooltip" data-placement="top" title="Edit">
                                                    <i class="zmdi zmdi-edit text-white"></i>
                                                </button>
                                                </a>
                                                <a href="{{route('admin#deleteCategory',$category->id)}}">
                                                <button class="item ms-2 bg-success" data-toggle="tooltip" data-placement="top" title="Delete">
                                                    <i class="zmdi zmdi-delete text-white"></i>
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
                    </div>
                    <div class="card-footer">
                        <div class="">
                            {{$categories->appends(request()->query())->links()}}
                        </div>
                    </div>
                    </div>
                   
                
                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
</div>
@endsection
Hello World