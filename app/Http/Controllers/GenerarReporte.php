<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use App\Models\cliente;
use App\Models\reclamo;
use App\Models\apoderado;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Barryvdh\DomPDF\Facade\PDF;



class GenerarReporte extends Controller
{
    public function reporteExcel(){
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Reclamos de Personas Naturales');
       


        //nombre de las comlumnas
        $sheet->setCellValue('A1', '#');
        $sheet->setCellValue('B1', 'DNI');
        $sheet->setCellValue('C1', 'APELLIDOS Y NOMBRES');
        $sheet->setCellValue('D1', 'TELEFONO');
        $sheet->setCellValue('E1', 'CORREO');
        $sheet->setCellValue('F1', 'MENOR EDAD');
        $sheet->setCellValue('G1', 'APODERADO');
        $sheet->setCellValue('H1', 'DNI APODERADO');
        $sheet->setCellValue('I1', 'DIRECCION APODERADO');
        $sheet->setCellValue('J1', 'TIPO RECLAMO');
        $sheet->setCellValue('K1', 'BIEN CONTRATADO');
        $sheet->setCellValue('L1', 'RECLAMO');
        $sheet->setCellValue('M1', 'PEDIDO RECLAMO');
        $sheet->setCellValue('N1', 'ESTADO ECLAMO');

        //aplicar estilo a las celdas de los titulos
        $sheet->getStyle('A1:N1')->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('00A0CE');

        
        $reclamos = reclamo::where('tipo_reclamo', 'reclamo')
        ->whereNull('empresa_id')
        ->get();
        $row = 2; // Comenzar desde la segunda fila porque la primera fila se usa para los nombres de las columnas
        
        
       
        
        foreach ($reclamos as $reclamo) {
            $sheet->setCellValue('A' . $row, $reclamo->id);
            $sheet->setCellValue('B' . $row, $reclamo->cliente->dni);
            $sheet->setCellValue('C' . $row, $reclamo->cliente->nombres_apellidos);
            $sheet->setCellValue('D' . $row, $reclamo->cliente->fono_persona);
            $sheet->setCellValue('E' . $row, $reclamo->cliente->email);
            $sheet->setCellValue('F' . $row, $reclamo->cliente->menor_edad);
            $sheet->setCellValue('G' . $row, $reclamo->cliente->apoderado->nombres_apellidos_apoderado);
            $sheet->setCellValue('H' . $row, $reclamo->cliente->apoderado->dni_apoderado);
            $sheet->setCellValue('I' . $row, $reclamo->cliente->apoderado->direccion_apoderado);
            $sheet->setCellValue('J' . $row, $reclamo->tipo_reclamo);
            $sheet->setCellValue('K' . $row, $reclamo->bien_contratado);
            $sheet->setCellValue('L' . $row, $reclamo->texto_reclamo);
            $sheet->setCellValue('M' . $row, $reclamo->detalle_reclamacion);
            $sheet->setCellValue('N' . $row, $reclamo->estado);
            
            $row++;

        }

        // Ajustar el ancho de las columnas al contenido
        
        
        foreach (range('A', 'N') as $col) {
            if ($col == 'L' || $col == 'M') {
                $sheet->getColumnDimension($col)->setWidth(40);
                $sheet->getStyle($col . '1:' . $col . $sheet->getHighestRow())
                    ->getAlignment()->setWrapText(true);
            } else {
                $sheet->getColumnDimension($col)->setAutoSize(true);
            }

            // Aplicar centrado vertical y horizontal a todas las celdas
            $sheet->getStyle($col . '1:' . $col . $sheet->getHighestRow())
                ->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER)
                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        }
        
        

        $writer = new Xlsx($spreadsheet);
        $filename = 'reclamos-de-personas-naturales.xlsx';
        $writer->save($filename);

        return response()->download($filename)->deleteFileAfterSend(true); 
    }

    public function reportePDF(){
        $reclamos = reclamo::where('tipo_reclamo', 'reclamo')
        ->whereNull('empresa_id')
        ->get();
        $pdf = PDF::loadView('generarReporte.personas-Naturales-PDF' , compact('reclamos'))
            ->setPaper('a4', 'landscape');
        
        return $pdf->stream();
    }
}
