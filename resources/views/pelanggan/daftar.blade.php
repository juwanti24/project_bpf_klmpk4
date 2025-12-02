@extends('layouts.app')

@section('title', 'Daftar Pelanggan')

@section('content')
<div class="container mt-5">
     <div class="row justify-content-center">
          <div class="col-md-6">
               <div class="card">
                    <div class="card-body">
                         <h4 class="card-title mb-3">Daftar Pelanggan</h4>

                         @if ($errors->any())
                              <div class="alert alert-danger">
                                   <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                             <li>{{ $error }}</li>
                                        @endforeach
                                   </ul>
                              </div>
                         @endif

                         <form action="{{ route('pelanggan.simpan') }}" method="POST">
                              @csrf

                              <div class="mb-3">
                                   <label class="form-label">Nama</label>
                                   <input type="text" name="nama" class="form-control" value="{{ old('nama') }}" required>
                              </div>

                              <div class="mb-3">
                                   <label class="form-label">No HP</label>
                                   <input type="text" name="no_hp" class="form-control" value="{{ old('no_hp') }}" required>
                              </div>

                              <div class="d-flex justify-content-between align-items-center">
                                   <a href="{{ route('pelanggan.menu') }}" class="btn btn-outline-secondary">Kembali ke Menu</a>
                                   <button type="submit" class="btn btn-primary">Daftar & Lihat Menu</button>
                              </div>
                         </form>
                    </div>
               </div>
          </div>
     </div>
</div>
@endsection
