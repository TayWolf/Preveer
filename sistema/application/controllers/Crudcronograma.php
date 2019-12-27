<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;



class CrudCronograma extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model("cronograma"); //cargamos el modelo de User

    }

    public function index($index = 1)
    {
        // $data['cronogr'] = $this->cronograma->getDatos();
        //$data['cronogrFecha'] = $this->cronograma->getDatosFecha();
        $data['otis']=$this->cronograma->getOtis();
        $this->load->view('viewcronograma', $data);
    }


    function getVisi($orden="")
    {
        $prueba = $this->cronograma->getDatos($orden);
        echo json_encode($prueba);
    }

    function getVisitas()
    {
        return $this->cronograma->getDatosVisitas();
    }
    function getFecha($idUser, $idCe)
    {

        $prueba = $this->cronograma->getDatosFecha($idUser, $idCe);
        echo json_encode($prueba);
    }
    function getFechaVisitas($idUser, $idCe)
    {

        $prueba = $this->cronograma->getDatosFecha($idUser, $idCe);
        return $prueba;
    }

    function descargarCronograma()
    {
        setlocale(LC_ALL,"es_ES");
        $visita=$this->getVisitas();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();


        $styleArrayA1 = [
            'font' => [
                'bold' => true,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
        ];
        $styleArrayEncabezados = [
            'font' => [
                'bold' => true
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
            ],
            'borders' => [
                'top' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => [
                    'argb' => '00000000',
                ]
            ],
        ];
        $styleArrayUnidades= [
            'font' => [
                'bold' => true
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
            ],
            'borders' => [
                'top' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => [
                    'argb' => '00FF0000',
                ]
            ],
        ];
        //ESTABLECE EL TITULO
        $sheet->mergeCells('A1:D5');
        $sheet->getStyle('A1')->applyFromArray($styleArrayA1);
        $sheet->setCellValue('A1', 'PROGRAMACIÓN DE INSPECCIONES PLANEADAS');
        $sheet->getColumnDimension('A')->setWidth(6);
        $sheet->getColumnDimension('B')->setWidth(25);
        $sheet->getColumnDimension('C')->setWidth(14);
        $sheet->getColumnDimension('D')->setWidth(50);
        $celdaEncabezado=$sheet->getStyle('A1');
        $celdaEncabezado->getFont()->setBold(true);
        //FIN TITULO
        //ESTABLECE LOS ENCABEZADOS
        $sheet->getStyle('A6:D6')->applyFromArray($styleArrayEncabezados);
        $spreadsheet->getActiveSheet()->getStyle('A6:D6')->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE);
        $sheet->setCellValue('A6', 'No.');
        $sheet->setCellValue('B6', 'Analista');
        $sheet->setCellValue('C6', 'Responsable');
        $sheet->setCellValue('D6', 'Nombre de la unidad');
        //FIN ENCABEZADOS
        $columnaInicio='A';
        $filaInicio="7";
        $ultimoNombreMunicipio=null;
        $contadorNumerico=1;
        $styleArrayFechas =
            [
                'fill' =>
                    [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'startColor' =>
                            [
                                'argb' => '00000000',
                            ]
                    ]
            ];

        foreach ($visita as $item)
        {
            if($item["nombreMunicipio"]!=$ultimoNombreMunicipio)
            {
                $ultimoNombreMunicipio=$item["nombreMunicipio"];
                $sheet->getStyle('A'.$filaInicio.':D'.$filaInicio)->applyFromArray($styleArrayUnidades);
                $sheet->getStyle('A'.$filaInicio.':D'.$filaInicio)->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE);
                $sheet->setCellValue('A'.$filaInicio, $item["nombreMunicipio"]);
                $filaInicio++;
            }
            $sheet->setCellValue('A'.$filaInicio, $contadorNumerico);
            $sheet->setCellValue('B'.$filaInicio, $item["nombreUser"]);
            $sheet->setCellValue('C'.$filaInicio, "X");
            $spreadsheet->getActiveSheet()->getStyle('A'.$filaInicio.':C'.$filaInicio)
                ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->setCellValue('D'.$filaInicio, $item["nombreUnidad"]);
            $inicioFecha='E';
            //Codigo para colocar las fechas
            $fechasVisita=$this->getFechaVisitas($item["idUsuario"], $item["idCentroTrabajo"]);
            foreach ($fechasVisita as $fecha)
            {
                $colorLetra=\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE;


                if ($fecha["status"]==1)
                {
                    //rojo
                    $styleArrayFechas['fill']['startColor']['argb']='FFD51414';
                }
                else if ($fecha["status"]==2)
                {
                    //verde
                    $styleArrayFechas['fill']['startColor']['argb']='FF4CAF50';

                }

                else
                {
                    //amarillo
                    $colorLetra=\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_BLACK;
                    $styleArrayFechas['fill']['startColor']['argb']='FFFFC46C';

                }

                $date = DateTime::createFromFormat("Y-m-d", $fecha["fechaVisita"]);
                $dia=strftime("%d de %B de %Y",$date->getTimestamp());
                $sheet->setCellValue($inicioFecha.$filaInicio, $dia);
                $spreadsheet->getActiveSheet()->getStyle($inicioFecha.$filaInicio)->applyFromArray($styleArrayFechas);
                $spreadsheet->getActiveSheet()->getStyle($inicioFecha.$filaInicio) ->getFont()->getColor()->setARGB($colorLetra);

                $inicioFecha++;
            }
            $spreadsheet->getActiveSheet()->getStyle('E'.$filaInicio.':'.$inicioFecha.$filaInicio)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

            $filaInicio++;
            $contadorNumerico++;
        }

        $sheet->getDefaultColumnDimension()->setWidth(22);
        $writer = new Xlsx($spreadsheet);
        $writer->save('Cronograma.xlsx');
        $this->load->helper('download');
        force_download('Cronograma.xlsx', NULL);


    }

}

?>