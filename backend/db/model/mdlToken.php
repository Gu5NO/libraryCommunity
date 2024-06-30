<?php
class mdlToken {
    private $id;
    private $token;
	private $pagina;
	private $ipPublica;
	private $ipInterna;
    private $estatus;
    private $um;
    private $fm;

	public function __construct($token, $pagina, $ipPublica, $ipInterna, $id = null, $estatus = null, $fm=null ,$um = null) {
		$this->id 			= $id;
		$this->token 		= $token;
		$this->pagina 		= $pagina;
		$this->ipPublica 	= $ipPublica;
		$this->ipInterna 	= $ipInterna;
		$this->estatus 		= $estatus;
		$this->um 			= $um;
		$this->fm 			= $fm;
	}

	public function getId() {
		return $this->id;
	}

	public function setId($value) {
		$this->id = $value;
	}

	public function getToken() {
		return $this->token;
	}

	public function setToken($value) {
		$this->token = $value;
	}

	public function getPagina() {
		return $this->pagina;
	}

	public function setPagina($value) {
		$this->pagina = $value;
	}

	public function getIpPublica() {
		return $this->ipPublica;
	}

	public function setIpPublica($value) {
		$this->ipPublica = $value;
	}

	public function getIpInterna() {
		return $this->ipInterna;
	}

	public function setIpInterna($value) {
		$this->ipInterna = $value;
	}

	public function getEstatus() {
		return $this->estatus;
	}

	public function setEstatus($value) {
		$this->estatus = $value;
	}

	public function getUm() {
		return $this->um;
	}

	public function setUm($value) {
		$this->um = $value;
	}

	public function getFm() {
		return $this->fm;
	}

	public function setFm($value) {
		$this->fm = $value;
	}
}