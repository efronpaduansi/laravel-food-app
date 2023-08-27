@extends('layouts.web.app')

@section('title')
    New Book
@endsection

@section('content')
<main id="main" class="mb-5">
  @include('layouts.web.partials.navbar')
    <section id="dashboard" class="menu">
      <div class="container d-block justify-content-center" data-aos="fade-up">
        <div class="row d-flex justify-content-center my-5">
            <h2 class="text-center">Form Pemesanan</h2>
            <small class="text-center">Silahkan isi formulir untuk memesan.</small>
            <div class="row d-flex justify-content-center my-5">
                <div class="col-md-6">
                    <form action="{{ route('guest.book.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="guest_id" value="{{ Auth()->user()->id }}">
                        <div class="form-group">
                            <label for="menu_id">Nama Menu</label>
                            <input type="hidden" name="menu_id" id="menu_id" class="form-control mb-2" value="{{ $menu->id }}" readonly>
                            <input type="text" name="menu_name" id="menu_name" class="form-control mb-2" value="{{ $menu->name }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="menu_price">Harga</label>
                            <input type="text" name="menu_price" id="menu_price" class="form-control mb-2" value="{{ $menu->price }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="qty">Jumlah</label>
                            <input type="text" name="qty" id="qty" class="form-control mb-2 @error('qty') is-invalid @enderror" autofocus>
                            @error('qty')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="payment">Metode Pembayaran</label>
                            <select name="payment" id="payment" class="form-select form-control mb-2 @error('payment') is-invalid @enderror">
                                <option value="cash">Cash</option>
                                <option value="transfer">Transfer</option>
                            </select>
                            @error('payment')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="note">Catatan (Opsional)</label>
                            <textarea name="note" id="note" cols="30" rows="2" class="form-control mb-3"></textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-danger">Pesan</button>
                        </div>
                    </form>
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

