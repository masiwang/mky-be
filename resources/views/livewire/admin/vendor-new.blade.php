<div class="mb-10">
  <div class="w-full fixed mt-10 flex flex-row h-10 bg-gray-100">
    <button class="w-24 h-full rounded-none bg-green-400 text-white">&equals; Menu</button>
    <a href="/vendor" class="w-24 h-full flex justify-center items-center">List</a>
    <a href="#" class="w-24 h-full flex justify-center items-center">Detail</a>
    <a href="/vendor-new" class="w-24 h-full flex justify-center items-center border-b-2 border-green-400">Tambah</a>
  </div>
  <form wire:submit.prevent="save" class="container mx-auto" style="padding-top: 7rem;">
    <div class="w-full grid grid-cols-12">
      <div class="col-span-2 p-2 flex flex-col">
        <div class="w-full mb-2">
          @if ($profileURL)
          <img src="{{ $profileURL }}" alt="">
          @else
          <div class="{{ $profileURL ? 'hidden' : '' }} w-full h-40 bg-gray-500"></div>
          @endif
        </div>
        <div class="w-full">
          <a href="#" wire:click="openDialog('profile')" class="mb-5 py-1 px-3 bg-green-500 text-white flex justify-center items-center">Tambah foto</a>
          <button type="submit" href="#" class="w-full mb-1 py-1 px-3 bg-green-500 text-white flex justify-center items-center">Simpan perubahan</button>
          <a href="#" class="mb-2 py-1 px-3 bg-red-500 text-white flex justify-center items-center">Batal</a>
        </div>
      </div>
      <div class="col-span-10 p-4">
        <table class="w-full table-fixed">
          <tr>
            <td class="w-40 pb-2 font-semibold">Nama perusahaan</td>
            <td><input wire:model="name" type="text" name="name" class="w-full p-2 mb-2 bg-gray-200" value=""></td>
          </tr>
          <tr>
            <td class="w-40 pb-2 font-semibold">Nama Pemilik</td>
            <td><input wire:model="owner" type="text" name="owner" class="w-full p-2 mb-2 bg-gray-200" value=""></td>
          </tr>
          <tr>
            <td class="w-40 pb-2 font-semibold">KTP</td>
            <td class="w-40 pb-2 font-semibold">
              <div class="flex flex-row">
                <button type="button" wire:click="openDialog('ktp')" class="bg-gray-200 px-3 mb-2 mr-2">{{ $ktpImage ? '✅' : 'Unggah'}} Foto KTP</button>
                <input wire:model="ktp" name="ktp" type="text" class="flex-grow p-2 mb-2 bg-gray-200" placeholder="ID KTP">
              </div>
            </td>
          </tr>
          <tr>
            <td class="w-40 pb-2 font-semibold">Kartu Keluarga</td>
            <td class="w-40 pb-2 font-semibold">
              <div class="flex flex-row">
                <button type="button" wire:click="openDialog('kk')" class="bg-gray-200 px-3 mb-2 mr-2">{{ $kkImage ? '✅' : 'Unggah'}} Foto KK</button>
                <input wire:model="kk" type="text" name="kk" class="flex-grow p-2 mb-2 bg-gray-200" placeholder="ID KK">
              </div>
            </td>
          </tr>
          <tr>
            <td class="w-40 pb-2 font-semibold">NPWP</td>
            <td class="w-40 pb-2 font-semibold">
              <div class="flex flex-row">
                <button type="button" wire:click="openDialog('npwp')" class="bg-gray-200 px-3 mb-2 mr-2">{{ $npwpImage ? '✅' : 'Unggah'}} Foto NPWP</button>
                <input wire:model="npwp" type="text" name="npwp" class="flex-grow p-2 mb-2 bg-gray-200" placeholder="ID NPWP">
              </div>
            </td>
          </tr>
          <tr>
            <td class="w-40 pb-2 font-semibold">Email</td>
            <td><input wire:model="email" type="text" name="email" class="w-full p-2 mb-2 bg-gray-200"></td>
          </tr>
          <tr>
            <td class="w-40 pb-2 font-semibold">No. HP</td>
            <td><input wire:model="phone" type="text" name="phone" class="w-full p-2 mb-2 bg-gray-200" value=""></td>
          </tr>
          <tr>
            <td class="w-40 pb-2 font-semibold">Rekening</td>
            <td class="w-full grid grid-cols-5 gap-4">
              <input wire:model="bank_type" list="datalistOptions"  type="text" name="bank_type" class="col-span-1 p-2 mb-2 bg-gray-200" placeholder="Nama Bank">
              <datalist id="datalistOptions">
                @foreach ($banks as $bank)
                <option value="{{ $bank->name }}">    
                @endforeach
              </datalist>
              <input wire:model="bank_acc" type="text" name="bank_acc" class="col-span-4 p-2 mb-2 bg-gray-200" placeholder="No. Rekening">
            </td>
          </tr>
          <tr>
            <td class="w-40 pb-2 font-semibold">Alamat</td>
            <td>
              <div class="flex flex-row">
                <input wire:model="jalan" type="text" name="jalan" class="w-2/5 p-2 bg-gray-200 mr-2" placeholder="Jalan">
                <input wire:model="kodepos" type="text" name="kodepos" class="w-1/4 p-2 bg-gray-200 mr-2" placeholder="Kodepos">
                <input wire:model="provinsi" type="text" name="provinsi" class="w-1/4 p-2 bg-gray-200 mr-2" placeholder="Provinsi">
                <input wire:model="kabupaten" type="text" name="kabupaten" class="w-1/4 p-2 bg-gray-200 mr-2" placeholder="Kabupaten">
                <input wire:model="kecamatan" type="text" name="kecamatan" class="w-1/4 p-2 bg-gray-200 mr-2" placeholder="Kecamatan">
                <select wire:model="kelurahan" class="w-1/4 p-2 bg-gray-200 mr-2" >
                  <option selected>Pilih...</option>
                  @if(count($kelurahans) > 0)
                  @foreach ($kelurahans as $kelurahan)
                  <option value="{{ $kelurahan->kelurahan }}">{{$kelurahan->kelurahan}}</option>
                  @endforeach
                  @endif  
                </select>
              </div>
            </td>
          </tr>
        </table>
      </div>
    </div>
  </form>
  @if($ktpDialog)
  <div class="fixed left-0 top-0 h-screen w-screen flex justify-center items-center rounded-md" style="background-color: #48bb7888">
    <form wire:submit.prevent="saveKTP" class="w-1/3 bg-white p-4 shadow-md">
      <h1 class="font-bold">Unggah KTP</h1>
      <hr class="my-3">
      <div class="flex flex-col">
        <div class="flex flex-col">
          <span class="mb-2">Pilih KTP</span>
          <input type="file" wire:model="ktpImage">
        </div>
      </div>
      <hr class="my-3">
      <div class="flex justify-end">
        <button type="button" wire:click="closeDialog('profile')" class="w-24 bg-gray-200 text-green-500 mr-2 p-1">Tutup</button>
        <button disabled wire:loading wire:target="ktpImage" type="submit" class="w-24 bg-green-500 text-white p-1 mr-2">Loading...</button>
        <button wire:loading.remove wire:target="ktpImage" type="submit" class="w-24 bg-green-500 text-white p-1 mr-2">Unggah</button>
      </div>
    </form>
  </div>
  @endif
  @if($kkDialog)
  <div class="fixed left-0 top-0 h-screen w-screen flex justify-center items-center rounded-md" style="background-color: #48bb7888">
    <form wire:submit.prevent="saveKK" class="w-1/3 bg-white p-4 shadow-md">
      <h1 class="font-bold">Unggah KK</h1>
      <hr class="my-3">
      <div class="flex flex-col">
        <div class="flex flex-col">
          <span class="mb-2">Pilih KK</span>
          <input type="file" wire:model="kkImage">
        </div>
      </div>
      <hr class="my-3">
      <div class="flex justify-end">
        <button type="button" wire:click="closeDialog('profile')" class="w-24 bg-gray-200 text-green-500 mr-2 p-1">Tutup</button>
        <button disabled wire:loading wire:target="kkImage" type="submit" class="w-24 bg-green-500 text-white p-1 mr-2">Loading...</button>
        <button wire:loading.remove wire:target="kkImage" type="submit" class="w-24 bg-green-500 text-white p-1 mr-2">Unggah</button>
      </div>
    </form>
  </div>
  @endif
  @if($npwpDialog)
  <div class="fixed left-0 top-0 h-screen w-screen flex justify-center items-center rounded-md" style="background-color: #48bb7888">
    <form wire:submit.prevent="saveNPWP" class="w-1/3 bg-white p-4 shadow-md">
      <h1 class="font-bold">Unggah NPWP</h1>
      <hr class="my-3">
      <div class="flex flex-col">
        <div class="flex flex-col">
          <span class="mb-2">Pilih NPWP</span>
          <input type="file" wire:model="npwpImage">
        </div>
      </div>
      <hr class="my-3">
      <div class="flex justify-end">
        <button type="button" wire:click="closeDialog('profile')" class="w-24 bg-gray-200 text-green-500 mr-2 p-1">Tutup</button>
        <button disabled wire:loading wire:target="npwpImage" type="submit" class="w-24 bg-green-500 text-white p-1 mr-2">Loading...</button>
        <button wire:loading.remove wire:target="npwpImage" type="submit" class="w-24 bg-green-500 text-white p-1 mr-2">Unggah</button>
      </div>
    </form>
  </div>
  @endif
  @if($profileDialog)
  <div class="fixed left-0 top-0 h-screen w-screen flex justify-center items-center rounded-md" style="background-color: #48bb7888">
    <form wire:submit.prevent="saveProfile" class="w-1/3 bg-white p-4 shadow-md">
      <h1 class="font-bold">Unggah Foto Profile</h1>
      <hr class="my-3">
      <div class="flex flex-col">
        <div class="flex flex-col">
          <span class="mb-2">Pilih Foto Profile</span>
          <input type="file" wire:model="profileImage">
        </div>
      </div>
      <hr class="my-3">
      <div class="flex justify-end">
        <button type="button" wire:click="closeDialog('profile')" class="w-24 bg-gray-200 text-green-500 mr-2 p-1">Tutup</button>
        <button disabled wire:loading wire:target="profileImage" type="submit" class="w-24 bg-green-500 text-white p-1 mr-2">Loading...</button>
        <button wire:loading.remove wire:target="profileImage" type="submit" class="w-24 bg-green-500 text-white p-1 mr-2">Unggah</button>
      </div>
    </form>
  </div>
  @endif
</div>
