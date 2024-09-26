<?php

namespace App\Http\Controllers;

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
}
