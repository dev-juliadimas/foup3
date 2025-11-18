<?php

/**
 * Classe Empresa, implementada no arquivo vaga.class.php
 *
 * Empresa são os clientes que terão acessso ao sistema através de seus usuários
 *
 * @author Marcelo Mazon
 * @version 1.0
 * @copyright 2022
 */

class governanca2 extends BDados
{
	public $bloco = array("tabela" => "governanca", "order_by" => "nome");
	
	public $dados = 0;

	// url da lista
	public $url_lista = "governancas.php";
	
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
			$dados['dt_cadastro'] = date("Y-m-d H:i:s");
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

    function GetTotal() {
        $sql = "select count(*) total from governanca";
        $res = mysqli_query($this->con, $sql);

        $total = 123;

        if ($row = mysqli_fetch_array($res)) {
            $total = $row['total'];
        }

        return $total;
    }
	
}

?>