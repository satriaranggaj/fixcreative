<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 13px; color: #000; line-height: 1.6; }
        .content { margin: 20px; }
        p { margin: 5px 0; }
    </style>
</head>
<body>
    <div class="content">
        <p>Kepada Yth.</p>
        <p><strong>{{ strtoupper($project->client) }}</strong></p>
        <p>{{ $project->address }}</p>
        <p>{{ $project->phone }}</p>

        <br>
        <p>Terima kasih atas kepercayaan Anda dalam menggunakan layanan kami.</p>

        <p>Terlampir kami kirimkan tagihan Anda:</p>

        <p>
            <strong>No Invoice :</strong> {{ str_pad($project->id, 3, '0', STR_PAD_LEFT) }}/{{ $project->invoice_date ? \Carbon\Carbon::parse($project->invoice_date)->format('m/Y') : now()->format('m/Y') }}/FCP <br>
            <strong>Total Tagihan :</strong> Rp {{ number_format($project->items->sum(fn($i) => $i->qty * $i->price), 0, ',', '.') }} <br>
            <strong>Tanggal Invoice :</strong> {{ $project->invoice_date ? \Carbon\Carbon::parse($project->invoice_date)->translatedFormat('d F Y') : now()->translatedFormat('d F Y') }} <br>
        </p>

        <p>Untuk rincian tagihan, silakan lihat E-Statement (Invoice) yang terlampir pada email ini.</p>

        <br>
        <p><strong>Note:</strong></p>
        <ul>
            <li>Pembayaran dilakukan melalui rekening resmi yang tercantum pada invoice.</li>
            <li>Untuk informasi lebih lanjut, silakan hubungi Customer Service kami melalui email: <a href="mailto:info@fixcreative.id">fixcreativecoid@gmail.com</a> atau WhatsApp: +62 858-9493-4143.</li>
        </ul>

        <br>
        <p>Hormat kami,</p>
        <p><strong>Finance Dept.</strong></p>
        <hr>
        <p>Fix Creative Jasa Multimedia Event Organizer</p>
        <p>Jl. Wibawa Mukti II No.RT06/04, Jatisari, Kec. Jatiasih, Kota Bks, Jawa Barat 17426</p>
        <p>Telp. +62 858-9493-4143</p>
    </div>
</body>
</html>
