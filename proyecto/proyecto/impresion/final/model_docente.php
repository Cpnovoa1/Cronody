<?php

 session_start();

include_once 'database.php';

class Model extends Database{

    function getAll(){
        $clientes = array();
        $clientes['items'] = array();
        include('../../php/obtener_usuario.php');
		$cod = $codigo;

        $query = $this->connect()->query("Select * From horarios_materias o, horarios h, dias d, materias m, paralelo p, docente t Where o.HOR_CODIGO = h.HOR_CODIGO and o.DIA_CODIGO = D.DIA_CODIGO and o.MAT_CODIGO = m.MAT_CODIGO and p.HOR_CODIGO = h.HOR_CODIGO and m.DOC_CODIGO = t.DOC_CODIGO and t.DOC_CODIGO = '$cod'");

        if($query->rowCount()){
            while($row = $query->fetch()){
                array_push($clientes['items'], array(
                    'HMA_CODIGO'=> $row['HMA_CODIGO'],
					'HOR_CODIGO'=> $row['HOR_CODIGO'],
					'MAT_CODIGO'=> $row['MAT_CODIGO'],
					'DIA_CODIGO'=> $row['DIA_CODIGO'],
					'HMA_HORAINICIO'=> $row['HMA_HORAINICIO'],
					'HMA_HORAFIN'=> $row['HMA_HORAFIN'],
                    'HMA_ESTADO'=> $row['HMA_ESTADO'],
					'AUL_ESTADO'=> $row['AUL_ESTADO'],
					'AUL_CURSO'=> $row['AUL_CURSO'],
					'AUL_NOMBRE'=> $row['AUL_NOMBRE'],
					'DIA_NOMBRE'=> $row['DIA_NOMBRE'],
					'HOR_ESTADO'=> $row['HOR_ESTADO'],
					'MAT_ESTADO'=> $row['MAT_ESTADO'],
					'MAT_NOMBRE'=> $row['MAT_NOMBRE']
                ));
            }

            return $clientes;
        }
    }
}

?>