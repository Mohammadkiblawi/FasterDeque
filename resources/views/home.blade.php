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
                        <th scope="col">Status</th>
                        <th scope="col">Data/Time</th>
                        <th scope="col">Options</th>
                        <th scope="col">Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td><a class="btn btn-success rounded-pill">Done</a></td>
                        <td>10-12-2022</td>
                        <td></td>
                        <td>20 $</td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td><a class="btn btn-warning rounded-pill">Pending</a></td>
                        <td>10-12-2022</td>
                        <td></td>
                        <td>20 $</td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td><a class="btn btn-primary rounded-pill">Under Process</a></td>
                        <td>10-12-2022</td>
                        <td></td>
                        <td>20 $</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection