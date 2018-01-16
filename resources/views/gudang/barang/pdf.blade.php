<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Data Barang</title>
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
                <center><h2>Data Barang {{ $bulan.' - '.$tahun }}</h2></center>
            </div>
            <br>
            <table class="tg">
              <tr>
                <th class="tg-3wr7">No.<br></th>
                <th class="tg-3wr7">Nama Barang<br></th>
                <th class="tg-3wr7">Kategori<br></th>
                <th class="tg-3wr7">Distributor<br></th>
                <th class="tg-3wr7">Harga Beli<br></th>
                <th class="tg-3wr7">Harga Jual<br></th>
              </tr>
              <?php $no = 1; ?>
            @for ($i = 0; $i < count($barang); $i++)
              <tr>
                <td class="tg-rv4w" width="7%">{{ $no++ }}</td>
                <td class="tg-rv4w" width="30%">{{$barang[$i]['nama_barang'] }}</td>
                <td class="tg-rv4w" width="20%">{{$barang[$i]['kategori']['kategori'] }}</td>
                <td class="tg-rv4w" width="30%">{{$barang[$i]['distributor']['nama_distributor'] }}</td>
                <td class="tg-rv4w" width="5%">{{$barang[$i]['harga_beli'] }}</td>
                <td class="tg-rv4w" width="5%">{{$barang[$i]['harga_jual'] }}</td>
              </tr>
              @endfor
            </table>
        </body>
    </head>
</html>
