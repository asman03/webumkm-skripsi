@extends('layouts.success')

@section('title')
    Sukses - Pojok UMKM
@endsection

  @section('content') 
    <div class="page-content page-success">
      <div class="section-success" data-aos="zoom-in">
        <div class="container">
          <div class="row align-items-center row-login justify-content-center">
            <div class="col-lg-6 text-center">
              <img
                src="/images/trf success.png"
                alt=""
                width="230"
                height="190"
                class="mb-4"
              />
              <h2>Transaksi Berhasil</h2>
              <p>
                Silahkan cek email kamu dan kami akan
                mengirimkan barangnya segera!
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
  
