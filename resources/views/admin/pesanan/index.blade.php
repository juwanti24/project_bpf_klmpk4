@extends('layouts.admin')

@section('content')
<div class="header mb-4">
    <h2 class="fw-bold text-dark" style="font-size: 1.75rem; text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">
        <i class="fa-solid fa-box me-2" style="color: #ffbe33;"></i>Pesanan
    </h2>
</div>

<div class="card border-0 shadow-sm" style="border-radius: 15px; overflow: hidden;">
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead style="background: #ffbe33; color: #222831;">
                <tr>
                    <th style="padding: 15px; font-weight: 600;">No</th>
                    <th style="padding: 15px; font-weight: 600;">Meja</th>
                    <th style="padding: 15px; font-weight: 600;">Menu Dipesan</th>
                    <th style="padding: 15px; font-weight: 600;">Jumlah</th>
                    <th style="padding: 15px; font-weight: 600;">Subtotal</th>
                    <th style="padding: 15px; font-weight: 600;">Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pesanan as $index => $p)
                    <tr style="border-bottom: 1px solid #e0e0e0;">
                        <td style="padding: 15px;">{{ $index + 1 }}</td>
                        <td style="padding: 15px;">
                            <span class="badge" style="background: #ffbe33; color: #222831; padding: 5px 12px; border-radius: 20px;">
                                {{ $p->meja->nomor_meja ?? 'Tidak Ada' }}
                            </span>
                        </td>
                        <td style="padding: 15px; font-weight: 600; color: #222831;">    {{ $p->menu->nama_menu ?? '-' }}
</td>
                        <td style="padding: 15px;">{{ $p->jumlah }}</td>
                        <td style="padding: 15px; font-weight: 600; color: #ffbe33;">Rp {{ number_format($p->total_harga, 0, ',', '.') }}</td>
                        <td style="padding: 15px;">{{ $p->tanggal_pesanan }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
