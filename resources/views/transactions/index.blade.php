@extends('../layouts.application')

@section('content')

<!-- page content -->
<div class="right_col" role="main">

	<div class="">
		<div class="page-title">
			<div class="title_left">
				<h3>Transaction Lists</h3>
			</div>
		</div>

		<div class="clearfix"></div>

		<div class="row">

			<div class="col-md-12">
				<div class="x_panel">
					<div class="x_title">

						@role('admin')
						<div class="col-md-3 col-sm-3 col-xs-12 form-group">
							{!! Form::select('category', \App\User::all()->pluck('username','id'), null, ['class' =>
							'form-control show-tick', 'id' => 'userSelect', 'onchange'=>'changeUser(this)','placeholder'=>'Pilih User'] ) !!}
						</div>
						@endrole
						<div class="col-md-3 col-sm-3 col-xs-12 form-group">
							<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</div>
								<input type="text" name="reportrange" id="reportrange-filter"
									class="form-control form-width-date" />
							</div>
						</div>

						<ul class="nav navbar-right panel_toolbox">
							<button type="button" onclick="table.buttons('.export-print').trigger();"
								class="btn btn-primary">+ Print</button>
							@role('admin')
							<a href="{{ route("transactions.create") }}"><button type="button" class="btn btn-success">+
									Create</button></a>
							@endrole
						</ul>

						<div class="clearfix"></div>
					</div>

					<div class="x_content">
						<table class="table table-hover" id="konten">
							<tfoot>
								<tr>
									<th></th>
									<th></th>
									<th></th>
									<th></th>
									<th></th>
									<th style="text-align:right">Total:</th>
									<th></th>
								</tr>
							</tfoot>
						</table>
					</div>
				</div>
			</div>

		</div>

	</div>

</div>

@endsection

@section('js')
<script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>

<script type="text/javascript">
	var path = "{{ route('transactions.index') }}";

	function changeUser(el) {
		table.ajax.url('?user_id='+el.value).load();
	}

	var table = $('#konten').DataTable({
		processing: true,
		serverSide: true,
		order: [[ 5, "desc" ]],
		ajax: '',
		columns: [
			{ title: '#', data: 'no', name: 'no', searchable:false },
			{ title: 'inisial', data: 'username', name: 'username' },
			{ title: 'Uraian', data: 'value', name: 'value' },
			{ title: 'Jumlah', data: 'qty', name: 'qty' },
			{ title: 'Harga Satuan', data: 'price', name: 'price' },
			{ title: 'Tanggal', data: 'date', name: 'date' },
			{ title: 'Total', data: 'total', name: 'total' },
			@role('admin')
			{ title: '', data: 'id', name: 'id', searchable:false, sortable:false, 'render': function(data,type,full) {
				return '<button type="button" class="btn btn-sm btn-danger" onclick="deleteData('+data+')"><i class="fa fa-trash"></i></button>';
			}},
			@endrole
		],
		buttons: [
			{
				extend: 'print',
				className: 'export-print',
				footer: true,
			}
		],
        "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
  
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return parseInt(i);
            };
			
            // Total over all pages
            total = api.column( 6 ).data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Total over this page
            pageTotal = api.column( 6, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
			$(api.column( 6 ).footer() ).html(
                pageTotal +' ( '+ total +' total)'
            );
		}
	});	

    @role('admin')
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
    @endrole

	var today = new Date();
	var dd = String(today.getDate()).padStart(2, '0');
	var mm = String(today.getMonth()).padStart(2, '0');
	var mmEnd = String(today.getMonth() + 1).padStart(2, '0');
	var yyyy = today.getFullYear();
	var startdate = yyyy + '/' + mm + '/' + dd;
	var enddate = yyyy + '/' + mmEnd + '/' + dd;

	// COMPLAINT
	$('#reportrange-filter').daterangepicker({
		"startDate": moment().subtract(1, 'month'),
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

		@role('admin')
		table.ajax.url('?user_id='+document.getElementById('userSelect').value+'&startDate='+startdate+'&endDate='+enddate).load();
		@else
		table.ajax.url('?startDate='+startdate+'&endDate='+enddate).load();
		@endrole

	});

</script>
@endsection