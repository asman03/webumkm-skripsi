@extends('layouts.app')

@section('title')
    Kategori - Pojok UMKM
@endsection



@section('content')
    <div class="page-content page-home">
            <section class="store-trend-categories">
                <div class="container">
                    <div class="row">
                        <div class="col-12" data-aos="fade-up">
                            <h5>Kategori</h5>
                        </div>
                    </div>
                    <div class="row">                       
                        @php
                            $incrementCategory = 0
                        @endphp
                        @forelse ( $categories as $category )                                                                                                                                                
                            <div
                                class="col-6 col-md-3 col-lg-2"
                                data-aos="fade-up"
                                data-aos-delay="{{ $incrementCategory += 100 }}"
                            >
                                <a href="{{ route('categories-detail', $category->slug) }}" class="component-categories d-block">

                                    <div class="categories-image">
                                        <img
                                            src="{{ Storage::url($category->photo) }}"
                                            alt=""
                                            class="w-100"
                                        />
                                    </div>
                                    <p class="categories-text">{{ $category->name }}</p>
                                </a>
                            </div>
                                                                                
                        @empty
                            <div class="col-12 text-center py-5" 
                                data-aos="fade-up"
                                data-aos-delay="100">
                                Kategori tidak ada
                            </div>                                
                        @endforelse                                                                     
                    </div>
                </div>
            </section>

            <section class="store-new-products">
                <div class="container">
                    <div class="row">
                        <div class="col-12" data-aos="fade-up">
                            <h5>Produk Pojok UMKM</h5>
                        </div>
                    </div>
                    <div class="row">
                        @php
                            $incrementProduct = 0
                        @endphp
                        @forelse ($products as $product)
                            <div
                                class="col-6 col-md-4 col-lg-3"
                                data-aos="fade-up"
                                data-aos-delay="{{ $incrementProduct += 100 }}"
                            >
                                <a
                                    href="{{ route('detail',$product->slug) }}"
                                    class="component-products d-block"
                                >
                                    <div class="products-thumbnail">
                                        <div
                                            class="products-image"
                                            style=" @if ($product->galleries->count())
                                                    background-image: url('{{ storage::url($product->galleries->first()->photos) }}')
                                                @else
                                                    background-color: #eee
                                                @endif                                                                                      
                                            "
                                        ></div>
                                    </div>
                                    <div class="products-text">{{ $product->name }}</div>
                                    <div class="products-price">Rp. {{ number_format($product->price) }}</div>
                                </a>
                            </div>
                        @empty
                            <div class="col-12 text-center py-5"
                                data-aos="fade-up"
                                data-aos-delay="100">
                                Produk tidak tersedia
                            </div>
                        @endforelse
                    </div>                    
                    <div class="row">
                        <div class="col-12 mt-4">
                            {{ $products->links() }}
                        </div>
                    </div>
                </div>
            </section>
        </div>
@endsection

@push('addon-script')
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.green.min.css"/>
  <script>
  $(document).ready(function($){
    $('.owl-carousel').owlCarousel({
      loop:true,
      margin:10,
      nav:false,
      autoWidth:false,
      responsive:{
        0:{
          items:1
        },
        600:{
          items:3
        },
        1000:{
          items:5
        }
      }
    })
  })
  </script>


@endpush