@extends('../layouts.application')

@section('content')
<!-- page content -->
<div class="right_col" role="main">
	<div class="">
    	<div class="page-title">
      		<div class="title_left">
        		<h3>Create User</h3>
      		</div>
    	</div>

    	<div class="clearfix"></div>

    	<div class="row">
      		<div class="col-md-12 col-sm-12 col-xs-12">
        		<div class="x_panel">
          
	          		<div class="x_content">

			          	@if ($errors->any())
			                <ul class="alert alert-danger">
			                    @foreach ($errors->all() as $error)
			                        <li>{{ $error }}</li>
			                    @endforeach
			                </ul>
			            @endif

			            {!! Form::open(['url' => '/users', 'class' => 'form-horizontal form-label-left', 'novalidate']) !!}
			            
			            	{{ csrf_field() }}
			            
			            	@include ('users.form')

			            {!! Form::close() !!}

          			</div>

        		</div>
      		</div>
    	</div>
  	</div>
</div>
<!-- /page content -->
@endsection