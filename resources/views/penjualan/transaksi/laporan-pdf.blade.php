<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Laporan Transaksi</title>
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
                <center><h2>Laporan Transaksi {{date('d-m-Y', strtotime($start)) . ' / ' . date('d-m-Y', strtotime($end))}}</h2></center>
            </div>
            <br>
            <table class="tg" style="text-align: center;">
              <tr>
                <th class="tg-3wr7">No.<br></th>
                <th class="tg-3wr7">Tgl. Transaksi</th>
                <th class="tg-3wr7">Invoice ID</th>
                <th class="tg-3wr7">Nama Barang</th>
                <th class="tg-3wr7">Qty</th>
                <th class="tg-3wr7">Total Bayar</th>
              </tr>
              <?php $no = 1; ?>
            @foreach($transaksi as $data)
              <tr>
                <td class="tg-rv4w" width="7%">{{ $no++ }}</td>
                <td class="tg-rv4w" width="10%">{{$data['tgl_transaksi'] }}</td>
                <td class="tg-rv4w" width="20%">{{$data['invoice_id'] }}</td>
                <td class="tg-rv4w" width="20%">{{$data['barang']['nama_barang'] }}</td>
                <td class="tg-rv4w" width="5%">{{$data['qty'] }}</td>
                <td class="tg-rv4w" width="10%">Rp. {{number_format($data['total_bayar'])}}</td>
              </tr>
              @endforeach
              <tr>
                  <td class="tg-rv4w" style="text-align: center;">&nbsp;</td>
                  <td class="tg-rv4w" style="text-align: center;">&nbsp;</td>
                  <td class="tg-rv4w" style="text-align: center;">&nbsp;</td>
                  <td class="tg-rv4w" style="text-align: center;">Total Keseluruhan</td>
                  <td class="tg-rv4w" style="text-align: center;">:</td>
                  <td class="tg-rv4w" style="text-align: center;">Rp. {{number_format($total_bayar)}}</td>
              </tr>
            </table>
        </body>
    </head>
</html>
