@extends('layouts.layout')
@section("content")
<div id="select-food" class="w-50 bg-primary position-fixed mt-0 end-0 z-1" style="height:540px; display:none;">
    <button onclick="hide()">X</button>
    <!-- Selected food details will be appended here -->
    <div id="food-details"></div>
</div>

<div class=" mt-2 mw-100 d-flex " style="background-color: #8B0000; height:70px;"><img  class="mx-auto" src="{{ asset('pics/logo_burg.png') }}" alt="" >
    <a href="#" id="online" class="border me-3 mt-2 pt-2 bg-white text-center" style=" width:120px; border-radius:10px; text-decoration:none; color:#8B0000; height:50px;">Order Online</a>
</div>
<div class="  mw-100 text-uppercase d-flex align-items-center justify-content-center " style="font-size: 45px ; height:200px;font-weight:bold; background-color:#dcdcdc;">order online</div>
<br><br>
<div class="d-inline-flex ">
<a href="{{ route('food.category','burger') }}" class="boder rounded-circle p-3 mx-2"  id="a1" data-category="burger" style="background-color:#dcdcdc; text-decoration:none; color:black;">Burger</a>
<a href="{{ route('food.category','pizza') }}" class="boder rounded-circle p-3 mx-2 " id="a2" data-category="pizza" style="background-color:#dcdcdc; text-decoration:none; color:black;">Pizza</a>
<a href="{{ route('food.category','dessert') }}" class="boder rounded-circle p-3 mx-2" id="a3" data-category="dessert" style="background-color:#dcdcdc; text-decoration:none; color:black;">dessert</a>

</div>
<div class="container mt-4">
    <div class="row" id="food-container">
        <!-- Food items will be injected here by the AJAX call -->
    </div>
</div>


<script>
    function hide(){
        var div=document.getElementById("select-food");
        div.style.display="none";
    }
    var links=document.querySelectorAll("a[id^=a]");
    links.forEach(link=>{
        link.addEventListener('click',function(e){
            e.preventDefault();
            links.forEach(l=>{
            l.classList.remove('clicked');
        });

        this.classList.add('clicked');
    }); });


    $(document).ready(function() {
        function loadFoods(category) {
            $.ajax({
                url: `/foods/${category}`,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
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
                                        <a href="#" id="add-${food.id}" food-id="${food.id}" class="rounded-circle w-25 p-2 ms-5" style='text-decoration:none; color:#8B0000; border:2px solid #8B0000;'>Select</a>

                                            </p>
                                    </div>
                                </div>
                            </div>`;
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

                        link.addEventListener("click",function(){

                            const food_id=this.getAttribute("food-id");
                            var div=document.getElementById("select-food");
                            div.style.display="block";
                            var food_container=document.getElementById("food-details");
                            food_container.innerHTML="";
                            $.ajax({
                                url:`/foods/${food_id}`,
                                type:"GET",
                                dataType:'JSON',
                                success:function(data){

                                    if (data.food) {
                                        food_container.innerHTML += `
                                            <div class="card">
                                                <img class="card-img-top" src="/pics/${data.food.photo}">
                                                <h1 class="card-title">${data.food.name}</h1>
                                                <p class="card-text">${data.food.description}</p>
                                            </div>
                                        `;
                                    } else {
                                        console.log("Food data not found");
                                    }
                                },
                                error: function(jqXHR, textStatus, errorThrown) {
                                        console.log('Network response was not ok:', textStatus, errorThrown);
                                    }

                            });
                          });

                         });


                        },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error('Network response was not ok:', textStatus, errorThrown);
                }
            });
        }

        var a1 = document.getElementById("a1");
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
