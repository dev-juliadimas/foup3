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

class Solicitacao extends BDados
{
	public $bloco = array("tabela" => "solicitacao", "order_by" => "dt_cadastro");
	
	public $dados = 0;

	// url da lista
	public $url_lista = "rel_setores.php";
	
	/**
	 * Metodo construtor do objeto
	 *
	 * @author Marcelo Mazon: 09/10/2007
	 * @return object Objeto pessoa
	 */
	
	function Solicitacao()
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
			{
				return true;
			}
			else
				return false;
		}
		return;
	}

	function GetLista($cd_tipo)
	{
		$sql = "SELECT s.*, ts.cd_tipo_solicitacao_pai, u.nm_usuario
				FROM solicitacao s, tipo_solicitacao ts, usuario u
				where s.cd_tipo_solicitacao = ts.cd_tipo_solicitacao
				 and s.cd_usuario_solicitante = u.cd_usuario 
				 and s.cd_empresa = u.cd_empresa
				 and ts.cd_tipo_solicitacao_pai = $cd_tipo -- movto pessoal
				 and s.cd_empresa = {$_SESSION['usuario']['empresa']}
				 and (exists (select ue.cd_usuario from usuario_envolvido ue
             	 				where ue.cd_tipo_solicitacao = ts.cd_tipo_solicitacao_pai
             	  				and ue.cd_usuario = {$_SESSION['usuario']['codigo']})
						 or s.cd_usuario_solicitante = {$_SESSION['usuario']['codigo']})
				ORDER BY dt_cadastro DESC";
		$this->res = mysql_query($sql);
		//$this->sql_select_lista($dados);
		return;
	}

/*	function SetDados()	
	{
		$this->cd_usuario       = $this->dados->cd_usuario;
		$this->nm_usuario 	    = $this->dados->nm_usuario;
		$this->email			= $this->dados->email;
		$this->senha			= $this->dados->senha;
		$this->cpf				= $this->dados->cpf;
		$this->dt_cadastro  	= date("Y-m-d")." ".date("H:i:s");

		return;
	}
*/	
	function FetchDados()
	{
		if ($this->dados = mysql_fetch_object($this->res))
		{
			//$this->SetDados();
			$this->total_registros = mysql_num_rows($this->res);
			return true;
		}
		else
			return false;
	}
	
	function Update($dados)
	{
		if ($dados['cd_solicitacao'] == "0")
		{
			// insert
			$dados['dt_cadastro'] = date("Y-m-d H:i:s");
			$dados['cd_usuario_solicitante'] = $_SESSION['usuario']['codigo'];
			$dados['id_status'] = 'A';
			$dados['nr_solicitacao'] = rand(1,999);
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
	
}

?>