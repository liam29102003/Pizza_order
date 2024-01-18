@extends('admin.layouts.master')
@section('search')
<h3>Admin Panel</h3>

@endsection
@section('content')
<div class="main-content" style="padding-top: 7%">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <!-- DATA TABLE -->
                <div class="table-data__tool">
                    <div class="table-data__tool-left">
                        
                    </div>
                    <div class="table-data__tool-right">
                        <button class="btn btn-success" >
                            Total-{{$data->total()}}
                        </button>
                        

                    </div>
                </div>
                @if(session('productSuccess'))
                <div class=" alert alert-success alert-dismissible fade show" role="alert">
                    {{session('productSuccess')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                 @if(session('DeleteSuccess'))
                <div class=" alert alert-danger alert-dismissible fade show" role="alert">
                    {{session('DeleteSuccess')}}
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
                <div class="card mt-0">
                    <div class="card-header p-2 text-center">
                        <h4 class="title-1 ">{{ucfirst($data[0]->role)}} List</h2>

                    </div>
                    <div class="card-body">
                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2 border">
                        <thead class="bg-success">
                            <tr>
                                <th class="text-center text-white">Image</th>

                                <th class="text-center text-white">name</th>
                                <th class="text-center text-white">Email</th>
                                <th class="text-center text-white">Gender</th>
                                <th class="text-center text-white">Phone</th>
                                <th class="text-center text-white">Address</th>

                                {{-- <th>status</th> --}}
                                {{-- <th>price</th> --}}
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>@if(count($data) === 0)

                                <tr><td colspan="7" class="text-center "><small>There is no data</small>
                                    </td></tr>

                            @else
                            @foreach ($data as $datas)
                            <tr class="tr-shadow">
                                <td class="col-2 text-center">
                                    @if($datas->image == null)
                                             @if($datas->gender == 'male')
                                             <img src="{{asset('img/defaultmale.png')}}" alt="John Doe"  width = '80' class ="  " style="height:60px "/>
                                             @else
                                             <img src="{{asset('img/defaultFemale.jpg')}}" alt="John Doe" width = '80'  class ="  " width="150px" style=" height:60px "/>
                                             @endif
                                            @else
                                            <img src="{{asset('storage/'.$datas->image)}}" alt="John Doe" width = '80' style="height:60px"/>
                                            @endif
                                </td>

                                <td class="text-center">{{$datas->name}}</td>
                                <td class="text-center">{{$datas->email}}</td>
                                <td class="text-center">{{$datas->gender}}</td>
                                <td class="text-center">{{$datas->phone}}</td>
                                <td class="text-center">{{$datas->address}}</td>


                                <td>
                                    <div class="table-data-feature">
                                        {{-- <a href="{{route('admin#detailProduct',$data->id)}}">
                                        <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                            <i class="fa-solid fa-info"></i>
                                        </button>
                                        </a> --}}
                                        {{-- <a href="{{route('admin#editProduct',$data->id)}}">
                                        <button class="item ms-2" data-toggle="tooltip" data-placement="top" title="Edit">
                                            <i class="zmdi zmdi-edit"></i>
                                        </button>
                                        </a> --}}
                                        @if(Auth::user()->id !== $datas->id)
                                        <a href="{{route('admin#changeRole',$datas->id)}}">
                                        <button class="item ms-2" data-toggle="tooltip" data-placement="top" title="Change Role">
<i class="fa-solid fa-pen-to-square"></i>                                        </button>
                                        </a>
                                         <a href="{{route('admin#adminListDelete',$datas->id)}}">
                                        <button class="item ms-2" data-toggle="tooltip" data-placement="top" title="Delete">
                                            <i class="zmdi zmdi-delete"></i>
                                        </button>
                                        </a>
                                        @endif

                                    </div>
                                </td>
                            </tr>

                            <tr class="spacer"></tr>
                            @endforeach
@endif

                        </tbody>
                    </table>
                    {{-- <div>
                        {{$data->appends(request()->query())->links()}}
                    </div> --}}
                </div>
                    </div>
                    <div class="card-footer">
                        <div class="">
                            {{$data->appends(request()->query())->links()}}
                        </div>
                    </div>

                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
</div>
@endsection
