@extends('user.layouts.master')
@section('name')
    <span class="content ms-2 mt-2">
                                            <a class="js-acc-btn" href="{{route('user#profile')}}">{{Auth::user()->name}}</a>
                                        </span>
@endsection
@section('category')
    <div class="col-lg-3 d-none d-lg-block">
                <div class="btn d-flex align-items-center justify-content-between bg-primary w-100"  style="height: 70px; padding: 0 30px;">
                    <h4 class="text-dark m-0 " style="font-weight: 900">Change Password</h4>
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
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            {{-- <div class="row">
                <div class="col-3 offset-8">
                    <a href="category_list.html"><button class="btn bg-dark text-white my-3">List</button></a>
                </div>
            </div> --}}
            <div class="col-lg-4 offset-4">
                @if(session('passwordSuccess'))
                <div class=" alert alert-success alert-dismissible fade show" role="alert">
                    {{session('passwordSuccess')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                 @if(session('notMatch'))
                <div class=" alert alert-danger alert-dismissible fade show" role="alert">
                    {{session('notMatch')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Change Password</h3>
                        </div>
                        <hr>
                        <form  method="POST" novalidate="novalidate" action="{{route('user#passwordChange')}}">
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
                                <button id="payment-button" type="submit" class="btn btn-lg btn-warning btn-block mt-3">
                                    <span id="payment-button-amount">Update</span>
                                    <span id="payment-button-sending" style="display:none;">Sending…</span>
                                    <i class="fa-solid fa-circle-right"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


