
@extends('admin.layouts.master')
@section('search')
    <h4>Admin Panel</h4>
@endsection

@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            
            <div class="col-lg-8 offset-2">
                
                <a href="{{route('admin#contactList')}}"><button class="btn btn-success mb-2" >Back</button></a>
                <div class="card shadow shadow-lg bg-light">
                     <div class="card-header p-3 bg-success">
                            <h3 class="text-center text-white title-2 fw-3">Contact Details</h3>
                        </div>

                    <div class="card-body">

                        <table  class="table table-borderless border border-2  table-hover" >
                            <tbody>
                                <tr class="">
                                  
                                    <td class="pt-3"><input type="hidden" name="" id='contactId' value={{$data->id}}></td>

                                    <td class="pt-3"><span class="fs-6">From - </span><span class= >{{$data->name}}</span>

                                <div class="mt-2"><span class="fs-6">Subject - </span><span>{{$data->subject}}</span>
                                {{-- <button  class="btn shadow btn-sm btn-success"><i class="fa-regular fa-folder me-2"></i>{{$product->category_name}}</button> --}}

                                </div>
                                @if($data->OEmail == null)
                                <div class="mt-2"><span class="fs-6">Reply Email - </span><span>{{$data->email}}</span>
                                    {{-- <button  class="btn shadow btn-sm btn-success"><i class="fa-regular fa-folder me-2"></i>{{$product->category_name}}</button> --}}
    
                                    </div>
                                    @else
                                    <div class="mt-2"><span class="fs-6">Reply Email - </span><span>{{$data->OEmail}}</span>
                                        {{-- <button  class="btn shadow btn-sm btn-success"><i class="fa-regular fa-folder me-2"></i>{{$product->category_name}}</button> --}}
        
                                        </div>
                                        @endif
                                        @if(!$data->OPhone == null)

                                    <div class="mt-2"><span class="fs-6">Reply Phone - </span><span>{{$data->OPhone}}</span>
                                        {{-- <button  class="btn shadow btn-sm btn-success"><i class="fa-regular fa-folder me-2"></i>{{$product->category_name}}</button> --}}
        
                                        </div>
                                        @endif
                                <div class="mt-2">
                                    {{-- <button  class="btn shadow btn-sm btn-success me-1"><i class="fa-solid fa-hourglass-start me-2"></i>{{$product->waiting_time}} mins</button><button  class="btn shadow btn-sm btn-success"><i class="fa-solid fa-circle-info me-2"></i>{{$product->view_count}}</button></div> --}}
                                </td>
</tr>
                                <tr><td class colspan="3" class="text-center">
                                    <h4>Message -</h4>
                                    <p class="ms-3">{{$data->message}}</p>
                                    </td>
                                </tr>


                               
                            </tbody>
                        </table>
                    </div>
                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scriptSource')
<script>
    $(document).ready(function()
    {
        $.ajax({
                type : 'get',
                url : 'http://localhost/Pizza/public/ajax/contact/view',
                data:{'id' : $('#contactId').val()},
                dataType : 'json',
        });
      

    })
    </script>
@endsection

