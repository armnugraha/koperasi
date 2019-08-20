@extends('../layouts.application')

@section('content')

<!-- page content -->
<div class="right_col" role="main">
 	
 	<div class="">
    	<div class="page-title">
      		<div class="title_left">
        		<h3>Transaction Lists</h3>
      		</div>

	      	<div class="title_right">
	        	<div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
	          		<div class="input-group">
	            		<input type="text" class="form-control" placeholder="Search for...">
	            		<span class="input-group-btn">
	              			<button class="btn btn-default" type="button">Go!</button>
	            		</span>
	          		</div>
	        	</div>
	      	</div>
    	</div>

    	<div class="clearfix"></div>

    	<div class="row">

    		<div class="col-md-12">
                <div class="x_panel">
                 	<div class="x_title">
                    	{{-- <h2>Hover rows <small>Try hovering over the rows</small></h2> --}}
                    	<ul class="nav navbar-right panel_toolbox">
                    		<button type="button" class="btn btn-success" onclick="createNew()">+ Create New</button>
                      		{{-- <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                      		<li class="dropdown">
                        		<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        		<ul class="dropdown-menu" role="menu">
                          			<li><a href="#">Settings 1</a></li>
                          			<li><a href="#">Settings 2</a></li>
                        		</ul>
                      		</li>
                      		<li><a class="close-link"><i class="fa fa-close"></i></a></li> --}}
                    	</ul>
                    	
                    	<div class="clearfix"></div>
                 	</div>

                 	<div class="x_content">
                 		<table class="table table-hover" id="konten"></table>
                   		{{-- <table class="table table-hover">
                      		<thead>
                        		<tr>
                          			<th>#</th>
                          			<th>First Name</th>
                          			<th>Last Name</th>
                          			<th>Action</th>
                        		</tr>
                      		</thead>
                      		<tbody>
                        		<tr>
                          			<th scope="row">1</th>
                          			<td>Mark</td>
                          			<td>Otto</td>
                          			<td>
                          				<div class="x_content">
											<button type="button" class="btn btn-info">Show</button>
											<button type="button" class="btn btn-warning">Edit</button>
											<button type="button" class="btn btn-danger">Delete</button>
										</div>
                          			</td>
                        		</tr>
                        		<tr>
                          			<th scope="row">2</th>
                          			<td>Jacob</td>
                          			<td>Thornton</td>
                          			<td>
                          				<div class="x_content">
											<button type="button" class="btn btn-info">Show</button>
											<button type="button" class="btn btn-warning">Edit</button>
											<button type="button" class="btn btn-danger">Delete</button>
										</div>
                          			</td>
                        		</tr>
                      		</tbody>
                    	</table>
 --}}
                  	</div>
				</div>
			</div>

    	</div>

    </div>

</div>

<script type="text/javascript">
	function createNew() {
		window.location.href = '{{ url("/transactions/create") }}'
	}

	// $(function() {

	    $('#konten').DataTable({
	     	processing: true,
	     	serverSide: true,
	      	ajax: '{{ url("/products") }}',
			columns: [
	        	{ title: '#', data: 'no', name: 'no', searchable:false },
	        	{ title: 'Nama', data: 'nama', name: 'nama' },
	        	{ title: 'Harga', data: 'price', name: 'price' },
	        	{ title: 'Di Perbaharui', data: 'created_at', name: 'created_at' },
	        	{ title: 'Di Buat', data: 'updated_at', name: 'updated_at' },
	      	]
	    });
  // });
</script>

@endsection