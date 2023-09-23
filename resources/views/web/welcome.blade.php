@extends('layouts.web.app')

@section('title')
    Dapoer Masagena
@endsection

<!-- ======= Hero Section ======= -->
@include('layouts.web.partials.hero')
<!-- End Hero Section -->

@section('content')
    <main id="main">
        @include('layouts.web.partials.navbar')
        <!-- ======= Menu Section ======= -->
        <section id="menu" class="menu">
            <div class="container" data-aos="fade-up">
                <div class="section-header">
                    <h1>Our Menu</h1>
                    <h2>Pilih menu kesukaanmu di sini!</h2>
                </div>
                <div class="tab-content" data-aos="fade-up" data-aos-delay="300">
                    <div class="tab-pane fade active show" id="menu-starters">
                        <div class="row gy-5">
                            @foreach ($menus as $menu)
                                <div class="col-lg-4 menu-item">
                                    <a href="assets/img/menu/menu-item-1.png" class="glightbox"><img
                                            src="{{ asset('images/menu/' . $menu->thumbnail) }}" class="menu-img img-fluid"
                                            alt=""></a>
                                    <h4>{{ $menu->name }}</h4>
                                    <p class="price">
                                        {{ 'Rp.' . number_format($menu->price, 2) }}
                                    </p>
                                    <a href="{{ route('guest.book.new', $menu->id) }}" class="btn btn-success">Pesan</a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <!-- End Starter Menu Content -->
                </div>
            </div>
        </section>
    </main>
    <!-- ======= Footer ======= -->
    @include('layouts.web.partials.footer')
    <!-- End Footer -->
@endsection
