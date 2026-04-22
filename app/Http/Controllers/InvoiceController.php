<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Invoice_items;
use Illuminate\Http\Request;
use DataTables;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Carbon\Carbon;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.invoice.index');
    }

    public function tableInvoice(Request $request)
    {
        if ($request->ajax()) {
            $datas = Invoice::get();
        }

        return Datatables::of($datas)
            ->addIndexColumn()
            ->editColumn('total', function ($row) {
                return number_format($row->total, 0, ',', '.');
            })
            ->addColumn('action', function ($user) {

                $deleteUrl = route('product.destroy', $user->id);

                return '
                <a href="' . route('invoice.download', $user->id) . '" class="btn btn-xs btn-primary"><i class="fa fa-edit" target="_blank"></i> Download PDF</a>   
                ';
            })
            ->rawColumns(['action'])
            ->make(true)
        ;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.invoice.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'phone' => 'required',
            'address' => 'required',
            'date' => 'required',
            'items_json' => 'required'

        ]);
        if ($validator->fails()) {
            Alert::error('Error', 'Silahkan lengkapi semua data ');
            return redirect('/invoice/create')
                ->withErrors($validator)
                ->withInput();
        }

        $items = json_decode($request->items_json, true);
        $totalPrice = 0;
        foreach ($items as $value) {
            $totalPerItems = $value['price'] * $value['qty'];
            $totalPrice  = $totalPrice + $totalPerItems;
        }

        // $invoiceNumber = $this->invoiceNumber();

        $last = Invoice::whereMonth('created_at', now()->month)
            ->lockForUpdate()
            ->latest('id')
            ->first();

        $nextNumber = $last ? ((int) substr($last->invoice_number, -1) + 1) : 1;

        $invoiceNumber = 'INV-' . now()->format('Ym') . '-' . $nextNumber;


        DB::beginTransaction();
        try {
            $invoice = Invoice::create([
                'invoice_number' => $invoiceNumber,
                'customer_name' => $request->name,
                'customer_phone' => $request->phone,
                'invoice_date' => Carbon::createFromFormat('d-m-Y', $request->date)->format('Y-m-d'),
                'subtotal'  => 0,
                'discount'  => 0,
                'total'     => $totalPrice

            ]);

            // looping foreach
            foreach ($items as $value) {
                $invoice_items = Invoice_items::create([
                    'invoice_id' => $invoice->id,
                    'item_name' => $value['name'],
                    'quantity'  => $value['qty'],
                    'price'     => $value['price'],
                    'total'     => $value['qty'] * $value['price']
                ]);
            }

            DB::commit();
            Alert::success('Success', 'Invoice berhasil disimpan');
            return redirect()->route('invoice.index');
        } catch (\throwable $th) {
            DB::rollBack();
            return $th;
            return redirect()->back()->withInput($request->all());
            Alert::error('Error', 'Silahkan lengkapi semua data ');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function downloadPDF($id)
    {
        $invoice = Invoice::with('items')->findOrFail($id);

        $formattedItems = $invoice->items->map(function ($item) {
            return $this->formatItem($item);
        });

        $data = [
            "name" => $invoice->customer_name,
            "phone" => $invoice->customer_phone,
            "address" => '',
            "date"     => Carbon::parse($invoice->invoice_date)->format('d-m-Y'),
            "items"     => $formattedItems,
            "invoice_number"    => $invoice->invoice_number,
            "total_price"   => $invoice->total
        ];


        $pdf = Pdf::loadView('pdf.invoice', $data);

        $filename = $this->formatFileName($invoice->invoice_number);

        return $pdf->stream($filename);
    }

    public function previewPDF(Request $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'name' => 'required|max:255',
        //     'phone' => 'required',
        //     'address' => 'required',
        //     'date' => 'required',
        //     'items_json' => 'required'

        // ]);
        // if ($validator->fails()) {
        //     Alert::error('Error', 'Silahkan lengkapi semua data ');
        //     return redirect('/invoice/create')
        //         ->withErrors($validator)
        //         ->withInput();
        // }

        $items = json_decode($request->items_json, true);
        $totalPrice = 0;

        foreach ($items as $value) {
            $totalPerItems = $value['price'] * $value['qty'];
            $totalPrice  = $totalPrice + $totalPerItems;
        }

        $invoice_number = $this->invoiceNumber('DRAFT');
        
        $data = [
            "name" => $request->name,
            "phone" => $request->phone,
            "address" => $request->address,
            "date"     => $request->date,
            "items"     => $items,
            "invoice_number"    => $invoice_number,
            "total_price"   => $totalPrice
        ];


        $pdf = Pdf::loadView('pdf.invoice', $data);

        return $pdf->stream($this->formatFileName($invoice_number));
    }

    public function generatePDF()
    {

        $pdf = Pdf::loadView('pdf.invoice', '1');
    }


    private function invoiceNumber($prefix = 'INV')
    {
        $last = Invoice::whereMonth('created_at', now()->month)
            ->lockForUpdate()
            ->latest('id')
            ->first();

        $nextNumber = $last ? ((int) substr($last->invoice_number, -1) + 1) : 1;
        $invoiceNumber = $prefix . '-' . now()->format('Ym') . '-' . $nextNumber;

        return $invoiceNumber;
    }

    private function formatItem($items)
    {
        return [
            'name' => $items['item_name'],
            'qty' => $items['quantity'],
            'price' => $items['price'],
            'total' => $items['total']
        ];
    }

    private function formatFileName($invoiceNumber)
    {
        $filename = 'invoice_' . $invoiceNumber . '_' . Carbon::now()->format('Ymd_His') . '.pdf';
        return $filename;
    }
}
