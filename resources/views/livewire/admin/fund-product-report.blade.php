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
            Laporan 👁
          </a>
          <span class="badge bg-success rounded-pill">0</span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
          <a href="/v2/admin/fund/{{ $product->id }}/investor" class="text-decoration-none">
            Investor
          </a>
          <span class="badge bg-success rounded-pill">1</span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
          <a href="/v2/admin/vendor/{{ $product->vendor_id }}" class="text-decoration-none">
            Vendor
          </a>
        </li>
      </ul>
    </div>
    <div class="col-10">
      Laporan
    </div>
  </div>
</div>