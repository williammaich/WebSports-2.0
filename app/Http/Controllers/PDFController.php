<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class PDFController extends Controller
{
    public function makePdf()
    {
        //$pdf = PDF::loadView('pdf');
        //return $pdf->download('pdf.pdf');

        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('pdf');
        return $pdf->download('pdf.pdf');

    }
}

//$pdf = App::make('dompdf.wrapper');
//$pdf->loadHTML('<h1>Test</h1>');
//return $pdf->stream();
