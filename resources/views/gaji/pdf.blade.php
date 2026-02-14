<!DOCTYPE html>
<html>
<head>
    <title>Laporan Gaji Pegawai</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        table, th, td { border: 1px solid black; }
        th, td { padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .text-right { text-align: right; }
        .header { text-align: center; margin-bottom: 20px; }
    </style>
</head>
<body>
    <div class="header">
        <h2>LAPORAN PENGGAJIAN PEGAWAI</h2>
        <p>Periode: {{ date('F Y') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pegawai</th>
                <th>Bulan</th>
                <th>Gaji Pokok</th>
                <th>Tunjangan</th>
                <th>Pajak</th>
                <th>Total Diterima</th>
            </tr>
        </thead>
        <tbody>
            @foreach($allGaji as $key => $g)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $g->pegawai->nama ?? 'N/A' }}</td>
                <td>{{ $g->bulan_tahun }}</td>
                <td class="text-right">Rp {{ number_format($g->gaji_pokok, 0, ',', '.') }}</td>
                <td class="text-right">Rp {{ number_format($g->tunjangan, 0, ',', '.') }}</td>
                <td class="text-right">Rp {{ number_format($g->pajak, 0, ',', '.') }}</td>
                <td class="text-right">Rp {{ number_format($g->total_diterima, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>