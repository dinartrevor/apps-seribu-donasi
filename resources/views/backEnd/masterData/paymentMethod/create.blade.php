<div class="modal fade" id="modal-create" aria-modal="true" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Create Payment Method</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <form action="{{ route('payment_method.store') }}" method="POST" class="form-horizontal" enctype="multipart/form-data">
              @csrf
              <div class="card-body">
                  <div class="row">
                      <div class="col-md-12">
                          <div class="form-group">
                              <label for="name" class="form-label">Name <span class="text-red">*</span></label>
                              <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" autocomplate="off" placeholder="Enter Payment Method Name" value="{{ old('name') }}">
                              @error('name')
                                  <div class="invalid-feedback">{{ $message }}</div>
                              @enderror
                          </div>
                      </div>
                  </div>
              </div>
              <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Save changes</button>
              </div>
          </form>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
