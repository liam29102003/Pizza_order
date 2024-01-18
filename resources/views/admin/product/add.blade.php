@extends('admin.layouts.master')
@section('search')
    <h4>Admin Panel</h4>
@endsection
@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-3 offset-8">
                    <a href="{{route('admin#productList')}}"><button class="btn bg-dark text-white my-3">List</button></a>
                </div>
            </div>
            <div class="col-lg-6 offset-3">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Add Pizza</h3>
                        </div>
                        <hr>
                        <form action="{{route('admin#createProduct')}}" method="post" novalidate="novalidate" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="cc-payment" class="control-label mb-1"> Name</label>
                                <input id="cc-pament" name="name" type="text" class="form-control @error("name") is-invalid

                                @enderror" aria-required="true" aria-invalid="false" placeholder="pizza name" value="{{old('name')}}">
                            @error('name')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="cc-payment" class="control-label mb-1">Category</label>
                                <select name="category" id="" class="form-select @error("category") is-invalid

                                @enderror">
                                        <option value="">Choose Category</option>

                                    @foreach ($category as $categories)
                                        <option value="{{$categories->id}}">{{$categories->name}}</option>
                                    @endforeach
                                </select>
                                {{-- <input id="cc-pament" name="name" type="text" class="form-control @error("name") is-invalid

                                @enderror" aria-required="true" aria-invalid="false" placeholder="e.g. Seafood..." value="{{old('name')}}">--}}
                            @error('category')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="cc-payment" class="control-label mb-1">Price</label>
                                <input id="cc-pament" name="price" type="text" class="form-control @error("price") is-invalid

                                @enderror" aria-required="true" aria-invalid="false" placeholder="product price in kyats" value="{{old('price')}}">
                            @error('price')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="cc-payment" class="control-label mb-1">Waiting Time</label>
                                <input id="cc-pament" name="waiting_time" type="number" class="form-control @error("waiting_time") is-invalid

                                @enderror" aria-required="true" aria-invalid="false" placeholder="waiting time in minutes" value="{{old('waiting_time')}}">
                            @error('price')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="cc-payment" class="control-label mb-1">Description</label>
                                <textarea id="cc-pament" name="description" type="text" class="form-control @error("description") is-invalid

                                @enderror" aria-required="true" aria-invalid="false" cols="50" row='0' value="{{old('description')}}"></textarea>
                            @error('description')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="cc-payment" class="control-label mb-1">Image</label>
                                <input id="cc-pament" name="image" type="file" class="form-control @error("image") is-invalid

                                @enderror" aria-required="true" aria-invalid="false"  value="{{old('image')}}">
                            @error('image')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                            </div>

                            <div>
                                <button id="payment-button" type="submit" class="mt-2 btn btn-lg btn-info btn-block">
                                    <span id="payment-button-amount">Create</span>
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
