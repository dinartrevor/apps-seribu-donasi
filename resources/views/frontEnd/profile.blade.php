@extends('frontEnd.layouts.main')
@section('title', 'Profile - '.config('app.name'))
@section('content')
<div class="container mt-2">
  <div class="row">
      <!-- Banner Card Full Image -->
      <div class="col-12">
          <div class="card bg-dark text-white card-height">
              <img src="{{ asset('assets/img/banner-seribu.png') }}" class="card-img opacity-25 img-height" alt="Banner">
              <div class="card-img-overlay d-flex align-items-center justify-content-center">
                  <div class="text-center">
                      <h1 class="card-title">Satu Rupiah Satu Harapan <br>#SeribuSenyuman</h1>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>
<div class="container mt-4">
  <div class="row">
      <div class="col-md-4">
          <!-- Improved Profile Information Design -->
          <div class="card shadow">
              <img src="{{ asset('assets/img/utb.jpeg') }}" class="card-img-top mt-3"  alt="Profile Picture">
              <div class="card-body mt-4">
                  <h5 class="card-title">{{ Auth::user()->name }}</h5>
                  <p class="card-title">{{ Auth::user()->email }}</p>
                  <p class="card-title">{{ Auth::user()->npm }}</p>
              </div>
          </div>
      </div>
      <div class="col-md-8">
          <!-- Improved Card Design -->
          <div class="card shadow">
              <div class="card-header">
                  <ul class="nav nav-pills card-header-pills">
                      <li class="nav-item">
                          <a class="nav-link active" id="pills-edit-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-edit-profile" role="tab" aria-controls="pills-edit-profile" aria-selected="true">Profil</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" id="pills-donasi-tab" data-bs-toggle="pill" data-bs-target="#pills-donasi" role="tab" aria-controls="pills-donasi" aria-selected="false">Donasi</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" id="pills-donor-tab" data-bs-toggle="pill" data-bs-target="#pills-donor" role="tab" aria-controls="pills-donor" aria-selected="false">Donor</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" id="pills-password-tab" data-bs-toggle="pill" data-bs-target="#pills-password" role="tab" aria-controls="pills-password" aria-selected="false">Ganti Password</a>
                      </li>
                  </ul>
              </div>
              <div class="card-body">
                  <!-- Tabs Content -->
                  <div class="tab-content">
                      <!-- Edit Profile Content -->
                      <div class="tab-pane fade show active" id="pills-edit-profile" role="tabpanel" aria-labelledby="pills-edit-profile-tab" tabindex="0">
                          <form action="{{ route('frontEnd.student.store') }}" method="post" id="form-profile">
                              @csrf
                              <input type="hidden" name="id" value="{{ Auth::user()->id }}">
                              <div class="mb-3">
                                  <label for="name" class="form-label">Name:</label>
                                  <input type="text" id="name" name="name" value="{{  Auth::user()->name  }}" class="form-control @error('name') is-invalid @enderror" placeholder="Nama">
                                  @error('name')
                                      <div class="invalid-feedback">{{ $message }}</div>
                                  @enderror
                              </div>

                              <div class="mb-3">
                                  <label for="email" class="form-label">Email:</label>
                                  <input type="email" id="email" name="email" value="{{  Auth::user()->email  }}"  class="form-control @error('email') is-invalid @enderror" placeholder="Email">
                                  @error('email')
                                      <div class="invalid-feedback">{{ $message }}</div>
                                  @enderror
                              </div>

                              <!-- Add more fields as needed -->

                              <button type="submit" class="btn btn-primary">Save Changes</button>
                          </form>
                      </div>

                      <!-- Donasi Content -->
                      <div class="tab-pane fade" id="pills-donasi" role="tabpanel" aria-labelledby="pills-donasi-tab" tabindex="0">
                          <div class="row">
                              <div class="col-md-12 mb-3">
                                  <div class="d-flex justify-content-between align-items-center">
                                      <h4>Data Donasi</h4>
                                      <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#donationModal">
                                          Open Donation Modal
                                      </button>
                                  </div>
                              </div>

                              <div class="col-md-12">
                                  <div class="table-responsive">
                                      <table class="table table-striped" id="data-table">
                                          <thead>
                                              <tr>
                                                  <th scope="col">#</th>
                                                  <th scope="col">Judul</th>
                                                  <th scope="col">Target</th>
                                                  <th scope="col">Tanggal Buat</th>
                                                  <th scope="col">Status</th>
                                                  <th scope="col">Action</th>
                                              </tr>
                                          </thead>
                                           <tbody>
                                            @foreach ($donations as $key => $donation)
                                              <tr>
                                                  <td><?= $key + 1; ?></td>
                                                  <td><?= $donation->title; ?></td>
                                                  <td><?= number_format($donation->amount); ?></td>
                                                  <td><?= date('d-m-Y', strtotime($donation->created_at)); ?></td>
                                                  <td>
                                                      <?php if(empty($donation->deleted_at)){ ?>
                                                              <span class="badge bg-success">Publish</span>
                                                      <?php }else{ ?>
                                                          <span class="badge bg-danger">Not Active</span>
                                                      <?php }?>
                                                  </td>
                                                  <td>
                                                  <?php if(empty($donation->deleted_at)): ?>

                                                      <div class="dropdown">
                                                          <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                              <i class="bi bi-gear-fill"></i>
                                                          </button>
                                                          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                              <a class="dropdown-item verify" data-url-verify="<?= './../config/function/donation_verify.php' ?>" data-id="<?= $donation->id; ?>">
                                                                  <em class="bi bi-x-circle-fill close-card"></em>
                                                                  Not Active
                                                              </a>

                                                          </div>
                                                      </div>
                                                      <?php endif ?>
                                                  </td>
                                              </tr>
                                            @endforeach
                                          </tbody>
                                      </table>
                                  </div>
                              </div>
                          </div>
                           <!-- Table with stripped rows -->
                          <!-- End Table with stripped rows -->
                      </div>

                      <!-- Donor Content -->
                      <div class="tab-pane fade" id="pills-donor" role="tabpanel" aria-labelledby="pills-donor-tab" tabindex="0">
                          <div class="row">
                              <div class="col-md-12 mb-3">
                                  <div class="d-flex justify-content-between align-items-center">
                                      <h4>Data Donor</h4>
                                  </div>
                              </div>

                              <div class="col-md-12">
                                  <div class="table-responsive">
                                      <table class="table table-striped" id="data-table-donor">
                                          <thead>
                                              <tr>
                                                  <th scope="col">#</th>
                                                  <th scope="col">Nama</th>
                                                  <th scope="col">Donation</th>
                                                  <th scope="col">Jumlah</th>
                                                  <th scope="col">Metode Pembayaran</th>
                                                  <th scope="col">Tanggal Donor</th>
                                                  <th scope="col">Action</th>
                                              </tr>
                                          </thead>
                                           <tbody>
                                              @foreach ($donors as $item)
                                                  
                                             
                                                  <tr>
                                                      <td><?= $key + 1; ?></td>
                                                      <td><?= $donor->name; ?></td>
                                                      <td><?= $donor->donation?->name; ?></td>
                                                      <td><?= number_format($donor->amount); ?></td>
                                                      <td><?= $donor->paymentMethod?->name; ?></td>

                                                      <td><?= date('d-m-Y', strtotime($donor->created_at)); ?></td>
                                                      <td>
                                                          <a class="dropdown-item show_image" href="#" data-image="<?= $donor->image; ?>">
                                                              <em class="bi bi-camera open-card-option"></em>
                                                          </a>
                                                      </td>
                                                  </tr>
                                                @endforeach
                                          </tbody>
                                      </table>
                                  </div>
                              </div>
                          </div>
                           <!-- Table with stripped rows -->
                          <!-- End Table with stripped rows -->
                      </div>


                      <!-- Change Password Content -->
                      <div class="tab-pane fade" id="pills-password" role="tabpanel" aria-labelledby="pills-password-tab" tabindex="0">
                          <!-- Your change password form can be added here -->
                          <form action="{{ route('frontEnd.password.reset') }}" method="post" id="form-change-password">
                            @csrf
                              <!-- Add your form fields (current password, new password, etc.) here -->
                              <div class="mb-3">
                                  <label for="current-password" class="form-label">Kata sandi saat ini:</label>
                                  <input type="password" id="current_password" name="current_password" class="form-control @error('current_password') is-invalid @enderror" placeholder="Kata sandi saat ini">
                                  @error('current_password')
                                  <div class="invalid-feedback">{{ $message }}</div>
                                 @enderror
                              </div>

                              <div class="mb-3">
                                  <label for="new-password" class="form-label">Kata Sandi Baru:</label>
                                  <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Kata sandi Baru">
                                  @error('password')
                                  <div class="invalid-feedback">{{ $message }}</div>
                                  @enderror
                              </div>

                              <div class="mb-3">
                                  <label for="confirm-password" class="form-label">Konfirmasi Kata Sandi:</label>
                                  <input type="password" id="password_confirmation" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="Konfirmasi sandi Baru">
                                  @error('password_confirmation')
                                  <div class="invalid-feedback">{{ $message }}</div>
                                  @enderror
                              </div>

                              <button type="submit" class="btn btn-primary">Change Password</button>
                          </form>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>

@endsection
