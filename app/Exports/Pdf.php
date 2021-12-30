<?php

namespace App\Exports;

class Pdf
{
    public static function download(Export $build,$file='file.pdf'){
        $pdf = new \TCPDF();
        $pdf->SetDefaultMonospacedFont('courier');
        $pdf->SetMargins(15, 15, 15);
        $pdf->SetHeaderMargin(5);
        $pdf->SetFooterMargin(10);
        $pdf->SetAutoPageBreak(true, 25);
        $pdf->setFontSubsetting(true);
        $pdf->SetFont('stsongstdlight', '', 14);
        $pdf->AddPage();
        $str = '<table><tr>';
        foreach ($build->headings() as $header){
            $str.='<th>'.$header.'</th>';
        }
        $str.='</tr>';
        foreach ($build->query()->get() as $item){
            $str.='<tr>';
            foreach ($build->map($item) as $field){

                $str.='<td>'.$field.'</td>';
            }
            $str.='</tr>';
        }
        $str.='</table>';
        $pdf->writeHTML($str);
        return $pdf->Output($file, 'D');//I display、D download
    }
}
