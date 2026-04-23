<?php

namespace App\Exports;

use App\Models\Invoice;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Carbon\Carbon;

class InvoiceExport implements FromCollection, WithHeadings, WithMapping
{
    protected $request;
    public function __construct($request)
    {
        $this->request = $request;
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $query = Invoice::query();

        // 🔍 SEARCH
        $search = $this->request->input('search.value');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('customer_name', 'like', "%{$search}%")
                    ->orWhere('invoice_number', 'like', "%{$search}%");
            });
        }

        // 📅 DATE RANGE
        if ($this->request->start_date && $this->request->end_date) {
            $query->whereBetween('invoice_date', [
                $this->request->start_date,
                $this->request->end_date
            ]);
        }

    return $query->get(
            ['invoice_number', 'customer_name', 'invoice_date', 'total']
        );
    }

    public function map($row): array
    {
        return [
            $row->invoice_number,
            $row->customer_name,
            Carbon::parse($row->invoice_date)->format('d-m-Y'),
            $row->total, // number_format($row->total, 0, ',', '.'),
        ];
    }

    public function headings(): array
    {
        return [
            'Invoice Number',
            'Customer',
            'Tanggal',
            'Total'
        ];
    }
}
