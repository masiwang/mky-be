<table style="width: 100%">
  <tr>
    <td><p>Hi {{ $user->name }}</p></td>
  </tr>
  <tr><td>&nbsp;</td></tr>
  <tr><td>Anda telah melakukan permintaan reset password akun Makarya Anda. Kami harap permintaan reset password tersebut benar dari Anda. Untuk itu kami kirimkan token reset password Anda sebagai berikut.</td></tr>
  <tr><td>&nbsp;</td></tr>
  <tr><td><strong>{{ $user->remember_token }}</strong></td></tr>
  <tr><td>&nbsp;</td></tr>
  <tr><td><p>Apabila Anda tidak melakukan permintaan reset password. Harap segera menghubungi pihak Makarya di WhatsApp +62-82130004204 atau Email support@makarya.in.</p></td></tr>
  <tr><td>&nbsp;</td></tr>
  <tr><td><p>Salam,</p></td></tr>
  <tr><td><p>❤️</p></td></tr>
  <tr><td><p>Tim Makarya</p></td></tr>
</table>