@extends('layouts.dashboard')

@section('title')
    Akun - Pojok UMKM
@endsection

@section('content')
    <div
      class="section-content section-dashboard-home"
      data-aos="fade-up"
    >
      <div class="container-fluid">
        <div class="dashboard-heading">
          <h2 class="dashboard-title">Profil Akun</h2>
          <p class="dashboard-subtitle">Update profil</p>
        </div>
      </div>
      <div class="dashboard-content">
        <div class="row">
          <div class="col-12">
            <form action="{{ route('dashboard-settings-redirect','dashboard-account') }}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="card">
                <div class="card-body">
                  <div class="row mb-2">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="name" class="">Nama</label>
                        <input
                          type="text"
                          class="form-control"
                          id="name"
                          name="name"
                          value="{{ $users->name }}"
                        />
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="email" class="">Email</label>
                        <input
                          type="email"
                          class="form-control"
                          id="email"
                          name="email"
                          value="{{ $users->email }}"
                        />
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="address" class="">Alamat</label>
                        <input
                          type="text"
                          class="form-control"
                          id="addres"
                          name="address"
                          value="{{ $users->address }}"
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
                        >
                          <option value="{{ $users->villages_id }}">Tidak diganti ({{ $users->village->villages_name ?? ''  }})</option>
                          @foreach ($villages as $village)
                            <option value="{{ $village->id }}">{{ $village->villages_name }}</option> 
                          @endforeach                                         
                        </select>
                      </div>
                    </div>
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
                          name="phone"
                          class="form-control"
                          id="phone"
                          value="{{ $users->phone }}"
                        />
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col text-right">
                      <button type="submit" class="btn btn-success px-5">
                        Simpan
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
@endsection