@extends('layouts.app')

@section('title')
    Blog - Pojok UMKM
@endsection
@section('content')
    <div class="page-content page-details">
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
                  <li class="breadcrumb-item">
                    <a href="{{ route('blog') }}">Blog</a>
                  </li>
                  <li class="breadcrumb-item active">Artikel Details</li>
                </ol>
              </nav>
            </div>
          </div>
        </div>
      </section>

      <section class="mb-3" id="gallery">
        <div class="container">
          <div class="row">
            {{-- <div class="col-lg-12" data-aos="zoom-in">
              <transition name="slide-fade" mode="out-in">
                <img
                  :src="photos[activePhoto].url"
                  :key="photos[activePhoto].id"
                  class="w-100 main-image"
                  alt=""
                />
              </transition>
            </div>
            <div class="col-lg-2">
              <div class="row">
                <div
                  class="col-3 col-lg-12 mt-2 mt-lg-0"
                  v-for="(photo, index) in photos"
                  :key="photo.id"
                  data-aos="zoom-in"
                  data-aos-delay="100"
                >
                  <a href="#" @click="changeActive(index)">
                    <img
                      :src="photo.url"
                      class="w-100 thumbnail-image"
                      :class="{ active: index == activePhoto }"
                      alt=""
                    />
                  </a>
                </div>
              </div>
            </div> --}}
            <div class="col-lg-10">
              <img
                      src="{{ Storage::url($blog->photo) }}"
                      alt="banner carousel"                      
                      class="w-100 main-image"                      
                    />
            </div>
            
          </div>
        </div>
      </section>

      <div class="store-details-container" data-aos="fade-up">
        <section class="store-heading">
          <div class="container">
            <div class="row">
              <div class="col-lg-8">
                <h1>{{ $blog->judul }}</h1>
                <div class="owner">Diposting pada {{ $blog->tgl_publish }}</div>
              </div>
            </div>
          </div>
        </section>
        <section class="store-description">
          <div class="container">
            <div class="row">
              <div class="col-12 col-lg-8" style="float: left">
                {!! $blog->description !!}
              </div>
            </div>
          </div>
        </section>

        <section class="store-review">
          <div class="container">
            <div class="row">
              <div class="col-12 col-lg-10 mt-3 mb-3">
                <hr />
                <h5>Bagikan Artikel Ini</h5>
              </div>
            </div>
            <div class="sharethis-inline-share-buttons"></div>
          </div>
        </section>
      </div>
    </div>
@endsection

@push('addon-script')
    <script src="/vendor/vue/vue.js"></script>
    {{-- <script>
      // var gallery = new Vue({
      //   el: "#gallery",
      //   mounted() {
      //     AOS.init();
      //   },
      //   data: {
      //     activePhoto: 0,
      //     photos: [
      //       @foreach ($blog->photo as $item )
      //         {
      //           id: {{ $item->id }},
      //           url: "{{ Storage::url($item->photo) }}",
      //         },
      //       @endforeach
      //     ],
      //   },
      //   methods: {
      //     changeActive(id) {
      //       this.activePhoto = id;
      //     },
      //   },
      // });
    </script> --}}
@endpush