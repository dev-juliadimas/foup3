<?php

/**
 * Classe BDados
 *
 * Classe generica para implementar todas acoes com o banco
 *
 * @author Marcelo Mazon - 09/10/2007
 * @version 1.0
 * @copyright 2007
 */

class BDados
{

    var $database = "foup2";
    var $host = "localhost";
    var $user = "root";
    //var $user = "u617782901_foup";
    var $pwd = "";
    //var $pwd = "Foup@2023";
    var $porta = '3306';
    var $con;
    var $erro = "";
    var $bloco = array();
    var $colunas = array();


    //function BDados($bd)
    function __construct($bd)
    {
        //echo "criado obj BDados";
        if ($this->con = mysqli_connect($this->host, $this->user, $this->pwd, $this->database, $this->porta)) {
            //echo "Conectou!";
            mysqli_select_db($this->con, $this->database);
            $this->bloco = $bd; // seta o bloco de dados
            $this->set_colunas();

        } else
            echo "Erro ao conectar!";

    }

    /**
     * function set_colunas
     *
     * Configura as colunas da tabela para o Bloco de Dados
     *
     * @return array table_columns
     * @history 30/10/2009 - Versao inicial
     * @author Marcelo Mazon
     */

    private function set_colunas_para_fazer()
    {
        //$link = new mysqli('localhost', 'username', 'password', 'database');
        $query = mysqli_query($this->con, "DESCRIBE `{$this->bloco['tabela']}`");
        $i = 0;

        while ($result = $query->fetch_assoc()) {
            print_r($result);
            $coluna = $result['Field'];

            $tipo = $result['Type'];

            /// continuar....

            $this->bloco['coluna']['nome'][$i] = $coluna;
            $this->bloco['coluna']['tam'][$i] = mysqli_field_len($res_query, $i);
            $this->bloco['coluna']['flags'][$i] = mysqli_field_flags($res_query, $i);
            $this->bloco['coluna']['pk'][$i] = (strpos(mysqli_field_flags($res_query, $i), 'primary_key')) ? 1 : 0;

            ++$i;
        }

    }


    public function set_colunas_old()
    {
        $sql = "select * from " . $this->bloco['tabela'] . " where 1=2";
        $res_query = mysqli_query($this->con, $sql);
        $fields = mysqli_num_fields($res_query);
        $tipo = $nome = $tam = $flags = "";

        for ($i = 0; $i < $fields; $i++) {
            $this->bloco['coluna']['nome'][$i] = mysqli_field_name($res_query, $i);
            $this->bloco['coluna']['tam'][$i] = mysqli_field_len($res_query, $i);
            $this->bloco['coluna']['flags'][$i] = mysqli_field_flags($res_query, $i);
            $this->bloco['coluna']['pk'][$i] = (strpos(mysqli_field_flags($res_query, $i), 'primary_key')) ? 1 : 0;
            //$this->bloco['colunas']['type'][$i] = mysqli_field_type($res_query, $i);
            $tipo = strtolower(mysqli_field_type($res_query, $i));

            // agrupamentos de tipos com tratamentos identicos
            $ar_tipos['number'] = array('int', 'float', 'numeric', 'integer', 'bit', 'tinyint', 'smallint', 'bigint', 'double');
            $ar_tipos['text'] = array('text', 'varchar', 'string', 'char', 'set', 'enum', 'blob');
            $ar_tipos['date'] = array('date', 'datetime', 'timestamp', 'year', 'time');

            if (in_array($tipo, $ar_tipos['text']))
                $this->bloco['coluna']['tipo'][$i] = 'text';
            elseif (in_array($tipo, $ar_tipos['date']))
                $this->bloco['coluna']['tipo'][$i] = 'date';
            else
                $this->bloco['coluna']['tipo'][$i] = 'number';
        }
        return;
    }

