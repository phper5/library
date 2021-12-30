<?php

namespace App\Exports;


use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Facades\Excel;

class Export  implements FromQuery,WithMapping,WithHeadings
{
    use Exportable;
    const TYPE_EXCEL = 'excel';
    const TYPE_PDF = 'pdf';
    protected $query;
    protected $headings;
    protected $mapping;
    public function __construct($query,$headings,$mapping){
        $this->query = $query;
        $this->headings = $headings;
        $this->mapping = $mapping;
    }
    public function query():Builder
    {
        return $this->query;
    }
    public function map($row): array
    {
        $data = [];
        foreach ($this->headings as $header){
            if(isset($this->mapping[$header])){
                $callback = $this->mapping[$header];
                $data [] = $callback($row);
            }else{
                $data [] = '-';
            }
        }
        return $data;
    }
    public function headings(): array
    {
        $headings = [];
        foreach ($this->headings as $h)
        {
            $headings[] = __('export.'.$h);
        }
        return $headings;
    }
    public function to($format , $file_name= 'file.xlsx')
    {
        if ($format ==  self::TYPE_EXCEL){
            return Excel::download($this,$file_name);
        }else{
           return Pdf::download($this,$file_name);
        }
    }
}
