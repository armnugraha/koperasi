<div class="item form-group">
    <label class="control-label col-md-1" for="name">Name <span class="required">*</span></label>
    <div class="col-md-6 col-sm-6 col-xs-12">
        {!! Form::text('name', null, ['id' => 'name', 'class' => $errors->has('name') ? 'form-control col-md-7 col-xs-12 parsley-error' : 'form-control col-md-7 col-xs-12', 'required', 'data-validate-length-range' => '2', 'data-validate-words' => '1', 'placeholder' => 'Name']) !!}
    </div>
</div>

<div class="item form-group">
    <label class="control-label col-md-1" for="price">Price <span class="required">*</span></label>
    <div class="col-md-6 col-sm-6 col-xs-12">
        {!! Form::number('price', null, ['id' => 'price', 'class' => $errors->has('price') ? 'form-control col-md-7 col-xs-12 parsley-error' : 'form-control col-md-7 col-xs-12', 'required', 'data-validate-minmax' => '10', 'placeholder' => 'Price']) !!}
    </div>
</div>

<div class="ln_solid"></div>

<div class="form-group">
    <div class="col-md-6 col-md-offset-1">
        <button type="submit" class="btn btn-primary" onclick="window.history.go(-1); return false;">Cancel</button>
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Submit', ['class' => 'btn btn-success', 'onClick' => 'submitForm(this)']) !!}
    </div>
</div>