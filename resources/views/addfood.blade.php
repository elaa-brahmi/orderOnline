@extends('layouts.layout')
@section("content")

@include('shared.success-msg')
<div class="mt-2 mw-100 d-flex justify-content-between align-items-center" style="background-color: #8B0000; height:75px;">
    <img class="mx-auto" src="{{ asset('pics/logo_burg.png') }}" alt="">

</div>
<div class=" mw-100 text-uppercase d-flex align-items-center justify-content-center" id="add_food" style="font-size: 45px ; height:200px;font-weight:bold; background-color:#dcdcdc;">Order Online</div>
<br><br>
<h1 class="text-center"> add food</h1>
<form action="{{ route('savefood') }}" method="POST" class="w-50 m-auto">
    @csrf
    <input type="text" name="name" id="name" placeholder="food name" required class="form-control "><br><br>
    <input type="text" name="description" id="description" placeholder="food description" required class="form-control"><br><br>
    <input type="text" name="category" id="category" placeholder="food category" required class="form-control"><br><br>
    <input type="float" name="price" id="price" placeholder="food price" required class="form-control"><br><br>
    <input type="file" name="photo" id="photo" class="form-control"><br><br>
    <input type="submit" value="save"  class="btn btn-primary"><br>
</form>
