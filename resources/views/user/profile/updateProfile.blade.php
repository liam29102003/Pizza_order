@extends('user.layouts.master')
@section('bootstrap')
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
@endsection
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
                @if(session('passwordSuccess'))
                <div class=" alert alert-success alert-dismissible fade show" role="alert">
                    {{session('passwordSuccess')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                <a href="{{route('admin#profile')}}"><button class="btn btn-warning mb-2"><i class="fa-solid fa-arrow-left-long me-1"></i><span>Back</span>
                            </button></a>
                <div class="card shadow shadow-lg">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2 fw-1">Edit Profile</h3>
                        </div>
                        <hr>

                        <table  class="table table-borderless border border-2 shadow shadow table-hover" >
                            <tbody>
                                <form action="{{route('user#updateProfile',Auth::user()->id)}}" method="POST" enctype="multipart/form-data">

                                @csrf    <tr class="">
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
                                    <th scope="row"><div class=""><button class="shadow btn btn-secondary"><i class="fa-solid fa-image"></i></button>
                                        Image</div></th>
                                    <td><div class="mt-2"><i class="fa-solid fa-arrow-right"></i></div></td>
                                    <td class=""><input type="file" name="image" id="image" class="form-control border-warning " >
                                     </td>
                                </tr>
                                <tr>
                                    <th scope="row"><div class=""><button class="shadow btn btn-secondary"><i class="fa-solid fa-signature"></i></button>
                                        Name</div></th>
                                    <td><div class="mt-2"><i class="fa-solid fa-arrow-right"></i></div></td>
                                    <td class=""><input type="text" name="name" id="name" class="form-control border-warning " value="{{old('name',Auth::user()->name)}}">
                                     @error('name')
                                    <small class="text-danger">{{$message}}</small>
                                    @enderror</td>
                                </tr>
                                <tr>
                                    <th><div class=""><button class="shadow btn me-1 btn-secondary"><i class="fa-solid fa-envelope"></i></button>Email</div></th>
                                    <td><div class="mt-2"><i class="fa-solid fa-arrow-right"></i></div></td>                                    <td><input type="email" name="email" id="email" class="form-control border-warning " value="{{old('email',Auth::user()->email)}}"> @error('email')
            <small class="text-danger">{{$message}}</small>
            @enderror</td>
                                </tr>
                                <tr>
                                    <th><div class="mt-2"><button class="shadow btn me-1 btn-secondary"><i class="fa-solid fa-phone"></i></button>Phone</div></th>
                                    <td><div class="mt-2"><i class="fa-solid fa-arrow-right"></i></div></td>                                    <td><input type="number" name="phone" id="phone" class="form-control border-warning " value="{{old('phone',Auth::user()->phone)}}"> @error('phone')
            <small class="text-danger">{{$message}}</small>
            @enderror</td>
                                    </tr>
                                    <tr>
                                    <th><div class="mt-2"><button class="shadow btn me-1 btn-secondary"><i class="fa-solid fa-venus-mars"></i></button>Gender</div></th>
                                    <td><div class="mt-2"><i class="fa-solid fa-arrow-right"></i></div></td><td>
                                        <select name="gender" id="" class="form-select border-warning ">
                                            <option value="">Choose Gender</option>
                                            <option value="male" @if(Auth::user()->gender =="male") selected @endif>Male</option>
                                            <option value="female" @if(Auth::user()->gender =="female") selected @endif>Female</option>

                                        </select>
                                         @error('gender')
            <small class="text-danger">{{$message}}</small>
            @enderror
                                    </td>
                                    </tr>
                                    <tr>
                                        <th><div class="mt-2"><button class="shadow btn me-1 btn-secondary"><i class="fa-solid fa-map-location-dot"></i></button>Address</div></th>
                                    <td><div class="mt-2"><i class="fa-solid fa-arrow-right"></i></div></td>                                    <td><input type="text" name="address" id="address" class="form-control border-warning " value="{{old('address',Auth::user()->address)}}">
                                     @error('address')
            <small class="text-danger">{{$message}}</small>
            @enderror</td>
                                    </tr>

                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer text-center">
                        <button class="btn btn-dark" type="submit"><i class="me-1 fa-solid fa-check"></i><span>Confirm</span>
                            </button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
