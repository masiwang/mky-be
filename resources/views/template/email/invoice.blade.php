<tbody>
    <tr>
        <td align="center" valign="top">
            <table border="0" cellpadding="0" cellspacing="0">
                <tbody>
                    <tr>
                        <td align="center" valign="top">
                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                <tbody>
                                    <tr>
                                        <td valign="top">
                                          <a href="https://makarya.in" target="_blank" data-saferedirecturl="https://www.google.com/url?q=https://makarya.in/">
                                            <h1>Makarya</h1>
                                          </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td align="center" valign="top">
                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                <tbody>
                                    <tr>
                                        <td valign="top">
                                            <p>Hi, {{ $user->name }},</p>
                                            <p>Terimakasih telah melakukan pendanaan pada produk {{$portofolio->product->name}}, berikut ini adalah rincian invoice portofolio anda.</p>
                                            <p>No. Invoice: {{$portofolio->invoice}}</p>
                                            <p>Produk: {{$portofolio->product->name}}<br>
                                                Harga: Rp {{ $portofolio->product->price }}/paket<br>
                                                Pembelian: {{ $portofolio->qty }} paket<br>
                                                Total harga: {{ $portofolio->qty * $portofolio->product->price }}<br>
                                                Estimasi ROI: {{ $portofolio->product->estimated_return }}
                                                Pendanaan selesai: {{ $portofolio->product->ended_at }}</p>
                                            <p>&nbsp;</p>
                                            <p>Apabila terdapat kesalahan pada email ini harap hubungi pihak Makarya,</p>
                                            <p>Jl. Shinta No. 22, Purwo Asri, RT 40B, RW 016, Kroyo, Karang Malang, Sragen, Indonesia</p>
                                            <p>HP/WA: (+62) 821 3000 4204</p>
                                            <p>Email: support@makarya.in</p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td align="center" valign="top">
                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                <tbody>
                                    <tr>
                                        <td valign="top">
                                            <a href="https://makarya.in" target="_blank" data-saferedirecturl="https://www.google.com/url?q=https://makarya.in">website makarya</a>
                                            <span> | </span>
                                            Copyright © Makarya, All rights reserved.
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </tbody>
            </table>
        </td>
    </tr>
</tbody>