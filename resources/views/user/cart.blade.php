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
<div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0" id='dataTable'>
                    <thead class="thead-dark">

                        <tr>
                            <th>Products</th>
                            <th>Price(Kyats)</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        <?php $i = 0 ?>
                        @foreach ($data as $datas)
                        <?php $i++ ?>
                            <tr>
                            <td class="align-middle" align="left"><img src="{{asset('storage/'.$datas->image)}}" class="img-thumbnail" alt="" style="width: 70px;">&nbsp;&nbsp;&nbsp;{{$datas->name}}
                            <input type="text" name="" class="productId" value="{{$datas->product_id}}" hidden>
                            <input type="text" name="" class="userId" value="{{$datas->user_id}}" hidden>

                        </td>
                            <td class="align-middle" id='prices'>{{$datas->price}}</td>
                            <td class="align-middle">
                                 <div class="input-group quantity mx-auto" style="width: 100px;">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-primary btn-minus" id='minusBtn<?php echo $i ?>' value="{{$datas->id}}">
                                        <i class="fa fa-minus" id='minusBtn<?php echo $i ?>'></i>
                                        </button>
                                    </div>
 <input type="text" class="form-control form-control-sm bg-secondary border-0 text-center" value="{{$datas->qunatity}}" disabled id='qty'>                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-primary btn-plus" id='plusBtn<?php echo $i ?>' value="{{$datas->id}}">
                                            <i class="fa fa-plus" id='plusBtn<?php echo $i ?>'></i>
                                        </button>
                                    </div>
                                </div>

                            </td>
                            <td class="align-middle" id = 'total'>{{$datas->price * $datas->qunatity}}</td>
                            <td class="align-middle"><button class="btn btn-sm btn-danger removeBtn" id='removeBtn<?php echo $i ?>' value="{{$datas->id}}"><i class="fa fa-times" id='removeBtn<?php echo $i ?>'></i></button></td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart Summary</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h6>Subtotal</h6>
                            <h6 id ='subtotal'>{{$totalPrice}} kyats</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Delivery</h6>
                            <h6 class="font-weight-medium">3000 kyats</h6>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total</h5>
                            <h5 id='totalPrice'>{{$totalPrice + 3000}} kyats</h5>
                        </div>
                        <button class="btn btn-block btn-danger font-weight-bold my-3 py-3" id='clearBtn'>Clear Cart</button>

                        <button class="btn btn-block btn-primary font-weight-bold my-3 py-3" id='checkBtn'>Proceed To Checkout</button>
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
        $('.btn-plus').click(function(event)
        {
            hello  = event.target.id;
            // console.log(hello);
            product_id = document.getElementById(hello).value;
            $parentNode = $(this).parents('tr');
            $price = $parentNode.find('#prices').html();
            $qty = Number($parentNode.find('#qty').val());
            $parentNode.find('#total').html(($price) * $qty);
            calculateSummary();
            $.ajax({
                type : 'get',
                url : `http://localhost/Pizza/public/ajax/pizza/updateCart/${product_id}`,
                data:{'count' : $qty},
                dataType : 'json',
                success : function(response){
                   console.log(response);
                }})


        })
         $('.btn-minus').click(function()
        {
            hello  = event.target.id;
            // console.log(hello);
            product_id = document.getElementById(hello).value;
            $parentNode = $(this).parents('tr');
            $price = $parentNode.find('#prices').html();
            $qty = Number($parentNode.find('#qty').val());
            $parentNode.find('#total').html(($price) * $qty);
            calculateSummary();
            $.ajax({
                type : 'get',
                url : `http://localhost/Pizza/public/ajax/pizza/updateCart/${product_id}`,
                data:{'count' : $qty},
                dataType : 'json',
                success : function(response){
                   console.log(response);
                }})

        })
        // $('rn').click(function(event)
        // {
            
            $('.removeBtn').click(function(event){
                
            hello  = event.target.id;
            product_id = document.getElementById(hello).value;
            $parentNode = $(this).parents('tr');
            $parentNode.remove();
            calculateSummary();
            // console.log(product_id);
            // });
            $.ajax({
                type : 'get',
                url : `http://localhost/Pizza/public/ajax/pizza/deleteCart/${product_id}`,
                data:{'status':'desc'},
                dataType : 'json',
                success : function(response){
                    console.log(response);
                   
                }
            })
        })
        function calculateSummary()
        {
             $totalPrice = 0;
            $('#dataTable tr').each(function(index,row){
                $totalPrice += Number($(row).find('#total').text());
            })
            $('#subtotal').text($totalPrice + ' kyats' );
            $('#totalPrice').text($totalPrice + 3000 + 'kyats');
        }

        $('#checkBtn').click(function()
        {
            $orderList = [];
            // Object.assign({}, $orderList);
            $randomNumber = Math.floor(Math.random() * 100000001);
             $('#dataTable tbody tr').each(function(index,row){
                $orderList.push({
                    'userId' :$(row).find('.userId').val(),
                    'productId' : $(row).find('.productId').val(),
                    'quantity' : $(row).find('#qty').val(),
                    'total' : $(row).find('#total').text(),
                    'orderCode' : 'POS'+ $randomNumber,

                })
            })
            console.log(Object.assign({}, $orderList));
            $.ajax({
                type : 'get',
                url : `http://localhost/Pizza/public/ajax/pizza/addOrder`,
                data:Object.assign({}, $orderList),
                dataType : 'json',
                success : function(response){
                    if(response.status == 'success')
                    {
                        window.location.href = `http://localhost/Pizza/public/user/userHome`;
                    }
                   
                }
            })

        })
        $('#clearBtn').click(function()
        {
            $('#dataTable tbody tr').remove();
            $('#subtotal').html('0 kyats')
            $('#totalPrice').html('3000 kyats');
            $.ajax({
                type : 'get',
                url : `http://localhost/Pizza/public/ajax/pizza/clear/cart`,
                // data:Object.assign({}, $orderList),
                // dataType : 'json',
               
            })

        })

    })
</script>
@endsection
