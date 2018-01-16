@extends('layouts.app')

@section('content')
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-lg-offset-2">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Setting Toko</h3>
			</div>
			<div class="panel-body">
				<form action="{{ route('postSetting') }}" method="post" id="frm-setting"  enctype="multipart/form-data">
				{{ csrf_field() }}
					<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
						<div class="form-group">
						<label>Nama Toko</label>
						<input type="text" name="nama_toko" class="form-control" value="{{$data['nama_toko']}}">
						<input type="hidden" name="id" value="{{ $data['id'] }}">
					</div>
					<div class="form-group">
						<label>Email</label>
						<input type="email" name="email" class="form-control" value="{{ $data['email'] }}">
					</div>
					<div class="form-group">
						<label>No. Telp</label>
						<input type="text" name="telp" class="form-control" value="{{ $data['telp'] }}">
					</div>
					<div class="form-group">
						<label>Alamat</label>
						<textarea class="form-control" name="alamat" rows="3">{{ $data['alamat'] }}</textarea>
					</div>
					<div class="form-group">
						<label for="">Deskripsi</label>
						<textarea class="form-control" rows="3" name="deskripsi">{{ $data['deskripsi'] }}</textarea>
					</div>
					</div>

					<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
						<div class="panel panel-default">
							<div class="panel-heading">
								<h3 class="panel-title">Upload Foto Toko</h3>
							</div>
							<div class="panel-body">
								<div class="form-group">
									<img src="{{ URL::to('photo/toko/', $data['photo']) }}" class="img-thumbnail" width="200" height="200" id="showPhoto">
									<input type="file" name="photo" id="photo" class="form-control">
								</div>
							</div>
						</div>
					</div>

					<button class="btn btn-flat btn-block btn-primary" type="submit">Simpan <i class=" fa fa-save"></i></button>
				</form>
			</div>
		</div>
	</div>
	</div>
@endsection

@section('customJs')
	<script type="text/javascript">
		$(document).ready(function() {
			function showFile(fileInput, img, showName) {
		                if (fileInput.files[0]) {
		                    var reader = new FileReader();
		                    reader.onload = function (e) {
		                        $(img).attr('src', e.target.result);
		                    }
		                    reader.readAsDataURL(fileInput.files[0]);
		                }
		                $('#showPhoto').text(fileInput.files[0].name)
		            }

		            //---distributor---//
		            $('#photo').on('change', function() {
		                showFile(this, '#showPhoto');
		            });

			$('#frm-setting').on('submit', function() {
				toastr.success('Success !', 'Data berhasil di simpan !');
			});
		})
	</script>
@endsection