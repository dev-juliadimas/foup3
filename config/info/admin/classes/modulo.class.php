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

class Modulo extends BDados
{
	public $bloco = array("tabela" => "modulo", "order_by" => "cd_modulo");
	
	public $dados = 0;

	// url da lista
	public $url_lista = "rel_modulos.php";
	
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
		
		//parent::set_colunas();
		
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
			{
				return true;
			}
			else
				return false;
		}
		return;
	}

	function GetLista($dados=false)
	{
		$this->sql_select_lista($dados);
		return;
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
		if ($dados['cd_modulo'] == "0")
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
	
	function CarregaModulos($cd_empresa)
	{
		$sql = "select distinct m.*
				from modulo m, modulo_empresa me, usuario_acesso ua
				where m.cd_modulo = me.cd_modulo
				 and me.cd_modulo = ua.cd_modulo
				 and ua.cd_usuario = ".$_SESSION['usuario']['codigo']."
				 and me.cd_empresa = $cd_empresa
				 and m.id_status = 'A'";
 		$res = mysqli_query($this->con, $sql);
		
		while ($row = mysqli_fetch_array($res))
		{
			$modulos[$row['cd_modulo']] = array('cd_modulo'=>$row['cd_modulo'],
														 'nm_modulo'=>htmlentities($row['nm_modulo']),
														 'ds_modulo'=>htmlentities($row['ds_modulo']),
														 'url_modulo'=>$row['url_modulo']);
		}	
		return $modulos;
	}

}

?>