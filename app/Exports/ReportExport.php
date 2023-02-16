<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ReportExport implements FromView, ShouldAutoSize
{
    public $stock_report_data;

    function __construct($stock_report_data)
    {
        $this->stock_report_data = $stock_report_data;
    }

        public function view(): View
    {
        return view('excel.report', [
            'stock_report_data' => $this->stock_report_data,
        ]);
    }
}
