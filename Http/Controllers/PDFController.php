<?php

namespace App\Http\Controllers;

use App\Exports\ExcelCommandes;
use App\Models\commandes;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class PDFController extends Controller
{
    public function generate_manifest(Request $request)
    {
        $currentDate = \Carbon\Carbon::now();
        $selectedOrdersParam = $request->query('selectedOrders', []);
        $selectedOrders = explode(',', $selectedOrdersParam);
        $selectedOrders = array_map('trim', $selectedOrders);
        $selectedOrders = array_filter($selectedOrders, 'is_numeric');
        $selectedOrdersDetails = Commandes::whereIn('id', $selectedOrders)->where('id_societe', Auth::user()->id)->get();
        $pdf = FacadePdf::loadView('pdf.manifest', ['commandes' => $selectedOrdersDetails]);
        return $pdf->download('[MANIFEST] - ' . $currentDate->format('d-m-Y H:i') . '.pdf');
    }



    public function generate_bordereau(Request $request)
    {
        $currentDate = \Carbon\Carbon::now();
        $selectedOrdersParam = $request->query('selectedOrders', []);
        $selectedOrders = explode(',', $selectedOrdersParam);
        $selectedOrders = array_map('trim', $selectedOrders);
        $selectedOrders = array_filter($selectedOrders, 'is_numeric');
        $selectedOrdersDetails = Commandes::whereIn('id', $selectedOrders)->where('id_societe', Auth::user()->id)->get();
        $pdf = FacadePdf::loadView('pdf.bordereau', ['orders' => $selectedOrdersDetails]);
        return $pdf->download('[BORDEREAU] - ' . $currentDate->format('d-m-Y H:i') . '.pdf');
    }



    public function generate_excel(Request $request){
        $currentDate = \Carbon\Carbon::now();
        $selectedOrdersParam = $request->query('selectedOrders', []);
        $selectedOrders = explode(',', $selectedOrdersParam);
        $selectedOrders = array_map('trim', $selectedOrders);
        $selectedOrders = array_filter($selectedOrders, 'is_numeric');
        $export = new ExcelCommandes($selectedOrders);
        return Excel::download($export, '[EXCEL] -'. $currentDate->format('d-m-Y H:i') .'.xlsx');
    }
}
