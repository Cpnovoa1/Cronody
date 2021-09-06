<?php

class Horario {
	public $doc;
	public $sup;
	public $mat;
	public $horini;
	public $horfin;
	public $anio;
	public $dia;
	public $aula;
	
	//Metodos
	public function __construct($doc, $sup, $mat, $horini, $horfin, $anio, $dia, $aula) {
		$this->doc = $doc;
		$this->sup = $sup;
		$this->mat = $mat;
		$this->horini = $horini;
		$this->horfin = $horfin;
		$this->anio = $anio;
		$this->dia = $dia;
		$this->aula = $aula;
  	}

	public function getDoc(){
		return $this->doc;
	}
	
	public function getSup(){
		return $this->sup;
	}
	
	public function getMat(){
		return $this->mat;
	}
	
	public function getHoraIni(){
		return $this->horini;
	}
	
	public function getHoraFin(){
		return $this->horfin;
	}
	
	public function getAnio(){
		return $this->anio;
	}
	
	public function getDia(){
		return $this->dia;
	}
	
	public function getAula(){
		return $this->aula;
	}
	
}

?>
