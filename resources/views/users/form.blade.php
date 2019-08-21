<div class="item form-group">
    <label class="control-label col-md-1" for="name">Username <span class="required">*</span></label>
    <div class="col-md-6 col-sm-6 col-xs-12">
        {!! Form::text('username', null, ['id' => 'username', 'class' => $errors->has('username') ? 'form-control col-md-7 col-xs-12 parsley-error' : 'form-control col-md-7 col-xs-12', 'required', 'data-validate-length-range' => '2', 'data-validate-words' => '1', 'placeholder' => 'Username']) !!}
    </div>
</div>

<div class="item form-group">
    <label class="control-label col-md-1" for="name">Name <span class="required">*</span></label>
    <div class="col-md-6 col-sm-6 col-xs-12">
        {!! Form::text('name', null, ['id' => 'name', 'class' => $errors->has('name') ? 'form-control col-md-7 col-xs-12 parsley-error' : 'form-control col-md-7 col-xs-12', 'required', 'data-validate-length-range' => '2', 'data-validate-words' => '1', 'placeholder' => 'Name']) !!}
    </div>
</div>

<div class="item form-group">
    <label class="control-label col-md-1" for="name">Email <span class="required">*</span></label>
    <div class="col-md-6 col-sm-6 col-xs-12">
        {!! Form::email('email', null, ['id' => 'email', 'class' => $errors->has('email') ? 'form-control col-md-7 col-xs-12 parsley-error' : 'form-control col-md-7 col-xs-12', 'required', 'data-validate-length-range' => '2', 'data-validate-words' => '1', 'placeholder' => 'Email']) !!}
    </div>
</div>

@if(isset($data))

    <div class="item form-group">
        <label class="control-label col-md-1" for="name">Password <span class="required">*</span></label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <input id="password" type="password" name="password" class="{{ $errors->has('password') ? 'form-control col-md-7 col-xs-12 parsley-error' : 'form-control col-md-7 col-xs-12' }}">
        </div>
    </div>

    <div class="item form-group">
        <label class="control-label col-md-1" for="name">Repeat Password <span class="required">*</span></label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <input id="password_confirmation" type="password" name="password_confirmation" data-validate-linked="password" class="{{ $errors->has('password_confirmation') ? 'form-control col-md-7 col-xs-12 parsley-error' : 'form-control col-md-7 col-xs-12' }}">
        </div>
    </div>

@else

    <div class="item form-group">
        <label class="control-label col-md-1" for="name">Password <span class="required">*</span></label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <input id="password" type="password" name="password" data-validate-length="6,7" class="{{ $errors->has('password') ? 'form-control col-md-7 col-xs-12 parsley-error' : 'form-control col-md-7 col-xs-12' }}" required="required">
        </div>
    </div>

    <div class="item form-group">
        <label class="control-label col-md-1" for="name">Repeat Password <span class="required">*</span></label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <input id="password_confirmation" type="password" name="password_confirmation" data-validate-linked="password" class="{{ $errors->has('password_confirmation') ? 'form-control col-md-7 col-xs-12 parsley-error' : 'form-control col-md-7 col-xs-12' }}" required="required">
        </div>
    </div>

@endif

<div class="item form-group">
    <label class="control-label col-md-1" for="name">Role <span class="required">*</span></label>
    <div class="col-md-6 col-sm-6 col-xs-12">
        {!! Form::select('role', App\Role::pluck('display_name','id')->all(), null, ['class' => 'form-control show-tick', 'placeholder'=>'Pilih role', 'required'] ) !!}
    </div>
</div>

<div class="ln_solid"></div>

<div class="form-group">
    <div class="col-md-6 col-md-offset-1">
        <button type="submit" class="btn btn-primary" onclick="window.history.go(-1); return false;">Cancel</button>
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Submit', ['class' => 'btn btn-success', 'onClick' => 'submitForm(this)']) !!}
    </div>
</div>