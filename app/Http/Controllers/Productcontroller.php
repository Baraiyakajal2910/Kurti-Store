<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use File;
use App\color;
use App\Category;
use App\Product;
use App\Image;
use DB;

class Productcontroller extends Controller
{
    protected function showProductAddForm()
    {
    	$color = color::where('deleted_at','=','Y')->get();
        $brand = Category::where('deleted_at','=','Y')->get();
    	return view('layouts.admin.product.add',compact('color','brand'));
    }

     protected function store(Request $request)
    {
        // return $request;
        $validatedData = $request->validate([
            'brand_id'=>'required',
    		'color_id'=>'required',
        	'upc'=>'required|unique:products',
       		'name'=>'required|max:50',
            'access_url' => 'unique:products|max:50',
    		'description'=>'required',
      		'price'=>'required|numeric|between:0,999999.99',
            'stock'=>'required|integer|digits_between:1,4',
            'image'=>'required|mimes:jpg,png,jpeg,gif',
            // 'mul_img'=>'mimes:jpeg,jpg,png',
        // 'sort' => 'integer',
         ]);

        $result =Product::create($request->all());
            
            if($request->File('image'))
            {
                $image=$request->file('image');
                // $image->move('resources/assets/admin/images/product/'.$request->upc,'main.png');
                $path=resource_path().'/assets/admin/images/product/';
                if(!File::isDirectory($path))
                {
                    File::makeDirectory($path);
                    $image->move('resources/assets/admin/images/product/'.$request->upc,'main.png');
                }
                else
                {
                    $image->move('resources/assets/admin/images/product/'.$request->upc,'main.png');
                }
            }
            // dd($request->input('sort'));
            if($request->hasFile('mul_img'))
            {

                foreach ($request->file('mul_img') as $k=>$images) 
                {
                    Image::create(['product_id'=>$result->id,'name'=>$request->upc.'_'.$k.'.png','sort'=>$request->input('sort')[$k]]);
                    $images->move('resources/assets/admin/images/product/'.$request->upc,$request->upc.'_'.$k.'.png');
                }
            }
            if(isset($result))
            {
                session::flash('success','Product Added successfully');
                return redirect('admin/product/show');
            }   // dd($product);
            else
            {
                session::flash('danger','Product can\'t Added');
                return redirect('admin/product/add');
            }
        }

        
    protected function showTrashProduct(Request $request)
    {
       $product = Product::join('colors', 'colors.id', '=', 'products.color_id')
                ->join('brands', 'brands.id', '=', 'products.brand_id')
                ->select('products.*', 'colors.name as color_name', 'brands.name as brand_name')
                ->where('products.deleted_at','=','T')
                ->get();

        return view('layouts.admin.product.trash',compact('product'));
    }

    protected function show(Request $request)
    {
        $product = Product::join('colors', 'colors.id', '=', 'products.color_id')
                            ->join('brands', 'brands.id', '=', 'products.brand_id')
                            ->select('products.*', 'colors.name as color_name', 'brands.name as brand_name')
                            ->where('products.deleted_at','!=','T')
                            ->get();

        return view('layouts.admin.product.show',compact('product'));
    }

     protected function checkUpc(Request $request)
    {
        // dd($request);
        $user = Product::where('id','!=',$request->id)->where('upc',$request->upc)->first();
           if (isset($user)) {
                return json_encode(false);
           } 
           else 
           {
                  return json_encode(true);
            }
        // return response()->json(['msg'=>'km']);
    }

    protected function checkUrl(Request $request)
    {
        // return response()->json(['msg'=>$request->access_url]);
        $url =Product::where('id','!=',$request->id)->where('access_url',$request->access_url)->first();
        if(isset($url))
        {
            return json_encode(false);
        }
        else
        {
            return json_encode(true);
        }
    }

    protected function showEditForm(Request $request,$id)
    {
        $product = Product::findOrFail($id);
        $color = color::where('deleted_at','=','Y')->get();
        $brand = Category::where('deleted_at','=','Y')->get();
        $image = Image::where('product_id',$id)->get();
        return view('layouts.admin.product.edit',compact('color','brand','product','image'));
    }

