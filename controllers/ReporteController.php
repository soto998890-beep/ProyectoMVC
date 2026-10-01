<?php
require '../vendor/autoload.php';
require_once '../config/database.php';
require_once '../models/Producto.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Dompdf\Dompdf;
class ReporteController
{
  public function reporteExcel()
  {
    $database = new Database();
    $db = $database->conectar();
    $producto = new Producto($db);
    $datos = $producto->obtenerTodos();
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    $sheet->setCellValue('A1','ID');
    $sheet->setCellValue('B1','Nombre');
    $sheet->setCellValue('C1','Descripción');
    $sheet->setCellValue('D1','Precio');
    $sheet->setCellValue('E1','Stock');
    $sheet->getStyle('A1:E1')->getFont()->setBold(true);
    $sheet->getStyle('A1:E1')->getFill()
      ->setFillType(
        \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID
      )
      ->getStartColor()
      ->setARGB('4F81BD');
    $fila = 2;
    foreach($datos as $row)
    {
      $sheet->setCellValue('A'.$fila,$row['id']);
      $sheet->setCellValue('B'.$fila,$row['nombre']);
      $sheet->setCellValue('C'.$fila,$row['descripcion']);
      $sheet->setCellValue('D'.$fila,$row['precio']);
      $sheet->setCellValue('E'.$fila,$row['stock']);
      $fila++;
    }
    foreach(range('A','E') as $columna)
    {
      $sheet->getColumnDimension($columna)
        ->setAutoSize(true);
    }
    $writer = new Xlsx($spreadsheet);
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="ReporteProductos.xlsx"');
    $writer->save('php://output');
  }
  public function reportePDF()
  {
    $database = new Database();
    $db = $database->conectar();
    $producto = new Producto($db);
    $productos = $producto->obtenerTodos();
    ob_start();
    include '../views/reportes/productos_pdf.php';
    $html = ob_get_clean();
    $dompdf = new Dompdf();
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4','portrait');
    $dompdf->render();
    $dompdf->stream(
      "ReporteProductos.pdf",
      ["Attachment"=>false]
    );
  }
}