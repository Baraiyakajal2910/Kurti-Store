<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\color;
use App\Product;
use Session;
use DB;


class Colorcontroller extends Controller
{
    public function showColorAddForm()
    {
    	return view('layouts.admin.color.add');
    }

     public function changeStatus(Request $request)
    {
        color::whereId($request->id)->update(['deleted_at'=>$request->status]);
        session()->flash('success', 'Color status changed successfully!');
        return "success";

    }

    protected function checkName(Request $request)
    {
        $user = color::where('id','!=',$request->id )->where('name',$request->name)->first();
           if (isset($user)) {
                return json_encode(false);
           } else {
                  return json_encode(true);
            }
        // return response()->json(['msg'=>'km']);
    }

    protected function store(Request $request)
    {
        $validatedData = $request->validate([
        'name' => 'required|unique:colors',
        ]);

        $result = color::create(['name'=>$request->name]);
        if(isset($result))
        {
            session::flash('success','Color Added successfully');
            return redirect('admin/color/show');
        }
        else
        {
            session::flash('danger','Color can\'t Added successfully');
            return redirect('admin/color/add');
        }
    }

    protected function showTrashColor(Request $request)
    {
        $select = color::where('deleted_at',['T'])->get();
        return view('layouts.admin.color.trash')->with('name',$select);
    }

    protected function show(Request $request)
    {
    	//$select = DB::select("SELECT id, name, created_at, updated_at, deleted_at FROM colors");
	   $select = color::whereNotIn('deleted_at',['T'])->get();
	   return view('layouts.admin.color.show')->with('name',$select);
    }

     protected function showEditForm(Request $request,$id)
    {
        $color = color::findOrFail($id);
        return view('layouts.admin.color.edit',compact('color'));
    }

    protected function update(Request $request,$id)
    {
        $Product = Product::where('color_id',$id)->first();
        $color = color::where('id',$id)->where('deleted_at','Y')->first();
        
        if(isset($Product) && isset($color))
        {
            session::flash('danger','You can\'t delete Color it will be Used by Product');
            return redirect('admin/color/show');
        }

        $data = color::where('id',$request->id)
                 ->update(['deleted_at' => 'T']);

        if(isset($data))
        {
            session::flash('success','Product Deleted successfully');
            return redirect('admin/color/show');
        }
        else
        {
            session::flash('danger','Product can\'t ne deleted');
            return redirect('admin/color/show');
        }
            
    } 

    protected function restoreColor(Request $request,$id)
    {
            
        color::where('id',$request->id)
             ->update(['deleted_at' => 'Y']);
        return redirect('admin/color/show');
    }

    protected function edit(Request $request,$id)
    {
        $color = color::where('id','!=',$request->id )->where('name',$request->name)->first();
        if(isset($color))
        {
            $validatedData = $request->validate([
                    'name' => 'required|unique:colors',
                        ]);
        }
        else
        {
            $validatedData = $request->validate([
                    'name' => 'required',
                        ]);   
        }
        
        $data = color::where('id',$request->id)
             ->update(['name' => $request->name]);

        if(isset($data))
        {
            session::flash('success','Color Updated Successfully');
            return redirect('admin/color/show');
        }
        else
        {
            session::flash('danger','Color not Updated');
            return redirect('admin/color/add');
        }
    }
}