    protected function update(Request $request,$id)
    {
        $data = Product::where('id',$id)
                 ->update(['deleted_at' => 'T']);

        if(isset($data))
        {
            session::flash('success','Product Deleted successfully');
        }
        else
        {
            session::flash('danger','Product can\'t ne deleted');
        }
        return redirect('admin/product/show');
    } 

    protected function restoreProduct(Request $request,$id)
    {
        Product::where('id',$id)
             ->update(['deleted_at' => 'Y']);
        return redirect('admin/product/show');
    }

    protected function edit(Request $request,$id)
    {
        $validatedData = $request->validate([
        'name'=>'required|max:20',
        'price'=>'required|numeric|between:0,999999.99',
        'stock'=>'required|integer|digits_between:1,4',
        'image'=>'mimes:jpg,png,jpeg,gif',
         ]);

        if($request->File('image'))
        {
            $image=$request->file('image');
            // $image->move('resources/assets/admin/images/product/'.$request->upc,'main.png');
            $path=resource_path().'/assets/admin/images/product/';
            if(!File::isDirectory($path))
            {
                File::makeDirectory($path);
                $image->move('resources/assets/admin/images/product/'.$request->upc,'main.png');
            }
            else
            {
                $image->move('resources/assets/admin/images/product/'.$request->upc,'main.png');
            }
        }
        if($request->input('id'))
        {
            $img=Image::where('product_id',$id)->whereNotIn('id',array_filter($request->input('id')))->get();
            foreach ($img as $imgs) 
            {
                File::delete('resources/assets/admin/images/product/'.$request->upc.'/'.$imgs->name);
                $imgs->delete();
            }
        }
        else
        {
            $img=Image::where('product_id',$id)->get();
            foreach ($img as $imgs) 
            {
                File::delete('resources/assets/admin/images/product/'.$request->upc.'/'.$imgs->name);
                $imgs->delete();
            }
        }

        if($request->hasFile('mul_img'))
            {
                foreach ($request->file('mul_img') as $key=>$images) 
                {
                    if(isset($request->id[$key]))
                    {
                        Image::where('id',$request->id[$key])->update(['product_id'=>$id,'name'=>$request->upc.'_'.$key.'.png','sort'=>$request->input('sort')[$key]]);
                        $images->move('resources/assets/admin/images/product/'.$request->upc,$request->upc.'_'.$key.'.png');
                    }
                    else
                    {
                        if(isset($request->sort[$key]))
                        {
                            Image::create(['product_id'=>$id,'name'=>$request->upc.'_'.$key.'.png','sort'=>$request->input('sort')[$key]]);
                            $images->move('resources/assets/admin/images/product/'.$request->upc,$request->upc.'_'.$key.'.png');
                        }
                        else
                        {
                            Image::create(['product_id'=>$id,'name'=>$request->upc.'_'.$key.'.png']);
                            $images->move('resources/assets/admin/images/product/'.$request->upc,$request->upc.'_'.$key.'.png');
                        }
                       Image::where('id',$request->id[$key])->update(['product_id'=>$id,'name'=>$request->upc.'_'.$key.'.png']); 
                       $images->move('resources/assets/admin/images/product/'.$request->upc,$request->upc.'_'.$key.'.png');
                    }
                }
            }

        $data = Product::where('id',$id)
                 ->update(['name' => $request->name,
                            'access_url' => $request->access_url,
                            'description' =>$request->description,
                            'price' => $request->price,
                            'stock' => $request->stock,
                    ]);
        if(isset($data))
        {
            session::flash('success','Product Updated Successfully');
            return redirect('admin/product/show');
        }
        else
        {
            session::flash('danger','Product not Updated');
            return redirect('admin/product/add');
        }
    }
    public function changeProductStatus(Request $request)
    {
        
        Product::whereId($request->id)->update(['deleted_at'=>$request->status]);
        session()->flash('success', 'Product status changed successfully!');
        return "success";

    }

}
