
@extends('admin.layouts.master')
@section('search')
    <h4>Admin Panel</h4>
@endsection
@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            {{-- <div class="row">
                <div class="col-3 offset-8">
                    <a href="category_list.html"><button class="btn bg-dark text-white my-3">List</button></a>
                </div>
            </div> --}}
            <div class="col-lg-8 offset-2">
                @if(session('passwordSuccess'))
                <div class=" alert alert-success alert-dismissible fade show" role="alert">
                    {{session('passwordSuccess')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                <button class="btn btn-dark mb-2" onclick="history.back()">Back</button>
                <div class="card shadow shadow-lg bg-light">
                     <div class="card-header p-3">
                            <h3 class="text-center title-2 fw-3">Product Details</h3>
                        </div>

                    <div class="card-body">

                        {{-- <form  method="POST" novalidate="novalidate" action="{{route('admin#updatePassword')}}">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="cc-payment" class="control-label mb-1">Old Password</label>
                                <input id="cc-pament" name="oldPassword" type="text" class="form-control @error("oldPassword") is-invalid

                                @enderror" aria-required="true" aria-invalid="false"  placeholder="Old Password" >
                            @error('oldPassword')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                            @if (session('notMatch'))
                            <div class="invalid-feedback">Hello</div>

                            @endif
                            </div>
                            <div class="form-group mb-3">
                                <label for="cc-payment" class="control-label mb-1">New Password</label>
                                <input id="cc-pament" name="newPassword" type="text" class="form-control @error("newPassword") is-invalid

                                @enderror" aria-required="true" aria-invalid="false"  placeholder="New Password" >
                            @error('newPassword')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                            </div>
                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Confirm Password</label>
                                <input id="cc-pament" name="confirmPassword" type="text" class="form-control @error("confirmPassword") is-invalid

                                @enderror" aria-required="true" aria-invalid="false"  placeholder="Confirm Password" >
                            @error('confirmPassword')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                            </div>

                            <div>
                                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block mt-3">
                                    <span id="payment-button-amount">Update</span>
                                    <span id="payment-button-sending" style="display:none;">Sending…</span>
                                    <i class="fa-solid fa-circle-right"></i>
                                </button>
                            </div>
                        </form> --}}
                        <table  class="table table-borderless border border-2  table-hover" >
                            <tbody>
                                <tr class="">
                                    <td  class="text-center col-5">

                                            <img src="{{asset('storage/'.$product->image)}}" alt="John Doe" width="150px" height="1000"  class ="img-thumbnail shadow " style=" height:150px"/>

                                    </td>

                                    <td class="pt-3"><button  class="shadow btn btn btn-success"><h3 class="text-white" style="font-family:cursive">{{$product->name}}</h3></button>

                                <div class="mt-2"><button  class="btn shadow btn-sm btn-success"><i class="fa-solid fa-money-bill-1-wave me-2"></i>{{$product->price}} kyats</button>
                                <button  class="btn shadow btn-sm btn-success"><i class="fa-regular fa-folder me-2"></i>{{$product->category_name}}</button>

                                </div>
                                <div class="mt-2">
                                    <button  class="btn shadow btn-sm btn-success me-1"><i class="fa-solid fa-hourglass-start me-2"></i>{{$product->waiting_time}} mins</button><button  class="btn shadow btn-sm btn-success"><i class="fa-solid fa-circle-info me-2"></i>{{$product->view_count}}</button></div>
                                </td>
</tr>
                                <tr><td class colspan="3">
                                    <button  class="btn shadow text-left  btn-">{{$product->description}}</button>
                                    </td>
                                </tr>


                                {{-- <tr>

                                </tr>
                                <tr>

                                </tr>
                                <tr>
                                    <th><div class="mt-2"><button class="shadow btn me-1 btn-secondary"></button>Category</div></th>
                                    <td><div class="mt-2"><i class="fa-solid fa-arrow-right"></i></div></td>
                                    </tr>
                                    <tr>
                                    <th><div class="mt-2"><button class="shadow btn me-1 btn-secondary"></button>Waiting Time</div></th>
                                    <td><div class="mt-2"><i class="fa-solid fa-arrow-right"></i></div></td>                                    <td></td>
                                    </tr>
                                    <tr>
                                        <th ><div class="mt-2"><button class="shadow btn me-1 btn-secondary"><i class="fa-solid fa-users-viewfinder"></i></button><span>View Count</span></div></th>
                                    <td><div class="mt-2"><i class="fa-solid fa-arrow-right"></i></div></td>                                    <td></td>
                                    </tr>
                                    <tr>
                                        <th ><div class="mt-2"><button class="shadow btn me-1 btn-secondary"><i class="fa-solid fa-circle-info"></i></button><span>Description</span></div></th>
                                    <td><div class="mt-2"><i class="fa-solid fa-arrow-right"></i></div></td>                                    <td class="col-6">
                                    </tr>
                                    <tr>
                                        <th><div class="mt-2"><button class="shadow btn me-1 btn-secondary"><i class="fa-solid fa-calendar-days"></i></button>Created At</div></th>
                                    <td><div class="mt-2"><i class="fa-solid fa-arrow-right"></i></div></td>                                    <td><button  class="btn shadow btn-round rounded-pill btn-success">{{$product->created_at}}</button></td>
                                </tr> --}}
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer text-center">
                        <a href="{{route('admin#editProduct',$product->id)}}"><button class="btn btn-dark"><i class="fa-solid fa-user-pen"></i>Edit Product</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
