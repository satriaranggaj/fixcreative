<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Invoice {{ $project->client }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; color: #000; }
        .header { text-align: center; margin-bottom: 20px; color: #78452a; }
        .header p { margin: 2.5px 0; }
        .info { margin-bottom: 20px; }
        .info p { margin: 2.5px 0; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: none; padding: 6px; text-align: left; }
        .right { text-align: right; }
        .center { text-align: center; }
        .signature { margin-top: 350px; width: 100%; border-collapse: collapse; }
        .signature td { width: 50%; text-align: center; border: none; vertical-align: bottom; }
        .sig-space { height: 60px; } /* tinggi area untuk tanda tangan */
        ol { margin: 0; padding-left: 20px; font-size: 11px; }
    </style>
</head>
<body style="margin: 0; padding: 0; background-image: url('{{ public_path('img/logo/logo_fix_bg.png') }}'); background-size: contain; background-repeat: no-repeat; background-attachment: fixed; background-position: center;">
    <div class="header">
        <img width="125px" src="{{ public_path('img/logo/logo_fix.png') }}" alt="Logo Fix Creative">
        <p>Jl. Wibawa Mukti II RT06/04, Jatisari, Kec. Jatiasih, Kota Bekasi,
            <br>Jawa Barat 17426</p>
        <h2 style="margin: 5px 0;"><strong>INVOICE</strong></h2>
        <p>No: {{ str_pad($project->id, 3, '0', STR_PAD_LEFT) }}/{{ $project->invoice_date ? \Carbon\Carbon::parse($project->invoice_date)->format('m/Y') : now()->format('m/Y') }}/FCP</p>
        <p>
            <strong>Invoice Date:</strong>
            {{ $project->invoice_date ? \Carbon\Carbon::parse($project->invoice_date)->format('d F Y') : '-' }}
        </p>
        <p>
            <strong>Due Date:</strong>
            {{ $project->invoice_date ? \Carbon\Carbon::parse($project->date_date)->addDays(30)->format('d F Y') : '-' }}
        </p>
    </div>

    <div class="invoice-box">
        <div class="info">
            <p><strong style="color: #78452a;">Received <span style="display: inline-block; width:35px;"></span>:</strong> {{ $project->client }}</p>
            <p><strong style="color: #78452a;">WA/Telp <span style="display: inline-block; width:40px;"></span>:</strong> {{ $project->phone }}</p>
            <p><strong style="color: #78452a;">Email <span style="display: inline-block; width:60px;"></span>:</strong> {{ $project->email }}</p>
            <p><strong style="color: #78452a;">Venue <span style="display: inline-block; width:52.5px;"></span>:</strong> {{ $project->venue }}</p>
            <p><strong style="color: #78452a;">Address <span style="display: inline-block; width:40px;"></span>:</strong> {{ $project->address }}</p>
            <p><strong style="color: #78452a;">Project Date <span style="display: inline-block; width:10px;"></span>:</strong>
                {{ $project->event_start ? \Carbon\Carbon::parse($project->event_start)->format('d F Y') : '-' }}
                s/d
                {{ $project->event_end ? \Carbon\Carbon::parse($project->event_end)->format('d F Y') : '-' }}
            </p>
        </div>

        {{-- Tabel Items --}}
        <table>
            <thead style="background-color: #ba734c; color: #fff;">
                <tr>
                    <th class="center">Keterangan</th>
                    <th class="center">Qty/Day</th>
                    <th class="right">Harga</th>
                    <th class="right">Nominal</th>
                </tr>
            </thead>
            <tbody style="background-color: #fff; color: #000;">
                @php
                    $total = 0;
                    $paid = 0;
                @endphp

                {{-- Loop Items --}}
                @foreach($project->items as $item)
                    @php
                        $subtotal = $item->qty * $item->price;
                        $total += $subtotal;
                    @endphp
                    <tr>
                        <td>{{ $item->name }}</td>
                        <td class="center">{{ $item->qty }}</td>
                        <td class="right">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                        <td class="right">Rp {{ number_format($subtotal, 0, ',', '.') }}</td>
                    </tr>
                @endforeach

                {{-- Total harga --}}
                <tr>
                    <td style="background-color: #fff; color:#fff;" colspan="2">&nbsp;</td>
                    <td style="background-color: #ba734c; color:#fff;" colspan="1" class="right"><strong>Sub Total</strong></td>
                    <td style="background-color: #ba734c; color:#fff; white-space: nowrap;" class="right"><strong>Rp {{ number_format($total, 0, ',', '.') }}</strong></td>
                </tr>

                {{-- Loop Payments --}}
                @if($project->payments->count())
                        @foreach($project->payments as $payment)
                            @php $paid += $payment->amount; @endphp
                            <tr>
                                <td style="background-color: #fff; color:#fff;" colspan="2">&nbsp;</td>
                                <td style="background-color: #ba734c; color:#fff;" class="right" colspan="1">
                                    <strong>
                                        {{ ucfirst(str_replace('_',' ',$payment->type)) }} - {{ $payment->method }}
                                        -
                                        <small>{{ $payment->payment_date ? \Carbon\Carbon::parse($payment->payment_date)->format('d F Y') : '-' }}</small>
                                    </strong>
                                </td>
                                <td style="background-color: #ba734c; color:#fff; white-space: nowrap;" class="right"><strong>Rp {{ number_format($payment->amount, 0, ',', '.') }}</strong></td>
                            </tr>
                        @endforeach
                        <tr>
                            <td style="background-color: #fff; color:#fff; white-space: nowrap;" colspan="2">&nbsp;</td>
                            <td style="background-color: #ba734c; color:#fff;" colspan="1" class="right"><strong>Total</strong></td>
                            <td style="background-color: #ba734c; color:#fff;" class="right"><strong>Rp {{ number_format($total - $paid, 0, ',', '.') }}</strong></td>
                        </tr>
                @endif
            </tbody>
        </table>


        {{-- Deskripsi --}}
        @if($project->description)
            <p style="margin-top: 15px;"><strong>Keterangan:</strong> {{ $project->description }}</p>
        @endif

        <p style="margin: 10px 0 5px 0"><strong>Pembayaran dapat dilakukan melalui:</strong></p>
        <p style="margin: 2.5px 0">- Transfer ke rekening BCA <strong>5725998284</strong> a.n. <strong>Fikri Nur Ali Mazid</strong></p>
        <p style="margin: 2.5px 0">- Atau bertemu secara langsung di studio</p>
        <p style="margin: 2.5px 0">- Setelah DP & Mengisi Form Booking segera Kami buatkan Invoice</p>
        {{-- Tabel Pembayaran --}}
        {{-- @if($project->payments->count())
            <h4 style="margin-top:20px;">Pembayaran</h4>
            <table>
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Jenis</th>
                        <th>Nominal</th>
                        <th>Metode</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $paid = 0;
                    @endphp
                    @foreach($project->payments as $payment)
                        @php $paid += $payment->amount; @endphp
                        <tr>
                            <td>{{ $payment->payment_date ? \Carbon\Carbon::parse($payment->payment_date)->format('d F Y') : '-' }}</td>
                            <td>{{ ucfirst(str_replace('_',' ',$payment->type)) }}</td>
                            <td class="right">Rp {{ number_format($payment->amount, 0, ',', '.') }}</td>
                            <td>{{ $payment->method }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="2" class="right"><strong>Total Dibayar</strong></td>
                        <td colspan="2" class="right">
                            <strong>Rp {{ number_format($paid, 0, ',', '.') }}</strong>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" class="right"><strong>Sisa</strong></td>
                        <td colspan="2" class="right">
                            <strong>Rp {{ number_format($total - $paid, 0, ',', '.') }}</strong>
                        </td>
                    </tr>
                </tbody>
            </table>
        @endif --}}
        {{-- Syarat dan Ketentuan --}}
        <h1 style="margin-top:250px; margin-bottom: 20px; text-align: center;">Syarat & Ketentuan</h1>
        <ol style="font-size: 16px; line-height: 1.5;">
            <li>Invoice yang dikirim otomatis dianggap sudah membaca S&K pricelist kami.</li>
            <li>Include & Output sesuai dengan invoice & paket yang dipilih.</li>
            <li>Tambahan saat hari H bukan tanggung jawab kami.</li>
            <li>Jika ada tambahan, akan dikerjakan sesuai kesepakatan harga.</li>
            <li>Pelunasan maksimal H-1 sebelum acara.</li>
            <li>Pembayaran bisa via transfer ke BCA: 5725998284 a/n Fikri Nur Ali Mazid.</li>
            <li>DP Rp 1.000.000 dari paket yang dipilih.</li>
            <li>50% saat survey lokasi.</li>
            <li>50% maksimal H-1 acara.</li>
            <li>Album & video maksimal 4-5 minggu pengerjaan.</li>
            <li>Link Google Drive kadaluarsa setelah flashdisk diterima.</li>
            <li>Database/file pengantin fix creative max H+7 setelah flashdisk diterima.</li>
            <li>Kehilangan/kerusakan file bukan tanggung jawab kami.</li>
            <li>Harap backup file ke banyak tempat.</li>
        </ol>


        {{-- Tanda tangan --}}
        <table class="signature">
        <tr>
            <td>
            <div><strong>Staf Project</strong></div>
            <div class="sig-space">
                <img width="100px" src="{{ public_path('img/signature/staff.png') }}" alt="signature">
            </div>
            <div>(Lili Khodijah, S.I.Kom)</div>
        </td>
        <td>
            <div><strong>Owner</strong></div>
            <div class="sig-space">
                <img width="100px" src="{{ public_path('img/signature/owner.png') }}" alt="signature">
            </div>
            <div>(Fikri Nur Ali Mazid, Amd. Ikom)</div>
        </td>
        </tr>
        </table>
    </div>
</body>
</html>
