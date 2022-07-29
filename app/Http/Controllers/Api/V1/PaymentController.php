<?php

namespace App\Http\Controllers\Api\V1;

use App\Enums\OrderStatus;
use App\Enums\PaymentStatus;
use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentRequest;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use Shetabit\Multipay\Invoice;
use Shetabit\Payment\Facade\Payment;

class PaymentController extends Controller
{
     /**
     * @OA\Post(
     ** path="/api/v1/payment",
     *  tags={"Payment"},
     *  description="send products id in basket to payment",

     *   @OA\RequestBody(
     *    required=true,
     *          @OA\MediaType(
     *           mediaType="multipart/form-data",
     *           @OA\Schema(
     *           @OA\Property(
     *                  property="orders",
     *                  description="Product ID",
     *                  type="array",
      *                 collectionFormat="multi",
     *                  @OA\Items(type="integer", format="id")
     *               ),
     *     )
     *   )
     * ),
     *   @OA\Response(
     *      response=200,
     *      description="Its Ok",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   )
     *)
     **/
    public function payment(PaymentRequest $request)
    {
        dd($request->orders);
        $total_price = 0;
        $user = auth()->user();

        foreach ($request->orders as $order) {
            $product = Product::query()->find($order['product_id']);
            if ($product->discount == 0) {
                $total_price += $product->price * $order['count'];
            } else {
                $total_price += ($product->price - ((($product->price) * ($product->discount)) / 100)) * $order['count'];
            }
        }

        $order = Order::query()->create([
            'total_price' => $total_price,
            'status' => 0,
            'address_id' => $user->addresses()->latest()->first()->id,
            'user_id' => $user->id,
            'code'=>Helper::generateRandomRefId(6),
        ]);

        foreach ($request->orders as $orderDetail) {
            $product = Product::query()->find($orderDetail['product_id']);
            OrderDetail::query()->create([
                'order_id' => $order->id,
                'product_id' => $orderDetail['product_id'],
                'count' => $orderDetail['count'],
                'price' => $product->price,
                'discount_price' => $product->price - ((($product->price) * ($product->discount)) / 100),
            ]);
        }

        $result = Payment::purchase(
            (new Invoice)->amount($total_price),
            function ($driver, $transactionId) use ($order) {
                $order->update([
                    'transaction_id' => $transactionId,
                ]);
            })->pay()->toJson();

        return json_decode($result);
    }

    public function callback(Request $request)
    {
        $authority = $_GET['Authority'];

        $order = Order::query()->where('transaction_id', $authority)->first();
        $code = $order->code;
        $order_details = OrderDetail::query()->where('order_id', $order->id)->get();

        if ($_GET['Status'] == 'OK') {
            $order->update([
                'status' => PaymentStatus::Success,
            ]);

            foreach ($order_details as $order_detail) {
                $product = Product::query()->find($order_detail->product_id);
                $product->increment('sell');
            }

            return view('admin.pay.accept', compact('code'));
        } else {
            $order->update([
                'status' => PaymentStatus::Failed,
            ]);

            foreach ($order_details as $order_detail) {
                $product = Product::query()->find($order_detail->product_id);
                $product->increment('sell');

                $order_detail->status = OrderStatus::Failed;
                $order_detail->save();
            }

            return view('admin.pay.reject');
        }
    }
}
