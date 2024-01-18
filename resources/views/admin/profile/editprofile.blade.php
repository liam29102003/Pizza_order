
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
                <a href="{{route('admin#profile')}}"><button class="btn btn-success mb-2"><i class="fa-solid fa-arrow-left-long me-1"></i><span>Back</span>
                            </button></a>
                <div class="card shadow shadow-lg">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2 fw-1">Edit Profile</h3>
                        </div>
                        <hr>

                        <table  class="table table-borderless border border-2 shadow shadow table-hover" >
                            <tbody>
                                <form action="{{route('admin#updateprofile',Auth::user()->id)}}" method="POST" enctype="multipart/form-data">

                                @csrf    <tr class="">
                                    <td colspan="3" class="text-center bg-light ">
                                        @if(Auth::user()->image == null)
                                             @if(Auth::user()->gender == 'male')
                                             <img src="{{asset('img/defaultmale.png')}}" alt="John Doe"   class ="img-thumbnail  " style="border-radius: 200%;"  width="150px" height="1000"/>
                                             @else
                                             <img src="{{asset('img/defaultFemale.jpg')}}" alt="John Doe"   class ="img-thumbnail  " width="150px" height="1000"style="border-radius: 200%; "/>
                                             @endif
                                            @else
                                            <img src="{{asset('storage/'.Auth::user()->image)}}" alt="John Doe" class ="img-thumbnail  " width="150px" height="1000"/>
                                            @endif
                                    </td>

                                </tr>
                                  <tr>
                                    <th scope="row"><div class=""><button class="shadow btn btn-secondary"><i class="fa-solid fa-image"></i></button>
                                        Image</div></th>
                                    <td><div class="mt-2"><i class="fa-solid fa-arrow-right"></i></div></td>
                                    <td class=""><input type="file" name="image" id="image" class="form-control border-success " >
                                    @error('image')
                                    <small class="text-danger">{{$message}}</small>
                                    @enderror</td>
                                     </td>
                                     
                                </tr>
                                <tr>
                                    <th scope="row"><div class=""><button class="shadow btn btn-secondary"><i class="fa-solid fa-signature"></i></button>
                                        Name</div></th>
                                    <td><div class="mt-2"><i class="fa-solid fa-arrow-right"></i></div></td>
                                    <td class=""><input type="text" name="name" id="name" class="form-control border-success " value="{{old('name',Auth::user()->name)}}">
                                     @error('name')
                                    <small class="text-danger">{{$message}}</small>
                                    @enderror</td>
                                </tr>
                                <tr>
                                    <th><div class=""><button class="shadow btn me-1 btn-secondary"><i class="fa-solid fa-envelope"></i></button>Email</div></th>
                                    <td><div class="mt-2"><i class="fa-solid fa-arrow-right"></i></div></td>                                    <td><input type="email" name="email" id="email" class="form-control border-success " value="{{old('email',Auth::user()->email)}}"> @error('email')
            <small class="text-danger">{{$message}}</small>
            @enderror</td>
                                </tr>
                                <tr>
                                    <th><div class="mt-2"><button class="shadow btn me-1 btn-secondary"><i class="fa-solid fa-phone"></i></button>Phone</div></th>
                                    <td><div class="mt-2"><i class="fa-solid fa-arrow-right"></i></div></td>                                    <td><input type="number" name="phone" id="phone" class="form-control border-success " value="{{old('phone',Auth::user()->phone)}}"> @error('phone')
            <small class="text-danger">{{$message}}</small>
            @enderror</td>
                                    </tr>
                                    <tr>
                                    <th><div class="mt-2"><button class="shadow btn me-1 btn-secondary"><i class="fa-solid fa-venus-mars"></i></button>Gender</div></th>
                                    <td><div class="mt-2"><i class="fa-solid fa-arrow-right"></i></div></td><td>
                                        <select name="gender" id="" class="form-select border-success ">
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
                                    <td><div class="mt-2"><i class="fa-solid fa-arrow-right"></i></div></td>                                    <td><input type="text" name="address" id="address" class="form-control border-success " value="{{old('address',Auth::user()->address)}}">
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
