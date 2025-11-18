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

class Programa extends BDados
{
	public $bloco = array("tabela" => "programa", "order_by" => "cd_modulo, cd_programa");
	
	public $dados = 0;

	// url da lista
	public $url_lista = "rel_programas.php";
	
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
		if ($dados['cd_programa'] == "0")
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

    public function MenuEmpresaUsuario($cd_empresa, $cd_usuario) {
        $sql = "select m.nm_modulo, m.url_modulo, m.ds_modulo, p.*
            from modulo m, modulo_empresa ma, programa p, usuario_acesso ua
            where p.cd_programa = ua.cd_programa
                and p.cd_modulo = m.cd_modulo
                and m.cd_modulo = ma.cd_modulo
                and ma.cd_empresa = $cd_empresa
                and ua.cd_usuario = $cd_usuario
                and p.id_status = 'A'";

        $res = mysqli_query($this->con, $sql);

        while ($row = mysqli_fetch_array($res))
        {
            $menu[$row['nm_modulo']][] = array(
                'nm_modulo'     => $row['nm_modulo'],
                'cd_modulo'     => $row['cd_modulo'],
                'url_modulo'    => $row['url_modulo'],
                'cd_programa'   => $row['cd_programa'],
                'nm_programa'   => htmlentities($row['nm_programa']),
                'ds_programa'   => htmlentities($row['ds_programa']),
                'url_programa'  => $row['url_programa']
            );
        }
        return $menu;
    }
	
	function CarregaProgramas($cd_modulo = '')
	{
        $add_sql = ($cd_modulo !== '') ? " and p.cd_modulo = $cd_modulo " : '';

		$sql = "select p.* from programa p, usuario_acesso ua
			where p.cd_programa = ua.cd_programa
			 $add_sql
			 and ua.cd_usuario = ".$_SESSION['usuario']['codigo']."
			 and p.id_status = 'A'";
						 
 		$res = mysqli_query($this->con, $sql);
		
		while ($row = mysqli_fetch_array($res))
		{
			$programas[] = array('cd_programa'=>$row['cd_programa'],
									 'nm_programa'=>htmlentities($row['nm_programa']),
									 'ds_programa'=>htmlentities($row['ds_programa']),
									 'url_programa'=>$row['url_programa']);
		}
		return $programas;
	}

	function ProgramaAcesso($cd_usuario)
	{
		$sql = "select me.cd_modulo, m.nm_modulo, p.cd_programa, p.nm_programa, ua.cd_usuario, ua.in_autoriza, ua.in_libera, ua.in_conclui
				from modulo m, modulo_empresa me, programa p
				left join usuario_acesso ua on (ua.cd_programa = p.cd_programa and ua.cd_usuario = $cd_usuario)
				where me.cd_modulo = p.cd_modulo
				 and me.cd_modulo = m.cd_modulo
				 and me.cd_empresa = ".$_SESSION['usuario']['empresa']."
				order by m.nm_modulo, p.nm_programa";
						 
 		$res = mysqli_query($this->con, $sql);
		
		while ($row = mysqli_fetch_array($res))
		{
			$programas[] = $row;
		}
		return $programas;
	}

	function UsuarioAcesso($cd_usuario, $cd_programa, $cd_modulo)
	{
		$sql = "SELECT in_autoriza, in_libera, in_conclui FROM usuario_acesso
				where cd_usuario = 1
				and cd_programa = 14
				and cd_modulo = 1";
 		$res = mysqli_query($this->con, $sql);
		
		$permissao = false;
		
		if ($row = mysqli_fetch_array($res))
		{
			$permissao['acesso']   = 1;
			$permissao['autoriza'] = $row['in_autoriza'];
			$permissao['libera']   = $row['in_libera'];
			$permissao['conclui']  = $row['in_conclui'];
		}
		return $permissao;
	}
	
}

?>