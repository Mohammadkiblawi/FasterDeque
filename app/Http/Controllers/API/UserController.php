<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Models\category;
use App\Models\item;
use App\Models\order;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    use AuthenticatesUsers;

    public function index()
    {
        $users = User::with('orders')->orderBy('id', 'ASC')->get();
        return $users;
    }

    public function checkLogin(Request $request)
    {
        $postData = $this->validate($request, [
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);
        $user = User::with('orders')->where('email', $postData['email'])->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['error' => 'Invalid credentials']);
        }
        // $users = DB::table('users')
        //     ->join('orders', 'users.id', '=', 'orders.user_id')
        //     ->select('users.*', 'orders.id', 'orders.user_id')
        //     ->get();

        return response()->json([
            'success' => true,
            'user' => $user,




        ]);
    }
    public function createUser(Request $request)
    {
        $user = new User;
        $user->fname = $request->fname;
        $user->lname = $request->lname;
        $user->dob = $request->dob;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        $user_order_id = new Order;
        $user_order_id->user_id = $user->id;
        $user->orders()->save($user_order_id);
        return response()->json([
            'success' => "user created successfuly"
        ], 201);
    }
    public function deleteUser($id)
    {
        if (User::where('id', $id)->exists()) {
            $user = User::find($id);
            $user->delete();

            return response()->json([
                "message" => "user deleted successfuly"
            ], 202);
        } else {
            return response()->json([
                "message" => "user not found"
            ], 404);
        }
    }

    public function updateOrder(Request $request, $id)
    {
        if (order::where('id', $id)->exists()) {

            // $order = order::find($id);
            // $order->order_date =  $request->order_date;
            // $order->order_time = $request->order_time;
            // $order->total_price =  $request->total_price;
            // $order->brief = is_null($request->brief) ? '' : $request->brief;
            // $order->save();
            $order = order::findOrFail($id);
            $order->update($request->all());


            return response()->json([
                'success' => 'the order was updated',
                'order' => $order
            ], 200);
        } else {
            return response()->json([
                "message" => "order not found"
            ], 404);
        }
    }
    public function getOrders()
    {
        return order::all();
    }
    public function addItems(Request $request)
    {
        $item = new item;
        $item->quantity = $request->quantity;
        $item->price = $request->price;
        $item->description = $request->description;
        $item->category_id = $request->category_id;
        $item->order_id = $request->order_id;
        $item->save();


        return  response()->json([
            'success' => "item added successfuly"

        ], 201);
    }
    public function showItems($id)
    {
        if (order::where('id', $id)->exists()) {
            // $order = order::find($id);
            $items = item::with('order')->where('order_id', $id)->get();
            return response()->json([
                'items' => $items,

            ], 200);
        } else {
            return response()->json([
                'message' => 'order wasn\'t found '

            ], 404);
        }
    }
    public function deleteItem($id)
    {
        if (order::where('id', $id)->exists()) {
            $order = order::where('id', $id)->pluck('id');
            $items = item::where('order_id', $order);
            $items->delete();

            return response()->json([
                "message" => "items deleted successfuly"
            ], 202);
        } else {
            return response()->json([
                "message" => "order not found"
            ], 404);
        }
    }
}
