<?php

namespace App\Http\Controllers;

use App\Models\InvoiceItem;
use App\Models\Counter;
use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    /**
     * get all invoice
     */
    public function get_all_invoice(){
        $invoices = Invoice::with('customer')->orderBy('id', "DESC")->get();
        return response()->json([
            'invoices' => $invoices
        ], 200);
    }

    /**
     * Search Invoice
     */
    public function search_invoice(Request $request){
        $search = $request->get('s');
        if ($search != null) {
            $invoices = Invoice::with('customer')
                        ->where('number', 'LIKE', "%$search%")
                        ->get();

            return response()->json([
                'invoices' => $invoices
            ], 200);
        }else{
            return $this->get_all_invoice();
        }
    }  

    /**
     * Create Invoice
     */
    public function create_invoice(Request $request){
        
        $counter = Counter::where('key', 'invoice')->first();
        $random = Counter::where('key', 'invoice')->first();

        $invoice = Invoice::orderBy('id', 'DESC')->first();
        if($invoice){
            $invoice = $invoice->id+1;
            $counters = $counter->value + $invoice;
        }else{
            $counters = $counter->value;
        }

        $formData = [
            'number' => $counter->prefix.$counters,
            'customer_id' => null,
            'customer' => null,
            'date' => date('Y-m-d'),
            'due_date' => null,
            'reference' => null,
            'discount' => 0,
            'terms_and_conditions' => 'Default Terms and Conditions',
            'items' => [
                [
                    'product_id' => null,
                    'product' => null,
                    'unit_price' => 0,
                    'quantity' => 1
                ]
            ]
        ];

        return response()->json($formData);
    }


    /**
     * Add Invoice
     */

     public function add_invoice(Request $request){

        $invoiceItem = $request->input('invoice_item');

        $invoiceData['sub_total'] = $request->input('sub_total');
        $invoiceData['total'] = $request->input('total');
        $invoiceData['customer_id'] = $request->input('customer_id');
        $invoiceData['number'] = $request->input('number');
        $invoiceData['date'] = $request->input('date');
        $invoiceData['due_date'] = $request->input('due_date');
        $invoiceData['discount'] = $request->input('discount');
        $invoiceData['reference'] = $request->input('reference');
        $invoiceData['terms_and_conditions'] = $request->input('terms_and_conditions');

        $invoice = Invoice::create($invoiceData);

        foreach(json_decode($invoiceItem) as $item){

            $itemData['product_id'] = $item->id;
            $itemData['invoice_id'] = $invoice->id;
            $itemData['quantity'] = $item->quantity;
            $itemData['unit_price'] = $item->unit_price;

            InvoiceItem::create($itemData);
        }
     }

     /**
      * Show Invoice
      */
    public function show_invoice($id){
        $invoice = Invoice::with(['customer', 'invoice_items.product'])->find($id);
        return response()->json([
            'invoice' => $invoice
        ], 200);
    }

    /**
     * Edit Invoice
     */
    public function edit_invoice($id){
        $invoice = Invoice::with(['customer', 'invoice_items.product'])->find($id);
        return response()->json([
            'invoice' => $invoice
        ], 200);
    }

    /**
     * Delete Invoice Item
     */
    public function delete_invoice_items($id){
        $invoiceItem = InvoiceItem::findOrFail($id);
        $invoiceItem->delete();
    }

    // Update Invoice
    public function update_invoice(Request $request, $id){
        $invoice = Invoice::where('id', $id)->first();

        $invoice->sub_total = $request->input('sub_total');
        $invoice->total = $request->input('total');
        $invoice->customer_id = $request->input('customer_id');
        $invoice->number = $request->input('number');
        $invoice->date = $request->input('date');
        $invoice->due_date = $request->input('due_date');
        $invoice->discount = $request->input('discount');
        $invoice->reference = $request->input('reference');
        $invoice->terms_and_conditions = $request->input('terms_and_conditions');

        $invoice->update($request->all());

        $invoiceItem = $request->input("invoice_item");
        $invoice->invoice_items()->delete();

        foreach(json_decode($invoiceItem) as $item){

            $itemData['product_id'] = $item->product_id;
            $itemData['invoice_id'] = $invoice->id;
            $itemData['quantity'] = $item->quantity;
            $itemData['unit_price'] = $item->unit_price;

            InvoiceItem::create($itemData);
        }
    }
}

