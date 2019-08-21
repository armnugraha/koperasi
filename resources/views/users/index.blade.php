@extends('../layouts.application')

@section('content')

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
      		<h3>User Lists</h3>
    		</div>

        <div class="input-group">
          <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
            <input type="text" name="reportrange" id="reportrange-filter" class="form-control form-width-date"/>
        </div>
  	</div>

  	<div class="clearfix"></div>

  	<div class="row">

  		<div class="col-md-12">
          <div class="x_panel">

            @if(\Laratrust::can("create-users"))
             	<div class="x_title">

              	<ul class="nav navbar-right panel_toolbox">
              		<button type="button" class="btn btn-success" onclick="createNew()">+ Create New</button>
              	</ul>
                	
                <div class="clearfix"></div>
             	</div>
            @endif

           	<div class="x_content">
           		<table class="table table-hover" id="konten"></table>
            </div>
	        </div>
       </div>

    </div>

  </div>

</div>

@endsection

@section("js")

  <script type="text/javascript">
    $(document).ready(function() {

        var startdate;
        var enddate;

        // COMPLAINT
        $('#reportrange-filter').daterangepicker({
            "startDate": moment().subtract(7, 'days'),
            "endDate": moment(),

            ranges: {
                'Today' : [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(7, 'days'), moment()],
                'Last 30 Days': [moment().subtract(30, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            }
        });

        $('#reportrange-filter').on('apply.daterangepicker', function(ev, picker) {
            startdate=picker.startDate.format('YYYY-MM-DD');
            enddate=picker.endDate.format('YYYY-MM-DD');
            oTable.fnDraw();
            
            get_filter_shm_complaint('{{url("/filter_complaint")}}',startdate, enddate);

        });

    } );
  </script>

  <script type="text/javascript">

    var path = "{{ url("/users") }}";

    function createNew() {
      window.location.href = '{{ url("/users/create") }}'
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
            { title: 'Username', data: 'username', name: 'username' },
            { title: 'Nama', data: 'name', name: 'name' },
            { title: 'Email', data: 'email', name: 'email' },
            { title: 'Saldo', data: 'saldo', name: 'saldo' },
            { title: 'Di Perbaharui', data: 'created_at', name: 'created_at' },
            { title: 'Di Buat', data: 'updated_at', name: 'updated_at' },
            @if(\Laratrust::can("update-users") && \Laratrust::can("delete-users"))
              { title: '', data: 'id', name: 'id', sortable: false,render: function(data,type,full) {
                return '@if(\Laratrust::can("update-users")) <a href="'+genEditPath(data)+'"><button class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i></button></a>@endif @if(\Laratrust::can("delete-users")) <button onclick="deleteData('+data+')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button> @endif';
              }},
            @endif
          ]
      });

    @if(\Laratrust::can("delete-users"))
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