    public function set_colunas()
    {
        $sql = "select * from " . $this->bloco['tabela'] . " where 1=2";
        $res_query = mysqli_query($this->con, $sql);
        $fields = mysqli_fetch_fields($res_query);

        //echo"<pre>";
        //$this->describe();
        //echo"</pre>";

        $tipo = $nome = $tam = $flags = "";
        $i = 0;

        foreach ($fields as $val) {
            /*echo"<pre>";
             printf("Name:     %s\n", $val->name);
             printf("Table:    %s\n", $val->table);
              printf("Len: %d\n", $val->length);
             printf("max. Len: %d\n", $val->max_length);
             printf("Flags:    %d\n", $val->flags);
             printf("Type:     %d\n\n", $val->type);
            echo"</pre>";*/
            //echo"<pre>";
            //print_r($val);
            //echo"</pre>";

            $this->bloco['coluna']['nome'][$i] = $val->name;
            $this->bloco['coluna']['tam'][$i] = $val->length;
            $this->bloco['coluna']['flags'][$i] = $val->flags;

            if ($val->flags & 2) {
                $this->bloco['coluna']['pk'][$i] = 1;
            }

            $this->bloco['coluna']['pk'][$i] = ($val->flags & 2) ? 1 : 0;
            $this->bloco['coluna']['tipo'][$i] = $this->map_field_type_to_bind_type($val->type);

            ++$i;
        }
        return;
    }

    private function get_tamanhos($res)
    {
        /* display column lengths */
        foreach (mysqli_fetch_lengths($res) as $i => $val) {
            printf("Field %2d has length: %2d\n", $i + 1, $val);
        }
    }

    private function describe()
    {
        //$link = new mysqli('localhost', 'username', 'password', 'database');
        $query = mysqli_query($this->con, "DESCRIBE `{$this->bloco['tabela']}`");
        $desired_column = 'id';
        $id = null;
        while ($result = $query->fetch_assoc()) {
            /*if($result['Field'] == $desired_column) {
                $field_type = $result['Type'];
                preg_match('#\((.*?)\)#', $field_type, $match);
                $id = $match[1];
            }*/
            print_r($result);
        }

        echo $id; // 11
    }

    private function map_field_type_to_bind_type($field_type)
    {
        switch ($field_type) {
            case MYSQLI_TYPE_DECIMAL:
            case MYSQLI_TYPE_NEWDECIMAL:
            case MYSQLI_TYPE_FLOAT:
            case MYSQLI_TYPE_DOUBLE:
                //return 'd';
                return 'number';

            case MYSQLI_TYPE_BIT:
            case MYSQLI_TYPE_TINY:
            case MYSQLI_TYPE_SHORT:
            case MYSQLI_TYPE_LONG:
            case MYSQLI_TYPE_LONGLONG:
            case MYSQLI_TYPE_INT24:
            case MYSQLI_TYPE_YEAR:
            case MYSQLI_TYPE_ENUM:
                //return 'i';
                return 'number';

            case MYSQLI_TYPE_TIMESTAMP:
            case MYSQLI_TYPE_DATE:
            case MYSQLI_TYPE_TIME:
            case MYSQLI_TYPE_DATETIME:
            case MYSQLI_TYPE_NEWDATE:
            case MYSQLI_TYPE_INTERVAL:
            case MYSQLI_TYPE_SET:
            case MYSQLI_TYPE_VAR_STRING:
            case MYSQLI_TYPE_STRING:
            case MYSQLI_TYPE_CHAR:
            case 252: // text
            case MYSQLI_TYPE_GEOMETRY:
                //return 's';
                return 'text';

            case MYSQLI_TYPE_TINY_BLOB:
            case MYSQLI_TYPE_MEDIUM_BLOB:
            case MYSQLI_TYPE_LONG_BLOB:
            case MYSQLI_TYPE_BLOB:
                return 'binary';

            default:
                trigger_error("unknown type: $field_type");
                return 'text';
        }
    }

    /**
     * function sql_insert
     *
     * Executa um comando de insert no banco, baseando-se no bloco e nos dados recebidos
     *
     * @author Marcelo Mazon
     * @history 09/10/2007 - Versao inicial
     */

