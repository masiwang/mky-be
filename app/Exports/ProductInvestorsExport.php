<?php

namespace App\Exports;

use App\Models\FundCheckout as PortofolioDB;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ProductInvestorsExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public $portofolios;

    public function __construct($portofolios){
      $this->portofolios = $portofolios;
    }
    public function view(): View
    {
        return view('template.excel.product-investors', [
          'portofolios' => $this->portofolios
        ]);
    }
}
