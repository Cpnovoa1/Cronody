<?php

class horario {
	public $doc;
	public $sup;
	public $mat;
	public $horini;
	public $horfin;
	public $anio;
	
	//Metodos
	public function __construct($genero, $modelo, $talla, $tallanum, $precio) {
		$this->genero = $genero;
		$this->modelo = $modelo;
		$this->talla = $talla;
		$this->tallanum = $tallanum;
		$this->precio = $precio;
  	}

	public function getGenero(){
		return $this->genero;
	}
	
	public function getModelo(){
		return $this->modelo;
	}
	
	public function getTalla(){
		return $this->talla;
	}
	
	public function getTallanum(){
		return $this->tallanum;
	}
	
	public function getPrecio(){
		return $this->precio;
	}
	
	public function validar(){
		
	}
}