    function sql_insert($dados)
    {
        $TotalColunas = count($this->bloco['coluna']['nome']);

        //echo "<pre>";
        //print_r($this->bloco);
        //echo "</pre>";

        $list1 = "INSERT INTO " . $this->bloco['tabela'] . " \n  (";
        $list2 = " (";

        for ($i = 0; $i < $TotalColunas; $i++) {
            if ($this->bloco['coluna']['tipo'][$i] != '+')  // se nao for auto-increment
            {
                if (isset($dados[$this->bloco['coluna']['nome'][$i]])) {
                    $list1 .= $this->bloco['coluna']['nome'][$i] . ", ";    // lista das colunas!
                    $list2 .= GetSQLValueString($dados[$this->bloco['coluna']['nome'][$i]], $this->bloco['coluna']['tipo'][$i]) . ", ";
                }
            }
        }

        //die();

        $list1 = substr($list1, 0, strlen($list1) - 2) . ")\nVALUES \n";
        $list2 = substr($list2, 0, strlen($list2) - 2) . ")";

        $sql = "$list1 $list2";
        $res = @mysqli_query($this->con, $sql);

        if ($res) {
            //$this->botoes = botoes(1,2,1,1,0,0,0,0);
            return mysqli_insert_id($this->con);
        } else {
            echo "<TEXTAREA NAME=\"t\" ROWS=\"10\" COLS=\"80\">$sql</TEXTAREA>"; //exit;
            $this->erro = mysqli_errno($this->con) . ": " . mysqli_error($this->con) . "\n";
            die('<table width="100%"><tr><td align="center" bgcolor="#F0F0F0"><FONT SIZE="2" face="Verdana"><b>N�o foi possivel executar comando solicitado!<br>(' . $this->erro . ')</b><br>' . $sql . '<br><br><A HREF="javascript:history.back()">Voltar</A></font></td></tr></table>');
            return false;
        }
    }

    /**
     * function sql_delete
     *
     * Delete o registro especificado em $dados
     *
     * @author Marcelo Mazon
     * @history 09/10/2007 - Vers?o inicial
     */

    function sql_delete($dados)
    {
        if (!$dados) // se n�o passou dados, tenta pegar os dados setados no objeto
        {
            $dados = (array)$this->dados; // typecast pra array
        }

        $TotalColunas = count($this->bloco['coluna']['nome']);
        $list1 = "DELETE FROM " . $this->bloco['tabela'] . " WHERE \n";

        for ($i = 0; $i < $TotalColunas; ++$i) {
            if ($this->bloco['coluna']['pk'][$i] == 1)
                $list1 .= $this->bloco['coluna']['nome'][$i] . " = " . GetSQLValueString($dados[$this->bloco['coluna']['nome'][$i]], $this->bloco['coluna']['tipo'][$i], $this->con) . " AND \n";
        }

        $sql = substr($list1, 0, strlen($list1) - 6);
        $res = @mysqli_query($this->con, $sql);

        //echo"<TEXTAREA NAME=\"t\" ROWS=\"10\" COLS=\"80\">$sql</TEXTAREA>"; exit;

        if ($res) {
            return true;
        } else {
            $this->erro = mysqli_errno($this->con) . ": " . mysqli_error($this->con) . "\n";
            die('<table width="100%"><tr><td align="center" bgcolor="#F0F0F0"><FONT SIZE="2" face="Verdana"><b>N�o foi poss�vel executar comando solicitado!<br>(' . $this->erro . ')</b><br><A HREF="javascript:history.back()">Voltar</A></font></td></tr></table>');
            return false;
        }
    }

    function sql_update($dados)
    {
        $TotalColunas = count($this->bloco['coluna']['nome']);
        //$sql_select    = $dados['sql_select'];
        //$w_total       = $dados['w_total'];
        //$w_index       = $dados['w_index'];

        $list1 = "UPDATE " . $this->bloco['tabela'] . " SET \n";
        $list2 = "WHERE ";

        for ($i = 0; $i < $TotalColunas; ++$i) {
            if (isset($dados[$this->bloco['coluna']['nome'][$i]])) {
                if ($this->bloco['coluna']['pk'][$i] == 1)
                    $list2 .= $this->bloco['coluna']['nome'][$i] . " = " . GetSQLValueString($dados[$this->bloco['coluna']['nome'][$i]], $this->bloco['coluna']['tipo'][$i], $this->con) . " AND \n";
                else
                    $list1 .= $this->bloco['coluna']['nome'][$i] . " = " . GetSQLValueString($dados[$this->bloco['coluna']['nome'][$i]], $this->bloco['coluna']['tipo'][$i], $this->con) . ",\n";
            }
        }

        $list1 = substr($list1, 0, strlen($list1) - 2);
        $list2 = substr($list2, 0, strlen($list2) - 6);

        $sql = $list1 . "\n" . $list2;
        //echo"<TEXTAREA NAME=\"t\" ROWS=\"10\" COLS=\"80\">$sql</TEXTAREA>"; exit;
        $res = @mysqli_query($this->con, $sql);

        if ($res) {
            ///$this->botoes = botoes(1,2,1,1,0,0,0,0);
            return true;
        } else {
            echo "<TEXTAREA NAME=\"t\" ROWS=\"10\" COLS=\"80\">$sql</TEXTAREA>";
            exit;
            $this->erro = mysqli_errno($this->con) . ": " . mysqli_error($this->con) . "\n";
            die('<table width="100%"><tr><td align="center" bgcolor="#F0F0F0"><FONT SIZE="2" face="Verdana"><b>N�o foi poss�vel executar comando solicitado!<br>(' . $this->erro . ')</b><br><A HREF="javascript:history.back()">Voltar</A></font></td></tr></table>');
            return false;
        }
    }

