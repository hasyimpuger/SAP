<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Data Pemasukan</title>
        <body>
            <style type="text/css">
                .tg  {border-collapse:collapse;border-spacing:0;border-color:#ccc;width: 100%; }
                .tg td{font-family:Arial;font-size:12px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#ccc;color:#333;background-color:#fff;}
                .tg th{font-family:Arial;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#ccc;color:#333;background-color:#f0f0f0;}
                .tg .tg-3wr7{font-weight:bold;font-size:12px;font-family:"Arial", Helvetica, sans-serif !important;;text-align:center}
                .tg .tg-ti5e{font-size:10px;font-family:"Arial", Helvetica, sans-serif !important;;text-align:center}
                .tg .tg-rv4w{font-size:10px;font-family:"Arial", Helvetica, sans-serif !important;}
            </style>

            <div style="font-family:Arial; font-size:12px;">
                <center><h2>Data Pemasukan {{ date('F-Y', strtotime($bulan . $tahun)) }}</h2></center>
            </div>
            <br>
            <table class="tg">
              <tr>
                <th class="tg-3wr7">No.<br></th>
                <th class="tg-3wr7">Tanggal Pemasukan<br></th>
                <th class="tg-3wr7">Jumlah Uang<br></th>
                <th class="tg-3wr7">Keterangan<br></th>
              </tr>
              <?php $no = 1; ?>
            @for ($i = 0; $i < count($pemasukan); $i++)
              <tr>
                <td class="tg-rv4w" width="7%">{{ $no++ }}</td>
                <td class="tg-rv4w" width="30%">{{date('d-F-Y', strtotime($pemasukan[$i]['tgl_pemasukan'])) }}</td>
                <td class="tg-rv4w" width="30%">Rp. {{ number_format($pemasukan[$i]['jumlah_uang']) }}</td>
                <td class="tg-rv4w" width="30%">{{$pemasukan[$i]['keterangan'] }}</td>
              </tr>
              @endfor
            </table>
        </body>
    </head>
</html>
