@extends('layouts.app')

@section('content')
<div class="container ">
    <div class="row ">
        <div class="col-md-4 mt-5">
            <div class="row g-3" style="height:500px;border-right:1px solid black;">
                <div class="col">
                    <label for="order" class="visually-hidden">Password</label>
                    <input type="text" name="order_id" class="form-control" id="order" placeholder="Enter order id">
                </div>
                <div class="col">
                    <button type="submit" class="btn btn-primary mb-3" onclick="getOrderID()">Confirm order</button>
                </div>
            </div>

        </div>

        <div class="col-md-8 mt-3" id="card">
            <div class="card" id="card-body">
                <div class="card-body">
                    <h5 class="card-title">No orders taken yet</h5>
                    <p class="card-text">No items to show </p>
                </div>
            </div>
        </div>
        <button type="submit" class="offset-md-6 btn btn-primary col-md-2" id="add" onclick="addOrder()">ADD</button>
    </div>
</div>
<script>
    const card = document.getElementById('card');
    const orderID = document.getElementById('order');
    const url = 'https://faster-deque.herokuapp.com/api/items/';
    const addorder = document.getElementById('add');
    const url2 = 'https://faster-deque.herokuapp.com/api/order/';
    const cardBody = document.getElementById('card-body');
    let total_price = 0;
    let sum = 0;

    function getOrderID() {
        let orderId = document.getElementById('order').value;
        console.log(orderId);
        fetch(url + orderId)
            .then((res) => res.json())
            .then(items => {
                const item = items.items;
                let html = '';
                item.forEach(item => {
                    html += `<div class="card mb-3">
                        <div class="card-body" id="card-body">
                        <h5 class="card-title">Description: ${item.description}</h5>
                            <p class="card-text">Price: ${item.price} $</p>
                            <p class="card-text">Quantity: ${item.quantity}</p>
                            <p class="card-text total_price" id="total_price"><b>Total Price:</b> ${item.quantity *item.price} $</p>
                           
                       
                        </div>                  
                        </div>`
                    card.innerHTML = html;
                    // total_price = document.getElementById('total_price').innerText;
                    const items = Array.from(document.getElementsByClassName("total_price")).map(item => item.innerText.substr(13, 15));
                    total_price = items.reduce((a, b) => a + b);


                    const regex = /\d+/gm;
                    const str = total_price;
                    let m;
                    const filter = [];
                    while ((m = regex.exec(str)) !== null) {
                        // This is necessary to avoid infinite loops with zero-width matches
                        if (m.index === regex.lastIndex) {
                            regex.lastIndex++;
                        }

                        // The result can be accessed through the `m`-variable.
                        m.forEach((match, groupIndex) => {
                            filter.push(parseInt(match))
                        });
                    }
                    sum += filter[filter.length - 1];
                    console.log(sum);



                });
            })
            .catch(err => {
                console.log('error: ' + err);
            });
    }


    function addOrder() {
        const url = url2 + orderID.value;
        console.log(url);

        const order = {
            paid: 1,
            total_price: sum

        };

        fetch(url, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(order)
            }).then(response => {
                return response.json()
            })
            .then(data => {
                card.innerHTML = "";
                card.appendChild(cardBody);
                console.log(data);
                window.location.href = 'http://faster-deque.herokuapp.com/paid'


            });
    }

    // const card = document.getElementById('card');
    // const orderID = document.getElementById('order');
    // const url = 'http://fasterdeque.test/api/items/';
    // const addorder = document.getElementById('add');
    // const url2 = 'http://fasterdeque.test/api/order/';
    // const cardBody = document.getElementById('card-body');

    // function getOrderID() {
    //     let orderId = document.getElementById('order').value;
    //     console.log(orderId);
    //     fetch(url + orderId)
    //         .then((res) => res.json())
    //         .then(items => {
    //             const item = items.items;
    //             let html = '';
    //             item.forEach(item => {
    //                 html += `<div class="card mb-3">
    //                     <div class="card-body" id="card-body">
    //                     <h5 class="card-title">Description: ${item.description}</h5>
    //                         <p class="card-text">Price: ${item.price} $</p>
    //                         <p class="card-text">Quantity: ${item.quantity}</p>
    //                         <p class="card-text"><b>Total Price:</b> ${item.order.total_price} $</p>

    //                     </div>                  
    //                     </div>`
    //                 card.innerHTML = html;
    //             });
    //         })
    //         .catch(err => {
    //             console.log('error: ' + err);
    //         });
    // }

    // function addOrder() {
    //     const url = url2 + orderID.value;
    //     console.log(url);

    //     const order = {
    //         paid: 1
    //     };

    //     fetch(url, {
    //             method: 'PUT',
    //             headers: {
    //                 'Content-Type': 'application/json'
    //             },
    //             body: JSON.stringify(order)
    //         }).then(response => {
    //             return response.json()
    //         })
    //         .then(data => {
    //             card.innerHTML = "";
    //             card.appendChild(cardBody);
    //             console.log(data);
    //             window.location.href = 'http://fasterdeque.test/paid'


    //         });
    // }
</script>
@endsection