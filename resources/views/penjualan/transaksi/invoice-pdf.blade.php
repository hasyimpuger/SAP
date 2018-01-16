<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Sistem Akuntansi Pertokoan</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  {{-- <link rel="stylesheet" type="text/css" href="{{ asset('bower_components/bootstrap/dist/css/bootstrap.css') }}"> --}}
  <style type="text/css">
  @page { 
    size: 230pt 2000pt; 
    margin: -10mm 7mm 10mm 7mm;
  }
    body {
            background: #fff;
            background-image: none;
            font-size: 18px;
            margin: 0px;
        }
        img{
          display: block;
          margin:0 40px;
        }
        table th {
            font-size: 9px;
            text-align: left;
        }
        table td{
            font-size: 10px;
        }
  }
  </style>
<body>
  <div style="margin: 0 auto">
        {{-- <img src="photo/toko/{{$toko['photo']}}" width="50" height="50"> --}}
        <br>
        <h4 style="text-align: center">
            {{ $toko['nama_toko'] }}
            </h4>
        <div style="text-align: left;font-size: 10px">
            {{$toko['deskripsi']}}<br>
            {{ $toko['alamat'] }} <br>
            Telp : {{ $toko['telp'] }} <br>
            Email: {{ $toko['email'] }} <br>
          </div>
      <hr>
    <span style="font-size: 12px">ID Transaksi : {{ $invoice_id }}</span><br>
    @if($nama_pelanggan)
      <span style="font-size: 12px">Nama Pelanggan : {{ $nama_pelanggan }}</span><br>
    @endif
    <span style="font-size: 12px">Tgl. Transaksi : {{ date('d-m-Y', strtotime($tgl_transaksi)) }}</span>
    <table style="margin-top: 5px">
            <tr style="font-size: 14px">
              <td>Barang</td>
              <td>Harga</td>
              <td>Qty</td>
              <td>Total</td>
            </tr>
            <?php $no = 1;?>
            @foreach($transaksi as $data)
              <tr>
                <td>{{ $data['barang']['nama_barang'] }}</td>
                <td>{{ ($nama_pelanggan ? number_format($data['barang']['harga_reseller']) : number_format($data['barang']['harga_jual'])) }}</td>
                <td>{{ $data['qty'] }}</td>
                <td>{{ ($nama_pelanggan ? number_format($data['qty'] * $data['barang']['harga_reseller']) : number_format($data['qty'] * $data['barang']['harga_jual'])) }}</td>
              </tr>
              @endforeach
          </table>
  <hr>
      <table>
              <tr>
                <td>Total:</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td align="right">Rp. {{ number_format($sub_total) }}</td>
              </tr>
              <tr>
                <td>Bayar :</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td align="right">Rp. {{ number_format($jumlah_bayar) }}</td>
              </tr>
              <tr>
                <td>Kembalian :</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td align="right">Rp. {{ number_format($kembalian) }}</td>
              </tr>
            </table>
        <hr>
              <div style="text-align: center;" class="page-break">
                <b style="font-size: 10px;">Terima Kasih atas kunjungan anda</b><br>  
                <p style="font-size: 8px">barang yang sudah dibeli tidak bisa di kembalikan.</p>
              </div>
    <div>
</body>
</html>