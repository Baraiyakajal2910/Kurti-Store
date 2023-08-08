<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Category;
use App\Product;
use DB;
use Session;

class Categorycontroller extends Controller
{
    public function showCategoryAddForm()
    {
    	return view('layouts.admin.category.add');
    }

     public function changeBrandStatus(Request $request)
    {
         // return response()->json(['success'=>'Status change successfully.']);
        Category::whereId($request->id)->update(['deleted_at'=>$request->status]);
        session()->flash('success', 'Category status changed successfully!');
    

    }

    protected function checkBrandname(Request $request)
    {
        $user = Category::where('id','!=',$request->id )->where('name',$request->name)->first();
           if (isset($user)) {
                return json_encode(false);
           } else {
                  return json_encode(true);
            }
        // return response()->json(['msg'=>'efewg']);
    }

    protected function store(Request $request)
    {
        //return $request;
        $validatedData = $request->validate([
        'name' => 'required|unique:brands',
        ]);


        $result = Category::create(['name'=>$request->name]);
        if(isset($result))
        {
            session::flash('success','Record Added successfully');
            return redirect('admin/categories/show');
        }
        else
        {
            session::flash('danger','Category can\'t Added');
            return redirect('admin/categories/add');
        }
    }

    protected function showTrashCategory(Request $request)
    {
        $select = Category::where('deleted_at',['T'])->get();
        return view('layouts.admin.category.trash')->with('name',$select);
    }

    protected function show(Request $request)
    {
    	$select = Category::where('deleted_at','!=','T')->get();
    	return view('layouts.admin.category.show')->with('name',$select);
    }

     protected function showEditForm(Request $request,$id)
    {            
        $category = Category::findOrFail($id);
        return view('layouts.admin.category.edit',compact('category'));
    }

    protected function update(Request $request,$id)
    {
        $product = Product::where('brand_id',$id)->first();
        $category = Category::where('id',$id)->where('deleted_at','Y')->first();
        
        if(isset($product) && isset($category))
        {
            session::flash('danger','You can\'t delete Category it will be Used by Product');
            return redirect('admin/categories/show');
        }

        $data = Category::where('id',$request->id)
                 ->update(['deleted_at' => 'T']);

        if(isset($data))
        {
            session::flash('success','Category Deleted successfully');
            return redirect('admin/categories/show');
        }
        else
        {
            session::flash('danger','Category can\'t ne deleted');
            return redirect('admin/categories/show');
        }
    } 

    protected function restoreCategory(Request $request,$id)
    {
            Category::where('id',$request->id)
                        ->update(['deleted_at' => 'Y']);
            return redirect('admin/categories/show');
    }

    protected function edit(Request $request,$id)
    {
        $category = Category::where('id','!=',$request->id )->where('name',$request->name)->first();
        if(isset($category))
        {
            $validatedData = $request->validate([
                    'name' => 'required|unique:brands',
                        ]);
        }
        else
        {
            $validatedData = $request->validate([
                    'name' => 'required',
                        ]);   
        }
        
        $data = Category::where('id',$request->id)
             ->update(['name' => $request->name]);

        if(isset($data))
        {
            session::flash('success','Category Updated Successfully');
            return redirect('admin/categories/show');
        }
        else
        {
            session::flash('danger','Category not Updated');
            return redirect('admin/categories/add');
        }
    }
}
