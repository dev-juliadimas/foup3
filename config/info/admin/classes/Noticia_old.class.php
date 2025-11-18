<?php

/**
 * Classe Idioma, implementada no arquivo idioma.class.php
 *
 * Aqui vai alguma descriчуo do arquivo
 *
 * @author Marcelo Mazon
 * @version 1.0
 * @copyright 2007
**/

class Noticia_old extends BDados
{
	// info da tabela
	var $bloco = array("tabela"   => "noticia",
		 				"order_by" => "id",
		  				"coluna"   => array('id','usuario_id','ds_titulo','ds_resumo', 'ds_noticia', 'dt_cadastro'),
   						"tipo"     => array('+','number','text','text','text','date'),
   						"pk"       => array(1,0,0,0,0,0),
						"db_item"  => array(1,1,1,1,0,0));

	// informaчѕes fetchadas do result	
	var $dados = 0;

	// url da lista
	var $url_lista = "r_noticias.php";
	
	// colunas da tabela
	var $id = 0;
	var $ds_titulo;
	var $ds_resumo;
	var $ds_noticia;
	var $dt_cadastro;
		
	// colunas relacionadas
	var $usuario_id;
	
	
	/**
	 * Metodo construtor do objeto
	 *
	 * @author Marcelo Mazon: 09/10/2007
	 * @return object Objeto pessoa
	 */
	
	function Noticia()
	{
		//echo"criado obj pessoa";
		parent::BDados();
	}
	
	
	
	/**
	 * Busca os dados solicitados, setando o objeto com a 1a. ocorrencia encontrada 
	 *
	 * @author Marcelo Mazon: 09/10/2007
	 * @param array $dados Array com as informaчѕes para a busca
	 * @return bool
	 */

	function GetDados($dados=false)
	{
		// comando para buscar a pessoa pelo cѓdigo
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
		$this->usuario_id	= $this->dados->usuario_id;
		$this->ds_titulo	= $this->dados->ds_titulo;
		$this->ds_resumo	= $this->dados->ds_resumo;
		$this->ds_noticia	= $this->dados->ds_noticia;
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
			$dados['usuario_id'] = 1; // alimentando a variavel usuario, isso serс controlado por session
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