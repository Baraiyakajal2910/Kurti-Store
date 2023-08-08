<?php

use App\Product;
use App\cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

 function showCart()
    {
        if(Auth::check() && Auth::user()->role != 1)
        {
            $products = cart::join('products','products.id', '=' , 'cart.product_id')
                            ->select('cart.qty','products.*')->where('user_id',Auth::user()->id)
                            ->get()->toArray();
            return $products;
        }
        else
        {
            $product_id=[];
            $product_qty=[];
            $cart_item=Session::has('cart')?Session::get('cart'):null;
            // dd($cart_item);
            if(!empty($cart_item)){
                $i =0;
                foreach ($cart_item as $key=>$citem) 
                {
                    // echo $citem['id'];
                    if($i == 3)
                        break;
                    $product_id[]=$citem['id'];
                    $product_qty[]=$citem['qty'];
                    $i++;
                }
            }
            // else
            // {
            //     return "There is No products Added in Cart";
            // }
            // dd($product_id);
            $sessionproducts = (Product::whereIn('id',$product_id)->get())->toArray();
            $products=null;
    		foreach ($sessionproducts as $key => $product) 
            {
                $products[] = array_merge($product, array('qty' => $product_qty[$key]));
            }
            return $products;
        }
    }

?>