    function sql_select($dados, $exato = false)
    {
        //print_r($bloco);
        //print_r($dados);

        $TotalColunas = count($this->bloco['coluna']['nome']);

        $list1 = "SELECT * FROM " . $this->bloco['tabela'];
        $list2 = "WHERE ";
        $list3 = "ORDER BY " . $this->bloco['order_by'];

        for ($i = 0; $i < $TotalColunas; ++$i) {
            // if ($this->bloco['db_item'][$i] == 1)
            //echo $i;
            //echo $dados[$this->bloco['coluna']['nome'][$i]];
            if ((isset($dados[$this->bloco['coluna']['nome'][$i]])) and ($dados[$this->bloco['coluna']['nome'][$i]] != "")) {
                if ($exato)
                    $list2 .= $this->bloco['coluna']['nome'][$i] . " = '" . $dados[$this->bloco['coluna']['nome'][$i]] . "' AND \n";
                else
                    $list2 .= $this->bloco['coluna']['nome'][$i] . " LIKE '" . $dados[$this->bloco['coluna']['nome'][$i]] . "' AND \n";
            }
        }

        $list2 = substr($list2, 0, strlen($list2) - 6); # remove quebra de linha e o 'AND' da Ultima iteracao.

        $sql_select = $list1 . "\n" . $list2 . "\n" . $list3;

        //echo"<TEXTAREA NAME=\"t\" ROWS=\"10\" COLS=\"80\">$sql_select</TEXTAREA>"; //exit;
        $res = mysqli_query($this->con, $sql_select);

        if ($res) {
            if ($oRow = @mysqli_fetch_object($res)) {
                return $oRow;
            } else {
                return false;
            }
        } else {
            $this->erro = mysqli_errno($this->con) . ": " . mysqli_error($this->con) . "\n";
            die('<table width="100%"><tr><td align="center" bgcolor="#F0F0F0"><FONT SIZE="2" face="Verdana"><b>N�o foi poss�vel executar comando solicitado!<br>(' . $this->erro . ')</b><br><A HREF="javascript:history.back()">Voltar</A></font></td></tr></table>');
            return false;
        }

    }

    function sql_select_lista($dados)
    {
        //print_r($bloco);

        $TotalColunas = count($this->bloco['coluna']['nome']);

        $list1 = "SELECT * FROM " . $this->bloco['tabela'];
        $list2 = "WHERE 1 ";
        $list3 = "ORDER BY " . $this->bloco['order_by'];

        if (isset($dados) && is_array($dados))
        {
            foreach ($dados as $k => $v)
            {
                $list2 .= " AND $k = '$v'";
            }
        }

        $sql_select = $list1 . "\n" . $list2 . "\n" . $list3;
        //echo"<TEXTAREA NAME=\"t\" ROWS=\"10\" COLS=\"80\">$sql_select</TEXTAREA>"; //exit;

        $this->res = mysqli_query($this->con, $sql_select);

        if ($this->res) {
            return true;
            //if ($oRow = @mysqli_fetch_object($this->res))
            //{
            //	return $oRow;
            //}
            //else
            //{
            //	return false;
            //}
        } else {
            echo "<TEXTAREA NAME=\"t\" ROWS=\"10\" COLS=\"80\">$sql_select</TEXTAREA>"; //exit;
            $this->erro = mysqli_errno($this->con) . ": " . mysqli_error($this->con) . "\n";
            die('<table width="100%"><tr><td align="center" bgcolor="#F0F0F0"><FONT SIZE="2" face="Verdana"><b>N�o foi poss�vel executar comando solicitado!<br>(' . $this->erro . ')</b><br><A HREF="javascript:history.back()">Voltar</A></font></td></tr></table>');
            return false;
        }
    }

}

?>