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

						<div class="col-md-3 col-sm-3 col-xs-12 form-group">
							{!! Form::select('category', \App\User::all()->pluck('username','id'), null, ['class' =>
							'form-control show-tick', 'onchange'=>'changeUser(this)','placeholder'=>'Pilih User'] ) !!}
						</div>
						<div class="col-md-3 col-sm-3 col-xs-12 form-group">
							<div id="reportrange"
								style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc">
								<i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
								<span>July 23, 2019 - August 21, 2019</span> <b class="caret"></b>
							</div>
						</div>

						<ul class="nav navbar-right panel_toolbox">
							<button type="button" onclick="table.buttons('.export-print').trigger();" class="btn btn-primary">+ Print</button>
							<a href="{{ route("transactions.create") }}"><button type="button" class="btn btn-success">+
									Create</button></a>
							<div id="print">
							</div>
						</ul>

						<div class="clearfix"></div>
					</div>

					<div class="x_content">
						<table class="table table-hover" id="konten">
							<tfoot>
								<tr>
									<th colspan="7" style="text-align:right">Total:</th>
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
				text: '<i class="fa fa-lg fa-print"></i> Print Assets',
				extend: 'print',
				className: 'btn btn-primary btn-sm export-print'
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
</script>
@endsection