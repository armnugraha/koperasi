<div class="item form-group">
  <label class="control-label col-md-1" for="product_id">Type <span class="required">*</span></label>
  <div class="col-md-6 col-sm-6 col-xs-12">
    {!! Form::select('product_id', \App\Product::all()->pluck('name','id'), null, ['class' =>
    'form-control show-tick', 'onchange'=>'showPrice(this)','placeholder'=>'Deposit'] ) !!}
  </div>
</div>

<div class="item form-group">
  <label class="control-label col-md-1" for="user_id">User <span class="required">*</span></label>
  <div class="col-md-6 col-sm-6 col-xs-12">
    {!! Form::select('user_id', \App\User::all()->pluck('username','id'), null, ['class' =>
    'form-control show-tick', 'placeholder'=>'Pilih User', 'required'] ) !!}
  </div>
</div>

<div class="item form-group" id="price">
  <label class="control-label col-md-1" for="price">Harga <span class="required">*</span></label>
  <div class="col-md-6 col-sm-6 col-xs-12">
    {!! Form::number('price', null, ['class' =>'form-control', 'placeholder'=>'1000', 'required'] ) !!}
  </div>
</div>

<div class="item form-group">
  <label class="control-label col-md-1" for="qty">Jumlah <span class="required">*</span></label>
  <div class="col-md-6 col-sm-6 col-xs-12">
    {!! Form::number('qty', 1, ['class' =>'form-control', 'placeholder'=>'jumlah', 'required'] ) !!}
  </div>
</div>

<div class="item form-group">
  <label class="control-label col-md-1" for="Tanggal">Tanggal <span class="required">*</span></label>
  <div class="col-md-6 col-sm-6 col-xs-12">
    {!! Form::text('date', null, ['class' =>'form-control', 'placeholder'=>'yyyy-mm-dd', 'id'=>'single_cal2',
    'required'] ) !!}
  </div>
</div>

<div class="ln_solid"></div>
<div class="form-group">
  <div class="col-md-6 col-md-offset-1">
    {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Submit', ['class' => 'btn btn-success', 'onClick'
    => 'submitForm(this)']) !!}
  </div>
</div>

<script>
  function showPrice(el) {
    if(el.value == '') {
      document.getElementById('price').style.display = '';
    } else {
      document.getElementById('price').style.display = 'none';
    }
  }
</script>