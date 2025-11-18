<?php

class Setor extends BDados
{
	public $bloco = array("tabela" => "setor", "order_by" => "nm_setor");
	public $dados = 0;
    public $url_lista = "rel_setores.php";
	

    public function __construct()
    {
        parent::__construct($this->bloco);
    }


	public function GetDados($dados=false, $exato=false)
	{
		if ($dados)
		{
			if ($this->dados = parent::sql_select($dados,$exato)) 
				return true;
			else
				return false;
		}
		return true;
	}


	public function GetLista($dados=false)
	{
		$this->sql_select_lista($dados);
		return true;
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
		if ($dados['cd_setor'] == "0")
		{
			$dados['dt_cadastro'] = date("Y-m-d H:i:s");
			return parent::sql_insert($dados);
		}
		else
		{
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
	
}

?>