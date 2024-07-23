<!-- Donation Modal -->
<div class="modal fade" id="donationModal" tabindex="-1" aria-labelledby="donationModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="donationModalLabel">Buat Donasi</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
		    <input type="hidden" id="json_payment_method" value='<?= json_encode($paymentMethods)  ?>'> 
        <form action="config/function/donation_store.php" method="POST" enctype='multipart/form-data'> 
          	<div class="row">
				<div class="col-md-6">
					<div class="mb-3">
						<label for="title" class="form-label">Judul <span class="text-red">*</span></label>
						<input type="text" class="form-control" id="title" name="title" placeholder="Judul">
					</div>
				</div>
				<div class="col-md-6">
					<div class="mb-3">
						<label for="amount" class="form-label">Target Donasi <span class="text-red">*</span></label>
						<input type="text" class="form-control currency" id="amount" name="amount" placeholder="Target Donasi">
					</div>
				</div>
				<div class="col-md-6">
					<div class="mb-3">
						<label for="image" class="form-label">Gambar</label>
						<input type="file" class="form-control" id="image" name="image">
					</div>
				</div>
				<div class="col-md-6">
					<div class="mb-3">
						<label for="notes" class="form-label">Keterangan</label>
						<textarea class="form-control" id="notes" name="notes" placeholder="Keterangan"></textarea>
					</div>
				</div>
				<div class="col-md-12">
					<div class="row g-3">
						<div class="col-md-3">
							<label for="payment_method" class="form-label">Metode Pembayaran <span class="text-red">*</span></label>
							<div class="d-flex flex-column" id="paymentMethodWrapper" style="row-gap: 0.5rem;">
								<select name="payment_method_id[]" id="payment_method_id1" class="form-select"  aria-labelledby="payment_method"  data-selectModalCreatejs="true" data-placeholder="Metode Pembayaran">
									<option value="" selected disabled>Pilih Metode Pembayaran</option>
									@foreach ($paymentMethods as $paymentMethod)
                      <option value="{{ $paymentMethod->id }}">{{ $paymentMethod->name }}</option>
                  @endforeach
								</select>
							</div>
						</div>

						<div class="col-md-3">
							<label for="account_number" class="form-label">Nomor Rekening<span class="text-red">*</span></label>
							<div class="d-flex flex-column" id="accountNumberWrapper" style="row-gap: 0.5rem;">
								<input type="text" name="account_number[]" class="form-control number-only" id="account_number1" placeholder="Nomor Rekening" aria-labelledby="account_number" />
							</div>
						</div>

						<div class="col-md-4">
							<label for="account_holder_name" class="form-label">Atas Nama<span class="text-red">*</span></label>
							<div class="d-flex flex-column" id="accountHolderWrapper" style="row-gap: 0.5rem;">
								<input type="text" name="account_holder_name[]" class="form-control" id="account_holder_name1" placeholder="Atas Nama" aria-labelledby="account_holder_name" />
							</div>
						</div>
						<div class="col-md-2">
							<div class="d-flex" style="column-gap: 0.25rem; margin-top: 2rem">
								<input type="hidden" value="1" id="totalInput" />
								<button class="btn btn-success" type="button" id="addInputBtn" title="Tambah Input">
									<i class="bi bi-plus-circle"></i>
								</button>
								<button class="btn btn-danger" type="button" id="removeInputBtn" title="Hapus Input" disabled>
									<i class="bi bi-trash-fill"></i>
								</button>
							</div>
						</div>
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