<?php

namespace App\Http\Controllers;

use App\Models\Donor;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Barryvdh\DomPDF\Facade\Pdf;

class DonationController extends Controller
{
    private Donor $donor;
    public function __construct(Donor $donor) {
        $this->donor = $donor;
    } 

    public function index(): View|Factory
    {
        $donors = $this->donor->with(['donation', 'paymentMethod', 'user'])->get();
        return view('backEnd.donor.index', compact('donors'));
    }

    public function exportPDF()
    {
        $donors = $this->donor->with(['donation', 'paymentMethod', 'user'])->get();
        $pdf = Pdf::loadView('backEnd.donor.pdf', ['donors' => $donors]);
        return $pdf->stream();
    }
}
