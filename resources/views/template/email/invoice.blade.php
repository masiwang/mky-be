<table>
  <tr>
    <td>Hi, {{ $user_name }} 👋</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>
      Terima kasih kami ucapkan kepada Anda, dengan ini anda secara resmi berpartisipasi dalam Project Funding {{ $product_name }} oleh {{ $vendor_name }}. Berikut ini adalah <em>invoice</em> pendanaan anda,
    </td>
  </tr>
  <tr>
    <td>
      <table style="border: 1px solid black;border-collapse: collapse;width: 100%;">
        <tr>
          <td style="border: 1px solid black;width: 30%;">Invoice No.</td>
          <td style="border: 1px solid black;width: 70%;">{{$invoice_code}}</td>
        </tr>
        <tr>
          <td style="border: 1px solid black">Produk pendanaan</td>
          <td style="border: 1px solid black">{{$product_name}}</td>
        </tr>
        <tr>
          <td style="border: 1px solid black">Jml. Pembiayaan</td>
          <td style="border: 1px solid black">{{$qty}} paket</td>
        </tr>
        <tr>
          <td style="border: 1px solid black">Harga paket</td>
          <td style="border: 1px solid black">Rp {{number_format($price, 0, ',', '.')}}/paket</td>
        </tr>
        <tr>
          <td style="border: 1px solid black">Total Pembiayaan</td>
          <td style="border: 1px solid black">Rp {{number_format($qty*$price, 0, ',', '.')}},-</td>
        </tr>
        <tr>
          <td style="border: 1px solid black">Estimasi ROI</td>
          <td style="border: 1px solid black">{{$estimated_return}}%</td>
        </tr>
        <tr>
          <td style="border: 1px solid black">Waktu Pembiayaan</td>
          <td style="border: 1px solid black">{{$created_at}}</td>
        </tr>
        <tr>
          <td style="border: 1px solid black">Est. Waktu Selesai</td>
          <td style="border: 1px solid black">{{$ended_at}}</td>
        </tr>
      </table>
    </td>
  </tr>
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