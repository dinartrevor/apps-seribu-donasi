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
                <a href="#" class="btn btn-primary" onclick="clickDonor({{$donation->id}})">Donasi Sekarang</a>
                @else
                    <a href="{{route('frontEnd.login')}}" class="btn btn-primary">Donasi Sekarang</a>
               @endif
            </div>
        </div>
    </div>
    @endforeach
  </div>
</div>
@include('frontEnd.modal.donor')
@endsection
@push('scripts')
    <script>
         $(document).ready(function () {
            $("#donor_payment_method_id").on("change", function() {
                let account_number = $(this).find(':selected').attr('data-number');
                let account_name = $(this).find(':selected').attr('data-name');
                $("#donor_number").html('Nomor Rekening : ' + account_number);
                $("#donor_name").html('Atas Nama : ' + account_name);
            });
        });

        function clickDonor(id){
            $("#donation_id").val(id);
            getAllPaymentUser(id);
        }
        function getAllPaymentUser(id){
            $.ajax({
                url: "{{ route('frontEnd.donation.payment_method_user') }}",
                type: 'GET',
                data : {
                    id : id
                }
            }).done(function (response) {
                if(response.status){
                    let data = response.data;
                console.log(data);

                    if(data.length > 0){
                        let html = `<option value="" selected disabled>Pilih Metode Pembayaran</option>`;
                        for (let i = 0; i < data.length; i++) {
                            html +=`<option value="${data[i].id}" data-name="${data[i].account_holder_name}" data-number="${data[i].account_number}">${data[i].bank}</option>`
                        }
                        $('#donor_payment_method_id').html(html);
                    }
                    $("#donorModal").modal('show');
                }
            })
            .fail(function () {
                console.log("error");
            });
        }
    </script>
@endpush
