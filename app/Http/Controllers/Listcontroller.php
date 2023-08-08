<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\color;
use App\cart;
use App\Image;
use App\Category;
use App\Product;
use Illuminate\Support\Facades\Session;

class Listcontroller extends Controller
{
    protected function showList()
    {
        // $product = showCart();
        // return $product[0]['upc'];
        $color = color::where('deleted_at','=','Y')->get();
        $brand = Category::where('deleted_at','=','Y')->get();
        $product = Product::where('deleted_at','=', 'Y')->get();
        return view('layouts.front.product.products',compact('color','brand','product'));
        // return 'asf';
    }
    // public function 

    protected function showDetailForm(Request $request, $access_url)
    {
        // return $request;
        $product = Product::where('access_url',$access_url)->where('deleted_at','=','Y')->first();
        // return $product;
        if(isset($product))
        {
            $image = Image::where('product_id',$product->id)->get();
            // return $image;
            $detail_item=Session::get('cart',[]);
            if(isset($detail_item)){
                foreach ($detail_item as $key=>$ditem) 
                {
                    // echo $ditem['id'];
                    // echo $product->id;
                    if($product->id == $ditem['id'])
                    {

                        $product_qty=$ditem['qty'];

                    }
                    else
                    {
                        $product_qty=1;

                    }
                }
            }
            else
            {
                return view('layouts.front.product.cart');   
            }
            // if(Auth::user() && Auth::user()->role != 1)
            // {
            //     $cart=cart::where('user_id',Auth::user()->id)->get();
            //     return $cart;
            //     if(isset($cart->qty))
            //     {$product_qty=$cart->qty;
            //       // return $product_qty;  
            //     }
            //     else
            //     {$product_qty=1;}
            //     // return $product_qty;
            // }    
                $product_qty=1;
                // return $product_qty;
            
        	return view('layouts.front.product.detail',compact('product','image','product_qty'));
        }
        else
        {
            return view('layouts.front.common.error');
        }
    }

    public function sort(Request $request)
    {
        // return $request; 
        if (isset($request->brand_id) && isset($request->color_id)) 
        {
            $product = Product::whereIn('color_id',$request->color_id)->whereIn('brand_id',$request->brand_id)->where('deleted_at','Y')->whereBetween('price',[$request->input('min_price'),$request->input('max_price')])->get();
        }
        elseif(isset($request->brand_id))
        {
            $product = Product::whereIn('brand_id',$request->brand_id)->where('deleted_at','Y')->whereBetween('price',[$request->input('min_price'),$request->input('max_price')])->get();           
        }
        elseif (isset($request->color_id)) 
        {
            $product = Product::whereIn('color_id',$request->color_id)->where('deleted_at','Y')->whereBetween('price',[$request->input('min_price'),$request->input('max_price')])->get();   
        } 
        elseif (isset($request->min_price) && isset($request->max_price)) 
        {
            $product = Product::whereBetween('price',[$request->input('min_price'),$request->input('max_price')])->where('deleted_at','Y')->get();
        } 
        else
        {
            $product = Product::where('deleted_at','Y')->get();
        }

        if(!$product->isEmpty())
        {
            if($request->grid_list == "true")
            {
                return view('layouts.front.product.grid',compact('product'));
            }
            // elseif($request->grid_list == "false")
            // {
            //     return view('layouts.front.product.grid',compact('product'));
            // }
            else
            {
                return view('layouts.front.product.list',compact('product'));   
            }
        }
        else
        {
            return view('layouts.front.product.error');
        }
    }

