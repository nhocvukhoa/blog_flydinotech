<div class="col-md-4">
    <div class="card">
        {{ Form::open(['method' => 'POST', 'route' => 'admin.categories.store']) }}
            @include('admin.categories.form.form')
            <div class="card-footer">
                <div class="row">
                    <div class="col-12 text-center">
                        {{ Form::button('Add', ['class' => 'btn btn-dark px-4', 'type' => 'submit']) }}
                    </div>
                </div>
            </div>
        {{ Form::close() }}
    </div>
</div>
