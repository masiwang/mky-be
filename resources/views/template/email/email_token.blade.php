<table style="width: 100%">
  <tr>
    <td><p>Hi {{ $user->name }}</p></td>
  </tr>
  <tr><td>&nbsp;</td></tr>
  <tr><td>Terimakasih telah melakukan registrasi akun di Makarya. Berikut ini adalah token konfirmasi akun Anda.</td></tr>
  <tr><td>&nbsp;</td></tr>
  <tr><td><strong>{{ $user->email_token }}</strong></td></tr>
  <tr><td>&nbsp;</td></tr>
  <tr><td><p>Apabila Anda terdapat pertanyaan mengenai email ini. Harap segera menghubungi pihak Makarya di WhatsApp +62-82130004204 atau Email support@makarya.in.</p></td></tr>
  <tr><td>&nbsp;</td></tr>
  <tr><td><p>Salam 💚,</p></td></tr>
  <tr><td><p>Tim Makarya</p></td></tr>
</table>