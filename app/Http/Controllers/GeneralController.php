<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Storage;
use TCPDF;

class GeneralController extends Controller
{
    public function fileup(Request $request)
    {
        $user = \Auth::user();

        $request->validate([
            'file' => 'required|mimes:xls,xlsx,csv|max:41943040',
        ]);

        $error = false;
        $message = "upfile ok";
        $data = [];

        $pathSave = sha1(rand(1000,9999) . date('ymd His'));
        $file = $request->file;
        $url = $pathSave . "/" . str_replace(" ", "", $file->getClientOriginalName());
        $actual = Storage::disk('public')->put($pathSave,$file);
        Storage::disk('public')->move($actual, $url);

        //lectura de archivo
        $documento = IOFactory::load(storage_path('app/public/'.$url));
        $totalDeHojas = $documento->getSheetCount();
        $hojaActual = $documento->getSheet(0);
        $data = [];
        foreach ($hojaActual->getRowIterator() as $fila) {
            $row=[];
            foreach ($fila->getCellIterator() as $celda) {
                $fila = $celda->getRow();
                $col  = $celda->getColumn();
                if(key_exists($fila,$data)){
                    $data[$fila] = [];
                }
                $row[$col] = $celda->getCalculatedValue();
            }
            $data[$fila] = $row;
        }


        $data = [
                    'name' => $file->getClientOriginalName(),
                    'url' => $url,
                    'scr' => Storage::disk('public')->url($url),
                    'file' => json_encode($data),
                ];
        return [
            'error' => $error,
            'message' => $message,
            'data' => $data
        ] ;
    }

    //
    public function etiquetas($space){

    }

    public function code2d ($code){
        $barcodeobj = new \TCPDFBarcode($code, 'C128');

        // export as SVG image
        //$barcodeobj->getBarcodeSVG(3, 3, 'black');

        // export as PNG image
        //$barcodeobj->getBarcodePNG(3, 3, array(0,128,0));

        // export as HTML code
        return $barcodeobj->getBarcodePNG(2, 30, [0,0,0]);
    }
}
