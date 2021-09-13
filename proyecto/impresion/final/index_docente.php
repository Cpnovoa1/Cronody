<link href="../css/impresionPDFestilo.css" rel="stylesheet" type="text/css">

<?php

require_once __DIR__ . '/vendor/autoload.php';
require_once 'model_docente.php';

$alumnos = new Model();

$lista = $alumnos->getAll();

$html .= '<h1>Lista de horarios registrados</h1>';
$html .= '<table>
            <tr>
                <td>N°</td>
                <td>Curso</td>
				<td>Materias</td>
                <td>Día </td>
				<td>Hora de inicio</td>
                <td>Hora final </td>             
            </tr>';
$cont = 1;
foreach($lista['items'] as $item){
	if($item['HOR_ESTADO']=='1' && $item['AUL_ESTADO']=='1'){$curso = $item[ "AUL_CURSO" ]. ' "'.  $item[ "AUL_NOMBRE" ] .'" ';}
	else {$curso = "Sin horario";}
	if($item['MAT_ESTADO']=='1'){$mat = $item['MAT_NOMBRE'];}
	else {$mat = "Ninguno";}	
	if($item['HMA_ESTADO']=='1'){$est = 'Activo';}
	else {$est = "Inactivo";}
	
    $html .= '<tr>
                <td>'.$cont.'</td><td>'.$curso.'</td> <td>'.$mat.'</td> <td>'.$item['DIA_NOMBRE'].'</td> <td>'.$item['HMA_HORAINICIO'].'</td> <td>'.$item['HMA_HORAFIN'].'</td>
              </tr>';
	$cont++;
}
    $html .= '</table>';

    //echo $html;
$mpdf = new \Mpdf\Mpdf();
$mpdf->WriteHTML($html);
$mpdf->Output();

?>