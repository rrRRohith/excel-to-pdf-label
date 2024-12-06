<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class HomeController extends Controller
{
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);

        // Load the file
        $path = $request->file('file')->getRealPath();
        $data = Excel::toArray([], $path);
        $list = [];
        foreach($data[0] as $key => $item){
            if($key && $item[2]){
                $list[$key]['contact_name'] = $item[2];
                $list[$key]['company_name'] = $item[3];
                $list[$key]['address_1'] = $item[4];
                $list[$key]['address_2'] = $item[5];
                $list[$key]['phone'] = $item[6];
                $list[$key]['city'] = $item[7];
                $list[$key]['province'] = $item[8];
                $list[$key]['postalcode'] = $item[9];
                $list[$key]['message'] = $item[11];
                $list[$key]['from_name'] = $item[12];
            }
        }

        $listnew[] = $list[1];
        $listnew[] = $list[2];

        // Generate PDF
        $pdf = Pdf::loadView('excel-pdf', ['items' => $list ]);

        // Set PDF size to 4x3 inches
        $pdf->setPaper([0, 0, 288, 216]); // 4 inches x 72 dpi = 288, 3 inches x 72 dpi = 216

        // Save the PDF locally
        $fileName = 'excel_data.pdf';
        $storagePath = storage_path('app/pdfs/' . $fileName);

        
        $pdf->save($storagePath);
        return $pdf->stream('excel_data.pdf');
        //return response()->download($pdfPath)->deleteFileAfterSend();

        dd($list);
    }
}
