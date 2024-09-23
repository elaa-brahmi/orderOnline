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
@if(session()->has("foodadded"))
<div class="alert alert-success">
    {{ session('foodadded') }}
</div>
@endif

@if(session()->has("foodupdated"))
<div class="alert alert-success">
    {{ session('foodupdated') }}
</div>
@endif
