<table style="width: 100%; margin: 0; padding: 0;border-collapse:collapse;">
    <tr>
        <td style="text-align:center">
            <img src="https://www.makarya.in/wp-content/uploads/2020/07/makarya-dark-160x48.png" alt="" srcset="">
        </td>
    </tr>
    <tr>
        <td style="text-align:center">
            #{{ $portofolio->invoice }}
        </td>
    </tr>
    <tr>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td>
            <table style="width:100%;border-collapse:collapse;">
                <tr>
                    <td style="text-align: left">
                        <span style="color: #6c757d!important">Pembayaran dari</span>
                    </td>
                    <td style="text-align: right">
                        <span style="color: #6c757d!important">Pembayaran ke</span>
                    </td>
                </tr>
                <tr>
                    <td style="text-align: left">
                        <h3 style="margin:0">{{ $user->name }}</h3>
                    </td>
                    <td style="text-align: right">
                        <h3 style="margin: 0">PT. Inspira Karya Teknologi Nusantara</h3>
                    </td>
                </tr>
                <tr>
                    <td style="text-align: left">
                        {{ $user->jalan }}
                    </td>
                    <td style="text-align: right">
                        Jl. Shinta No. 20, Purwo Asri, RT/RW 40B/016
                    </td>
                </tr>
                <tr>
                    <td style="text-align: left">
                        {{ $user->kelurahan }}, {{ $user->kecamatan }}
                    </td>
                    <td style="text-align: right">
                        Kroyo, Karang Malang
                    </td>
                </tr>
                <tr>
                    <td style="text-align: left">
                        {{ $user->kabupaten }} - {{ $user->kodepos }}
                    </td>
                    <td style="text-align: right">
                        Sragen - 67516
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td>
            <table style="width: 100%;border-collapse:collapse;">
                <tr>
                    <th style="border-bottom: 3px solid #000">
                        Nama produk
                    </th>
                    <th style="border-bottom: 3px solid #000">
                        Harga
                    </th>
                    <th style="border-bottom: 3px solid #000">
                        Qty
                    </th>
                    <th style="border-bottom: 3px solid #000">
                        Total
                    </th>
                </tr>
                <tr>
                    <td style="border-bottom: 1px solid #000">
                        <span style="color: #28a745!important">{{ $product->name }}</span>
                    </td>
                    <td style="border-bottom: 1px solid #000">
                        Rp.{{ $product->price }}
                    </td>
                    <td style="border-bottom: 1px solid #000">
                        {{ $portofolio->qty }}
                    </td>
                    <td style="border-bottom: 1px solid #000">
                        Rp.{{ (int)$product->price * (int)$portofolio->qty }}
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <strong>Total</strong>
                    </td>
                    <td>
                        <strong>Rp.{{ (int)$product->price * (int)$portofolio->qty }}</strong>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>