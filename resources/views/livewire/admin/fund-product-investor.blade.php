<div class="container" style="margin-top: 6rem">
  <div class="row">
    <div class="col-2">
      @if ($product->image)
      <img src="{{ $product->image }}" class="mb-3" style="max-width: 100%">
      @else
      <div class="bg-gray" style="height: 4rem; width: 100%">&nbsp;</div>
      @endif
      <ul class="list-group mb-3">
        <li class="list-group-item d-flex justify-content-between align-items-center">
          <a href="/v2/admin/fund/{{ $product->id }}" class="text-decoration-none">
            Detail
          </a>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
          <a href="/v2/admin/fund/{{ $product->id }}/report" class="text-decoration-none">
            Laporan
          </a>
          <span class="badge bg-success rounded-pill">0</span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
          <a href="/v2/admin/fund/{{ $product->id }}/investor" class="text-decoration-none">
            Investor 👁
          </a>
          <span class="badge bg-success rounded-pill">1</span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
          <a href="/v2/admin/vendor/{{ $product->vendor_id }}" class="text-decoration-none">
            Vendor
          </a>
        </li>
      </ul>
      <form wire:submit.prevent="addInvestor" class="mb-3">
        <h6 class="border-bottom border-1 pb-1 border-success">Tambah Investor</h6>
        <input class="form-control mb-1" wire:model="new_investor_name" list="datalistOptions" id="exampleDataList" placeholder="Cari nama...">
        <datalist id="datalistOptions">
          @if ($users)
          @foreach ($users as $user)
          <option value="{{ $user->name }}">    
          @endforeach
          @endif
        </datalist>
        <input class="form-control mb-1" wire:model="new_investor_qty" type="number" placeholder="Jml. Paket">
        <button type="submit" class="w-100 btn btn-success">Simpan</button>
      </form>
    </div>
    <div class="col-10">
      <table class="table table-hover table-borderless">
        <thead>
          <tr>
            <th>#</th>
            <th>Nama</th>
            <th>Email</th>
            <th>HP</th>
            <th>Portofolio</th>
            <th>Nilai Portofolio</th>
            <th>Invoice</th>
            <th>Return</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($investors as $key => $investor)
          <tr>
            <td>{{ $investors->firstItem() + $key }}</td>
            <td>{{ $investor->user->name }}</td>
            <td>{{ $investor->user->email }}</td>
            <td>{{ $investor->user->phone }}</td>
            <td>{{ $investor->qty }} paket</td>
            <td>Rp {{ number_format($investor->qty * $investor->product->price, 2) }}</td>
            <td>
              @if ($investor->invoice_sent_at)
              <button type="button" disabled class="btn shadow-sm">✅</button>
              @else
              <button type="button" class="btn btn-light shadow-sm">🚀</button>
              @endif
            </td>
            <td>
              @if ($investor->return_sent_at)
              <button type="button" disabled class="btn shadow-sm">✅</button>
              @else
              <button type="button" class="btn btn-light shadow-sm">🚀</button>
              @endif
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      <div>{{ $investors->links() }}</div>
    </div>
  </div>
</div>