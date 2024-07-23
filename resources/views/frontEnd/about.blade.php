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
  <h2>Team Kami</h2>
  <div class="row">
      <!-- Card Anggota Tim 1 -->
      <div class="col-md-4">
          <div class="shadow p-3 mb-5 bg-body rounded">
              <img src="{{ asset("assets/img/goku.jpeg") }}" class="card-img-top height-500px" alt="Dinar Abdul Hollik Firdaus">
              <div class="card-body mt-3">
                  <h5 class="card-title">Dinar Abdul Hollik Firdaus</h5>
                  <p class="card-text">Posisi: Programmer</p>
              </div>
          </div>
      </div>
      <div class="col-md-4">
          <div class="shadow p-3 mb-5 bg-body rounded">
              <img src="{{ asset("assets/img/naruto.jpg") }}" class="card-img-top height-500px" alt="Dinar Abdul Hollik Firdaus">
              <div class="card-body mt-3">
                  <h5 class="card-title">Dinar Abdul Hollik Firdaus</h5>
                  <p class="card-text">Posisi: Programmer</p>
              </div>
          </div>
      </div>
      <div class="col-md-4">
          <div class="shadow p-3 mb-5 bg-body rounded">
              <img src="{{ asset("assets/img/luffy.jpg") }}" class="card-img-top height-500px" alt="Dinar Abdul Hollik Firdaus">
              <div class="card-body mt-3">
                  <h5 class="card-title">Dinar Abdul Hollik Firdaus</h5>
                  <p class="card-text">Posisi: Programmer</p>
              </div>
          </div>
      </div>
  </div>
</div>

@endsection
