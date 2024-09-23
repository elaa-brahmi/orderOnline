@extends('layouts.layout')
@section("content")

@include('shared.success-msg')
<div class="mt-2 mw-100 d-flex justify-content-between align-items-center" style="background-color: #8B0000; height:75px;">
    <img class="mx-auto" src="{{ asset('pics/logo_burg.png') }}" alt="">
    <a href="{{ route('addfood') }}" id="online" class="border me-3 mt-2 pt-2 bg-white text-center"
       style="width:120px; border-radius:10px; text-decoration:none; color:#8B0000; height:50px;">
       add new food
    </a>
    <a href="{{ route('foodadded') }}" id="online" class="border me-3 mt-2 pt-2 bg-white text-center"
       style="width:120px; border-radius:10px; text-decoration:none; color:#8B0000; height:50px;">
       home page
    </a>


</div>
    <div class=" mw-100 text-uppercase d-flex align-items-center justify-content-center" id="add_food" style="font-size: 45px ; height:200px;font-weight:bold; background-color:#dcdcdc;">Order Online</div>
    <br><br>
    <div id="orders_container">
        <!-- food will be injected here by ajax call!-->
    </div>
    <script>
         document.addEventListener("DOMContentLoaded", function() {
        $(document).ready(function(){
            $.ajax({
                url:"/espaceAdmin/getOrders",
                type:"GET",
                dataType:"json",
                success:function(data){
                    var container=document.getElementById("orders_container");
                    container.innerHTML=`
                    <table class="container mw-100 m-auto table table-striped">
                        <div class="row">
                            <div class="col-2"><h4>name</h4> </div>
                            <div class="col-2"><h4>last name</h4> </div>
                            <div class="col-2"><h4>adress </h4></div>
                            <div class="col-2"><h4>order date</h4> </div>
                            <div class="col-4"><h4>items ordered </h4></div>
                         </div>
                        </div>
                    `;
                    if(data.orders){
                        console.log(data.orders);
                        for(let id in data.orders){
                            var items="";
                            for(let i in data.orders[id].items_ordered){
                                console.log(i);
                                items+=data.orders[id].items_ordered[i]['food_name']+" "+data.orders[id].items_ordered[i]['price']+","+"\n";
                            }
                            console.log(items)
                            console.log(id);
                            console.log(data.orders[id].client.name);
                            console.log(data.orders[id].items_ordered[0]);
                             container.innerHTML+=`
                             <div class="row">
                                <div class="col-2">${data.orders[id].client.name}</div>
                                <div class="col-2">${data.orders[id].client.lastname}</div>
                                <div class="col-2">${data.orders[id].client.adress}</div>
                                <div class="col-2">${data.orders[id].commande.updated_at}</div>
                                <div class="col-4">${items}</div>
                                </div><br><br>


                             `;
                        }
                        container.innerHTML+=`</table>`;



                    }


                },
                error(xhr){
                    console.log('error');
                }

            });});
        });
    </script>
