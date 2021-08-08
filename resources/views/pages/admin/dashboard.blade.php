@extends('layouts.admin')

@section('title')
    Admin Dashboard - Pojok UMKM
@endsection

@section('content')
    <div
      class="section-content section-dashboard-home"
      data-aos="fade-up"
    >
      <div class="container-fluid">
        <div class="dashboard-heading">
          <h2 class="dashboard-title">Admin Dashboard</h2>
          <p class="dashboard-subtitle">Halaman administrator Sepatan Jasa</p>
        </div>
      </div>
      <div class="dashboard-content">
        <div class="row">
          <div class="col-md-4">
            <div class="card mb-2">
              <div class="card-body">
                <div class="dashboard-card-title">Customer</div>
                <div class="dashboard-card-subtitle">{{ ($customer) }}</div>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card mb-2">
              <div class="card-body">
                <div class="dashboard-card-title">Penghasilan</div>
                <div class="dashboard-card-subtitle">Rp. {{ number_format($penghasilan) }}</div>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card mb-2">
              <div class="card-body">
                <div class="dashboard-card-title">Transaksi</div>
                <div class="dashboard-card-subtitle">{{ ($transaksi) }}</div>
              </div>
            </div>
          </div>
        </div>              
      </div>
    </div>
@endsection