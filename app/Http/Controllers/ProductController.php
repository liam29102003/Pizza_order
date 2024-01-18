<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function productList()
    {
        $products = Product::select('products.*','categories.name as category_name')
                    ->when(request('search'),function($query){
                    $query->where('products.name','like','%'.request('search').'%');
                    })
                    ->leftJoin('categories','products.category_id','=','categories.id')
                    ->orderBy('products.id','desc')->paginate(5);
        return view('admin.product.list')->with(['products'=>$products]);

    }
    public function detailProduct($id)
    {
        $product = Product::select('products.*','categories.name as category_name')
        ->leftJoin('categories','products.category_id','categories.id')
                    ->where('products.id',$id)->first();
        return view('admin.product.detail')->with(['product'=>$product]);
    }
    public function addProduct()
    {
                $category = Category::select('name','id')->get();

        return view('admin.product.add',compact('category') );
    }
    public function editProduct($id)
    {
        $product = Product::where('id',$id)->first();
        $category = Category::get();
        return view('admin.product.edit',compact('product','category'));

    }
    public function updateProduct(Request $request,$id)
    {
        $this->validateProductData($request,'update');
        $data = $this->createProductData($request);
        if(isset($request->image))
        {
           $dbImage =  Product::where('id',$id)->first();
           $dbImage = $dbImage['image'];
           Storage::delete('public/'.$dbImage);

            $filename=uniqid().'_'.$request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public',$filename);
        $data['image']=$filename;
        }
            Product::where('id',$id)->update($data);

        return redirect()->route('admin#productList')->with(['updateSuccess'=>"Successfully updated category"]);

    }
    public function deleteProduct($id)
    {
        Product::where('id',$id)->delete();
        return back()->with(['deleteSuccess'=>'Product deleted successfully']);
    }
    public function createProduct(Request $request)
    {

        $this->validateProductData($request,'create');
        $data = $this->createProductData($request);
         $filename=uniqid().'_'.$request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public',$filename);
        $data['image']=$filename;
        Product::create($data);
        return redirect()->route('admin#productList')->with(['productSuccess'=>'New Product Created Successfully']);
    }
    private function validateProductData($request,$action)
    {
        $validateData = [
            'name' => 'required|unique:products,name,'.$request->id,
            'category' => 'required',
            'price' => 'required',
            'waiting_time'=>'required',
            'description' => 'required',
            // 'image'=>'required|memes:jpg,jpeg,webp,png|file',

        ];
        $validateData['image'] = $action == 'create' ?'required|mimes:jpg,jpeg,webp,png|file' : 'mimes:jpg,jpeg,webp,png|file' ;
        Validator::make($request->all(),$validateData)->validate();
    }
    private function createProductData($request)
    {
        return  [
            'name' => $request->name,
            'category_id' => $request->category,
            'description' => $request->description,
            'price'=>$request->price,
            'waiting_time'=>$request->waiting_time,

        ];
    }
}