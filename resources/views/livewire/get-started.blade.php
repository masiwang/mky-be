<div>
    @livewire('client.component.navbar')
    <div class="container mb-5" style="margin-top: 6rem">
      <div class="row">
        <div class="col-xl-2 d-none d-xl-block">
          <p class="mb-1 fw-bolder">Lengkapi informasi</p>
          <ul class="list-group rounded-0 shadow-sm">
            <li class="list-group-item">Konfirmasi email {{ $level == 0 ? '👈' : ''}}</li>
            <li class="list-group-item">Informasi {{ $level == 1 ? '👈' : ''}}</li>
            <li class="list-group-item">Alamat {{ $level == 2 ? '👈' : ''}}</li>
            <li class="list-group-item">Dokumen {{ $level == 3 ? '👈' : ''}}</li>
            <li class="list-group-item">Persetujuan {{ $level == 4 ? '👈' : ''}}</li>
          </ul>
        </div>
        <div class="col-xl-10 col-12">
          @if($level == 0)
          <form wire:submit.prevent="emailConfirm" class="card rounded-0 border-0 shadow-sm">
            <div class="card-body">
              <div>
                <div class="mb-3">
                  <label for="exampleFormControlInput1" class="form-label">Token konfirmasi</label>
                  <input wire:model="email_token" type="text" name="token" class="form-control" id="exampleFormControlInput1" style="width: 10rem">
                </div>
              </div>
              @if(Session::has('error'))
              <p class="text-danger">{{ Session::get('error') }}</p>
              @endif
              <p class="mb-0 text-secondary">Token dikirim ke email Anda, jika belum menerima token konfirmasi, <a wire:click="resendToken" type="button">
                <span wire:loading.remove wire:target="resendToken">kirim ulang token.</span>  
                <span wire:loading wire:target="resendToken">Loading...</span>  
              </a></p>
              @if(Session::has('success'))
              <p class="text-success">{{ Session::get('success') }}</p>
              @endif
              
            </div>
            <div class="card-footer bg-white d-flex justify-content-end p-2">
              <button type="submit" class="btn btn-success">Simpan</button>
            </div>
          </form>
          @endif
          @if($level == 1)
          <form wire:submit.prevent="personalInfo" class="card rounded-0 border-0 shadow-sm">
            <div class="card-body">
              <div class="row">
                <div class="col-8 mb-3">
                  <label for="exampleFormControlInput1" class="form-label">Nama lengkap <span class="text-info" style="font-size: .7rem">[sesuai KTP]</span></label>
                  <input wire:model="name" type="text" name="name" class="form-control" id="exampleFormControlInput1">
                  @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="col-4 mb-3">
                  <label for="exampleFormControlInput1" class="form-label">Jenis kelamin</label>
                  <select wire:model="gender" class="form-select" aria-label="Default select example">
                    <option selected>Pilih...</option>
                    <option value="1">♂️ Laki-laki</option>
                    <option value="2">♀️ Perempuan</option>
                  </select>
                  @error('gender') <span class= "text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="col-4 mb-3">
                  <label for="exampleFormControlInput1" class="form-label">Tanggal lahir</label>
                  <div class="row">
                    <div class="col-xl-3 pr-0">
                      <select wire:model="birthday_date" class="form-select" aria-label="Default select example">
                        <option selected>Tgl...</option>
                        @for ($i = 1; $i <= 31; $i++)
                        <option value="{{$i}}">{{$i}}</option>
                        @endfor
                      </select>
                    </div>
                    <div class="col-xl-5 px-0">
                      <select wire:model="birthday_month" class="form-select" aria-label="Default select example">
                        <option selected>Bulan...</option>
                        @for ($i = 1; $i <= 12; $i++)
                        <option value="{{$i}}">{{date('F', strtotime('2020-'.$i.'-1'))}}</option>
                        @endfor
                      </select>
                    </div>
                    <div class="col-xl-4 pl-0">
                      <input wire:model="birthday_year" type="number" class="form-control" placeholder="Tahun"/>
                    </div>
                  </div>
                  @error('birthday_date') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="col-4 mb-3">
                  <label for="exampleFormControlInput1" class="form-label">Nomor HP</label>
                  <input wire:model="phone" type="phone" name="phone" class="form-control" id="exampleFormControlInput1">
                  @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="col-4 mb-3">
                  <label for="exampleFormControlInput1" class="form-label">Pekerjaan</label>
                  <input wire:model="job" type="text" name="job" class="form-control" id="exampleFormControlInput1">
                  @error('job') <span class="error">{{ $message }}</span> @enderror
                </div>
              </div>
            </div>
            <div class="card-footer bg-white d-flex justify-content-end p-2">
              <button type="submit" class="btn btn-success">Simpan</button>
            </div>
          </form>
          @endif
          @if($level == 2)
          <form wire:submit.prevent="userAddress" class="card rounded-0 border-0 shadow-sm">
            <div class="card-body">
              <div class="row">
                <div class="col-5 mb-3">
                  <label for="exampleFormControlInput1" class="form-label">Jalan</label>
                  <input wire:model="jalan" type="text" name="jalan" class="form-control" id="exampleFormControlInput1">
                </div>
                <div class="col-3 mb-3">
                  <label for="exampleFormControlInput1" class="form-label">Kodepos</label>
                  <input wire:model="kodepos" type="text" name="postal_code" class="form-control" id="exampleFormControlInput1">
                  
                </div>
                <div class="col-4 mb-3">
                  <label for="exampleFormControlInput1" class="form-label">Kelurahan</label>
                  <input wire:model="kelurahan" list="kelurahanList" type="text" name="subdistrict" class="form-control" id="exampleFormControlInput1">
                  <datalist id="kelurahanList">
                    @if($kelurahanList)
                    @foreach($kelurahanList as $kelurahan)
                    <option value="{{ $kelurahan->kelurahan }}">
                    @endforeach
                    @endif
                  </datalist>
                </div>
                <div class="col-4 mb-3">
                  <label for="exampleFormControlInput1" class="form-label">Kecamatan</label>
                  <input wire:model="kecamatan" type="text" name="district" class="form-control" id="exampleFormControlInput1">
                </div>
                <div class="col-4 mb-3">
                  <label for="exampleFormControlInput1" class="form-label">Kabupaten</label>
                  <input wire:model="kabupaten" type="text" name="city" class="form-control" id="exampleFormControlInput1">
                </div>
                <div class="col-4 mb-3">
                  <label for="exampleFormControlInput1" class="form-label">Provinsi</label>
                  <input wire:model="provinsi" type="text" name="province" class="form-control" id="exampleFormControlInput1">
                </div>
              </div>
            </div>
            <div class="card-footer bg-white d-flex justify-content-end p-2">
              <button type="submit" class="btn btn-success">Simpan</button>
            </div>
          </form>
          @endif
          @if($level == 3)
          <form wire:submit.prevent="userDocument" class="card rounded-0 border-0 shadow-sm">
            <div class="card-body">
              <div class="row">
                <div class="col-xl-4 col-12 mb-3">
                  <label for="exampleFormControlInput1" class="form-label">Foto KTP</label>
                  <input wire:model="ktp_image" type="file" class="form-control" accept="image/x-png,image/gif,image/jpeg">
                  @error('ktp_image')
                    <small class="text-danger">File terlalu besar. </small>
                  @enderror
                  <small class="text-primary">Maksimum 2MB</small>
                </div>
                <div class="col-xl-8 col-12 mb-3">
                  <label for="exampleFormControlInput1" class="form-label">Nomor KTP</label>
                  <input wire:model="ktp" type="text" name="ktp" class="form-control" >
                  @error('ktp')
                    <small class="text-danger">Nomor KTP harus angka</small>
                  @enderror
                </div>
                <div class="col-xl-4 col-12 mb-3">
                  <label for="exampleFormControlInput1" class="form-label">Foto NPWP <small class="text-primary">[Tidak wajib]</small></label>
                  <input wire:model="npwp_image" type="file" class="form-control" accept="image/x-png,image/gif,image/jpeg">
                  @error('npwp_image')
                    <small class="text-danger">File terlalu besar. </small>
                  @enderror
                  <small class="text-primary">Maksimum 2MB</small>
                </div>
                <div class="col-xl-8 col-12 mb-3">
                  <label for="exampleFormControlInput1" class="form-label">Nomor NPWP <small class="text-primary">[Tidak wajib]</small></label>
                  <input wire:model="npwp" type="text" name="npwp" class="form-control">
                </div>
                <div class="col-4 mb-3">
                  <label for="exampleFormControlInput1" class="form-label">Nama Bank</label>
                  <input wire:model="bank_type" type="text" name="bank" class="form-control">
                  @error('bank_type')
                    <small class="text-danger">Nama bank salah</small>
                  @enderror
                </div>
                <div class="col-8 mb-3">
                  <label for="exampleFormControlInput1" class="form-label">Nomor Rekening</label>
                  <input wire:model="bank_acc" type="text" name="rekening" class="form-control">
                  @error('bank_acc')
                    <small class="text-danger">Nomor rekening harus angka</small>
                  @enderror
                </div>
              </div>
            </div>
            <div class="card-footer bg-white d-flex justify-content-end p-2">
              <button type="submit" class="btn btn-success">
                <span wire:loading.remove wire:target="ktp_image, npwp_image">Simpan</span>
                <span wire:loading wire:target="ktp_image, npwp_image">Sedang upload..</span>
              </button>
            </div>
          </form>
          @endif
          @if($level == 4)
          <form wire:submit.prevent="agreement" class="card rounded-0 border-0 shadow-sm">
              <div class="card-body">
                  <div class="mb-3 p-3"
                      style="height: 400px; background-color: #e8f5e9; overflow-y: scroll; font-size: .8rem">
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
                                              Mendapatkan bagi hasil atas pengelolaan dana investasi, sesuai dengan
                                              pembagian keuntungan yang disepakati
                                          </li>
                                          <li>
                                              Menerima bukti-bukti telah melakukan investasi, Mendapatkan laporan secara
                                              berkala tentang perkembangan proyek yang diberikan pendanaan minimal 1
                                              bulan sekali
                                          </li>
                                      </ol>
                                  </li>
                                  <li>
                                      <p class="mb-0">Kewajiban</p>
                                      <ol style="list-style-type: lower-roman">
                                          <li>
                                              Di dalam pembelian Pendanaan di bidang Pertanian, Peternakan dan
                                              Perikanan, Pemodal wajib untuk memiliki dan menjaga kemampuan untuk
                                              membeli paket, serta memiliki kemampuan analisis risiko terhadap paket
                                          </li>
                                          <li>
                                              Pemodal wajib untuk memberikan dokumen dan/atau informasi yang sah / valid
                                              dan dapat dipertanggungjawabkan atas diri Pemodal, termasuk Pemodal maupun
                                              wakilnya telah mempunyai kapasitas hukum dan/atau ijin yang diperlukan
                                              dari lembaga pemerintah yang berwenang
                                          </li>
                                          <li>
                                              Menjamin dan bersedia untuk diverifikasi oleh Penyelenggara guna
                                              memastikan dana milik Pemodal yang digunakan dalam investasi di Project
                                              Funding adalah memang benar dana milik Pemodal dan bukan diperoleh dari
                                              tindakan yang melanggar peraturan perundang-undangan, termasuk di antara
                                              lain korupsi, penggelapan, pencurian, ataupun pencucian uang ataupun
                                              Pendanaan di bidang Pertanian, Peternakan dan Perikanan dari dan/atau
                                              untuk tindakan terorisme
                                          </li>
                                          <li>
                                              Pemodal memahami semua risiko investasi yang dapat terjadi pada proyek
                                              yang diinvestasikan
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
                                      Makarya akan memberikan hasil keuntungan paling lambat dalam waktu 3 hari kerja
                                      setelah periode proyek investasi selesai
                                  </li>
                              </ol>
                          </li>
                          <li>
                              <strong>Resiko Investasi</strong>
                              <ol style="list-style-type: lower-latin">
                                  <li>
                                      Investasi di bidang pertanian, peternakan, dan perikanan termasuk dalam salah satu
                                      investasi riil dimana bisa mendapatkan keuntungan jika budidaya atau jual beli
                                      sesuai dengan yang diperhitungkan
                                  </li>
                                  <li>
                                      Untuk meningkatkan keberhasilan proyek, Makarya memberikan analisis risiko sesuai
                                      yang ada pada prospektus
                                  </li>
                                  <li>
                                      Pemodal, penyelenggara, dan pelaku usaha akan menanggung risiko investasi yang
                                      terjadi apabila terjadi <em>Force Majeure</em>, dalam jangka waktu 3 hari semua
                                      pihak bertemu dan membicarakan pemecahannya secara musyawarah untuk mencapai
                                      mufakat
                                  </li>
                              </ol>
                          </li>
                      </ol>
                  </div>
                  <div class="form-check">
                    <input wire:model="agree" class="form-check-input" type="checkbox" >
                    <label class="form-check-label" for="flexCheckDefault">
                      Saya telah membaca dan menyetujui Syarat dan Ketentuan Makarya
                    </label>
                    @if(Session::has('error'))
                    <br/><small class="text-danger">{{ Session::get('error') }}</small>
                    @endif
                  </div>
              </div>
              <div class="card-footer bg-white d-flex justify-content-end p-2">
                  <button type="submit" class="btn btn-success">Simpan</button>
              </div>
          </form>
          @endif
        </div>
      </div>
    </div>
    <div wire:loading>
    @php
      $gifs = [
        'https://media.giphy.com/media/kyzzHEoaLAAr9nX4fy/giphy.gif',
        'https://media.giphy.com/media/UsLzFcO1wZCgnAFFvi/giphy.gif',
        'https://media.giphy.com/media/UVqhzNsYWIelUBV7zN/giphy.gif',
        'https://media.giphy.com/media/LPkczVwUYcMbXsRCdP/giphy.gif',
        'https://media.giphy.com/media/UsLzFcO1wZCgnAFFvi/giphy.gif',
        'https://media.giphy.com/media/cNqBzFAC3aU2gDuD4k/giphy.gif',
        'https://media.giphy.com/media/IbaaxVxgaZAZx9ddJ4/giphy.gif'
      ];
      $gif = $gifs[rand(0, 6)];
    @endphp
    <div class="d-flex flex-column justify-content-center align-items-center" style="position:fixed; top: 0; left: 0; height: 100vh; width: 100vw; background-color: #333333bb">
      <img src="{{ $gif }}" alt="" style="height: 6rem">
      <p class="text-white">Sebentar, jangan lupa pakai masker ya...</p>
    </div>
  </div>
    @livewire('client.component.footer')
</div>
