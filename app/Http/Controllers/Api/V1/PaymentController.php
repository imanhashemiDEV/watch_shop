<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Shetabit\Multipay\Invoice;
use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentRequest;
use Shetabit\Payment\Facade\Payment;

class PaymentController extends Controller
{


    public function payment(PaymentRequest $request)
    {
        $products_id = $request->products_id;
        $count = $request->count;

        $products = Product::query()->whereIn('id',$products_id)->get();
        $total_price=0;
        foreach($products as $product){
            if($product->discount==0){
                $total_price +=$product->price;

            }else{
                $total_price += $product->price - ((($product->price) * ($product->discount))/100);
            }

        }

        $order = Order::query()->create([
            'price' => $total_price,
            'status' => 0,
            'address_id' => auth()->user()->addresses()->latest()->first()->id ,
            'user_id' => auth()->user()->id
        ]);

        foreach ($products as $key=>$value) {

            $order->orderDetails()->create([
                'product_id' => $value->id,
                'count' => $count[$key],
                'price' => $value->price,
            ]);
        }

        // $invoice = (new Invoice)->amount($total_price);
        // return Payment::purchase($invoice,function($driver, $transactionId) use($order) {
        //     $order->update([
        //         'transaction_id'=>$transactionId
        //     ]);
        // })->pay()->render();

        $result =  Payment::purchase(
            (new Invoice)->amount(1000),
            function($driver, $transactionId) use($order){
                    $order->update([
                 'transaction_id'=>$transactionId
             ]);
            }
        )->pay()->toJson();

        return json_decode($result);


    }

    public function callback(Request $request)
    {

        $order = Order::query()->where('transaction_id',$request->get('Authority'))->first();

        if($request->get('Status')=="OK"){
            $order->update([
                'status'=>1,
            ]);
        }

        // if ($_GET['Status'] == 'OK') {

        //     $data = [
        //         'amount' => $amount,
        //         'authority' => $authority,
        //     ];

        //     $result = Zarinpal::verify($data);

        //     if ($result['statusCode'] == 100 or $result['statusCode'] == 101) {

        //         $lessonShop = LessonShop::where('authority', $authority)->get();
        //         foreach ($lessonShop as $lesson) {
        //             $lesson->status = 1; // verified
        //             $lesson->refId = $result['refId'];
        //             $log_lessons[] = (array)$lesson;
        //             $lesson->save();

        //             Lesson::query()->find($lesson->lesson_id)->increment('ordered');
        //         }



        //         $ref = $result['refId'];

        //         return view('admin.lessonsshop.accept', compact(['ref']));

        //     } else {

        //         return view('admin.lessonsshop.reject');
        //     }
        // }
    }

}
