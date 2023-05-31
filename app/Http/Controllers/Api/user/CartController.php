<?php

namespace App\Http\Controllers\Api\user;

use Carbon\Carbon;
use App\Models\Sim;
use App\Models\Cart;
use App\helpers\helper;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CartDetailsResource;

class CartController extends Controller
{
    public function __construct()
    {
        $this->helper = new helper();
    }
    public function createCart(Request $request){

        $validator=validator()->make($request->all(),[
            'sim_id'=>'required|exists:sims,id',
            'qty'=>'required',
            ]);
            if($validator->fails()){
          return $this->helper->ResponseJson(0,$validator->errors()->first(),$validator->errors());
            }
            
            $sim=Sim::findOrFail($request->sim_id);
            $checkCartItem = Cart::where('client_id',auth()->user()->id)->where('sim_id',$sim->id)->first();
            if($checkCartItem){
                return $this->helper->ResponseJson(0, __('apis.cart_faild'));
    
            }
            $total_price = $sim->price * $request->qty;
            if($sim->period == 'month'){
                $cart=$request->user()->carts()->create([
                    'sim_id'=>$request->sim_id,
                    'qty'=>$request->qty,
                    'client_id' => auth()->user()->id,
                    'price'=>$sim->price,
                    'total_price'=> $total_price,
                    'start_date'=> Carbon::now()->format('Y-m-d'),
                    'end_date'=> Carbon::now()->addMonth()->format('Y-m-d'),
                   ]);
                   return $this->helper->ResponseJson(1, __('apis.success'), $cart);
            }elseif($sim->period == '3months'){
                $cart=$request->user()->carts()->create([
                    'sim_id'=>$request->sim_id,
                    'qty'=>$request->qty,
                    'client_id' => auth()->user()->id,
                    'price'=>$sim->price,
                    'total_price'=> $total_price,
                    'start_date'=> Carbon::now()->format('Y-m-d'),
                    'end_date'=> Carbon::now()->addMonth(3)->format('Y-m-d'),
                   ]);
                   return $this->helper->ResponseJson(1, __('apis.success'), $cart);
            }elseif($sim->period == '6months'){
                $cart=$request->user()->carts()->create([
                    'sim_id'=>$request->sim_id,
                    'qty'=>$request->qty,
                    'client_id' => auth()->user()->id,
                    'price'=>$sim->price,
                    'total_price'=> $total_price,
                    'start_date'=> Carbon::now()->format('Y-m-d'),
                    'end_date'=> Carbon::now()->addMonth(6)->format('Y-m-d'),
                   ]);
                   return $this->helper->ResponseJson(1, __('apis.success'), $cart);
            }elseif($sim->period == 'year'){
                $cart=$request->user()->carts()->create([
                    'sim_id'=>$request->sim_id,
                    'qty'=>$request->qty,
                    'client_id' => auth()->user()->id,
                    'price'=>$sim->price,
                    'total_price'=> $total_price,
                    'start_date'=> Carbon::now()->format('Y-m-d'),
                    'end_date'=> Carbon::now()->addYear()->format('Y-m-d'),
                   ]);
                   return $this->helper->ResponseJson(1, __('apis.success'), $cart);
            }
           
    
    }

    public function cartDetails(Request $request)
    {
        $carts = Cart::where('client_id',auth()->user()->id)->get();
    
       $collectCartPrice = [];
       foreach($carts as $item)
       {
            $price = Cart::where('id',$item->id)->first();
            $collectCartPrice[] = $item->total_price;
       }
        $totalprice = array_sum($collectCartPrice);
        
        $total = $totalprice + 50;

    
        if($carts != '[]')
        {
            return [
                'key' => 'succes',
                'sub_total'=>round($totalprice),
                'shipping'=>50,
                'total'=>round($total),
                'sims' => CartDetailsResource::collection($carts)->map(function($row){
                    return[
                        'data' =>$row
    
                    ];
                })->values()->all()
            ];
        }else {
                return [
                    'msg' => __('apis.cart_is_empty'),
                    'key' => 'empty',
                    'data' => [],
                ];
            }
    
    
    
    
    }
    

    public function removeFromCart(Request $request)
    {
        
        if ($request->type == 'single') {
            $carts = Cart::where('product_id',$request->product_id)->first();
            if($carts){
                
            $carts->delete();
            return $this->helper->responseJson(1, __('apis.cart_delete'));
            }
                        return $this->helper->responseJson(1, __('apis.already_rem'));

        } else {
            $carts = Cart::where('client_id', auth()->user()->id)
                ->get()->each->delete();

            return $this->helper->responseJson(1, __('apis.removeAll'));
        }
    }

    }
