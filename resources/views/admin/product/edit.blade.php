
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
                    <a href="Waiting Time_list.html"><button class="btn bg-dark text-white my-3">List</button></a>
                </div>
            </div> --}}
            <div class="col-lg-8 offset-2">
                @if(session('passwordSuccess'))
                <div class=" alert alert-success alert-dismissible fade show" role="alert">
                    {{session('passwordSuccess')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                <button class="btn btn-success mb-2" onclick="history.back()"><i class="fa-solid fa-arrow-left-long me-1"></i><span>Back</span>
                            </button>
                <div class="card shadow shadow-lg">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2 fw-1">Edit Product</h3>
                        </div>
                        <hr>

                        <table  class="table table-borderless border  border-2 shadow shadow table-hover" >
                            <tbody>
                                <form action="{{route('admin#updateProduct',$product->id)}}" method="POST" enctype="multipart/form-data">

                                @csrf    <tr class="">
                                    <td colspan="3" class="text-center bg-light ">

                                            <img src="{{asset('storage/'.$product->image)}}" alt="John Doe" width="150px" height="1000"  class ="img-thumbnail shadow " style="border-radius: 200%; height:150px"/>


                                    </td>

                                </tr>
                                  <tr>
                                    <th scope="row"><div class=" ms-3">
                                        Image</div></th>
                                    <td><div class="mt-2"><i class="fa-solid fa-arrow-right"></i></div></td>
                                    <td class="">
                                        <input type="number" name="id" id="id" class="form-control border-success " hidden value="{{$product->id}}"><input type="file" name="image" id="image" class="form-control border-success " >
                                     </td>
                                </tr>
                                <tr>
                                    <th scope="row"><div class="ms-3">
                                        Name</div></th>
                                    <td><div class="mt-2"><i class="fa-solid fa-arrow-right"></i></div></td>
                                    <td class=""><input type="text" name="name" id="name" class="form-control border-success " value="{{old('name',$product->name)}}">
                                     @error('name')
                                    <small class="text-danger">{{$message}}</small>
                                    @enderror</td>
                                </tr>
                                <tr>
                                    <th><div class=" ms-3">Price</div></th>
                                    <td><div class="mt-2"><i class="fa-solid fa-arrow-right"></i></div></td>                                    <td><input type="price" name="price" id="price" class="form-control border-success " value="{{old('price',$product->price)}}"> @error('price')
            <small class="text-danger">{{$message}}</small>
            @enderror</td>
                                </tr>
                               <tr>
                                    <th><div class="mt-2 ms-3">Category</div></th>
                                    <td><div class="mt-2"><i class="fa-solid fa-arrow-right"></i></div></td><td>
                                        <select name="category" id="" class="form-select border-success ">
                                            <option value="">Choose Category</option>
                                            @foreach ($category as $c)
<option value="{{$c->id}}" @if($c->id==$product->category_id) selected @endif>{{$c->name}}</option>

                                            @endforeach


                                        </select>
                                         @error('category')
            <small class="text-danger">{{$message}}</small>
            @enderror
                                    </td>
                                    </tr>
                                    <tr>
                                    <th><div class="mt-2 ms-3">WaitTime</div></th>
                                    <td><div class="mt-2"><i class="fa-solid fa-arrow-right"></i></div></td>                                    <td><input type="number" name="waiting_time" id="waiting_time" class="form-control border-success " value="{{old('waiting_time',$product->waiting_time)}}"> @error('waiting_time')
            <small class="text-danger">{{$message}}</small>
            @enderror</td>
                                    </tr>

                                    <tr>
                                        <th><div class="mt-2 ms-3">Info</div></th>
                                    <td><div class="mt-2"><i class="fa-solid fa-arrow-right"></i></div></td>                                    <td>
                                        <textarea name="description" class="form-control border-success" id="" cols="30" rows="10">{{old('description',$product->description)}}</textarea>
                                     @error('description')
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
