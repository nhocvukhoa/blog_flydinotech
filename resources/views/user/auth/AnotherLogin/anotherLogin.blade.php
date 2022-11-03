<div class="form-group row another-login">
    <div class="col row">
        <div class="col">
            <a href="{{ url('login/facebook') }}" class="btn btn-primary d-flex my-1">
                <i class="fa-brands fa-facebook-f icon-fa px-2"></i>
                <span class="text-center">Facebook</span>
            </a>
        </div>
        <div class="col">
            <a href="{{ url('login/google') }}" class="btn btn-danger d-flex my-1">
                <i class="fa-brands fa-google icon-fa"></i>
                <span class="text-center">Google</span>
            </a>
        </div>
    </div>
    <div class="col row">
        <div class="col">
            <a href="{{ url('login/github') }}" class="btn btn-dark d-flex my-1">
                <i class="fa-brands fa-github icon-fa"></i>
                <span class="text-center">Github</span>
            </a>
        </div>
        <div class="col">
            <a href="{{ url('login/twitter') }}" class="btn d-flex my-1 twitter">
                <i class="fa-brands fa-twitter icon-fa text-primary"></i>
                <span class="text-center">Twitter</span>
            </a>
        </div>
    </div>
</div>
