@extends('../layouts.application')

@section('content')

@inject('helper', 'App\Helpers\AppHelper')

<!-- page content -->
<div class="right_col" role="main">
 	
 	<div class="">

    <!-- Start alert info -->
    @if(Session::has('flash_message'))
      <div class="ui-pnotify ui-pnotify-fade-normal ui-pnotify-in ui-pnotify-fade-in ui-pnotify-move" style="display: block; width: 300px; right: 36px; top: 60px; cursor: auto;" aria-live="assertive" aria-role="alertdialog">
        <div id="successMessageAlert" class="alert ui-pnotify-container alert-success ui-pnotify-shadow" role="alert" style="min-height: 16px;">
          <div class="ui-pnotify-closer" aria-role="button" tabindex="0" title="Close" style="cursor: pointer; visibility: hidden;">
            <span class="glyphicon glyphicon-remove"></span>
          </div>
          <div class="ui-pnotify-sticker" aria-role="button" aria-pressed="false" tabindex="0" title="Stick" style="cursor: pointer; visibility: hidden;">
            <span class="glyphicon glyphicon-pause" aria-pressed="false"></span>
          </div>
          <div class="ui-pnotify-icon">
            <span class="glyphicon glyphicon-ok-sign"></span>
          </div>
          <h4 class="ui-pnotify-title">Success</h4>
          <div class="ui-pnotify-text" aria-role="alert">{!!Session::get('flash_message')!!}</div>
        </div>
      </div>
    @endif
    <!-- End alert info -->
    
  	<div class="page-title">
    		<div class="title_left">
      		<h3>Product Lists</h3>
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

                    @if($helper->get_session_user()['role_name'] == "admin")
                       	<div class="x_title">
                          	{{-- <h2>Hover rows <small>Try hovering over the rows</small></h2> --}}
                          	<ul class="nav navbar-right panel_toolbox">
                          		<button type="button" class="btn btn-success" onclick="createNew()">+ Create New</button>
                          	</ul>
                          	
                          	<div class="clearfix"></div>
                       	</div>
                    @endif

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

@endsection

@section("js")

  <script type="text/javascript">

    var path = "{{ url("/products") }}";

  	function createNew() {
  		window.location.href = '{{ url("/products/create") }}'
  	}

    function genEditPath(id) {
      return genShowPath(id) + '/edit';
    }

    function genShowPath(id) {
      return path+'/'+id;
    }

  	$('#konten').DataTable({
       	processing: true,
       	serverSide: true,
        ajax: '',
  		  columns: [
          	{ title: '#', data: 'no', name: 'no', searchable:false },
          	{ title: 'Nama', data: 'name', name: 'name' },
          	{ title: 'Harga', data: 'price', name: 'price' },
          	{ title: 'Di Perbaharui', data: 'created_at', name: 'created_at' },
          	{ title: 'Di Buat', data: 'updated_at', name: 'updated_at' },
            @if($helper->get_session_user()['role_name'] == "admin")
              { title: '', data: 'id', name: 'id', sortable: false,render: function(data,type,full) {
                return '<a href="'+genEditPath(data)+'"><button class="btn btn-warning btn-xs"><i class="fa fa-pencil"></i></button></a> <button onclick="deleteData('+data+')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button>';
              }},
            @endif
        ]
    });

    @if(\Laratrust::can("delete-products"))
      function deleteData(id) {
        swal({
            title: "Apakah Anda Yakin ?",
            text: "Data akan Hilang Setelah Di Hapus!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Ya, Hapus!",
            closeOnConfirm: false
        }, function() {
            sendAjax();
        } );

        function sendAjax() {
          $.ajax({
            url: path+'/'+id,
            data: { '_token': '{{ csrf_token() }}' },
            type: 'DELETE',
            error: function() {
              alert('error');
            },
            success: function(res) {
                swal({
                  title: "Berhasil Di Hapus!",
                  text: "Data Telah Berhasil Di Hapus",
                  type: "success"
                }, function() {
                  location.reload();
                });
            }
          });
        }
      }
    @endif
  </script>
@endsection