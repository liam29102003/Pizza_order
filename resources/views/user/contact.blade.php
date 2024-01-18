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

     <div class="container">
        <div class="row">
            <div class="col-8 offset-2 ">
                @if(session('Success'))
                <div class=" alert alert-success alert-dismissible fade show" role="alert">
                   {{session('Success')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                <div class="card">
                    <div class="card-header p-2 pt-3">
                       <h3 class="text-center ">Contact Us</h3> 
                    </div>
                    <div class="card-body p-3">
                        <form action="{{route('user#contact')}}" class="form" method="post">
                            @csrf
                            <div class="offset-2">
                                <div class="d-flex mb-3 "><label for="subject" class="mb-0 mt-2">Choose Subject:</label>
                                    <select name="subject" id="subject" class="form-select  w-50 mt-0 ms-2">
                                        <option value="report">Report</option>
                                        <option value="order">Order</option>
                                        <option value="other">Other</option>
                
                                    </select>
                                    @error('subject')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                @enderror
                                </div>
                            </div>
                            
                            <div class="container-fluid p-0 ">
                                <div class="row">
                                    <div class="col-6">
                                        <input type="text" name='oPhone' placeholder="phone(optional)" class="form-control">
                                    
                                    </div>
                                    <div class="col-6"> 
                                        <input type="text" name = 'oEmail' placeholder="Email(optional)" class="form-control">
                                        {{-- <small class="text-warning">*if not enter, we will use your registered email to reply</small> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <small class="text-warning">*if do not enter, we will use your registered phone number or email address to reply</small>
        
                            </div>
        
                            
                               
                            
                           
                            <textarea name="message" @error("message") is-invalid

                            @enderror" id="" class="form-control mt-3" required placeholder="message.." cols="30" rows="6"></textarea>
                            @error('message')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                        @enderror
                    </div>
                    <div class="card-footer text-center">
                        <input type="submit" value="Send" class="btn btn-warning text-white rounded">
                        {{-- <button class="btn btn-"> Hello</button> --}}
                    </div>
                </form>
                    
                </div>
                
            </div>
        </div>
     </div>
    
@endsection