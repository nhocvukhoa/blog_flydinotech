@if (Session('success'))
    <div class="alert alert-success">
        {{ Session('success') }}
    </div>
@elseif (Session('error'))
    <div class="alert alert-danger">
        {{ Session('error') }}
    </div>
@endif