    public function showMyCart()
    {
        //  $cart_item = showCart();
        //  // return $cart_item[0][1]['id'];

        // foreach ($cart_item[0] as $key => $product) {
        //     echo $product['id'].' '.$cart_item[1][$key].'<br>';
        // }
        if(Auth::check() && Auth::user()->role != 1)
        {
            $products=showCart();
            // return $products;
            return view('layouts.front.product.cart',compact('products')); 
        }
        else
        {
            $product_id=[];
            $product_qty=[];
            $cart_item=Session::has('cart')?Session::get('cart',[]):null;
            // dd($cart_item);
                if(isset($cart_item)){
                    foreach ($cart_item as $key=>$citem) 
                    {
                        // echo $citem['id'];
                        $product_id[]=$citem['id'];
                        $product_qty[]=$citem['qty'];
                    }
                }
                else
                {
                    return view('layouts.front.product.cart');
                }
            // dd($product_id);
            $sessionproducts = (Product::whereIn('id',$product_id)->get())->toArray();
            // return $sessionproducts;
            $products=null;
            foreach ($sessionproducts as $key => $product) 
            {
                $products[] = array_merge($product, array('qty' => $product_qty[$key]));
            }
            
            return view('layouts.front.product.cart',compact('products')); 
        }
    }

    public function addToCart(Request $request)
    {
        // return $request;       
         if(Auth::user() && Auth::user()->role != 1)
        {
            $data = cart::where('user_id', Auth::user()->id)->where('product_id', $request->id)->first();
            // dd($data);
            if(isset($data)){
                $data->update(['qty' => isset($request->qty) ? $request->qty : 1]);
            }
            else
            {
                $data = cart::create(['user_id' => Auth::user()->id,
                                      'product_id' => $request->id,
                                      'qty' => (isset($request->qty) ? $request->qty : 1),
                                  ]);
                // return $data;
                // return response()->json($request->session()->get('data'));
            }
            $minicart= view('layouts.front.product.minicart')->render();
            return response()->json(['minicart'=>$minicart]);
        }
        else
        {
            if ($oldcart = Session::get('cart',[])){
                $this->items=$oldcart;
            }
            $product=Product::find($request->id);
            $sort_items=['qty'=>isset($request->qty)?$request->qty:1,'id'=>$request->id];
            // return $sort_items;
            $this->items[$request->id]=$sort_items;
            $request->session()->put('cart',$this->items);
            // return session::get('cart',[]);
            $minicart= view('layouts.front.product.minicart')->render();
            return response()->json(['minicart'=>$minicart]);
            // return response()->json($request->session()->get('cart'));
        }
    }

    public function updateCart(Request $request)
    {
        // dd($request);
        $cart = Session::get('cart',[]);
        if(is_object(Auth::user()) && Auth::user()->role != 1)
        {
            if(isset($request->deleteitem))
            {
                // return $request->deleteitem;
                // return Auth::user()->id;
                $var=cart::where('user_id', Auth::user()->id)->where('product_id', $request->deleteitem)->delete();
                // return $var;
                $minicart= view('layouts.front.product.minicart')->render();
                return response()->json(['minicart'=>$minicart]);
            }
            else
            {
                cart::where('user_id', Auth::user()->id)->where('product_id', $request->id)->update(['qty' => $request->qty]);
                $pro = Product::where('id', $request->id)->first();
                $price = $request->qty * $pro->price;
                $request->session()->put('cart', $cart);
                $minicart= view('layouts.front.product.minicart')->render();
                return response()->json(['price'=>$price, 'minicart'=>$minicart]);
            }
        }
        else
        {
            $items =Session::get('cart',[],[]);
            if(isset($request->deleteitem))
            {  
                unset($items[$request->deleteitem]);
                // return $items;
                $request->session()->put('cart',$items);
                $minicart= view('layouts.front.product.minicart')->render();
                return response()->json(['minicart'=>$minicart]);
            }
            else
            {
                $pro=Product::where('id', $request->id)->first();
                $items[$request->id]['qty']=$request->qty;
                $price=$pro->price*$request->qty;
                // return $price;
                $request->session()->put('cart',$items);
                $minicart= view('layouts.front.product.minicart')->render();
                return response()->json(['price'=>$price, 'minicart'=>$minicart]);
            }
        }

    }

}