<?php
session_start();?>
@extends('layouts.layout')
@section("content")
<div class="col-md-6 mx-auto">
<form method="POST" action="{{ route("espaceAdmin") }}">
    @csrf
    <br>
    <label for="login">login</label>
    <input type="text" name="login" id="login" class="form-control"><br>
    <label for="password">password</label>
    <input type="password" name="password" id="password" class="form-control"><br>
    <input type="submit" value="login" class="btn btn-primary"></form>

</div>
@endsection



