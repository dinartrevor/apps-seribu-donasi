@extends('backEnd.layouts.main')
@section('title', 'Donasi - '.config('app.name'))
@section('content')
<div class="pagetitle">
    <h1>Donasi</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item active">Donasi</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->
  <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                      <h5 class="card-title">Donasi List</h5>
                    </div>
                    <div class="col-md-8 mt-2">
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('donation.pdf') }}" class="btn btn-outline-danger">
                                Export PDF
                            </a>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <!-- Table with stripped rows -->
                    <table class="table table-striped" id="data-table">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Donasi</th>
                            <th scope="col">Nama Donor</th>
                            <th scope="col">Total Donasi</th>
                            <th scope="col">Pembayaran Via</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($donors as $donor)
                              <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$donor->donation->title}}</td>
                                <td>{{$donor->user->name}}</td>
                                <td>{{number_format($donor->amount)}}</td>
                                <td>{{$donor->paymentMethod->name}}</td>
                              </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <!-- End Table with stripped rows -->
                </div>
            </div>
        </div>
      </div>
    </div>
  </section>
@endsection

