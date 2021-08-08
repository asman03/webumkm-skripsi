@extends('layouts.dashboard')

@section('title')
    Transaksi Detail - Pojok UMKM
@endsection

@section('content')
   <div
      class="section-content section-dashboard-home"
      data-aos="fade-up"
    >
      <div class="container-fluid">
        <div class="dashboard-heading">
          <h2 class="dashboard-title">{{ $transaction->code }}</h2>
          <p class="dashboard-subtitle">Transactions Details</p>
        </div>
      </div>
      <div class="dashboard-content" id="transactionDetails">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col-12 col-md-4">
                    <img
                      src="{{ Storage::url($transaction->product->galleries->first()->photos ?? '') }}"
                      class="mb-3"
                      width="300px"
                      height="200px"
                      alt=""
                    />
                  </div>
                  <div class="col-12 col-md-8">
                    <div class="row">
                      <div class="col-12 col-md-6">
                        <div class="product-title">Nama Customer</div>
                        <div class="product-subtitle">{{ $transaction->transaction->user->name }}</div>
                      </div>
                      <div class="col-12 col-md-6">
                        <div class="product-title">Nama Produk</div>
                        <div class="product-subtitle">{{ $transaction->product->name }}</div>
                      </div>
                      <div class="col-12 col-md-6">
                        <div class="product-title">Tanggal Transaksi</div>
                        <div class="product-subtitle">{{ $transaction->created_at }}</div>
                      </div>
                      <div class="col-12 col-md-6">
                        <div class="product-title">Status Pembayaran</div>
                        <div class="product-subtitle text-danger">
                          {{ $transaction->transaction->transaction_status }}
                        </div>
                      </div>
                      <div class="col-12 col-md-6">
                        <div class="product-title">Total</div>
                        <div class="product-subtitle">Rp. {{ number_format($transaction->transaction->total_price) }}</div>
                      </div>
                      <div class="col-12 col-md-6">
                        <div class="product-title">No Hp</div>
                        <div class="product-subtitle">
                          {{ $transaction->transaction->user->phone }}
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <form action="{{ route('dashboard-transaction-update', $transaction->id) }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <div class="row">
                    <div class="col-12 mt-4 mb-2">
                      <h5>Informasi Pengiriman</h5>
                    </div>
                    <div class="col-12">
                      <div class="row">
                        <div class="col-12 col-md-6">
                          <div class="product-title">Alamat</div>
                          <div class="product-subtitle">
                            {{ $transaction->transaction->user->address }}
                          </div>
                        </div>
                        <div class="col-12 col-md-6">
                          <div class="product-title">Kecamatan</div>
                          <div class="product-subtitle">
                            {{ $transaction->transaction->user->districts }}
                          </div>
                        </div>
                        <div class="col-12 col-md-6">
                          <div class="product-title">Desa</div>
                          <div class="product-subtitle">{{ $transaction->transaction->user->villages }}</div>
                        </div>
                        <div class="col-12 col-md-6">
                          <div class="product-title">Email</div>
                          <div class="product-subtitle">
                            {{ $transaction->transaction->user->email }}
                          </div>
                        </div>
                        <div class="col-12 col-md-6">
                          <div class="product-title">Kode Pos</div>
                          <div class="product-subtitle">{{ $transaction->transaction->user->zip_code }}</div>
                        </div>
                        <div class="col-12 col-md-3">
                          <div class="product-title">Status Pengiriman</div>
                            <select
                              name="shipping_status"
                              id="status"
                              class="form-control"
                              v-model="status"
                            >                          
                              <option value="PENDING">Pending</option>
                              <option value="SHIPPING">Sedang Dikirim</option>
                              <option value="SUCCESS">Sukses</option>
                            </select>
                          </div>
                          {{-- <template v-if="status == 'SHIPPING'">
                            <div class="col-md-4">
                              <div class="product-title">Input Resi</div>
                              <input
                                type="text"
                                class="form-control"
                                name="resi"
                                v-model="resi"
                              />
                            </div>
                            <div class="col-md-2">
                              <button
                                type="submit"
                                class="btn btn-success btn-block mt-4"
                              >
                                Update Resi
                              </button>
                            </div>
                          </template> --}}
                        </div>                
                    </div>
                  </div>
                  <div class="row mt-4">
                    <div class="col-12 text-right">
                      <button
                        type="submit"
                        class="btn btn-success btn-lg mt-4"
                      >
                        Save Now
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection

@push('addon-script')
    <script src="/vendor/vue/vue.js"></script>
    <script>
      var transactionDetails = new Vue({
        el: "#transactionDetails",
        data: {
          status: "{{ $transaction->shipping_status }}",
        },
      });
    </script>
@endpush