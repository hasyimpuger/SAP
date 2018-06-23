<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Data Pemasukan</title>
        <body>
            <table>
              <tr>
                <th>&nbsp;</th>
                <th colspan="1">Data Pemasukan {{ date('F-Y', strtotime($bulan . $tahun)) }}</th>
                <th>&nbsp;</th>
              </tr>
              <tr>
                <th>No.<br></th>
                <th>Kode Invoice/Nota<br></th>
                <th>Tanggal Pemasukan<br></th>
                <th>Keterangan<br></th>
                <th>Jumlah Uang<br></th>
              </tr>
              <?php $no = 1; ?>
           @for($i=0;$i < count($invoice_id);$i++)
                      <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{$invoice_id[$i]['invoice_id']}}</td>
                        <td>{{ date('d-m-Y', strtotime($invoice_id[$i]['tgl_pemasukan'])) }}</td>
                        <td>
                          Dari penjualan
                          @foreach($pemasukan as $data)
                            @if($data['invoice_id'] == $invoice_id[$i]['invoice_id'])
                            {{ $data['keterangan'] }},
                            @endif
                          @endforeach
                        </td>
                        <td>Rp. {{ number_format($invoice_id[$i]['jumlah_uang']) }}</td>
                      </tr>
                @endfor
              <tfoot>
                <tr>
                  <th>&nbsp;</th>
                  <th>&nbsp;</th>
                  <th>&nbsp;</th>
                  <th style="text-align: left;">Total Pemasukan</th>
                  <th style="text-align: left;">Rp. {{number_format($total)}}</th>
                </tr>
              </tfoot>
            </table>
        </body>
    </head>
</html>
