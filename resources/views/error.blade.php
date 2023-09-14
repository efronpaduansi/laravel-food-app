@extends('layouts.web.app')

@section('title')
    404 Not Found
@endsection

@section('content')
    <main id="main" class="mb-5">
        @include('layouts.web.partials.navbar')
        <section id="dashboard" class="menu">
            <div class="container d-block justify-content-center" data-aos="fade-up">
                <div class="row d-flex justify-content-center my-5">
                    <h1 class="text-center">
                        Upss! Anda mungkin salah jalan atau alamat. Yuk, balik sebelum gelap!
                    </h1>
                    <a href="{{ route('guest.home') }}" class="btn btn-danger rounded col-lg-2 my-4">Kembali</a>
                </div>
            </div>
        </section>
    </main>
    <!-- ======= Footer ======= -->
    @include('layouts.web.partials.footer')
    <!-- End Footer -->
@endsection
