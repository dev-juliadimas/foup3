<?php

/**
 * Classe Institucao, implementada no arquivo autor.class.php
 *
 * Instituicoes cadastradas no FOrum
 *
 * @author Marcelo Mazon
 * @version 1.0
 * @copyright 2023
 */

class autor extends BDados
{
	public $bloco = array("tabela" => "autor", "order_by" => "id");
	
	public $dados = 0;

	// url da lista
	public $url_lista = "autores.php";
	
	/**
	 * Metodo construtor do objeto
	 *
	 * @author Marcelo Mazon: 09/10/2022
	 * @return object Objeto pessoa
	 */
	
	public function __construct()
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

	public function GetDados($dados=false, $exato=false)
	{
		// comando para buscar a pessoa pelo c�digo	
		if ($dados)
		{
			if ($this->dados = parent::sql_select($dados,$exato)) 
			{
				return true;
			}
			else
				return false;
		}
		return true;
	}

	public function GetLista($dados=false)
	{
		$this->sql_select_lista($dados);
		return;
	}

	public function FetchDados()
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
	
	public function Update($dados)
	{
		if ($dados['id'] == "0" || $dados['id'] == '' )
		{
			// insert
			//$dados['dt_cadastro'] = date("Y-m-d H:i:s");
            //echo"<pre>"; print_r($dados); echo"</pre>";
			return parent::sql_insert($dados);
		}
		else
		{
			// update
			return parent::sql_update($dados);
		}
	}
	
	public function Delete($dados = false)
	{
		return parent::sql_delete($dados);
	}
	
	function ExibeLista()
	{
		header("Location: ".$this->url_lista);
	}

    public function InsereAutorPublicacao($id_autor, $id_publicacao)
    {
        $sql = "INSERT INTO autor_publicacao (id_autor, id_publicacao) VALUES ($id_autor, $id_publicacao)";
        if ($res = mysqli_query($this->con, $sql))
            return true;
        else
            return false;
    }


    public function GetEixosJson()
    {
        $sql = "select id, titulo 
                from eixo 
                order by id";

        $res = mysqli_query($this->con, $sql);

        $dados = array();

        while ($row = @mysqli_fetch_assoc($res)) {
            $dados[] = $row;
        }
        return json_encode($dados);
    }


	
}

?>