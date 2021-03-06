@extends('layouts.success')

@section('title')
    Failed - Pojok UMKM
@endsection

  @section('content') 
    <div class="page-content page-success">
      <div class="section-success" data-aos="zoom-in">
        <div class="container">
          <div class="row align-items-center row-login justify-content-center">
            <div class="col-lg-6 text-center">
              <h2>Oops!</h2>
              <p>
                Transaksi kamu Gagal
                <br/>
                Silahkan ulangi kembali
              </p>
              <div>
                <a href={{ route('dashboard') }} class="btn btn-success w-50 mt-4"
                  >My Dashboard</a
                >
                <a href={{ route('home') }} class="btn btn-signup w-50 mt-2"
                  >Go To Shopping</a
                >
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  @endsection
  
