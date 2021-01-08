<table>
  <tr>
    <td>Hi, {{ $user_name }} 👋.</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>
      Terimakasih telah melakukan pendanaan pada Project Funding {{ $product_name }} oleh {{ $vendor_name }}. Pendanaan tersebut telah selesai. Return telah dikirim ke Akun Anda dengan kode transaksi {{$transaction_code}}. Berikut ini adalah detail transaksi <em>return</em> pendanaan,
    </td>
  </tr>
  <tr>
    <td>
      <table style="border: 1px solid black;border-collapse: collapse;width: 100%;">
        <tr>
          <td style="border: 1px solid black;width: 30%;">Kode Pendanaan</td>
          <td style="border: 1px solid black;width: 70%;">{{$invoice_code}}</td>
        </tr>
        <tr>
          <td style="border: 1px solid black">Produk pendanaan</td>
          <td style="border: 1px solid black">{{$product_name}}</td>
        </tr>
        <tr>
          <td style="border: 1px solid black">Total Pendanaan</td>
          <td style="border: 1px solid black">Rp {{number_format($qty*$price, 0, ',', '.')}},-</td>
        </tr>
        <tr>
          <td style="border: 1px solid black">ROI (%)</td>
          <td style="border: 1px solid black">{{$actual_return}}%</td>
        </tr>
        <tr>
          <td style="border: 1px solid black">ROI (Rp.)</td>
          <td style="border: 1px solid black">Rp {{number_format($qty * $price * ($actual_return/100), 2)}}</td>
        </tr>
        <tr>
          <td style="border: 1px solid black">Total ditransfer</td>
          <td style="border: 1px solid black">Rp {{number_format($qty * $price * (1+$actual_return/100), 2)}}</td>
        </tr>
      </table>
    </td>
  </tr>
  <tr><td>&nbsp;</td></tr>
  <tr><td>Nantikan produk-produk pendanaan selanjutnya ya!</td></tr>
  <tr><td>&nbsp;</td></tr>
  <tr>
    <td>Apabila terdapat kesalahan atau pertanyaan terkait notifikasi ini, harap hubungi Support Makarya melalui WA (+62) 821 3000 4204 atau melalui Email support@makarya.in</td>
  </tr>
  <tr><td>&nbsp;</td></tr>
  <tr><td>&nbsp;</td></tr>
  <tr><td>Salam 💚,</td></tr>
  <tr><td>&nbsp;</td></tr>
  <tr><td>Tim Makarya</td></tr>
</table>