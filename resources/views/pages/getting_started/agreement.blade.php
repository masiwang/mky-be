@extends('pages.getting_started.components.__layout')
@section('title')
  Lengkapi pendaftaran
@endsection
@section('getting_started_content')
<div class="mb-3 p-3" style="height: 400px; background-color: #e8f5e9; overflow-y: scroll; font-size: .8rem">
  <p class="text-center">
      <strong>SYARAT DAN KETENTUAN INVESTASI</strong>
  </p>
  <ol style="list-style-type: decimal">
      <li>
          <b>Hak dan Kewajiban Pemodal</b>
          <ol style="list-style-type: lower-latin">
              <li>
                  <p class="mb-0">Hak</p>
                  <ol style="list-style-type: lower-roman">
                      <li>
                          Mendapatkan daftar perencanaan proyek investasi dari Makarya
                      </li>
                      <li>
                          Mendapatkan bagi hasil atas pengelolaan dana investasi, sesuai dengan pembagian keuntungan yang disepakati
                      </li>
                      <li>
                          Menerima bukti-bukti telah melakukan investasi, Mendapatkan laporan secara berkala tentang perkembangan proyek yang diberikan pendanaan minimal 1 bulan sekali
                      </li>
                  </ol>
              </li>
              <li>
                  <p class="mb-0">Kewajiban</p>
                  <ol style="list-style-type: lower-roman">
                      <li>
                          Di dalam pembelian Pendanaan di bidang Pertanian, Peternakan dan Perikanan, Pemodal wajib untuk memiliki dan menjaga kemampuan untuk membeli paket, serta memiliki kemampuan analisis risiko terhadap paket
                      </li>
                      <li>
                          Pemodal wajib untuk memberikan dokumen dan/atau informasi yang sah / valid dan dapat dipertanggungjawabkan atas diri Pemodal, termasuk Pemodal maupun wakilnya telah mempunyai kapasitas hukum dan/atau ijin yang diperlukan dari lembaga pemerintah yang berwenang
                      </li>
                      <li>
                          Menjamin dan bersedia untuk diverifikasi oleh Penyelenggara guna memastikan dana milik Pemodal yang digunakan dalam investasi di Project Funding adalah memang benar dana milik Pemodal dan bukan diperoleh dari tindakan yang melanggar peraturan perundang-undangan, termasuk di antara lain korupsi, penggelapan, pencurian, ataupun pencucian uang ataupun Pendanaan di bidang Pertanian, Peternakan dan Perikanan  dari dan/atau untuk tindakan terorisme
                      </li>
                      <li>
                          Pemodal memahami semua risiko investasi yang dapat terjadi pada proyek yang diinvestasikan
                      </li>
                  </ol>
              </li>
          </ol>
      </li>
      <li>
          <strong>Pembagian Keuntungan</strong>
          <ol style="list-style-type: lower-latin">
              <li>
                  Pembagian keuntungan dilakukan setiap project selesai sesuai dengan prospektus
              </li>
              <li>
                  Nilai pembagian bagi hasil sesuai range ROI yang ditawarkan
              </li>
              <li>
                  Makarya akan memberikan hasil keuntungan paling lambat dalam waktu 3 hari kerja setelah periode proyek investasi selesai
              </li>
          </ol>
      </li>
      <li>
          <strong>Resiko Investasi</strong>
          <ol style="list-style-type: lower-latin">
              <li>
                  Investasi di bidang pertanian, peternakan, dan perikanan termasuk dalam salah satu investasi riil dimana bisa mendapatkan keuntungan jika budidaya atau jual beli sesuai dengan yang diperhitungkan
              </li>
              <li>
                  Untuk meningkatkan keberhasilan proyek, Makarya memberikan analisis risiko sesuai yang ada pada prospektus
              </li>
              <li>
                  Pemodal, penyelenggara, dan pelaku usaha akan menanggung risiko investasi yang terjadi apabila terjadi <em>Force Majeure</em>, dalam jangka waktu 3 hari semua pihak bertemu dan membicarakan pemecahannya secara musyawarah untuk mencapai mufakat
              </li>
          </ol>
      </li>
  </ol>
</div>
<div class="mb-3">
  <div class="form-check">
      <input class="form-check-input" type="checkbox" name="agree">
      <label class="form-check-label" for="flexCheckDefault">
        Saya telah membaca dan menyetujui Syarat dan Ketentuan Makarya.
      </label><br/>
      @if (\Session::has('agree'))
        <span class="text-danger">
          {{\Session::get('agree')}}
        </span>
      @endif
  </div>
</div>
<div class="mb-3">
  <label for="ttd" class="form-label">Unggah Tanda Tangan</label>
  <input type="file" class="form-control" id="ttd" name="image">
  @if (\Session::has('ttd'))
        <span class="text-danger">
          {{\Session::get('ttd')}}
        </span>
      @endif
</div>
@endsection