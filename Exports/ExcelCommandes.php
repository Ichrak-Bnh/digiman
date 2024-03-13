<?php

namespace App\Exports;

use App\Models\commandes;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExcelCommandes implements FromCollection
{
    protected $selectedOrders;

    public function __construct($selectedOrders)
    {
        $this->selectedOrders = $selectedOrders;
    }

    public function collection()
    {
        return commandes::whereIn('id', $this->selectedOrders)
            ->where('id_societe', auth()->user()->id)
            ->get();
    }

    public function headings(): array
    {
        // Définis les en-têtes des colonnes du fichier Excel
        return [
            'ID',
            'ID Société',
            'Total Amount',
            'Status',
            'Nom Client',
            'Type',
            'Email',
            'Motif',
            'Adresse',
            'Telephone',
            'Gouvernerat',
        ];
    }
}
