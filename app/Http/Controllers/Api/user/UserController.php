<?php

namespace App\Http\Controllers\Api\user;

use App\Models\Sim;
use App\Models\Order;
use App\Models\Banner;
use App\Models\Wallet;
use App\helpers\helper;
use App\Models\Address;
use App\Models\Product;
use App\Models\Service;
use App\Models\Category;
use App\Models\OrderItem;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\SimResource;
use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Http\Resources\PlaceResource;
use App\Http\Resources\TransResource;
use App\Http\Resources\BannerResource;
use App\Http\Resources\HomeCatResource;
use App\Http\Resources\DelOrderResource;
use App\Http\Resources\PlaceByCatResource;
use App\Http\Resources\TrackOrderResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserController extends Controller
{
    public function __construct()
    {
        $this->helper = new helper();
    }
    
    public function home(Request $request)
    {
        $banners = Banner::select('id','banner_'.app()->getLocale().' as banner','created_at')->get();



        $sims = Sim::where('type', $request->type)->get();
        return $this->helper->ResponseJson(1, __('apis.success'), $banners
    );

    }

   

    public function myOrders(Request $request)
    {
        $orders = Order::where('client_id', auth()->user()->id)->get();
        if ($request->order_id) {
            $order = Order::where('id', $request->order_id)->first();
            if ($order) {
                return $this->helper->ResponseJson(1, __('apis.success'), new TrackOrderResource($order));
            }
            return $this->helper->ResponseJson(0, __('apis.faild'));
        }
        return $this->helper->ResponseJson(1, __('apis.success'), OrderResource::collection($orders));
    }
    


    public function cancelOrder(Request $request)
    {
        $validate = $request->validate([
            'order_id' => 'required|exists:orders,id',
        ]);
        $order = Order::findOrFail($validate['order_id']);
        if ($order->status == 'pending') {
            $order->status = 'cancelled';
            $order->save();
            return $this->helper->ResponseJson(1, __('apis.success'));
        }
        return $this->helper->ResponseJson(0, __('apis.order_faild'));
    }

    public function recently()
    {
        $sims = Sim::orderBy('id', 'DESC')->get();
        return $this->helper->ResponseJson(1, __('apis.success') ,   HomeCatResource::collection($sims));

    }

    public function getSim(Request $request)
    {
        try {
            $sim = Sim::findOrFail($request->sim_id);
    
            $orders = OrderItem::where('sim_id', $sim->id)->count();
    
            return $this->helper->ResponseJson(1, __('apis.success'), new SimResource($sim, $orders));
        } catch (ModelNotFoundException $e) {
            return $this->helper->ResponseJson(0, __('apis.faild'), [], __('apis.sim_not_found'));
        }
    }
    
}
