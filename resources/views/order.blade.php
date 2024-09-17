<!doctype html>
@extends('layouts.layout')
@section("content")
<head>

</head>
<body>
    <form action="{{ route("confirmOrder") }}" method="POST" class="container fluid" id="orderForm">
        @csrf
        <div class="row ">
            <div class="col-md-6">
        <h2 class="text-center">Contact Information</h2>
        <input type="email" name="mail" id="mail" placeholder="email adress" class="form-control"><br>
        <input type="text" name="phone" id="phone" placeholder="phone number" class="form-control"><br>
        <div class="row">
        <input type="text" name="fname" id="fname" placeholder="first name" class="form-control col">
        <input type="text" name="lname" id="lname" placeholder="last name" class="form-control col ms-1">


        </div><br><br>
        <h2 class="text-center">Billing & Shipping</h2>
        <input type="text" name="town" id="town" placeholder="town/city" class="form-control"><br>
        <input type="text" name="zipcode" id="zipcode" placeholder="zip code" class="form-control"><br>
        <button type="submit" value="order" class="rounded w-75 p-2" style="background-color:#8B0000; ">place order</button>


</div>

<div class ="col-md-6">
    <h3>your order</h3>
    <div id="order"></div>
</div>
<input type="hidden" name="cart" id="cartInput">
</form>
</body>


    <script>
    var cart=JSON.parse(localStorage.getItem("cart"));
    var div=document.getElementById("order");
    var details="";
    if(cart){
        for(let id in cart){
            item=cart[id];
            details+=`name: ${item.food_name}<br> options:${item.cheese_options.join(',')}<br> price: ${item.price}<br><br>`;
        }
        div.innerHTML=details;
    }
    else{
        console.log("you have no order");
        div.innerHTML="<p>you have no order</p>";
    }

    document.getElementById('orderForm').addEventListener('submit', function(event) {
            // Prevent the form from submitting immediately
            event.preventDefault();

            // Retrieve the cart from localStorage
            var cart = JSON.parse(localStorage.getItem('cart'));

            // Check if the cart exists
            if (cart) {
                // Add the cart data to the hidden input field
                document.getElementById('cartInput').value = JSON.stringify(cart);
            }

            // Submit the form after adding the cart data
            this.submit();
        });
    </script>


