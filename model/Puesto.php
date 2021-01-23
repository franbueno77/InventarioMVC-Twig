<?php

	require_once "libs/Database.php" ;

	class Puesto
	{
		private ?int $idPue = null ;
		private string $nombre ;
		private string $ubicacion ;
		private $planta ;
		private $numero ;

	    /**
	     * @return mixed
	     */
	    public function getIdPue()
	    {
	        return $this->idPue;
	    }

	    /**
	     * @return mixed
	     */
	    public function getNombre()
	    {
	        return $this->nombre;
	    }

	    /**
	     * @param mixed $nombre
	     *
	     * @return self
	     */
	    public function setNombre($nombre)
	    {
	        $this->nombre = $nombre;

	        return $this;
	    }

	    /**
	     * @return mixed
	     */
	    public function getUbicacion()
	    {
	        return $this->ubicacion;
	    }

	    /**
	     * @param mixed $ubicacion
	     *
	     * @return self
	     */
	    public function setUbicacion($ubicacion)
	    {
	        $this->ubicacion = $ubicacion;

	        return $this;
	    }

	    /**
	     * @return mixed
	     */
	    public function getPlanta()
	    {
	        return $this->planta;
	    }

	    /**
	     * @param mixed $planta
	     *
	     * @return self
	     */
	    public function setPlanta($planta)
	    {
	        $this->planta = ($planta)?$planta:0 ;

	        return $this;
	    }

	    /**
	     * @return mixed
	     */
	    public function getNumero()
	    {
	        return $this->numero;
	    }

	    /**
	     * @param mixed $numero
	     *
	     * @return self
	     */
	    public function setNumero($numero)
	    {	    		    
	        $this->numero = ($numero)?$numero:0 ;

	        return $this;
	    }

	    /**
	     * Return array of data puestos
	     */
	    public  function findAll()
	    {
			$db = Database::getInstance() ;
	    	$db->query("SELECT * FROM puestos ") ;
			
	    	$datos = [] ;
	    	while ($item = $db->getRow("Puesto")){
				array_push($datos, $item) ;
			}
	    		
	    	//
	    	return $datos ;
	    }
}

