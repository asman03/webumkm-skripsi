@extends('layouts.app')

@section('title')
    Keranjang - Pojok UMKM
@endsection

@section('content')
    <div class="page-content page-cart">
      <!-- breadcrumbs = menunjukan letak spesifik sebuah halaman pada website -->
        <section
            class="store-breadcrumbs"
            data-aos="fade-down"
            data-aos-delay="100"
        >
            <div class="container">
            <div class="row">
                <div class="col-12">
                <nav aria-labelledby="">
                    <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Cart</li>
                    </ol>
                </nav>
                </div>
            </div>
            </div>
        </section>

      <section class="store-cart">
        <div class="container">
          <div class="row" data-aos="fade-up" data-aos-delay="100">
            <div class="col-12 table-responsive">
              <table
                class="table table-borderless table-cart"
                aria-labelledby=""
              >
                <thead>
                  <tr>
                    <td>Gambar</td>
                    <td>Nama &amp; seller</td>
                    <td>Jumlah Barang</td>
                    <td>Harga</td>
                    <td>Total</td>
                    <td>Menu</td>
                  </tr>
                </thead>
                <tbody>
                  @php $totalPrice= 0 @endphp
                  @foreach ($carts as $cart)
                      <tr>
                        <td style="width: 20%">
                          @if ($cart->product->galleries)
                            <img
                              src="{{ Storage::url($cart->product->galleries->first()->photos) }}"
                              alt=""
                              class="cart-image"
                            />                              
                          @endif                          
                        </td>
                        <td style="width: 35%">
                          <div class="product-title">{{ $cart->product->name }}</div>
                          <div class="product-subtitle">By {{$cart->product->user->store_name}}</div>
                        </td>

                        <td style="width: 20%;" >
                          <div>
                            @if ($cart->qty > 1)
                              <form action="{{ route('dec',$cart->id) }}" method="post" enctype="multipart/form-data">
                              @csrf
                              <button type="submit" class="btn btn-danger btn-sm" style="width: 25%; display:inline;">-</button>
                              </form>
                            @endif
                            <input type="text" name="qty" class="form-control" style="width: 25%; display:inline;" value="{{ $cart->qty }}" readonly>
                          
                            <form action="{{ route('inc',$cart->id) }}" method="post" enctype="multipart/form-data" >
                              @csrf
                              <button type="submit" class="btn btn-success btn-sm" style="width: 25%;display:inline;" >+</button>
                            </form>
                          </div>
                        </td>

                        <td style="width: 35%">
                          <div class="product-title">Rp. {{ number_format($cart->product->price) }}</div>
                          <div class="product-subtitle">IDR</div>
                        </td>

                        <td style="width: 30%">
                          <div class="product-title">Rp. {{ number_format($cart->total) }}</div>                          
                        </td>

                        <td style="width: 20%">
                          <form action="{{ route('cart-delete', $cart->id) }}" method="POST">
                            @method('DELETE')
                            @csrf
                              <button type="submit" class="btn btn-remove-cart">Hapus</button>
                          </form>                          
                        </td>
                      </tr>
                      @php
                        // $totalPrice += $cart->product->price
                        $totalPrice += $cart->total
                      @endphp
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
          <div class="row" data-aos="fade-up" data-aos-delay="150">
            <div class="col-12">
              <hr />
            </div>
            <div class="col-12">
              <h2 class="mb-4">Pengiriman</h2>
            </div>
          </div>
          <form action="{{ route('checkout') }}"  id="locations" enctype="multipart/form-data" method="POST">
            @csrf
            <input type="hidden" name="total_price" value="{{ $totalPrice }}">
              <div class="row mb-2" data-aos="fade-up" data-aos-delay="200">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="address" class="">Alamat</label>
                    <input
                      type="text"
                      class="form-control"
                      id="addres"
                      name="address"
                      value="{{ $users->address ?? '' }}"
                      required
                    />
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="districts" class="">Kecamatan</label>
                    <input
                      type="text"
                      class="form-control"
                      id="districts"
                      name="districts"
                      value="Sepatan" 
                      value="{{ $users->districts }}"
                    />
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="villages" class="">Desa</label>
                    <select
                      name="villages_id"
                      id="villages"
                      class="form-control"
                      required
                    >
                      <option value="{{ $users->villages_id }}">{{ $users->village->villages_name ?? 'Lengkapi Profilmu'  }}</option>
                      @foreach ($villages as $village)
                        <option value="{{ $village->id }}">{{ $village->villages_name }}</option> 
                      @endforeach                                         
                    </select>
                  </div>
                </div>
                {{-- <div class="col-md-6">
                  <div class="form-group">
                    <label for="villages" class="">Desa</label>
                    <select name="villages" id="villages" class="form-control">
                      <option value="">Sepatan</option>
                      <option value="">Sarakan</option>
                      <option value="">Karet</option>
                      <option value="">Kayu Agung</option>
                      <option value="">kayu Bongkok</option>
                      <option value="">Mekar Jaya</option>
                      <option value="">Pisangan Jaya</option>
                      <option value="">Pondok Jaya</option>
                    </select>
                  </div>
                </div> --}}
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="zip_code" class="">Kode Pos</label>
                    <input
                      type="text"
                      class="form-control"
                      id="zip_code"
                      name="zip_code"
                      value="15520"                      
                      value="{{ $users->zip_code }}"
                    />
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="phone" class="">No. Hp</label>
                    <input
                      type="text"
                      class="form-control"
                      id="phone"
                      name="phone"
                      value="{{ $users->phone ?? '' }}"
                      required
                    />
                  </div>
                </div>
              </div>
                    
              <div class="row" data-aos="fade-up" data-aos-delay="200">
                <div class="col-12">
                  <hr />
                </div>
                <div class="col-12">
                  <h2 class="mb-1">Informasi Pembelian</h2>
                </div>
              </div>
              <div class="row" data-aos="fade-up" data-aos-delay="200">
                <div class="col-4 col-md-3">
                  <div class="product-title">RP. 2000</div>
                  <div class="product-subtitle">Admin</div>
                </div>
                <div class="col-4 col-md-3">
                  <div class="product-title">Rp. 5.000</div>
                  <div class="product-subtitle">Biaya Ongkir</div>
                </div>
                <div class="col-4 col-md-2">
                  <div class="product-title text-success">Rp. {{ number_format($totalPrice + 2000 + 5000 ?? 0) }}</div>
                  <div class="product-subtitle">Total</div>
                </div>
                <div class="col-8 col-md-3">
                  <button
                    type="submit"
                    class="btn btn-success mt-4 px-4 btn-block"
                    >Checkout
                  </button>
                </div>
              </div>
          </form>
        </div>
      </section>
    </div>
            
@endsection