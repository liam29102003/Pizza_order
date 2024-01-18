@extends('user.layouts.master')
@section('name')
    <span class="content ms-3 mt-2">
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
            <div class="col-lg-6 offset-3">
                @if(session('updateSuccess'))
                <div class=" alert alert-success alert-dismissible fade show" role="alert">
                    {{session('updateSuccess')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                <div class="card shadow shadow-lg">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2 fw-1">User Details</h3>
                        </div>
                        <hr>
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
                        <table  class="table table-borderless border border-2 shadow shadow table-hover" >
                            <tbody>
                                <tr class="">
                                    <td colspan="3" class="text-center bg-light ">

                                             @if(Auth::user()->image == null)
                                             @if(Auth::user()->gender == 'male')
                                             <img src="{{asset('img/defaultmale.png')}}" alt="John Doe"   class ="img-thumbnail  " style="border-radius: 200%; "/>
                                             @else
                                             <img src="{{asset('img/defaultFemale.jpg')}}" alt="John Doe"   class ="img-thumbnail  " width="150px" height="1000"style="border-radius: 200%; "/>
                                             @endif
                                            @else
                                            <img src="{{asset('storage/'.Auth::user()->image)}}"width="150px" class="img-thumbnail" alt="John Doe" />
                                            @endif
                                    </td>

                                </tr>
                                <tr>
                                    <th scope="row"><div class=""><button class="shadow btn btn-secondary"><i class="fa-solid fa-signature"></i></button>
                                        Name</div></th>
                                    <td><div class="mt-2"><i class="fa-solid fa-arrow-right"></i></div></td>
                                    <td class=""><button  class="shadow btn btn-round rounded-pill btn-warning">{{Auth::user()->name}}</button></td>
                                </tr>
                                <tr>
                                    <th><div class=""><button class="shadow btn me-1 btn-secondary"><i class="fa-solid fa-envelope"></i></button>Email</div></th>
                                    <td><div class="mt-2"><i class="fa-solid fa-arrow-right"></i></div></td>                                    <td><button  class="btn shadow btn-round rounded-pill btn-warning">{{Auth::user()->email}}</button></td>
                                </tr>
                                <tr>
                                    <th><div class="mt-2"><button class="shadow btn me-1 btn-secondary"><i class="fa-solid fa-phone"></i></button>Phone</div></th>
                                    <td><div class="mt-2"><i class="fa-solid fa-arrow-right"></i></div></td>                                    <td><button  class="btn shadow btn-round rounded-pill btn-warning">{{Auth::user()->phone}}</button></td>
                                    </tr>
                                    <tr>
                                    <th><div class="mt-2"><button class="shadow btn me-1 btn-secondary"><i class="fa-solid fa-venus-mars"></i></button>Gender</div></th>
                                    <td><div class="mt-2"><i class="fa-solid fa-arrow-right"></i></div></td>                                    <td><button  class="btn shadow btn-round rounded-pill btn-warning">{{Auth::user()->phone}}</button></td>
                                    </tr>
                                    <tr>
                                        <th ><div class="mt-2"><button class="shadow btn me-1 btn-secondary"><i class="fa-solid fa-map-location-dot"></i></button><span>Address</span></div></th>
                                    <td><div class="mt-2"><i class="fa-solid fa-arrow-right"></i></div></td>                                    <td><button  class="btn shadow btn-round rounded-pill btn-warning">{{Auth::user()->address}}</button></td>
                                    </tr>
                                    <tr>
                                        <th><div class="mt-2"><button class="shadow btn me-1 btn-secondary"><i class="fa-solid fa-calendar-days"></i></button>Created At</div></th>
                                    <td><div class="mt-2"><i class="fa-solid fa-arrow-right"></i></div></td>                                    <td><button  class="btn shadow btn-round rounded-pill btn-warning">{{Auth::user()->created_at->format('j F y')}}</button></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer text-center">

                                     <a href="{{route('user#passwordChange')}}"><button class="btn btn-dark "><i class="fa-solid fa-key"></i>Change Password</button></a>

                        <a href="{{route('user#editProfile')}}"><button class="btn btn-dark"><i class="fa-solid fa-user-pen"></i>Edit Profile</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

