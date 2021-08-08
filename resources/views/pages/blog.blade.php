@extends('layouts.app')

@section('title')
    Blog - Pojok UMKM
@endsection

@section('content')
    <div class="page-content page-home">
      <section class="store-new-products">
        <div class="container">
          <div class="row">
            <div class="col-12 mb-4" data-aos="fade-up">
              <h5>KABAR SEPATAN</h5>
            </div>
          </div>
          <div class="row">
            @php
                $incrementBlog = 0
            @endphp
            @forelse ($blogs as $blog)
                <div
                  class="col-6 col-md-4 col-lg-4"
                  data-aos="fade-up"
                  data-aos-delay="{{ $incrementBlog += 100 }}"
                >
                  <a href="{{ route('blog-detail', $blog->slug) }}" class="component-products d-block">
                    <div class="products-thumbnail">
                      <img
                          src="{{ Storage::url($blog->photo) }}"
                          alt=""
                          class="w-100"
                      />
                    </div>
                    <div class="products-text">
                      {{ $blog->judul }}
                    </div>
                  </a>
                </div>
            @empty
                <div class="col-12 text-center py-5" 
                    data-aos="fade-up"
                    data-aos-delay="100">
                    Artikel tidak ditemukan
                </div>
            @endforelse
          </div>
        </div>
      </section>
    </div>
@endsection