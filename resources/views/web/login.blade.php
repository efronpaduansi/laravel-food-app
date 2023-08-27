@extends('layouts.web.app')

@section('title')
    Login
@endsection

@section('content')
<main id="main" class="mb-5">
  @include('layouts.web.partials.navbar')
    <section id="login" class="menu">
      <div class="container d-block justify-content-center" data-aos="fade-up">
        <div class="row d-flex justify-content-center my-5">
            <div class="col-md-6">
              @if ($message = Session::get('success'))
              <div class="alert alert-success" role="alert">
                  <div class="alert-body">
                      <strong>{{ $message }}</strong>
                  </div>
              </div>
              @elseif($message = Session::get('error'))
                  <div class="alert alert-danger" role="alert">
                      <div class="alert-body">
                          <strong>{{ $message }}</strong>
                      </div>
                  </div>
              @endif
                <div class="card text-dark" style="background: whitesmoke;">
                    <div class="card-body">
                        <h2 class="text-center mb-4">Masuk ke akun</h2>
                       <form action="{{ route('auth.dologin') }}" method="POST">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}">
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
                           <div class="tombol d-block">
                                <button type="submit" class="btn btn-danger mb-2">Login</button>
                                <p class="font-weight-bold">Belum punya akun? <a href="{{ route('auth.register') }}">Daftar akun</a></p>
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

