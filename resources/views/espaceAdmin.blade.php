@extends('layouts.layout')
@section("content")

@include('shared.success-msg')
<div class="mt-2 mw-100 d-flex justify-content-between align-items-center" style="background-color: #8B0000; height:75px;">
    <img class="mx-auto" src="{{ asset('pics/logo_burg.png') }}" alt="">
    <a href="{{ route('addfood') }}" id="online" class="border me-3 mt-2 pt-2 bg-white text-center"
       style="width:120px; border-radius:10px; text-decoration:none; color:#8B0000; height:50px;">
       add new food
    </a>

    <a href="{{ route('vieworders') }}" id="online" class="border me-5 mt-2 pt-2 bg-white text-center"
       style="width:120px; border-radius:10px; text-decoration:none; color:#8B0000; height:50px;">
       view orders
    </a>
</div>
<div class=" mw-100 text-uppercase d-flex align-items-center justify-content-center" id="add_food" style="font-size: 45px ; height:200px;font-weight:bold; background-color:#dcdcdc;">Order Online</div>
<br><br>
<div id="food_container">
    <!-- food will be injected here by ajax call!-->
</div>
<script>

    $(document).ready(function(){
        $.ajax({
            url:"/espaceAdmin/data",
            type:'GET',
            dataType:'JSON',
            success:function(data){
                console.log(data);
                if(data.foods){
                    var food_container=document.getElementById("food_container");
                    food_container.innerHTML=`
                    <div class="container mw-100">
                        <div class="row">
                            <div class="col-md-2 p-2"><strong>food name</strong></div>
                            <div class="col-md-2 p-2"><strong>food description</strong></div>
                            <div class="col-md-2 p-2"><strong>food category</strong></div>
                            <div class="col-md-2 p-2"><strong>food price</strong></div>
                            <div class="col-md-2 p-2"><strong>food photo</strong></div>
                            <div class="col-md-2 p-2"><strong>update/delete</strong></div>
                        </div>
                        `;
                    data.foods.forEach(food=>{
                    food_container.innerHTML+=`
                        <div class="row">
                            <div class="col-md-2" >${food.name}</div>
                            <div class="col-md-2" >${food.description}</div>
                            <div class="col-md-2" >${food.category}</div>
                            <div class="col-md-2">${food.price}</div>
                            <div class="col-md-2 ps-0" ><img src="/pics/${food.photo}" style="width:220px; height:220px;"></div>
                            <div class="col-md-2"><button class="btn btn-primary" id="b1"><a href="/espaceAdmin/update/${food.idfood}" style="text-decoration:none;color:white;">Update</a>
</button>
                            <button class="btn btn-danger" id="b2" id_food="${food.idfood}">delete</button>
                            </div>
                        </div>

                    `; });
                    food_container.innerHTML+=`</div>`;
                    delete_Button=document.querySelectorAll("#b2").forEach(link=>{
                        link.addEventListener("click",function(){
                            var id=this.getAttribute("id_food");

                    $.ajax({
                        url:`/espaceAdmin/delete/${id}`,
                        type:"POST",
                        data: {
                            _token: "{{ csrf_token() }}" // Include the CSRF token here
                        },
                        success:function(response){
                            alert("food deleted! ");
                            location.reload();

                        },
                        error:function(xhr){
                            console.log("error deleting");

                        }


                    }); });});
                }

            }
        });

    });
</script>
@endsection
