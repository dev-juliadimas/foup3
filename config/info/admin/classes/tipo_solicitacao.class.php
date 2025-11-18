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

class TipoSolicitacao extends BDados
{
	public $bloco = array("tabela" => "tipo_solicitacao", "order_by" => "cd_tipo_solicitacao");
	
	public $dados = 0;

	// url da lista
	public $url_lista = "rel_setores.php";
	
	/**
	 * Metodo construtor do objeto
	 *
	 * @author Marcelo Mazon: 09/10/2007
	 * @return object Objeto pessoa
	 */
	
	function TipoSolicitacao()
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

	function GetLista($dados=false)
	{
		$sql = "select * from tipo_solicitacao 
				where cd_tipo_solicitacao_pai is null 
				order by cd_tipo_solicitacao_pai, nm_tipo_solicitacao";
		$this->res = mysql_query($sql);
		return;
	}


	function GetListaSubTipos($cd_tipo_pai)
	{
		$sql = "SELECT * FROM tipo_solicitacao
				where cd_tipo_solicitacao_pai = $cd_tipo_pai
				order by nm_tipo_solicitacao";
		$this->res = mysql_query($sql);
		return;
	}

	function GetUsuariosEnvolvidos($cd_tipo)
	{
		$sql = "SELECT ue.*, u.nm_usuario, u.email
				FROM usuario_envolvido ue, usuario u
				WHERE ue.cd_usuario = u.cd_usuario
					and ue.cd_empresa = u.cd_empresa
					and ue.cd_empresa = ".$_SESSION['usuario']['empresa']."
					and ue.cd_tipo_solicitacao = ".$cd_tipo;
		$res = mysql_query($sql);
		while ($row = mysql_fetch_array($res))
		{
			$ar_envolvidos[$row['cd_usuario']] = $row;
		}
		
		return $ar_envolvidos;
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
		if ($dados['cd_tipo_solicitacao'] == "0")
		{
			$dados['dt_cadastro'] = date("Y-m-d H:i:s");
			return parent::sql_insert($dados);
		}
		else
		{
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