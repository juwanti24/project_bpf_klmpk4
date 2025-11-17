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
            @foreach ($p['detail'] as $dIndex => $detail)
                <tr>
                    @if ($dIndex == 0)
                        <td rowspan="{{ count($p['detail']) }}">{{ $index + 1 }}</td>
                        <td rowspan="{{ count($p['detail']) }}">{{ $p['meja']['nomor_meja'] }}</td>
                    @endif

                    <td>{{ $detail['menu']['nama_menu'] }}</td>
                    <td>{{ $detail['jumlah'] }}</td>
                    <td>Rp {{ number_format($detail['subtotal'], 0, ',', '.') }}</td>

                    @if ($dIndex == 0)
                        <td rowspan="{{ count($p['detail']) }}">{{ $p['tanggal_pesanan'] }}</td>
                    @endif
                </tr>
            @endforeach
        @endforeach
    </tbody>
</table>
@endsection
