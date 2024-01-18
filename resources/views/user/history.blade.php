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
<div class="container-fluid" style='height:500px'>
        <div class="row px-xl-5">
            <div class="col-lg-8 offset-2 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0" id='dataTable'>
                    <thead class="thead-dark">

                        <tr>
                            <th>Order Code</th>
                            <th>Total Price</th>
                            <th>Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $datas)
                        <tr>
                            <td>{{$datas->order_code}}</td>
                            <td>{{$datas->total_price}} <span class="text-info">kyats</span></td>
                            <td>{{$datas->created_at}}</td>
                            @if($datas->status == 0)
                            <td class='text-warning'><i class="fa-regular fa-clock"></i> pending</td>
                            @elseif($datas->status == 1)
                            <td class='text-success'><i class="fa-regular fa-thumbs-up"></i> success</td>
                            @elseif($datas->status == 2)
                            <td class='text-danger'><i class="fa-regular fa-thumbs-down"></i> rejected</td>

                            @endif
                        </tr>
                        @endforeach
                       
                    </tbody>
                </table>
                <div class="mt-3">
                    {{$data->links()}}
                </div>
                
            </div>
            
        </div>
    </div>
@endsection
@section('scriptSource')
