@if (session()->has('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
@if(session()->has('successOrder'))
<div class="alert alert-success">
    {{ session('successOrder') }}
</div>


@endif
