@extends('layouts.layout')
@section("content")
@include('shared.success-msg')
<div class="mt-2 mw-100 d-flex justify-content-between align-items-center" style="background-color: #8B0000; height:75px;">
    <img class="mx-auto" src="{{ asset('pics/logo_burg.png') }}" alt="">
    <a href="{{ route('addfood') }}" id="online" class="border me-3 mt-2 pt-2 bg-white text-center"
       style="width:120px; border-radius:10px; text-decoration:none; color:#8B0000; height:50px;">
       add new food
    </a>
</div>

<div class=" mw-100 text-uppercase d-flex align-items-center justify-content-center" id="add_food" style="font-size: 45px ; height:200px;font-weight:bold; background-color:#dcdcdc;">Order Online</div>
<br><br>
<script>


</script>
<form action="{{ route('updatefood') }}" method="POST" class="w-50 m-auto">
    @csrf
    <input type="text" name="name" id="name" placeholder="food name" required class="form-control "><br><br>
    <input type="text" name="description" id="description" placeholder="food description" required class="form-control"><br><br>
    <input type="text" name="category" id="category" placeholder="food category" required class="form-control"><br><br>
    <input type="float" name="price" id="price" placeholder="food price" required class="form-control"><br><br>
    <div>
        <label for="photo">Current Photo:</label>
        <img id="current-photo" src="" alt="Food photo" style="width:220px; height:220px;">
    </div><br>


    <input type="file" name="photo" id="photo" class="form-control"><br><br>
    <input type="hidden" id="id" name="id" value="{{ $id }}">
    <input type="submit" value="save"  class="btn btn-primary"><br>
</form>
<script>
        document.addEventListener("DOMContentLoaded", function() {
    $(document).ready(function(){
        var id={{ $id }};
        $.ajax({
            url:`/espaceAdmin/getfood/${id}`,
            type:"GET",
            dataType:"json",
            success:function(data){
                console.log(data.food);
                document.getElementById("name").value=data.food.name;
                document.getElementById("description").value=data.food.description;
                document.getElementById("category").value=data.food.category;
                document.getElementById("price").value=data.food.price;
                document.getElementById("current-photo").src = `/pics/${data.food.photo}`;
            },
            error:function(xhr){
                console.log("error loading data");
            }

        });

    }); });
</script>
