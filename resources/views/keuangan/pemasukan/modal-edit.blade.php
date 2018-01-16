<div class="modal fade" id="modal-edit">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Edit Data</h4>
			</div>
			<div class="modal-body">
				<form method="post" id="frm-edit-pemasukan">
	    			<div class="form-group">
	    				<label>Tanggal Pemasukan</label>
	    				<input type="date" name="tgl_pemasukan" class="form-control">
	    				<input type="hidden" name="id">
	    			</div>
	    			<div class="form-group">
	    			<label>Jumlah Uang</label>
	    				<div class="input-group">
	    					<div class="input-group-addon">Rp.</div>
	    					<input type="text" class="form-control " name="jumlah_uang">
	    				</div>
	    			</div>
	    			<div class="form-group">
	    				<label>Keterangan</label>
	    				<input type="text" name="keterangan" class="form-control">
	    			</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary">Simpan <i class="fa fa-save"></i></button>
	    		</form>
			</div>
		</div>
	</div>
</div>