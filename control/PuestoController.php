<?php

	require_once "model/Puesto.php" ;

	class PuestoController 
	{
		private $twig;
		public function __construct() 
		{
			require_once "vendor/autoload.php";

			$loader = new \Twig\Loader\FilesystemLoader('./view');
			$this->twig = new \Twig\Environment($loader);

		}

		/**
		 * Muestra en pantalla un listado con todos los puestos
		 * del mercado.
		 */
		public function mostrar()
		{			
			$puestosInstance = new Puesto();
			
			echo  $this->twig->render('mostrarPuestos.php.twig',
			[
				"titulo" => "Listado de puestos",
				"puestos" => $puestosInstance->findAll(),
			]);
		}
	}