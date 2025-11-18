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

class Noticia extends BDados
{
	public $bloco = array("tabela" => "noticia", "order_by" => "id desc");
	
	public $dados = 0;

	// url da lista
	public $url_lista = "noticias.php";
	
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
		if ($dados['id'] == "0")
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
	
	function Delete($dados = false)
	{
		return parent::sql_delete($dados);
	}
	
	function ExibeLista()
	{
		header("Location: ".$this->url_lista);
	}

    function getUltimasNoticias($limite = 6, $id_not = false)
    {
        $add_sql = '';
        if ($id_not)
            $add_sql = " and id not in ($id_not) ";

        $sql = "select * from noticia 
                where id_status = 'A'
                $add_sql
                order by dt_noticia desc
                limit $limite";
        $res = mysqli_query($this->con, $sql);

        $dados = array();
        while ($row = @mysqli_fetch_array($res)) {
            $dados[] = $row;
        }
        return $dados;
    }

}

?>