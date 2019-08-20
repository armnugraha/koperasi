<div class="item form-group">
    <label class="control-label col-md-1" for="name">Name <span class="required">*</span></label>
    <div class="col-md-6 col-sm-6 col-xs-12">
        <input id="name" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="name" placeholder="both name(s) e.g Jon Doe" required="required" type="text">
    </div>
</div>

<div class="item form-group">
    <label class="control-label col-md-1" for="price">Price <span class="required">*</span></label>
    <div class="col-md-6 col-sm-6 col-xs-12">
        <input type="tel" id="price" name="price" required="required" data-validate-length-range="8,20" class="form-control col-md-7 col-xs-12">
    </div>
</div>

<div class="item form-group">
  <label class="control-label col-md-1" for="email">Email <span class="required">*</span>
  </label>
  <div class="col-md-6 col-sm-6 col-xs-12">
    <input type="email" id="email" name="email" required="required" class="form-control col-md-7 col-xs-12">
  </div>
</div>
<div class="item form-group">
  <label class="control-label col-md-1" for="email">Confirm Email <span class="required">*</span>
  </label>
  <div class="col-md-6 col-sm-6 col-xs-12">
    <input type="email" id="email2" name="confirm_email" data-validate-linked="email" required="required" class="form-control col-md-7 col-xs-12">
  </div>
</div>
<div class="item form-group">
  <label class="control-label col-md-1" for="number">Number <span class="required">*</span>
  </label>
  <div class="col-md-6 col-sm-6 col-xs-12">
    <input type="number" id="number" name="number" required="required" data-validate-minmax="10,100" class="form-control col-md-7 col-xs-12">
  </div>
</div>
<div class="item form-group">
  <label class="control-label col-md-1" for="website">Website URL <span class="required">*</span>
  </label>
  <div class="col-md-6 col-sm-6 col-xs-12">
    <input type="url" id="website" name="website" required="required" placeholder="www.website.com" class="form-control col-md-7 col-xs-12">
  </div>
</div>
<div class="item form-group">
  <label class="control-label col-md-1" for="occupation">Occupation <span class="required">*</span>
  </label>
  <div class="col-md-6 col-sm-6 col-xs-12">
    <input id="occupation" type="text" name="occupation" data-validate-length-range="5,20" class="optional form-control col-md-7 col-xs-12">
  </div>
</div>
<div class="item form-group">
  <label for="password" class="control-label col-md-1">Password</label>
  <div class="col-md-6 col-sm-6 col-xs-12">
    <input id="password" type="password" name="password" data-validate-length="6,8" class="form-control col-md-7 col-xs-12" required="required">
  </div>
</div>
<div class="item form-group">
  <label for="password2" class="control-label col-md-1">Repeat Password</label>
  <div class="col-md-6 col-sm-6 col-xs-12">
    <input id="password2" type="password" name="password2" data-validate-linked="password" class="form-control col-md-7 col-xs-12" required="required">
  </div>
</div>

<div class="item form-group">
  <label class="control-label col-md-1" for="textarea">Textarea <span class="required">*</span>
  </label>
  <div class="col-md-6 col-sm-6 col-xs-12">
    <textarea id="textarea" required="required" name="textarea" class="form-control col-md-7 col-xs-12"></textarea>
  </div>
</div>
<div class="ln_solid"></div>
<div class="form-group">
  <div class="col-md-6 col-md-offset-1">
    <button type="submit" class="btn btn-primary">Cancel</button>
    {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Submit', ['class' => 'btn btn-success', 'onClick' => 'submitForm(this)']) !!}
  </div>
</div>