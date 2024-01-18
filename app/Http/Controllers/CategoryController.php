<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function list(){
        $categories =  Category::when(request('search'),function($query)
        {$query->where('name','like','%'.request('search').'%');})
        ->orderBy('id','desc')->paginate(4);
         return view('admin.category.list',compact('categories'));
     }
    //create section
    public function add()
    {
        return view('admin.category.add');
    }
    public function create(Request $request)
    {
        $this->validateCategoryData($request);
        Category::create($this->createCategoryData($request));
        return redirect()->route('admin#list')->with(['createSuccess'=>"Successfully add new category"]);
    }
    private function validateCategoryData($request)
    {
        Validator::make($request->all(),[
            'name' =>'required|unique:categories,name'
        ])->validate();
    }
    private function createCategoryData($request)
    {
        return['name'=>$request->name];
    }
    //delete section
    public function delete($id)
    {
        Category::where('id',$id)->delete();
        return back()->with(['deleteSuccess'=>'Successfully deleted category']);
    }

    //edit ection
    public function edit($id)
    {
        $category = Category::where('id',$id)->first();
        return view('admin.category.edit',compact('category'));
    }
    public function update($id,Request $request)
    {
        $this->validateUpdateData($id,$request);
        Category::where('id',$id)->update($this->updateCategoryData($request));
        return redirect()->route('admin#list')->with(['updateSuccess'=>"Successfully updated category"]);
    }
    private function validateUpdateData($id,$request)
    {
        Validator::make($request->all(),[
            'name' =>'required|unique:categories,name,'.$id
        ])->validate();
    }
    private function updateCategoryData($request)
    {
        return['name'=>$request->name];
    }
}
