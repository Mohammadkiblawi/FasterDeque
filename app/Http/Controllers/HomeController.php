<?php

namespace App\Http\Controllers;

use App\Models\order;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $orders = order::with(['users'])->get();
        return view('home', compact('orders'));
    }

    public function updateOrder($id, $status)
    {
        $order = order::find($id);
        if ($order) {
            $order->order_date = now()->format('Y-m-d');
            $order->order_time = now()->format('H:i:s');
            if ($status == 'pending') {
                $order->status = 'under process';
            } elseif ($status == 'under process') {
                $order->status = 'done';
                $newOrder = new Order;
                $newOrder->user_id = $order->user_id;
                $newOrder->save();

                self::sendWebNotification();
            }
            $order->save();
            return $order;
        }
        // $order = order::find($id);
        // if ($order) {
        //     $order->order_date = now()->format('Y-m-d');
        //     $order->order_time = now()->format('H:i:s');
        //     if ($status == 'pending') {
        //         $order->status = 'under process';
        //     } elseif ($status == 'under process') {
        //         $order->status = 'done';
        //     }
        //     $order->paid = 1;
        //     $order->save();
        //     return redirect()->back();
        // }
    }
    // public function updateOrderStatus()

    public function paidOrders()
    {
        $orders = order::with(['users'])->where('paid', 1)->get();
        return view('paid', compact('orders'));
    }
    public function history()
    {
        $orders = order::with(['users'])->where('paid', 1)->get();
        return view('history', compact('orders'));
    }
    public function confirm()
    {
        return view('confirm');
    }


    public function sendWebNotification()
    {
        $url = 'https://fcm.googleapis.com/fcm/send';
        //$FcmToken = User::whereNotNull('fcm_token')->pluck('fcm_token')->all();
        $FcmToken = 'cMN93UXoRcCOaNNu3oAiiV:APA91bEdNN20RIO5uQ-_2secprK9zqDX8bWRo7JCh7l2C2772h8mLR1CYb6nykfc_mVMfWF0Y3MhU0yM9GsDwEwyTJXrSqIKPkYVFmDHn8KKMu2R_apcaR9v9G1r5Y1i_tPMh_Gyxtgi';

        $serverKey = 'AAAA0j7rYcE:APA91bGbvEGBbzgZzawEQ8YZM8C9leFocOsmneCHvwKicnGT2rLv9FIATpSUpGiLG1bNOhBiwlktSh3HStDRxciqKAmAocB5bxu0zX_GKeewZ9WdacXl0EwH7RKLoSsgfhbTBz2LtmLD';

        $data = [
            "registration_ids" => [$FcmToken],
            "notification" => [
                "title" => 'Order done!',
                "body" => 'Thank you,  please come and grab your order',

            ],

        ];
        $encodedData = json_encode($data);

        $headers = [
            'Authorization:key=' . $serverKey,
            'Content-Type: application/json',
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $encodedData);
        // Execute post
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }
        // Close connection
        curl_close($ch);
        // FCM response
        dd($result);
    }
}
