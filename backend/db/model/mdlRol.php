<?php
class mdlRol {
    

    private ?Int $id;
    private String $rol;
    private Int $estatus;
    private String $um;
    private ?String $fm;

    public function __construct(String $rol, ?Int $id = null, Int $estatus = null, String $um = null, ?String $fm = null) {
        $this->id       = $id;
        $this->rol      = $rol;
        $this->estatus  = $estatus;
        $this->um       = $um;
        $this->fm       = $fm;
    }

    public function getId(): Int {return $this->id;}

	public function getRol(): String {return $this->rol;}

	public function getEstatus(): Int {return $this->estatus;}

	public function getUm(): String {return $this->um;}

	public function getFm(): String {return $this->fm;}

	public function setId(Int $id): void {$this->id = $id;}

	public function setRol(String $rol): void {$this->rol = $rol;}

	public function setEstatus(Int $estatus): void {$this->estatus = $estatus;}

	public function setUm(String $um): void {$this->um = $um;}

	public function setFm(String $fm): void {$this->fm = $fm;}
	




}