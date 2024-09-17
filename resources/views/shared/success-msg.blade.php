@if (session()->has('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@if(session()->has('successOrder'))
<div class="alert alert-success">
    {{ session('successOrder') }}
</div>


@endif
