<!-- Donation Modal -->
<div class="modal fade" id="donorModal" tabindex="-1" aria-labelledby="donorModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="donorModalLabel">Donor</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <form action="config/function/donor_store.php" method="POST" enctype='multipart/form-data'>
            <input type="hidden" name="user_id" id="user_id" value='{{ Auth::user()?->id }}'>
            <input type="hidden" name="donation_id" id="donation_id">
          	<div class="row">
				<div class="col-md-6">
					<div class="mb-3">
						<label for="title" class="form-label">Nama <span class="text-red">*</span></label>
						<input type="text" class="form-control" id="name" name="name" value="{{ Auth::user()?->name }}">
					</div>
				</div>
				<div class="col-md-6">
					<div class="mb-3">
						<label for="amount" class="form-label">Jumlah Donasi<span class="text-red">*</span></label>
						<input type="text" class="form-control currency" id="amount" name="amount" value="<?= number_format(1000)?>">
					</div>
				</div>
        <div class="col-md-6">
            <div class="mb-3">
                <label for="payment_method" class="form-label">Metode Pembayaran <span class="text-red">*</span></label>
                <select name="payment_method_id" id="donor_payment_method_id" class="form-select"  aria-labelledby="payment_method"  data-selectModalDonorCreatejs="true" data-placeholder="Metode Pembayaran">
                    <option value="" selected disabled>Pilih Metode Pembayaran</option>

                </select>
                <p class="h5 mt-2" id="donor_number"></p>
                <p class="h5" id="donor_name"></p>
            </div>
        </div>
				<div class="col-md-6">
					<div class="mb-3">
						<label for="image" class="form-label">Bukti Donasi</label>
						<input type="file" class="form-control" id="image" name="image">
					</div>
				</div>
				<div class="col-md-12">
					<div class="mb-3">
						<label for="notes" class="form-label">Keterangan</label>
						<textarea class="form-control" id="notes" name="notes" placeholder="Keterangan"></textarea>
					</div>
				</div>
          	</div>
			<div class="modal-footer mt-5">
				<button type="submit" class="btn btn-primary">Simpan Donasi</button>
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
			</div>
        </form>
      </div>
    </div>
  </div>
</div>