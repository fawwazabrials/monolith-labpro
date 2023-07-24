@if(session()->has('danger'))
<div class="alert alert-danger m-0" role="alert">
    <p class="text-center p-0 m-0">
        {{ session()->get("danger") }}
    </p>
</div>
@endif

@if (session()->has('success'))
<div class="alert alert-success m-0" role="alert">
    <p class="text-center p-0 m-0">
        {{ session()->get("success") }}

    </p>
</div>
@endif
