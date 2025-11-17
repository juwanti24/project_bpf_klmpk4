@extends('layouts.admin')

@section('content')
<div class="header mb-4">
    <h2><i class="fa-solid fa-gauge"></i> Dashboard Admin</h2>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card p-3 mb-3 shadow-sm">
            <h5>Total Menu</h5>
            <p class="fs-2">{{ $totalMenu }}</p>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card p-3 mb-3 shadow-sm">
            <h5>Total Pesanan</h5>
            <p class="fs-2">{{ $totalPesanan }}</p>
        </div>
    </div>
</div>
@endsection
