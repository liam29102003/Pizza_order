<?php

namespace App\Http\Controllers\user;

use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function userHome()
    {
        $products = Product::orderBy('created_at','desc')->paginate(6);
                $categories = Category::orderBy('created_at','desc')->get();
        $cart = Cart::where('user_id',Auth::user()->id)->get();
        $data = Order::where('user_id',Auth::user()->id)->get();

        return view('user.home',compact('products','categories','cart','data'));
    }
    public function filter($id)
    {
          $products = Product::where('category_id',$id)->orderBy('created_at','desc')->paginate(6);
                $categories = Category::orderBy('created_at','desc')->get();
        $cart = Cart::where('user_id',Auth::user()->id)->get();
        $data = Order::where('user_id',Auth::user()->id)->get();

        return view('user.home',compact('products','categories','cart','data'));
    }
    public function filterByPrice(Request $request)
    {
        $products = Product::orderBy('created_at','desc');

        if(!($request->maxPrice == null))
        {
            $products = $products->where('price','<=',$request->maxPrice);
        }
        if(!($request->minPrice == null))
        {
            $products = $products->where('price','>=',$request->minPrice);
        }
        $products = $products->paginate(1000);
        $products->appends($request->all());
        $categories = Category::orderBy('created_at','desc')->get();
        $cart = Cart::where('user_id',Auth::user()->id)->get();
        $data = Order::where('user_id',Auth::user()->id)->get();
        return view('user.home',compact('products','categories','cart','data'));

    }
    public function passwordChange()
    {
        return view('user.profile.changePassword');
    }
    public function pizzaDetail($id)
    {
        $products = Product::where('id',$id)->first();
        $allproducts = Product::get();
        return view('user.pizzaDetail',compact('products','allproducts'));
    }
    public function profileDetail()
    {
        return view('user.profile.profileDetail');
    }
    public function updatePassword(Request $request)
    {
        // dd($request->all());
        $this->validatePassword($request);
        $id = Auth::user()->id;
        $dbpassword = User::select('password')->where('id',$id)->first()->password;
        if(Hash::check($request->oldPassword,$dbpassword))
        {
            User::where('id',$id)->update([
                'password'=>Hash::make($request->confirmPassword),
            ]);
            return back()->with(['passwordSuccess'=>'Password changed successfuly']);
        }
        return back()->with(['notMatch'=>'Wrong password']);

    }
    public function editprofile()
    {
        return view('user.profile.updateProfile');
    }
    public function updateProfile($id,Request $request)
    {
        $this->updateProfileValidation($request);
        $data = $this->updateProfileData($request);
    if(isset($request->image))
    {
        $dbImage = User::where('id',$id)->first();
        $dbImage = $dbImage->image;
        if($dbImage != null)
        {
            Storage::delete('public/'.$dbImage);
        }

            $filename=uniqid().'_'.$request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public',$filename);
        $data['image']=$filename;
    }

    User::where('id',$id)->update($data);
    return redirect()->route('user#profile')->with(['updateSuccess'=>"Profile updated successfully"]);

    }
    public function cart()
    {
        $data = Cart::select('carts.*','products.name','products.image','products.price')->leftJoin('products','product_id','=','products.id')->where('carts.user_id',Auth::user()->id)->get();
        $totalPrice = 0;
        foreach($data as $datas){
        $totalPrice += $datas->qunatity * $datas->price;
        }
        return view('user.cart',compact('data','totalPrice'));
    }
    //user order history
    public function history()
    {
        $data = Order::where('user_id',Auth::user()->id)->paginate(6);
        // dd($data->toArray());
        return view('user.history',compact('data'));
    }
    private function validatePassword($request)
    {

        Validator::make($request->all(),[
            'oldPassword' => 'required|min:6',
            'newPassword' => 'required|min:6|different:oldPassword',
            'confirmPassword'=> 'required|min:6|same:newPassword'
        ])->validate();

    }
     private function updateProfileData($request)
    {
         return['name'=>$request->name,
                'email'=>$request->email,
                'phone'=>$request->phone,
                'gender'=>$request->gender,
                'address'=>$request->address];
    }
    private function updateProfileValidation($request)
    {
        Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'gender' => 'required',
            'address'=>'required',

        ])->validate();
    }
}