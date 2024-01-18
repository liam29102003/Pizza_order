<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderList;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function orderList()
    
    {
        $data = Order::select('orders.id','user_id','name','total_price','orders.created_at','order_code','status')->join('users','orders.user_id','=','users.id')->orderBy('created_at','desc')->paginate(5);
        // dd($data->toArray());
        return view('admin.Order.orderList',compact(['data']));
    }
    public function orderStatus($id)
    {
        $data = Order::select('orders.id','user_id','name','total_price','orders.created_at','order_code','status')->join('users','orders.user_id','=','users.id')->orderBy('created_at','desc');

        if($id == 'null')
        {
            $data = $data->paginate(5);
        }
      
        else
        {
            $data = $data->where('status',$id)->paginate(5);
        }
        $status = $id;
        // dd($data->toArray());
        // dd($id);
        return view('admin.Order.orderList',compact('data','id'));

    }
    public function orderDetail($orderCode)
    {
        $data = OrderList::select('order_lists.*','users.name as user_name','products.image','products.name','orders.total_price as total_price')
        ->leftJoin('users','users.id','order_lists.user_id')
        ->leftJoin('products','products.id','order_lists.product_id')
        ->leftJoin('orders','orders.order_code','order_lists.order_code')
        ->where('order_lists.order_code',$orderCode)->get();
        // dd($data->toArray());
        return view('admin.Order.orderDetail',compact('data'));
    }
}
