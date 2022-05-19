@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            <a class="btn btn-primary float-end" href="#">Add Order</a>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Order Id</th>
                        <th scope="col">Customer Name</th>
                        <th scope="col">Order-Date</th>
                        <th scope="col">Order-Time</th>
                        <th scope="col">Paid</th>
                        <th scope="col">Status</th>
                        <th scope="col">Total Price</th>
                        <th scope="col">Brief</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                    <tr>
                        <th scope="row">{{$order->id}}</th>
                        <td>{{ $order->users->fname . ' ' . $order->users->lname }} </td>
                        <td>{{ date('d-m-Y', strtotime($order->order_date)) }}</td>
                        <td>{{ $order->order_time }}</td>
                        <td>{{ $order->paid}}</td>
                        <td>
                            <a class=" btn {{ $order->status =='done' ? 'btn-success': ($order->status=='under process' ? 'btn-primary' :'btn-warning')}} rounded-pill">{{ $order->status }}</a>
                        </td>
                        <td>{{ $order->total_price }} $</td>
                        <td>{{ $order->brief }}</td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection