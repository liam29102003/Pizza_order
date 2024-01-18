@extends('admin.layouts.master')
@section('search')
<h3>Admin Panel</h3>

@endsection
@section('content')
<div class="main-content"style="padding-top: 7%">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <!-- DATA TABLE -->
                <div class="table-data__tool">
                    <div class="table-data__tool-left">
                        <nav aria-label="...">
                            <ul class="pagination">
                                <li class="page-item" ><a class="page-link"   href="{{route('admin#orderStatus','null')}}">All</a></li>
    
                              <li class="page-item " ><a class="page-link text-warning"  href="{{route('admin#orderStatus',0)}}">Pending..</a></li>
                              <li class="page-item" ><a class="page-link text-success"  href="{{route('admin#orderStatus',1)}}">Success</a></li>
                              <li class="page-item" ><a class="page-link text-danger"  href="{{route('admin#orderStatus',2)}}">Reject</a></li>
    
                            </ul>
                          </nav>
                    </div>
                    <div class="table-data__tool-right">
                        <button class="btn btn-success" >
                            Total-{{$data->total()}}
                        </button>
                        {{-- <a href="{{route('admin#addProduct')}}">
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                <i class="zmdi zmdi-plus"></i>add product
                            </button>
                        </a>
                        <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                            CSV download
                        </button> --}}

                    </div>
                </div>
                @if(session('productSuccess'))
                <div class=" alert alert-success alert-dismissible fade show" role="alert">
                    {{session('productSuccess')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                 @if(session('deleteSuccess'))
                <div class=" alert alert-danger alert-dismissible fade show" role="alert">
                    {{session('deleteSuccess')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                 @if(session('updateSuccess'))
                <div class=" alert alert-warning alert-dismissible fade show" role="alert">
                    {{session('updateSuccess')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                @if(request('search'))

                <h3 class="">Search Key: <button class="btn btn-success" disabled>"{{request('search')}}"</button></h3>

                @endif
                {{-- <div class="container">
                    <div class="row">
                        <div class="col-2 text-center">
                            
                                <span>Order Status </span>  
                        
                            <select name="" id="status" class="text-dark form-control text-center">
                                <option value='null'  >All</option>
            
                                <option value="0"  >Pending ...</option>
                                <option value="1" >Success</option>
                                <option value="2" >Reject </option>
            
                            </select>
                        
                            
                        </div>
                    </div> --}}
                   
                    
                
                
            </div>
            <div class="card mt-0">
                <div class="card-header p-2 text-center">
                    <h4 class="title-1 ">Order List</h2>

                </div>
                <div class="card-body">
                <div class="table-responsive table-responsive-data2">

                    <table class="table table-data2 border">
                        <thead class="bg-success">
                            <tr>
                                <th class="text-center text-white">User Id</th>

                                <th class="text-center text-white">User Name</th>
                                <th class="text-center text-white">Order Date</th>
                                <th class="text-center text-white">Order Code</th>
                                <th class="text-center text-white">Amount</th>
                                <th class="text-center text-white">status</th>
                                {{-- <th>price</th> --}}
                                <th></th>
                            </tr>
                        </thead>
                        

                        <tbody id='dataList'>@if(count($data) == 0)

                                <tr><td colspan="6" class="text-center "><small>There is no data</small>
                                    </td></tr>

                            @else
                            @foreach ($data as $product)
                            <tr class="tr-shadow">
                                {{-- <td class="col-2 text-center"><img class= "img-thumbnail" src="{{asset('storage/'.$product->image)}}" alt=""></td> --}}
                                <td class="d-none"><input type='text' id ='' class="orderId text-center"  value={{$product->id}}></td>

                                <td class="text-center">{{$product->user_id}}</td>
                                <td class="text-center">{{$product->name}}</td>
                                <td class="text-center">{{$product->created_at->Format('j-F-Y')}}</td>
                                <td class="text-center"><a href="{{route('admin#orderDetail',$product->order_code)}}">{{$product->order_code}}</a>
                                    </td>
                                <td class="text-center">{{$product->total_price}}</td>
                                <td class="text-center abc">
                                    {{-- <select name="" id="" class="text-white border-0   form-control @if($product->status ==0)   bg-warning @elseif($product->status ==1) bg-success @elseif($product->status ==2) bg-danger @endif"> --}}
                                        <select name="" id="" class="text-dark  listStatus  form-control ">

                                        <option value="0" @if($product->status ==0)  selected @endif >Pending ...</option>
                                        <option value="1" @if($product->status ==1)  selected @endif>Success</option>
                                        <option value="2" @if($product->status ==2)  selected @endif>Reject </option>

                                    </select>
                                    
                                </td>


                                {{-- <td>
                                    <div class="table-data-feature">
                                        <a href="{{route('admin#detailProduct',$product->id)}}">
                                        <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                            <i class="fa-solid fa-info"></i>
                                        </button>
                                        </a>
                                        <a href="{{route('admin#editProduct',$product->id)}}">
                                        <button class="item ms-2" data-toggle="tooltip" data-placement="top" title="Edit">
                                            <i class="zmdi zmdi-edit"></i>
                                        </button>
                                        </a>
                                        <a href="{{route('admin#productDelete',$product->id)}}">
                                        <button class="item ms-2" data-toggle="tooltip" data-placement="top" title="Delete">
                                            <i class="zmdi zmdi-delete"></i>
                                        </button>
                                        </a>

                                    </div>
                                </td> --}}
                            </tr>
                        
                            <tr class="spacer"></tr>
                            @endforeach
@endif

                        </tbody>
                    </span>
                    </table>
                    <div>
                        {{$data->appends(request()->query())->links()}}
                    </div>
                </div>
                <!-- END DATA TABLE -->
            </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scriptSource')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>    <!-- Bootstrap JS-->

     <script>

$(document).ready(function()
    {
        // $('#status').change(function(){
        //     month = ['January','Feburary','March','April','May','June','July','August','September','October',"November",'December'];
        //     list = ''
        //    data =  $('#status').val();
           
        //     $.ajax({
        //         type : 'get',
        //         url : 'http://localhost/Pizza/public/ajax/status',
        //         data:{'status':data},
        //         dataType : 'json',
        //         success : function(response){
        //             for(i = 0; i < response.length; i++)
        //             {
        //                 let message0 = '';
        //                 let message1 = '';
        //                 let message2 = '';
        //                 if(response[i].status == 0)
        //                 {
        //                     message0 ='selected'; 
        //                 }
        //                 else if(response[i].status == 1)
        //                 {
        //                     message1 ='selected'; 
        //                 }
        //                 else if(response[i].status == 2)
        //                 {
        //                     message2 ='selected'; 
        //                 }

        //                 $date = new Date(response[i].created_at);
        //                 $year = $date.getFullYear();
        //                 $day = $date.getDate();
        //                 $month = month[$date.getMonth()];
        //                 date = $day + '-' + $month + '-' + $year;
        //                 // console.log(date);
        //                 list += ` <tr class="tr-shadow">
        //                     <td class="d-none"><input type='text' id ='' class="orderId text-center"  value='''></td>

        //                         <td class="text-center">${response[i].user_id}</td>
        //                         <td class="text-center">${response[i].name}</td>
        //                         <td class="text-center">${date}</td>
        //                         <td class="text-center">${response[i].order_code}</td>
        //                         <td class="text-center">${response[i].total_price}</td>
        //                         <td class="text-center abc">
        //                             <select name="" id="listStatus" class="text-dark  listStatus  form-control ">

        //                                 <option value="0" ${message0}     >Pending ...</option>
        //                                 <option value="1" ${message1}   >Success</option>
        //                                 <option value="2" ${message2}    >Reject </option>

        //                             </select>
                                    
        //                         </td>


        //                     </tr>`
        //             }
        //             $('#dataList').html(list);

        //         }
        //     });
        //     // console.log($('.abc .listStatus').val());
      

        // });
        $('.abc .listStatus').change(function()
        {
            status = $(this).val();
            parentNode = $(this).parents('tr');
            orderCode = parentNode.find(' .orderId').val();
            // console.log("");
            $.ajax({
                type : 'get',
                url : 'http://localhost/Pizza/public/ajax/update/status',
                data:{'status':status, 'order_code' : orderCode},
                dataType : 'json'
            });
        })
    })

        </script>
@endsection
