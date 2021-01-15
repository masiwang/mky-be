<table>
  <tr>
    <td>No</td>
    <td>Nama</td>
    <td>Total</td>
    <td>Paket</td>
  </tr>
  @php
    $numbering = 0;
    $total_dana = 0;
    $total_paket = 0;
  @endphp
  @foreach($portofolios as $key => $portofolio)
    @php
      $numbering++;
      $total_dana = $total_dana + $portofolio->qty * $portofolio->product->price;
      $total_paket = $total_paket + $portofolio->qty;
    @endphp
    <tr>
      <td>{{ $numbering }}</td>
      <td>{{ $portofolio->user->name }}</td>
      <td>{{ $portofolio->qty * $portofolio->product->price }}</td>
      <td>{{ $portofolio->qty }}</td>
    </tr>
  @endforeach
  <tr>
    <td colspan="2">Total Dana</td>
    <td>{{ $total_dana }}</td>
    <td>{{ $total_paket }}</td>
  </tr>
</table>