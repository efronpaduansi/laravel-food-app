@extends('layouts.web.app')

@section('title')
    My Dashboard
@endsection

@section('content')
<main id="main" class="mb-5">
  @include('layouts.web.partials.navbar')
    <section id="dashboard" class="menu">
      <div class="container d-block justify-content-center" data-aos="fade-up">
         {{-- Show Messages --}}
      @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
          <button type="button" class="close" data-dismiss="alert">×</button>	
            <strong>{{ $message }}</strong>
        </div>
      @endif
      @if ($message = Session::get('error'))
        <div class="alert alert-danger alert-block">
          <button type="button" class="close" data-dismiss="alert">×</button>	
            <strong>{{ $message }}</strong>
        </div>
      @endif
        <div class="row d-flex justify-content-center my-5">
            <h4>Selamat datang, {{ Auth()->user()->name }}</h4>
            <div class="row">
                <div class="col-3">
                  <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <button class="nav-link" id="v-pills-home-tab" data-toggle="pill" data-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true">Pesanan Saya</button>
                    <button class="nav-link" id="v-pills-profile-tab" data-toggle="pill" data-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false">Profile</button>
                    <button class="nav-link" id="v-pills-settings-tab" data-toggle="pill" data-target="#v-pills-settings" type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false">Settings</button>
                  </div>
                </div>
                <div class="col-9">
                  <div class="tab-content" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                        <h4>Pesanan Saya</h4>
                       {{-- Jika $myBookingList is not empty --}}
                       @if (!$myBookingList->isEmpty())
                        <a href="{{ route('web.home') }}" class="btn btn-sm btn-primary">Pesan lagi</a>
                       @endif
                      <hr>
                      @if ($myBookingList->isEmpty())
                          <p>Anda belum memiliki pesanan. Yuk <a href="{{ route('web.home') }}">Pesan Makanan Sekarang!</a></p>
                      @else
                        <table class="table table-striped table-bordered">
                          <thead>
                              <tr>
                                  <th>#</th>
                                  <th>Nama Menu</th>
                                  <th>Jumlah Pesanan</th>
                                  <th>Harga (IDR)</th>
                                  <th>Total Bayar (IDR)</th>
                                  <th>Status</th>
                                  <th>Aksi</th>
                              </tr>
                          </thead>
                          <tbody>
                              @foreach ($myBookingList as $item)
                                  <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->menu->name }}</td>
                                    <td>{{ $item->qty }}</td>
                                    <td>{{ number_format($item->menu->price, 2, ",", ".") }}</td>
                                    <td>{{ number_format($item->total, 2, ",", ".") }}</td>
                                    <td>{{ $item->status }}</td>
                                    @if ($item->status == 'Sedang Diproses' || $item->status == 'Selesai' || $item->status == 'Dibatalkan')
                                     <td>
                                        <button type="submit" class="btn btn-sm btn-danger disabled">Batalkan</button>
                                     </td>
                                    @else   
                                    <td>
                                          <form action="{{ route('guest.book.canceled', $item->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="status" value="Dibatalkan">
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Anda yakin membatalkan pesanan ini?')">Batalkan</button>
                                          </form>
                                       </td>
                                    @endif
                                  </tr>
                              @endforeach
                          </tbody>
                        </table>
                      @endif
                    </div>
                    <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                      <h4>My Profile</h4>
                      <hr>
                      <form action="{{ route('guest.profile-update') }}" method="POST">
                          @csrf
                          <input type="hidden" name="id" value="{{ $userData->id }}">
                          <div class="form-group row">
                            <label for="fullname" class="col-sm-4 col-form-label">Nama Lengkap</label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control" id="fullname" name="fullname" value="{{ $userData->name }}" required>
                            </div>
                          </div> <br>
                          <div class="form-group row">
                            <label for="email" class="col-sm-4 col-form-label">Email Address</label>
                            <div class="col-sm-8">
                              <input type="email" class="form-control" id="email" name="email" value="{{ $userData->email }}" required>
                            </div>
                          </div> <br>
                          <div class="form-group row">
                            <label for="email" class="col-sm-4 col-form-label">Terakhir Diubah</label>
                            <div class="col-sm-8">
                               <strong>{{ $userData->updated_at->diffForHumans() }}</strong>
                            </div>
                          </div> <br> <br>
                          <button type="submit" id="submit" class="btn btn-sm btn-primary">Update Profile</button>
                      </form>
                    </div>
                    <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                      <h4>Pengaturan</h4>
                      <hr>
                      <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#passModal">
                        Ubah Kata Sandi
                      </button>
                    </div>
                  </div>
                </div>
              </div>
        </div>
      </div>
      {{-- Password change modal --}}
      <div class="modal fade" id="passModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Ubah Kata Sandi</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="{{ route('guest.pass-update') }}" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{ $userData->id }}">
                <div class="form-group">
                  <label for="oldPass">Password saat ini</label>
                  <input type="password" id="oldPass" name="oldPass" class="form-control" required>
                </div>
                <div class="form-group">
                  <label for="newPass">Password baru</label>
                  <input type="password" id="newPass" name="newPass" class="form-control" required>
                </div>
                <div class="form-group">
                  <label for="passConf">Konfirmasi password</label>
                  <input type="password" id="passConf" name="passConf" class="form-control" required>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-success">Simpan Perubahan</button>
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

