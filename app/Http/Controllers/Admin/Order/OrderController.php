<?php

namespace App\Http\Controllers\Admin\Order;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $result = Order::query();

        if ($request->has('keywords') && $request->keywords != null) {
            $result->where('name', 'like', '%' . $request->keywords . '%')
                ->orWhere('email', 'like', '%' . $request->keywords . '%')->orWhere('phone', 'like', '%' . $request->keywords . '%');
        }
        if ($request->has('status') && $request->status != null) {
            $status = 1;
            if ($request->status == 'pending') {
                $status = 1;
            } elseif ($request->status == 'completed') {
                $status = 2;
            } else {
                $status = 3;
            }
            $result->where('status', '=', $status);
        }
        if ($request->has('sort') && $request->sort != null) {
            $result->orderBy('created_at', $request->sort);
        } else {
            $result->orderBy('created_at', 'desc');
        }

        $orders = $result->paginate(20);
        return view('admin.order.index', compact('orders'));
    }
    public function orderDetail($id)
    {
        $customerInfo = Order::where("id", $id)->first();
        $products = OrderDetail::where('OrderID', $id)->get();


        return view('admin.order.detail', compact('products', 'customerInfo'));
    }
    public function changeStatuOrder(Request $request)
    {
        if ($request->has('orderId') && $request->has('status')) {

            return Order::where('id', $request->orderId)->update(['status' => $request->status]);
        } else {
            return false;
        }
    }
    public function delete($id)
    {

        $deleteOrder =
            Order::destroy($id);
        if ($deleteOrder) {
            $deleteOrderDetail = OrderDetail::where('OrderID', $id)->delete();
            if ($deleteOrderDetail) {
                return back()->with('msgSuccess', 'Xóa thành công');
            }
        }
        return back()->with('msgError', 'Xóa thất bại!');
    }
}
