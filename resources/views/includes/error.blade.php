@if(session('error'))
<div class="alert alert-danger" role="alert" style="padding-top: 1%">
    <h6>
        {{ session('error') }}
    </h6>
</div>
@endif
