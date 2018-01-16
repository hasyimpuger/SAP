<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Data Transaksi</title>
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
                <center><h2>Data Transaksi {{ date('F-Y', strtotime($bulan . $tahun)) }}</h2></center>
            </div>
            <br>
            <table class="tg">
              <tr>
                <th class="tg-3wr7">No.<br></th>
                <th class="tg-3wr7">Tanggal Transaksi<br></th>
                <th class="tg-3wr7">Invoice ID<br></th>
                <th class="tg-3wr7">Nama Barang<br></th>
                <th class="tg-3wr7">Qty<br></th>
                <th class="tg-3wr7">Total Bayar<br></th>
                <th class="tg-3wr7">Jumlah Bayar<br></th>
              </tr>
              <?php $no = 1; ?>
            @for ($i = 0; $i < count($transaksi); $i++)
              <tr>
                <td class="tg-rv4w" width="7%" style="text-align: center;">{{ $no++ }}</td>
                <td class="tg-rv4w" width="10%" style="text-align: center;">{{$transaksi[$i]['tgl_transaksi'] }}</td>
                <td class="tg-rv4w" width="20%" style="text-align: center;">{{$transaksi[$i]['invoice_id'] }}</td>
                <td class="tg-rv4w" width="20%" style="text-align: center;">{{$transaksi[$i]['barang']['nama_barang'] }}</td>
                <td class="tg-rv4w" width="5%" style="text-align: center;">{{$transaksi[$i]['qty'] }}</td>
                <td class="tg-rv4w" width="10%" style="text-align: center;">{{$transaksi[$i]['total_bayar'] }}</td>
                <td class="tg-rv4w" width="10%" style="text-align: center;">{{$transaksi[$i]['jumlah_bayar'] }}</td>
              </tr>
              @endfor
              <tfoot>
                  <tr>
                      <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td style="text-align: center;">Total Keseluruhan</td>
                  <td style="text-align: center;">:</td>
                  <td style="text-align: center;">Rp. {{number_format($total_bayar)}}</td>
                  <td>&nbsp;</td>
                  </tr>
              </tfoot>
            </table>
        </body>
    </head>
</html>
