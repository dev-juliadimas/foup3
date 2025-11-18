<?php

/**
 * Classe Pessoa, implementada no arquivo pessoa.class.php
 *
 * Aqui vai alguma descriзгo do arquivo
 *
 * @author Marcelo Mazon
 * @version 1.0
 * @copyright 2007
 */

class Pessoa extends BDados
{
	// info da tabela
	var $bloco = array("tabela"   => "pessoa",
		 					 "order_by" => "id",
		  					 "coluna"   => array('id','nome','email','dt_cadastro'),
   						 "tipo"     => array('+','text','text','date'),
   						 "pk"       => array(1,0,0,0),
							 "db_item"  => array(1,1,1,0));
	
	// colunas da tabela
	var $id = 0;
	var $nome  = "";
	var $email = "";
	var $dt_cadastro = "";
	
	
	
	/**
	 * Metodo construtor do objeto
	 *
	 * @author Marcelo Mazon: 09/10/2007
	 * @return object Objeto pessoa
	 */
	
	function Pessoa()
	{
		echo"criado obj pessoa";
		//parent::BDados();
	}
	
	
	
	/***
	 * @author Marcelo Mazon: 09/10/2007
	 * @param int $id Identificador da pessoa
	 * @return bool
	 */

	function GetDados($ar_busca)
	{
		// comando para buscar a pessoa pelo cуdigo	
		if ($oDados = parent::sql_select($this->bloco,$ar_busca))
		{
			$this->SetDados($oDados);
		}
		
		return;
		
	}

	function SetDados($oDados)	
	{
		$this->id 			 = $oDados->id;
		$this->nome 		 = $oDados->nome;
		$this->email 		 = $oDados->email;
		$this->dt_cadastro = $oDados->dt_cadastro;
		
		return;
	}
	
	function Update()
	{
		// nada ainda...
	}
	
}


?>