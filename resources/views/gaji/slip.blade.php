<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Slip Gaji - {{ $gaji->pegawai->nama }}</title>
    <style>
        body { 
            font-family: 'Helvetica', 'Arial', sans-serif; 
            font-size: 13px;
            color: #333;
            line-height: 1.4;
        }
        .box { 
            border: 1px solid #000; 
            padding: 30px; 
            width: 90%; 
            margin: auto; 
        }
        .header { 
            text-align: center; 
            border-bottom: 2px double #000; 
            margin-bottom: 20px; 
            padding-bottom: 10px;
        }
        .header h2 { margin: 0; padding: 0; text-transform: uppercase; }
        .header p { margin: 5px 0 0; font-size: 14px; }
        
        table { 
            width: 100%; 
            border-collapse: collapse; 
        }
        .info-table td { 
            padding: 5px 0; 
        }
        .data-table { 
            margin-top: 20px;
        }
        .data-table th, .data-table td { 
            padding: 10px 5px; 
            border-bottom: 1px solid #eee;
        }
        .text-right { 
            text-align: right; 
        }
        .total-row { 
            background-color: #f9f9f9;
            font-weight: bold;
            font-size: 15px;
        }
        .footer { 
            margin-top: 50px; 
        }
        .signature { 
            width: 200px; 
            float: right; 
            text-align: center; 
        }
        .clear { clear: both; }
    </style>
</head>
<body>
    <div class="box">
        <div class="header">
            <h2>SLIP GAJI PEGAWAI</h2>
            <p>Periode: {{ $gaji->bulan_tahun }}</p>
        </div>

        <table class="info-table">
            <tr>
                <td width="120"><strong>Nama Pegawai</strong></td>
                <td>: {{ $gaji->pegawai->nama }}</td>
            </tr>
            <tr>
                <td><strong>ID Pegawai</strong></td>
                <td>: {{ $gaji->pegawai->no_pegawai }}</td>
            </tr>
        </table>

        <table class="data-table">
            <thead>
                <tr style="background-color: #f2f2f2;">
                    <th align="left">Deskripsi</th>
                    <th align="right">Jumlah</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Gaji Pokok</td>
                    <td class="text-right">Rp {{ number_format($gaji->gaji_pokok, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td>Tunjangan</td>
                    <td class="text-right">Rp {{ number_format($gaji->tunjangan, 0, ',', '.') }}</td>
                </tr>
                <tr style="color: #d9534f;">
                    <td>Potongan Pajak (PPh21)</td>
                    <td class="text-right">- Rp {{ number_format($gaji->pajak, 0, ',', '.') }}</td>
                </tr>
                <tr class="total-row">
                    <td style="border-top: 2px solid #333;">TOTAL DITERIMA (NET)</td>
                    <td class="text-right" style="border-top: 2px solid #333;">
                        Rp {{ number_format($gaji->total_diterima, 0, ',', '.') }}
                    </td>
                </tr>
            </tbody>
        </table>

        <div class="footer">
            <div class="signature">
                <p>Dicetak pada: {{ date('d/m/Y') }}</p>
                <p>Bendahara Penggajian,</p>
                <br><br><br>
                <p><strong>____________________</strong></p>
            </div>
            <div class="clear"></div>
        </div>
    </div>
</body>
</html>