@extends('layouts.layout')
@section("content")

@include('shared.success-msg')

<div id="select-food" class="w-50 position-fixed mt-0 end-0 z-1" style=" background-color:white; height:540px; overflow-y: scroll; display:none;">
    <button onclick="hide()">X</button>
    <!-- Selected food details will be appended here -->
    <div id="food-details" ></div>
</div>

<div class="mt-2 mw-100 d-flex justify-content-between align-items-center" style="background-color: #8B0000; height:75px;">
    @if (!session()->has('success'))
    <a href="{{ route("authentification") }}" class="ms-3" style="text-decoration:none; color:white;">espace admin</a>
    @endif

    <img class="mx-auto" src="{{ asset('pics/logo_burg.png') }}" alt="">
    <a href="#" id="online" class="border me-3 mt-2 pt-2 bg-white text-center"
       style="width:120px; border-radius:10px; text-decoration:none; color:#8B0000; height:50px;">
       Order Online
    </a>
</div>

<div class="  mw-100 text-uppercase d-flex align-items-center justify-content-center " style="font-size: 45px ; height:200px;font-weight:bold; background-color:#dcdcdc;">order online</div>
<br><br>
<div class="d-inline-flex ">
<a href="{{ route('food.category','burger') }}" class="boder rounded-circle p-3 mx-2"  id="b1" data-category="burger" style="background-color:#dcdcdc; text-decoration:none; color:black;">Burger</a>
<a href="{{ route('food.category','pizza') }}" class="boder rounded-circle p-3 mx-2 " id="b2" data-category="pizza" style="background-color:#dcdcdc; text-decoration:none; color:black;">Pizza</a>
<a href="{{ route('food.category','dessert') }}" class="boder rounded-circle p-3 mx-2" id="b3" data-category="dessert" style="background-color:#dcdcdc; text-decoration:none; color:black;">dessert</a>

</div>
<div class="container mt-4">
    <div class="row" id="food-container">
        <!-- Food items will be injected here by the AJAX call -->
    </div>
