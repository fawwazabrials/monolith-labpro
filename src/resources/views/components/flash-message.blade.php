@if(session()->has('danger'))
<div class="alert alert-danger m-0" x-data="{show: true}" x-init="setTimeout(() => show = false, 3000)" x-show="show"  role="alert">
    <p class="text-center p-0 m-0">
        {{ session()->get("danger") }}
    </p>
</div>
@endif

@if (session()->has('success'))
<div class="alert alert-success m-0" x-data="{show: true}" x-init="setTimeout(() => show = false, 3000)" x-show="show"  role="alert">
    <p class="text-center p-0 m-0">
        {{ session()->get("success") }}

    </p>
</div>
@endif
