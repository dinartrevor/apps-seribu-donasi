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
    <div class="col-md-12">
      <h2>List Donasi</h2>
    </div>
  </div>
  <div class="row">
    @foreach ($donations as $donation)
    <!-- Card Donasi Populer 1 -->
    <div class="col-md-4">
        <div class="card shadow p-3 mb-5 bg-body rounded">
            <img src="{{ $donation->image ? asset('storage/donation/'. $donation->image) :  'https://via.placeholder.com/300' }}" class="card-img-top" alt="Donasi 1">
            <div class="card-body">
                <h5 class="card-title">{{ $donation->title }}</h5>
                <p class="card-text">{{ $donation->notes }}</p>
                <div class="progress mb-2">
                    <div class="progress-bar bg-success" role="progressbar" style="width: {{ ($donation->donor_sum_amount/intval($donation->amount) * 100) }}%;"
                        aria-valuenow="{{ ($donation->donor_sum_amount/intval($donation->amount)) * 100 }}" aria-valuemin="0" aria-valuemax="100">
                        Rp {{ number_format($donation->donor_sum_amount) }} / Rp {{ number_format($donation->amount) }}
                    </div>
                </div>
                <p class="card-text"><strong>Pembuat : </strong>{{ $donation->user?->name }}  - {{ $donation->created_at->diffForHumans() }}</p>
                <p class="card-text"><strong>Target : Rp {{ number_format($donation->amount) }}</strong> </p>
                @if(Auth::user())
                <a href="#" class="btn btn-primary" onclick="clickDonor('{{$donation->id}}')">Donasi Sekarang</a>
                @else
                    <a href="{{route('frontEnd.login')}}" class="btn btn-primary">Donasi Sekarang</a>
               @endif
            </div>
        </div>
    </div>
    @endforeach
  </div>
</div>
@endsection