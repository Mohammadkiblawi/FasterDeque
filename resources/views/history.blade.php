@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            <a class="btn btn-primary float-end" href="/confirm">Add Order</a>
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
                    @if ($order->status == 'done')
                    <tr id="{{$order->id}}">
                        <th scope="row">{{$order->id}}</th>
                        <td>{{ $order->users->fname . ' ' . $order->users->lname }} </td>
                        <td>@if($order->order_date)
                            {{ \Carbon\Carbon::parse($order->order_date)->format('d/m/Y')}}
                            @endif
                        </td>
                        <td>{{ $order->order_time }}</td>
                        <td>{{ $order->paid}}</td>
                        <td>
                            <a class=" btn {{ $order->status =='done' ? 'btn-success': ($order->status=='under process' ? 'btn-primary' :'btn-warning')}} rounded-pill">{{ $order->status }}</a>
                        </td>
                        <td>{{ $order->total_price }} $</td>
                        <td>
                            @foreach ($order->items as $item)
                            {{ $item->description }}

                            @endforeach
                        </td>
                        <td></td>


                    </tr>
                    @endif
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection