<?php

namespace App\Http\Controllers\Api\user;

use Throwable;
use Carbon\Carbon;
use App\Models\Sim;
use App\Models\Cart;
use App\Models\User;
use App\Models\MySim;
use App\Models\Order;
use App\helpers\helper;
use App\Models\Product;
use App\Models\Service;
use App\Events\newOrder;
use App\Models\OrderItem;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Events\UserRegistration;
use Illuminate\Support\Facades\DB;
use App\Notifications\NewOrderNoti;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\mysimResource;
use Illuminate\Support\Facades\Notification;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->helper = new helper();
    }

  

    public function checkout(Request $request)
    {
        try {
            $validator = validator()->make($request->all(), [
                'name' => 'required',
                'address' => 'required',
                'phone' => 'required',
            ]);
    
            if ($validator->fails()) {
                return $this->helper->ResponseJson(0, $validator->errors()->first(), $validator->errors());
            }
    
            DB::beginTransaction(); // Start the database transaction
    
            $order = Order::create([
                'name' => $request->name,
                'address' => $request->address,
                'phone' => $request->phone,
                'client_id' => auth()->user()->id,
            ]);
    
    
            $cart = Cart::where('client_id', auth()->user()->id)->get();
    
            if ($cart->isNotEmpty()) {
                $collectCartPrice = [];
    
                foreach ($cart as $item) {

                    $item->sims->update([
                        'status'=>'unavailable',
                    ]);

                    OrderItem::create([
                        'sim_id' => $item->sim_id,
                        'qty' => $item->qty,
                        'price' => $item->price,
                        'total_price' => $item->total_price,
                        'order_id' => $order->id,
                    ]);
                    
                    MySim::create([
                        'sim_id' => $item->sim_id,
                        'client_id' => auth()->user()->id,
                        'date'=> $item->start_date,
                        'end_date'=> $item->end_date,
                    ]);
    
                    $sim = Sim::where('id', $item->sim_id)->first();
                    $price = Cart::where('id', $item->id)->first();
                    $collectCartPrice[] = $item->total_price;
                }
    
                $sub_total = array_sum($collectCartPrice);
                $total = $sub_total + 50;
    
                $order->update([
                    'sub_total' => round($sub_total),
                    'shipping_price' => 50,
                    'total_price' => round($total),
                ]);
    
                $cartItems = Cart::where('client_id', auth()->user()->id)->get();
                Cart::destroy($cartItems);
    
                DB::commit(); // Commit the transaction since all operations were successful
    
                return $this->helper->ResponseJson(1, __('apis.success'), $order);
            } else {
                DB::rollBack(); // Roll back the transaction since the cart is empty
    
                return $this->helper->ResponseJson(1, __('apis.cart_is_empty'), []);
            }
        } catch (\Exception $e) {
            DB::rollBack(); // Roll back the transaction if an exception occurs
    
            return $this->helper->ResponseJson(0, $e->getMessage());
        }

    }

    public function mySims(Request $request)
    {
        $sims = MySim::where('client_id', auth()->user()->id)->get();

        return $this->helper->ResponseJson(1, __('apis.success'), mysimResource::collection($sims));

    }
}