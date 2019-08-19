@extends('../layouts.application')

@section('content')
<!-- page content -->
<div class="right_col" role="main">
	<div class="">
    	<div class="page-title">
      		<div class="title_left">
        		<h3>Edit Product</h3>
      		</div>
    	</div>

    	<div class="clearfix"></div>

    	<div class="row">
      		<div class="col-md-12 col-sm-12 col-xs-12">
        		<div class="x_panel">
		          {{-- <div class="x_title">
		            <h2>Form validation <small>sub title</small></h2>
		            <div class="clearfix"></div>
		          </div> --}}
          
	          		<div class="x_content">

			          	@if ($errors->any())
			                <ul class="alert alert-danger">
			                    @foreach ($errors->all() as $error)
			                        <li>{{ $error }}</li>
			                    @endforeach
			                </ul>
			            @endif

			            {!! Form::model($product, [
			                'method' => 'PATCH',
			                'url' => ['/products', $product->id],
			                'class' => 'form-horizontal form-label-left',
			                'files' => true,
			                'novalidate'
			            ]) !!}

			            	{{ csrf_field() }}

			            	@include ('products.form', ['submitButtonText' => "Update"])

						{!! Form::close() !!}
            

          			</div>

        		</div>
      		</div>
    	</div>
  	</div>
</div>
<!-- /page content -->
@endsection