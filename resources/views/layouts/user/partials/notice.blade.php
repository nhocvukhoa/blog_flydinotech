@if (Session('success'))
    <div class="col-lg-5 col-md-12 ml-auto" id="auto-hide">
        <div class="alert alert-success fade show d-flex flex-row align-items-center" role="alert">
            <i class="fa-solid fa-check"></i>
            {{ Session('success') }}
        </div>
    </div>
@elseif (Session('error'))
    <div class="col-lg-5 col-md-12 ml-auto" id="auto-hide">
        <div class="alert alert-danger fade show d-flex flex-row align-items-center" role="alert">
            <i class="fa-solid fa-x"></i>
            {{ Session('error') }}
        </div>
    </div>
@endif
