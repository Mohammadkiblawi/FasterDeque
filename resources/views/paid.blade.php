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
                    @if ($order->status != 'done')
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

                        @if($order->status != 'done')
                        <td><button data-status="{{$order->status}}" data-id="{{$order->id}}" class="btn btn-primary change">Change Status</button></td>
                        @else
                        <td></td>
                        @endif

                    </tr>
                    @endif
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>
@section('script')
<script>
    function updateOrderStatus() {
        $('.change').on('click', function() {

            var status = $(this).data('status');
            var id = $(this).data('id');
            console.log(status, id);
            var tdStatus = $('tr#' + id + ' td:nth-child(6) a').text();
            var orderDate = $('tr#' + id + ' td:nth-child(3)').text();
            var orderTime = $('tr#' + id + ' td:nth-child(4)').text();


            $.ajax({
                type: 'GET',
                data: {
                    status: status,
                    id: id
                },
                url: "http://faster-deque.herokuapp.com/paid/" + id + "/status/" + status + "",

                success: function(response) {
                    console.log(response)
                    tdStatus = $('tr#' + id + ' td:nth-child(6) a').html(response.status);
                    orderDate = $('tr#' + id + ' td:nth-child(3)').text(response.order_date);
                    orderTime = $('tr#' + id + ' td:nth-child(4)').text(response.order_time);
                    location.reload();
                },
                error: function(error) {
                    alert(error);
                }

            });

        });


    }
    // function updateOrderStatus() {
    //     $('.change').on('click', function() {

    //         var status = $(this).data('status');
    //         var id = $(this).data('id');
    //         console.log(status, id);
    //         if (status == 'pending') {
    //             status = 'under process';


    //         } else if (status == 'under process') {
    //             status = 'done';

    //         }

    //         $.ajax({
    //             type: 'PUT',
    //             data: {
    //                 status: status,
    //                 id: id
    //             },
    //             url: "http://fasterdeque.test/api/order/" + id,

    //             success: function(response) {
    //                 console.log(response)
    //                 location.reload();
    //             },
    //             error: function(error) {
    //                 alert(error);
    //             }

    //         });

    //     });


    // }
    updateOrderStatus();
</script>
@endsection
@endsection