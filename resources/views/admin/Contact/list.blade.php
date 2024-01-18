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
                        <nav aria-label="...">
                            <ul class="pagination">
                                <li class="page-item" ><a class="page-link text-success"   href="{{route('admin#contactFilter','null')}}">All</a></li>
    
                              <li class="page-item " ><a class="page-link text-success"  href="{{route('admin#contactFilter','report')}}">Report</a></li>
                              <li class="page-item" ><a class="page-link text-success"  href="{{route('admin#contactFilter','order')}}">Order</a></li>
                              <li class="page-item" ><a class="page-link text-success"  href="{{route('admin#contactFilter','other')}}">Others</a></li>
    
                            </ul>
                          </nav>
                        
                       
                    </div>
                    <div class="table-data__tool-right">
                        <button class="btn btn-success" >
                            Total-{{$data->total()}}
                        </button>
                        {{-- <a href="{{route('admin#addCategory')}}">
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                <i class="zmdi zmdi-plus"></i>add category
                            </button>
                        </a>
                        <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                            CSV download
                        </button> --}}

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
                        <h4 class="title-1 ">Contact List</h2>

                    </div>
                    <div class="card-body">
                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2 border">
                        <thead class="bg-success">
                            <tr>
                                <th class="text-white">Id</th>

                                <th class="text-white">Username</th>
                                <th class="text-white">Reply email</th>
                                <th class="text-white">Subject</th>
                                <th class="text-white">created_date</th>
                                
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>@if(count($data) === 0)

                                <tr><td colspan="6" class="text-center "><small>There is no message</small>
                                    </td></tr>

                            @else
                            @foreach ($data as $contact)
                            <tr class="tr-shadow">
                                <td>{{$contact->id}}</td>

                                <td>{{$contact->name}}</td>
                                @if($contact->OEmail == null)
                                
                                    <td>{{$contact->email}}</td>
                                
                                @else
                                
                                    <td>{{$contact->OEmail}}</td>

                                
                                @endif
                                <td>{{$contact->subject}}</td>

                                <td>{{$contact->created_at->format('j-F-y')}}</td>
                                <td>
                                    <div class="table-data-feature">
                                        @if($contact->view == 'no')
                                            <button class="item bg-white border-danger" data-toggle="tooltip" data-placement="top" title="Edit">
                                               <small class="text-danger">new</small>
                                            </button>
                                        @endif
                                        <a href="{{route('admin#contactDetail',$contact->id)}}">
                                        <button class="item bg-success" data-toggle="tooltip" data-placement="top" title="Edit">
                                            <i class="zmdi zmdi-eye text-white"></i>
                                        </button>
                                        </a>
                                        <a href="{{route('admin#contactDelete',$contact->id)}}">
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
                    <div>
                    </div>
                    <div class="card-footer">
                        <div class="">
                            {{$data->appends(request()->query())->links()}}
                        </div>
                    </div>
                        {{-- {{$categories->appends(request()->query())->links()}} --}}
                    </div>
                </div>
                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>

@endsection
