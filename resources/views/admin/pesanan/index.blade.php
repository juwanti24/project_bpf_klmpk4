@extends('layouts.admin')

@section('content')
<div class="header mb-4">
    <h2><i class="fa-solid fa-box"></i> Pesanan</h2>
</div>

<table class="table table-hover rounded shadow-sm">
    <thead>
        <tr>
            <th>No</th>
            <th>Meja</th>
            <th>Menu Dipesan</th>
            <th>Jumlah</th>
            <th>Subtotal</th>
            <th>Tanggal</th>
        </tr>
    </thead>
   <tbody>
    @foreach ($pesanan as $index => $p)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $p->meja->nomor_meja ?? 'Tidak Ada' }}</td>
            <td>{{ $p->menu->nama_menu }}</td>
            <td>{{ $p->jumlah }}</td>
            <td>Rp {{ number_format($p->total_harga, 0, ',', '.') }}</td>
            <td>{{ $p->tanggal_pesanan }}</td>
        </tr>
    @endforeach
</tbody>

</table>
@endsection
