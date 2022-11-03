<div class="row">
    <div class="col-12 col-sm-6">
        <div class="form-group">
            {!! Form::label('email', 'Email', []) !!}
            @if (isset($user->email))
                {!! Form::text('email', $user->email, ['class'=>'form-control', 'type'=>'email', 'readonly']) !!}
            @else
                {!! Form::text('email', '', ['class'=>'form-control', 'type'=>'email', 'placeholder'=>'Enter Email', 'autocomplete' => 'off']) !!}
            @endif
            @error('email')
                <div class="text text-danger">{{ $message }}</div>
            @enderror
        </div>            
        <div class="form-group">
            {!! Form::label('first_name', 'first_name', []) !!}
            {!! Form::text('first_name', isset($user->userProfile->first_name) ? $user->userProfile->first_name : '', ['class'=>'form-control', 'placeholder'=>'First Name']) !!}
            @error('first_name')
                <div class="text text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            {!! Form::label('last_name', 'last_name', []) !!}
            {!! Form::text('last_name', isset($user->userProfile->last_name) ? $user->userProfile->last_name : '', ['class'=>'form-control', 'placeholder'=>'Last Name']) !!}
            @error('last_name')
                <div class="text text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            {!! Form::label('address', 'address', []) !!}
            {!! Form::text('address', isset($user->userProfile->address) ? $user->userProfile->address : '', ['class'=>'form-control', 'placeholder'=>'Address']) !!}
            @error('address')
                <div class="text text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col-12 col-sm-6">
        <div class="form-group">
            {!! Form::label('password', 'Password', []) !!}
            @if (isset($user->password))
                {!! Form::text('password', $user->password, ['class'=>'form-control']) !!}
            @else
                {!! Form::password('password', ['class'=>'form-control', 'placeholder'=>'Enter Password', 'autocomplete'=>'off']) !!}
            @endif
            @error('password')
                <div class="text text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            {!! Form::label('phone', 'phone', []) !!}
            {!! Form::text('phone', isset($user->userProfile->phone) ? $user->userProfile->phone : '', ['class'=>'form-control', 'placeholder'=>'Phone']) !!}
            @error('phone')
                <div class="text text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            {!! Form::label('province', 'province', []) !!}
            {!! Form::text('province', isset($user->userProfile->province) ? $user->userProfile->province : '', ['class'=>'form-control', 'placeholder'=>'Province']) !!}
            @error('province')
                <div class="text text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            {!! Form::label('gender', 'gender', []) !!}
            {!! Form::select(
                'gender',
                [\App\Enums\Genre::MALE => 'Male', \App\Enums\Genre::FEMALE => 'Female'],
                isset($user->userProfile->gender) ? $user->userProfile->gender : '',
                ['class'=>'form-control']
            )!!}
        </div>
    </div>
</div>
