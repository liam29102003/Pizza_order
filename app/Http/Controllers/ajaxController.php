<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Contact;
use App\Models\Product;
use App\Models\OrderList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ajaxController extends Controller
{
    public function order(Request $request)
    {
        
        if($request->status == 'asc')
        {
        $data = Product::orderBy('created_at','asc')->paginate(6);
        }
        else if($request->status == 'desc')
        {
        $data = Product::orderBy('created_at','desc')->paginate(6);
        }
        return $data;
    }
    //increase view count
    public function view(Request $request)
    {
        $data = Product::where('id',$request->id)->first();
        // logger($data->toArray());
        Product::where('id',$request->id)->update(['view_count'=> $data['view_count'] + 1]);
        
    }
    public function contactView(Request $request)
    {
        logger($request);
        // logger($data->toArray());
        Contact::where('id',$request->id)->update(['view'=> 'yes']);
        
    }
    public function addCart(Request $request)
    {
        $this->addCartData($request);
        Cart::create($this->addCartData($request));
        $response =[
            'message'=>'add to cart complete',
            'status'=>'success'
        ];
        return response()->json($response, 200);
    }
    public function deleteCart($id)
    {
        Cart::where('id',$id)->delete();
        $response =[
            'message'=>'delete to cart complete',
            'status'=>'success'
        ];
        return response()->json($response, 200);
        // Category::where('id',$id)->delete();

    }
    //update Cart
    public function updateCart($id,Request $request)
    {
        Cart::where('id',$id)->update(['qunatity'=>$request->count]);
        $response =[
            'message'=>'update quantity to cart complete',
            'status'=>'success'
        ];
        return response()->json($response, 200);
        
    }
    public function addOrder(Request $request)
    {
        $total = 0;
        foreach($request->all() as $item)
        {
            $total += $item['total'];
            $order_code = $item['orderCode'];
            OrderList::create(
                [
                    'user_id' => $item['userId'],
                    'order_code' =>$item['orderCode'],
                    'total' => $item['total'],
                    'qty' => $item['quantity'],
                    'product_id'=>$item['productId']
                ]
                );
        }
        Order::create(
            [
                'user_id' => Auth::user()->id,
                'order_code' => $order_code,
                'total_price' => $total + 3000,
            ]
            );
        Cart::where('user_id',Auth::user()->id)->delete();
        $response =[
            'message'=>'update quantity to cart complete',
            'status'=>'success'
        ];
        return response()->json($response, 200);
    }
    public function clearCart()
    {
        Cart::where('user_id',Auth::user()->id)->delete();
    }
    public function status(Request $request)
    {
        $status = $request->status;
        $data = Order::select('orders.id','user_id','name','total_price','orders.created_at','order_code','status')->join('users','orders.user_id','=','users.id')->orderBy('orders.id','desc');
        if($status !== 'null')
        {
            $data = $data->where('status',$status)->get();
        }
        else
        {
            $data = $data->get();

        }
        return $data;
    }
    //change order status
    public function updateStatus(Request $request)
    {
        Order::where('id',$request->order_code)->update(['status'=>$request->status]);
    }
    private function addCartData($request)
    {
        return [
            'user_id'=>$request->userId,
            'product_id'=>$request->productId,
            'qunatity'=>$request->count
        ];
    }

}
