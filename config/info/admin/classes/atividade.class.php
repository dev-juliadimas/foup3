<?php

/**
 * Classe Idioma, implementada no arquivo idioma.class.php
 *
 * Aqui vai alguma descrição do arquivo
 *
 * @author Marcelo Mazon
 * @version 1.0
 * @copyright 2007
 */

class Atividade extends BDados
{
	// info da tabela
	var $bloco = array("tabela"   => "atividade",
		 				"order_by" => "id",
		  				"coluna"   => array('id','area_id','nm_atividade', 'dt_cadastro'),
   					"tipo"     => array('+','number','text','date'),
   					"pk"       => array(1,0,0,0),
						"db_item"  => array(1,1,1,0));

	// informações fetchadas do result	
	var $dados = 0;
	
	// url da lista
	var $url_lista = "r_atividades.php";
	
	// colunas da tabela
	var $id = 0;
	var $area_id = 0;
	var $nm_atividade = "";
	var $dt_cadastro = "";
	
	/**
	 * Metodo construtor do objeto
	 *
	 * @author Marcelo Mazon: 09/10/2007
	 * @return object Objeto pessoa
	 */
	
	function Atividade()
	{
		//echo"criado obj pessoa";
		parent::BDados();
	}
	
	
	
	/**
	 * Busca os dados solicitados, setando o objeto com a 1a. ocorrencia encontrada 
	 *
	 * @author Marcelo Mazon: 09/10/2007
	 * @param array $dados Array com as informações para a busca
	 * @return bool
	 */

	function GetDados($dados=false)
	{
		// comando para buscar a pessoa pelo código	
		if ($dados)
		{
			if ($this->dados = parent::sql_select($dados))
			{
				$this->SetDados();
				return true;
			}
			else
				return false;
		}		
	}

	function GetLista($dados=false)
	{
		$this->sql_select_lista($dados);
		return;
	}

	function SetDados()	
	{
		$this->id		    = $this->dados->id;
		$this->area_id      = $this->dados->area_id;
		$this->nm_atividade = $this->dados->nm_atividade;
		$this->dt_cadastro  = $this->dados->dt_cadastro;

		return;
	}
	
	function FetchDados()
	{
		if ($this->dados = mysql_fetch_object($this->res))
		{
			$this->SetDados();
			return true;
		}
		else
			return false;
	}
	
	function Update($dados)
	{
		if ($dados['id'] == "0")
		{
			// formatando dados antes de executar no sql
			$dados['dt_cadastro'] = date("Y-m-d H:i:s");
			return parent::sql_insert($dados);
		}
		else
		{
			$dados['dt_atualizacao'] = date("Y-m-d H:i:s");
			return parent::sql_update($dados);
		}
	}
	
	function Delete($dados)
	{
		return parent::sql_delete($dados);
	}

	function ExibeLista()
	{
		header("Location: ".$this->url_lista);
	}
	
}

?>