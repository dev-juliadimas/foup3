<?php

/**
 * Classe Empresa, implementada no arquivo empresa.class.php
 *
 * Empresa são os clientes que terão acessso ao sistema através de seus usuários
 *
 * @author Marcelo Mazon
 * @version 1.0
 * @copyright 2009
 */

class Empresa extends BDados
{
	public $bloco = array("tabela" => "empresa", "order_by" => "nm_empresa");
	
	public $dados = 0;

	// url da lista
	public $url_lista = "empresas.php";
	
	/**
	 * Metodo construtor do objeto
	 *
	 * @author Marcelo Mazon: 09/10/2007
	 * @return object Objeto pessoa
	 */
	
	function __construct()
	{
		// setar o bloco de dados
		parent::__construct($this->bloco);
		// setar colunas e tipos do bloco
		
		//parent::set_colunas(); no construtor do parent
		
	}
	
	
	
	/***
	 * @author Marcelo Mazon: 09/10/2007
	 * @param int $id Identificador da empresa
	 * @return bool
	 */

	function GetDados($dados=false, $exato=false)
	{
		// comando para buscar a pessoa pelo código	
		if ($dados)
		{
			if ($this->dados = parent::sql_select($dados,$exato)) 
				return true;
			else
				return false;
		}
		return;
	}

	function GetLista($dados=false)
	{
		$this->sql_select_lista($dados);
        return true;
	}

	function FetchDados()
	{
		if ($this->dados = mysqli_fetch_object($this->res))
		{
			//$this->SetDados();
			$this->total_registros = mysqli_num_rows($this->res);
			return true;
		}
		else
			return false;
	}
	
	function Update($dados)
	{
		if ($dados['cd_empresa'] == "0")
		{
			// insert
			$dados['dt_cadastro'] = date("Y-m-d H:i:s");
			return parent::sql_insert($dados);
		}
		else
		{
			// update
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

	function ModulosAcesso()
	{
		$sql = "SELECT m.cd_modulo, m.nm_modulo, me.cd_empresa
			FROM modulo m
			left join modulo_empresa me on 
				(me.cd_modulo = m.cd_modulo and me.cd_empresa = ".$this->dados->cd_empresa.")
			order by m.cd_modulo";
						 
 		$res = mysqli_query($sql);
		$modulos = array();
		while ($row = mysqli_fetch_array($res))
		{
			$modulos[] = $row;
		}
		return $modulos;
	}
	
	
}

?>