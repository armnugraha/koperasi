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
				<div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right">
					{!! Form::select('category', \App\User::all()->pluck('username','id'), null, ['class' =>
					'form-control show-tick', 'placeholder'=>'Pilih User'] ) !!}
				</div>
			</div>
		</div>

		<div class="clearfix"></div>

		<div class="row">

			<div class="col-md-12">
				<div class="x_panel">
					<div class="x_title">
						<ul class="nav navbar-right panel_toolbox">
							<a href="{{ route("transactions.create") }}"><button type="button" class="btn btn-success">+ Create New</button></a>
						</ul>

						<div class="clearfix"></div>
					</div>

					<div class="x_content">
						<table class="table table-hover" id="konten"></table>
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

	$('#konten').DataTable({
		processing: true,
		serverSide: true,
		ajax: '',
		columns: [
			{ title: '#', data: 'no', name: 'no', searchable:false },
			{ title: 'Uraian', data: 'value', name: 'value' },
			{ title: 'Jumlah', data: 'qty', name: 'qty' },
			{ title: 'Harga Satuan', data: 'price', name: 'price' },
			{ title: 'Tanggal', data: 'date', name: 'date' },
			{ title: 'Total', data: 'id', name: 'id', 'render': function(data,type,full) {
				return full.qty * full.price;
			}},
			@role('admin')
			{ title: '', data: 'id', name: 'id', 'render': function(data,type,full) {
				return '<button type="button" class="btn btn-sm btn-danger" onclick="deleteData('+data+')"><i class="fa fa-trash"></i></button>';
			}},
			@endrole
		]
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