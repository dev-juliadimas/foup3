<?php

class Usuario extends BDados
{
	public $bloco = array("tabela" => "usuario", "order_by" => "nm_usuario");
	
	public $dados = 0;

	// url da lista
	public $url_lista = "rel_usuarios.php";
	
	/**
	 * Metodo construtor do objeto
	 *
	 * @author Marcelo Mazon: 09/10/2007
	 * @return object Objeto pessoa
	 */

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
		return;
	}

	
	public function CarregaLista()
	{
		$sql = "select u.*, s.nm_setor from usuario u, setor s
				  where u.cd_setor = s.cd_setor
				   and u.cd_empresa = ".$_SESSION['usuario']['empresa']."
				  order by u.nm_usuario";
		$res = mysql_query($sql);
		return $res;
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
		if ($dados['cd_usuario'] == "0")
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
	
	public function Delete($dados = false)
	{
		return parent::sql_delete($dados);
	}
	
	public function ExibeLista()
	{
		header("Location: ".$this->url_lista);
	}
	
	public function AcessoPrograma($dados)
	{
		//escrever....
	}
	
}

?>