</div>
<script> var hasSessionSuccess = @json(session()->has('success'));</script>
<script>
     function handle(total){
        let dic = {
        "id_food":"",
        "cheese_options": [],
        "food_name":"",
        "price":total
        };
        total=parseFloat(total);
            document.querySelectorAll(".cheese-option").forEach(link => {
                link.addEventListener("click", function() {
                    this.style.backgroundColor = "#8B0000";
                    this.style.color = "white";
                        const cheese_option=this.querySelector("nav.ms-3").innerText;
                        dic["cheese_options"].push(cheese_option);
                    const priceElement = this.querySelector(".me-2");
                    if (priceElement) {
                        const priceText = priceElement.innerText.replace(/[+$]/g, "");
                        const price = parseFloat(priceText);
                        total += price;
                        var nav=document.getElementById("total");
                        nav.innerText=total.toFixed(2)+"$";
                        dic["price"]=total.toFixed(2)+"$";
                        console.log("Updated Total:", total);
                    }
        });
    });
    var add_botton=document.querySelector("button.ms-2");
        add_botton.addEventListener("click",function(){
            var name=this.getAttribute("food-name");
            var id=this.getAttribute("food-id");
            dic["id_food"]=id;
            dic["food_name"]=name;
            console.log(name);
            console.log(id);
            var cart=JSON.parse(localStorage.getItem("cart"))||{};
            cart[id]=dic;
            localStorage.setItem("cart",JSON.stringify(cart));
            console.log(cart);
            const foodContainer = document.getElementById('food-details');
            foodContainer.innerHTML = '';
            displayOrder();
            });
        }
        function displayOrder(){
            const cart=JSON.parse(localStorage.getItem("cart"));
            const foodContainer = document.getElementById('food-details');
            var somme=0;
            if(cart){
                var details=`<h2 class="text-center">your order</h2><br>`;
                for (let id in cart){
                    item=cart[id];
                    var prixtext=item.price.replace(/[+$]/g,"");
                    var price=parseFloat(prixtext);
                    somme=somme+price;

                    details+=`
                <div class="d-flex justify-content-between">
                    name:<h3 class="ms-2">
                    food ${item.food_name}</h3>
                    <div class="me-2"><a href="" class="drop-item" idItem="${id}" style="text-decoration:none;">delete from cart </a></div>
                    </div>
                <p>options:${item.cheese_options.join(',')}</p>

                <p>total:${item.price}</p>

                `;
                }
                console.log(somme);
                details+=`<div class="bottom-75 d-flex justify-content-between">
                    <div class="me-2">subtotal:${somme.toFixed(2)}<br></div>
                    <div class="ms-2"><a href ="{{ route("checkOrder") }}" class=" rounded p-2" style="background-color:#8B0000; color:white; text-decoration:none;">checkout</a></div>
                </div>`;

                foodContainer.innerHTML=details;
                var drop_item=document.querySelectorAll(".drop-item").forEach(item=>{
                item.addEventListener("click",function(e){
                    e.preventDefault();
                    var id_dropped=this.getAttribute("idItem");
                    var cart=JSON.parse(localStorage.getItem("cart"));
                    if(cart[id_dropped]){
                        delete(cart[id_dropped]);
                        localStorage.setItem("cart",JSON.stringify(cart));
                        console.log("elemnt dropped");
                        displayOrder();
                    }

                }); });


            }
        }
    function hide(){
        var div=document.getElementById("select-food");
        div.style.display="none";
    }
    var links=document.querySelectorAll("a[id^=b]");
    links.forEach(link=>{
        link.addEventListener('click',function(e){
            e.preventDefault();
            links.forEach(l=>{
            l.classList.remove('clicked');
        });

        this.classList.add('clicked');
    }); });
    var datafood=[]
    $(document).ready(function() {
        function loadFoods(category) {
            $.ajax({
                url: `/foods/${category}`,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    datafood=data.foods
                    const foodContainer = document.getElementById('food-container');
                    foodContainer.innerHTML = '';
                    data.foods.forEach(food => {
                        foodContainer.innerHTML += `
                            <div class="col-md-4">
                                <div class="card mb-4">
                                    <img src="/pics/${food.photo}" class="card-img-top" alt="${food.name}">
                                    <div class="card-body">
                                        <h5 class="card-title">${food.name}</h5>
                                        <p class="card-text">${food.description}</p>
                                        <p class="card-text"><strong>${food.price}</strong>
                                            <a href="#" id="add-${food.idfood}" food="${food.idfood}" food_cat=${food.category} class="rounded-circle w-25 p-2 ms-5" style='text-decoration:none; color:#8B0000; border:2px solid #8B0000;'>select</a>
                                            </p></div></div></div>`;

                    });
                    var links=document.querySelectorAll('a[id^="add-"]');
                    links.forEach(link=>{
                        link.addEventListener("mouseover", function() {
                            links.forEach(l=>{
                                l.style.backgroundColor = "white";
                                l.style.color = "#8B0000";
                            });
                            this.style.backgroundColor = "#8B0000";
                            this.style.color = "white";
                        });
                        link.addEventListener("click",function(event){
                            const elementId = event.target.id;
                            var div=document.getElementById("select-food");
                            div.style.display="block";
                            var food_container=document.getElementById("food-details");
                            food_container.innerHTML="";
                            const idNumber = elementId.replace(/[add-]/g,"");
                            const foundItem = datafood.find(item => item.idfood == idNumber);
                                    if (foundItem) {
                                        food_container.innerHTML +=`
                                            <div class="card">
                                                <img class="card-img-top mx-auto" src="/pics/${foundItem.photo}" style="width:250px; height:280px;">
                                                <div class="card-body" style="background-color:white;">
                                                    <h1 class="card-title text-center">${foundItem.name}</h1>
                                                    <p class="card-text">${foundItem.description}</p>`;
                                                    if(foundItem.category=="burger"){
                                                        food_container.innerHTML += `
                                                        <div class="card-text d-table w-75"><h2 class="text-center">cheese</h2>
                                                            <div class="d-table-row d-flex mw-100 justify-content-between cheese-option" style="border: 1px solid gray; cursor:pointer;">
                                                                <nav class="ms-3">american</nav>
                                                                <nav class="me-2">+1.4$</nav>
                                                            </div>
                                                            <div class="d-table-row d-flex mw-100 justify-content-between cheese-option" style="border: 1px solid gray; cursor:pointer;">
                                                                <nav class="ms-3">cheddar</nav>
                                                                <nav class="me-2">+1.4$</nav>
                                                            </div>
                                                            <div class="d-table-row d-flex mw-100 justify-content-between cheese-option" style="border: 1px solid gray; cursor:pointer;">
                                                                <nav class="ms-3">swiss</nav>
                                                                <nav class="me-2">+1.4$</nav>
                                                            </div>
                                                            <div class="d-table-row d-flex mw-100 justify-content-between cheese-option" style="border: 1px solid gray; cursor:pointer;">
                                                                <nav class="ms-3">vegan</nav>
                                                                <nav class="me-2">+1.4$</nav>
                                                            </div>

                                                       `;

                                                    }
                                                    else if(foundItem.category=="pizza"){
                                                        food_container.innerHTML += `
                                                        <div class="card-text d-table w-75" ><h2>Pizza toppings</h2>
                                                            <div class="d-table-row d-flex mw-100 justify-content-between cheese-option" style="border: 1px solid gray;  cursor:pointer;">
                                                                <nav class="ms-3">extra cheese</nav>
                                                                <nav class="me-2">+1.0$</nav>
                                                            </div>
                                                            <div class="d-table-row d-flex mw-100 justify-content-between cheese-option" style="border: 1px solid gray;  cursor:pointer;">
                                                                <nav class="ms-3">Extra Sauce </nav>
                                                                <nav class="me-2">+1.0$</nav>
                                                            </div>
                                                            <div class="d-table-row d-flex mw-100 justify-content-between cheese-option" style="border: 1px solid gray;  cursor:pointer;">
                                                                <nav class="ms-3">add pepperoni</nav>
                                                                <nav class="me-2">+2.0$</nav>
                                                            </div>
                                                            <div class="d-table-row d-flex mw-100 justify-content-between cheese-option" style="border: 1px solid gray;  cursor:pointer;">
                                                                <nav class="ms-3">add sausage</nav>
                                                                <nav class="me-2">+1.7$</nav>
                                                            </div>
                                                            <div class="d-table-row d-flex mw-100 justify-content-between cheese-option" style="border: 1px solid gray;  cursor:pointer;">
                                                                <nav class="ms-3">add bacon</nav>
                                                                <nav class="me-2">+1.7$</nav>
                                                            </div>
                                                    </div><br>`;
                                                    }
                                                    else{
                                                        food_container.innerHTML += `
                                                        <div class="card-text d-table w-75" ><h2>choose your sauce</h2>
                                                            <div class="d-table-row d-flex mw-100 justify-content-between cheese-option" style="border: 1px solid gray; cursor:pointer;">
                                                                <nav class="ms-3">hot chocolate</nav>
                                                                <nav class="me-2">+1.4$</nav>
                                                            </div>
                                                            <div class="d-table-row d-flex mw-100 justify-content-between cheese-option" style="border: 1px solid gray; cursor:pointer;">
                                                                <nav class="ms-3">whip cream</nav>
                                                                <nav class="me-2">+0.5$</nav>
                                                            </div>
                                                            <div class="d-table-row d-flex mw-100 justify-content-between cheese-option" style="border: 1px solid gray; cursor:pointer;">
                                                                <nav class="ms-3">caramel</nav>
                                                                <nav class="me-2">+0.5$</nav>
                                                            </div>

                                                    </div><br>`;
                                                    }
                                                    food_container.innerHTML +=`<br>
                                                    <div class="card-text d-flex justify-content-between">
                                                        <button class="ms-2" style="background-color:#8B0000;" food-name="${foundItem.name}" food-id="${foundItem.idfood}">add</button>
                                                        <nav class="me-2" id="total">${foundItem.price}$</nav>
                                                    </div>
                                                </div>
                                            </div>`;
                                                handle(foundItem.price);




















                                }
                                    else {
                                        console.log("Food data not found");
                                    }

                          });



                         });
                        },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log('Network response was not ok:', textStatus, errorThrown);
                }
            });
        }

        var a1 = document.getElementById("b1");
        a1.classList.add('clicked');
        loadFoods('burger');

        document.querySelectorAll('a[data-category]').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const category = this.getAttribute('data-category');
                loadFoods(category);
            });
        });
    });
</script>
@endsection("content")
