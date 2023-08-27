@extends('layouts.web.app')

@section('title')
    Register Akun
@endsection

@section('content')
<main id="main" class="mb-5">
  @include('layouts.web.partials.navbar')
    <section id="login" class="menu">
      <div class="container d-block justify-content-center" data-aos="fade-up">
        <div class="row d-flex justify-content-center my-5">
            <div class="col-md-6">
                <div class="card text-dark" style="background: whitesmoke;">
                    <div class="card-body">
                        <h2 class="text-center mb-4">Daftar akun baru</h2>
                       <form action="{{ route('auth.doregister') }}" method="POST">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="name">Nama</label>
                                <input type="text" name="name" id="neme" class="form-control @error('name') is-invalid @enderror" autofocus value="{{ old('name') }}">
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="email">Email</label>
                                <input type="text" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}">
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror">
                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="passConf">Konfirmasi Password</label>
                                <input type="password" name="passConf" id="passConf" class="form-control @error('passConf') is-invalid @enderror">
                                @error('passConf')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                           <div class="tombol d-block">
                                <button type="submit" class="btn btn-danger mb-2">Daftar</button>
                                <p class="font-weight-bold">Sudah punya akun? <a href="{{ route('auth.login') }}">Masuk ke akun</a></p>
                           </div>
                       </form>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </section>
  </main>
   <!-- ======= Footer ======= -->
   @include('layouts.web.partials.footer')
   <!-- End Footer -->
@endsection

