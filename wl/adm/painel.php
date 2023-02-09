<style>
    td {
        border: 1px solid rgb(0, 0, 0, 1);
    }

    select {
        width: 300px;
        padding: 10px 18px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;

    }
</style>
<script src="https://code.jquery.com/jquery-3.6.3.js"></script>
<style>
.not_efeito{
    background-color: rgb(0,0,0,0);
    border-color: rgb(0,0,0,0);
    font-size: 15px;
}

</style>
<form action="" method="post" enctype="multipart/form-data">
<table>
    <tr>
        <td>1</td>
        <td>2.dxf</td>
    </tr>
    <tr>
        <td>2</td>
        <td></td>
    </tr>
</table>
</form>

<?php
if (isset($_POST['ian'])) {
    echo 'ian';
}
if (isset($_POST['olo'])) {
    echo 'olo';
}


?>
<?php

function tabela($valores, $valores1, $titulo, $itens, $nomes_itens, $php,$html=[],$type='')
{
    
   if($valores1==[]){
    sort($valores);
   }

   
    $result = '<table width=70% cellspacing="0" cellpadding="5"><form action="" method="POST"><form action="" method="post" enctype="multipart/form-data"><tr></tr><tr>';
    $result .= '<td><h4> Id </h4></td>';
    for ($i = 0; $i < count($titulo); $i++) {
      
        $result .= '<td><h4>' . $titulo[$i] . '</h4></td>';
    
}
    $result .= '</tr>';
    $php_result = '';
    for ($i = 0; $i < count($valores); $i++) {

        if ($type != 'text_button') {
            $result .= '<tr><td>' . $i + 1 . '</td>';
            $result .= '<td>' . $valores[$i] . '</td>';
            if ($valores1 != []) {
                $result .= '<td>' . $valores1[$i] . '</td>';
            }
        }else{
            
            $result .= '<tr><td><button name="butao_tabela'.$i.'" class="not_efeito" type="submit">' . $i + 1 . '</button></td>';
       
            $result .= '<td><button name="butao_tabela'.$i.'" class="not_efeito" type="submit">' . $valores[$i] . '</button></td>';
            if ($valores1 != []) {
                $result .= '<td><button name="butao_tabela'.$i.'" class="not_efeito" type="submit">' . $valores1[$i] . '</button></td>';
            }
        }
        for ($l = 0; $l < count($itens); $l++) {
            $result .= '<td align="center"><input type="' . $itens[$l] . '" value="' . $nomes_itens[$l] . '" id="' . $nomes_itens[$l] . $i . '" name="' . $nomes_itens[$l] . $i . '"></td>';
            if($php!=''){
            eval('$php_result.=' . $php);
            }
        }
      
        $result .= '</tr>';
    }
    if($php!=''){
    for ($l = 0; $l < count($html); $l++) {
        
        eval('$php_result.=' . $php);
        
       

    }}

    return [$result . '</form></table>', $php_result];
}
include('../config/login/verifica_login.php');
include('../config/db/comandos.php');
include('../config/db/conexao.php');
date_default_timezone_set('America/Sao_Paulo');

menu($_SESSION['usuario'], '<li><input type="submit" name="filtros" value="Tipo de Arquivo" /></li>
<li><input type="submit" name="empreendimento" value="empreendimento" /></li><li><input type="submit" name="empresa" value="Empresa/Cliente" /></li><li><input type="submit" name="finalidade" value="finalidade" /></li><li><input type="submit" name="prioridade" value="prioridade" /></li><li><input type="submit" name="usuarios" value="usuario" /></li><li><input type="submit" name="desenho" value="Desenhos" /></li>');
echo '<div class="main">';




function retorne($session_origem, $session)
{
    $_SESSION = ['usuario' => $_SESSION['usuario'], $session => true, $session_origem => true];

}
if (isset($_POST['sair'])) {
    reload('../config/login/logout.php');
}
if (isset($_POST['empreendimento'])) {
    retorne('empreendimento', 'empreendimento');
}
if (isset($_POST['desativar_empreendimento'])) {
    retorne('desativar_empreendimento', 'empreendimento');
}
if (isset($_POST['ativar_empreendimento'])) {
    retorne('ativar_empreendimento', 'empreendimento');
}
if (isset($_POST['add_empreendimento'])) {
    retorne('add_empreendimento', 'empreendimento');
}

if (isset($_POST['empresa'])) {
    retorne('empresa', 'empresa');
}
if (isset($_POST['desativar_empresa'])) {
    retorne('desativar_empresa', 'empresa');
}
if (isset($_POST['ativar_empresa'])) {
    retorne('ativar_empresa', 'empresa');
}
if (isset($_POST['add_empresa'])) {
    retorne('add_empresa', 'empresa');
}

if (isset($_POST['filtros'])) {
    retorne('filtros', 'filtros');
}
if (isset($_POST['desativar_filtros'])) {
    retorne('desativar_filtros', 'filtros');
}
if (isset($_POST['ativar_filtros'])) {
    retorne('ativar_filtros', 'filtros');
}
if (isset($_POST['add_filtros'])) {
    retorne('add_filtros', 'filtros');
}

if (isset($_POST['finalidade'])) {
    retorne('finalidade', 'finalidade');
}
if (isset($_POST['desativar_finalidade'])) {
    retorne('desativar_finalidade', 'finalidade');
}
if (isset($_POST['ativar_finalidade'])) {
    retorne('ativar_finalidade', 'finalidade');
}
if (isset($_POST['add_finalidade'])) {
    retorne('add_finalidade', 'finalidade');
}

if (isset($_POST['prioridade'])) {
    retorne('prioridade', 'prioridade');
}
if (isset($_POST['desativar_prioridade'])) {
    retorne('desativar_prioridade', 'prioridade');
}
if (isset($_POST['ativar_prioridade'])) {
    retorne('ativar_prioridade', 'prioridade');
}
if (isset($_POST['add_prioridade'])) {
    retorne('add_prioridade', 'prioridade');
}

if (isset($_POST['usuarios'])) {
    retorne('usuarios', 'usuarios');
}
if (isset($_POST['desativar_usuarios'])) {
    retorne('desativar_usuarios', 'usuarios');
}
if (isset($_POST['ativar_usuarios'])) {
    retorne('ativar_usuarios', 'usuarios');
}
if (isset($_POST['add_usuarios'])) {
    retorne('add_usuarios', 'usuarios');
}

if (isset($_POST['desenho'])) {
    retorne('desenho', 'desenho');
}
if (isset($_POST['corte_desenho'])) {
    retorne('corte_desenho', 'desenho');
}
if (isset($_POST['cortados_desenho'])) {
    retorne('cortados_desenho', 'desenho');
}
if (isset($_POST['relatorio_desenho'])) {
    retorne('relatorio_desenho', 'desenho');
}
if ($_SESSION == ['usuario' => $_SESSION['usuario']]) {
    retorne('desenho', 'desenho');
}

if (true) { //filtros
    if (isset($_POST['filtros']) || isset($_SESSION['filtros'])) {
        echo ('<table  cellspacing="0" cellpadding="5">
        <form action="" method="post" enctype="multipart/form-data"><tr>
        <td><input type="submit" name="add_filtros" value="Add Tipo de Arquivo" /></td>
        <td><input type="submit" name="desativar_filtros" value="Desativar um Tipo de Arquivo" /></td>
        <td><input type="submit" name="ativar_filtros" value="Ativar um Tipo de Arquivo" /></td>
        </form>
        </table>');
        $_SESSION['ini_filtros'] = true;
    }

    if (isset($_POST['desativar_filtros']) || isset($_SESSION['desativar_filtros'])) {
        unset($_SESSION['ini_filtros']);
        


        $php = '"
        if(isset(\$_POST[\'" . $nomes_itens[$l] . $i . "\'])){
            sql(\"UPDATE `filtros` SET `status`=\'desativado\' WHERE `nome`=\'" . $valores[$i] . "\' \");
            sql(\"INSERT INTO `historico_adm`(`nome`,`id_adm`, `item`, `status`,  `data_add`) VALUES (\'" . nome_id(\'filtros\',$valores[$i],\'nome\') . "\',\'' . nome_id('usuarios',$_SESSION['usuario'],'nome') . '\',\'filtros\',\'desativado\',\'\".date(\'d/m/Y H:i:s\').\"\')\");
            reload(\'painel.php\');
        }";';
        
        $array_nome = select_lin('filtros', 'nome', '`status` = \'ativo\'');
        $result = tabela($array_nome, [], ['Tipo de Arquivos', ' '], ['submit'], ['Desativar'], $php);
        echo ($result[0]);
        eval($result[1]);
        $_SESSION['desativar_filtros'] = true;
    }

    if (isset($_POST['ativar_filtros']) || isset($_SESSION['ativar_filtros'])) {
        unset($_SESSION['ini_filtros']);
        $array_nome = select_lin('filtros', 'nome', '`status` = \'desativado\'');


        $php = '"
        if(isset(\$_POST[\'" . $nomes_itens[$l] . $i . "\'])){
            sql(\"UPDATE `filtros` SET `status`=\'ativo\' WHERE `nome`=\'" . $valores[$i] . "\' \");
            sql(\"INSERT INTO `historico_adm`(`nome`,`id_adm`, `item`, `status`,  `data_add`) VALUES (\'" . nome_id(\'filtros\',$valores[$i],\'nome\') . "\',\'' . nome_id('usuarios',$_SESSION['usuario'],'nome') . '\',\'filtros\',\'ativo\',\'\".date(\'d/m/Y H:i:s\').\"\')\");
            reload(\'painel.php\');
        }";';

        $result = tabela($array_nome, [], ['Tipo de Arquivos', ' '], ['submit'], ['Ativar'], $php);
        echo ($result[0]);
        eval($result[1]);
        $_SESSION['ativar_filtros'] = true;
    }


    if (isset($_POST['add_filtros']) || isset($_SESSION['add_filtros'])) {
        $_SESSION['ini_filtros'] = true;
        echo ('<form action="" method="POST">
        <table border="1" cellspacing="0" class="relative"cellpadding="5"><form action="" method="POST"><tr></tr><tr><td>Nome</td><td></td></tr><tr>                          
        <td><input type="text" placeholder="Insira o nome do novo Tipo de Arquivos" name="filtros_nome" autofocus></td>
        <td><input type="submit" name="add_filtros1" value="Adicionar" /></td>
        </tr></table>
        </form>');
        $_SESSION['add_filtros'] = true;
    }
    if (isset($_POST['add_filtros1'])) {
        if ($_POST['filtros_nome'] != '') {
            $result = sql("SELECT * FROM `filtros` WHERE `nome` = '" . $_POST['filtros_nome'] . "'");
            if (!mysqli_num_rows($result)) {
                sql("INSERT INTO `filtros`(`individuo`, `data_hora_add`,`nome`, `status`) VALUES ('" . nome_id('usuarios',$_SESSION['usuario'],'nome') . "','" . date('d/m/Y H:i:s') . "','" . $_POST['filtros_nome'] . "','ativo')");
                //$_SESSION = ['usuario' => $_SESSION['usuario']];
                reload('painel.php');
            } else {
                alert('ja existe um filtro com esse nome \nobs:verifique os filtros desativadas');
            }

        } else {
            alert('É preciso prencher o nome do filtros');
        }





    }
    if(isset($_SESSION['ini_filtros'])){
        
    $array_nome = select_lin('filtros', 'nome', '');
      
     
            $php = '"
            
            if(isset(\$_POST[\'butao_tabela".$l."\'])){
                modal(\'Renomear\', \'<p>Coloque um novo nome para ".$valores[$l]."</p><p><input class=\"input_text\" type=\"text\" name=\"novo_nome".$l."\" multiple=\"multiple\" autofocus/></p>\', \'botao_novo_nome".$l."\', \'Mudar\');

            }  
            if(isset(\$_POST[\'botao_novo_nome".$l."\'])){
                \$row = mysqli_num_rows(sql(\"SELECT * FROM `filtros` WHERE `nome` = \'\".\$_POST[\'novo_nome".$l."\'].\"\'\"));
              
                if(!\$row){
                           
                            sql(\"INSERT INTO `historico_adm`(`info_mais`,`nome`,`id_adm`, `item`, `status`, `data_add`) VALUES (\'".$valores[$l]."\',\'" . nome_id(\'filtros\',$valores[$l],\'nome\') . "\',\'' . nome_id('usuarios',$_SESSION['usuario'],'nome') . '\',\'filtros\',\'auterou_nome\',\'\".date(\'d/m/Y H:i:s\').\"\')\");
                            sql(\"UPDATE `filtros` SET `nome`=\'\".\$_POST[\'novo_nome".$l."\'].\"\' WHERE `nome`=\'".$valores[$l]."\'\");
                            reload(\'painel.php\');
                }else{
                            alert(\"Já existe esse nome\");
                }
            }
            
            ";';
            

           
           
            
            
    
    $result = tabela($array_nome, [], ['Tipo de Arquivos'], [], [], $php,$array_nome,'text_button');
    echo ($result[0]);
    eval($result[1]);
       
    }
}


if (true) { //empreendimento
    if (isset($_POST['empreendimento']) || isset($_SESSION['empreendimento'])) {

        echo ('<table  cellspacing="0" cellpadding="5">
    <form action="" method="post" enctype="multipart/form-data"><tr>
    <td><input type="submit" name="add_empreendimento" value="Add Empreendimento" /></td>
    <td><input type="submit" name="desativar_empreendimento" value="Desativar Empreendimento" /></td>
    <td><input type="submit" name="ativar_empreendimento" value="Ativar Empreendimento" /></td>
    </form>
    </table><br>');
        $_SESSION['ini_empreendimento'] = true;
    }


    if (isset($_POST['desativar_empreendimento']) || isset($_SESSION['desativar_empreendimento'])) {
        unset($_SESSION['ini_empreendimento']);
        $array_nome = select_lin('empreendimentos', 'nome', '`status` = \'ativo\'');
    
        sort($array_nome);
        $array_id_empresa = [];
        for ($i=0; $i < count($array_nome); $i++) { 
        array_push($array_id_empresa, select_lin('empreendimentos', 'empresa_id', '`nome` = \''.$array_nome[$i].'\'')[0]);
        }
        $array_empresa = [];

        $php = '"
    if(isset(\$_POST[\'" . $nomes_itens[$l] . $i . "\'])){
        \$id = select_lin(\'empresa\',\'id\',\"`nome`=\'" . $valores1[$i] . "\'\");
        sql(\"UPDATE `empreendimentos` SET `status`=\'desativado\' WHERE `nome`=\'" . $valores[$i] . "\' and `empresa_id` = \'\".\$id[0].\"\'\");
        sql(\"INSERT INTO `historico_adm`(`info_mais`,`nome`,`id_adm`, `item`, `status`, `data_add`) VALUES (\'\".\$id[0].\"\',\'" . nome_id(\'empreendimentos\',$valores[$i],\'nome\') . "\',\'' . nome_id('usuarios',$_SESSION['usuario'],'nome') . '\',\'empreendimento\',\'desativado\',\'\".date(\'d/m/Y H:i:s\').\"\')\");
        reload(\'painel.php\');
    }";';
        for ($i = 0; $i < count($array_id_empresa); $i++) {
            array_push($array_empresa, select_lin('empresa', 'nome', '`id` = \'' . $array_id_empresa[$i] . '\'')[0]);
        }

        $result = tabela($array_nome, $array_empresa, ['Empreendimentos', 'Empresas/Clientes', ' '], ['submit'], ['Desativar'], $php);
        echo ($result[0]);
        eval($result[1]);

    }

    if (isset($_POST['ativar_empreendimento']) || isset($_SESSION['ativar_empreendimento'])) {
        unset($_SESSION['ini_empreendimento']);
        $array_nome = select_lin('empreendimentos', 'nome', '`status` = \'desativado\'');
        sort($array_nome);
        $array_id_empresa = [];
        for ($i=0; $i < count($array_nome); $i++) { 
        array_push($array_id_empresa, select_lin('empreendimentos', 'empresa_id', '`nome` = \''.$array_nome[$i].'\'')[0]);
        }
        $array_empresa = [];
        for ($i = 0; $i < count($array_id_empresa); $i++) {
            array_push($array_empresa, select_lin('empresa', 'nome', '`id` = \'' . $array_id_empresa[$i] . '\'')[0]);
        }


        $php = '"
    if(isset(\$_POST[\'" . $nomes_itens[$l] . $i . "\'])){
        \$id = select_lin(\'empresa\',\'id\',\"`nome`=\'" . $valores1[$i] . "\'\");
        sql(\"UPDATE `empreendimentos` SET `status`=\'ativo\' WHERE `nome`=\'" . $valores[$i] . "\' and `empresa_id` = \'\".\$id[0].\"\'\");
        sql(\"INSERT INTO `historico_adm`(`info_mais`,`nome`,`id_adm`, `item`, `status`, `data_add`) VALUES (\'\".\$id[0].\"\',\'" . nome_id(\'empreendimentos\',$valores[$i],\'nome\') . "\',\'' . nome_id('usuarios',$_SESSION['usuario'],'nome') . '\',\'empreendimento\',\'ativo\',\'\".date(\'d/m/Y H:i:s\').\"\')\");
        reload(\'painel.php\');
    }";';
        $result = tabela($array_nome, $array_empresa, ['Empreendimentos', 'Empresas/Clientes', ' '], ['submit'], ['Ativar'], $php);
        echo ($result[0]);
        eval($result[1]);
    }

    if (isset($_POST['add_empreendimento']) || isset($_SESSION['add_empreendimento'])) {
        $_SESSION['ini_empreendimento'] = true;
        $empresa = cascata(select('empresa', 'nome', '`status` = \'ativo\''));
        echo ('<form action="" method="POST">  
        <table border="1" cellspacing="0" class="relative"cellpadding="5"><form action="" method="POST"><tr></tr><tr><td>Nome</td><td>Empresa/Cliente</td><td></td></tr><tr>                       
        <td><input type="text" placeholder="Insira o nome do novo Empreendimento" name="empreendimento_nome" autofocus></td>
        <td><select placeholder="Escolha a empresa" name="empreendimento_empresa">' . $empresa . '</select></td>
        <td><input type="submit"  name="add_empreendimento1" value="Adicionar" /></td>
        </tr></table>
    </form>');

    }
    if (isset($_POST['add_empreendimento1'])) {
        if ($_POST['empreendimento_empresa'] != '') {
            if ($_POST['empreendimento_nome'] != '') {
                $id = select_lin('empresa', 'id', "`nome` = '" . $_POST['empreendimento_empresa'] . "'");
                $result = sql("SELECT * FROM `empreendimentos` WHERE `nome` = '" . $_POST['empreendimento_nome'] . "' and `empresa_id` = '" . $id[0] . "'");
                if (!mysqli_num_rows($result)) {
                    sql("INSERT INTO `empreendimentos`(`individuo`, `data_hora_add`,`nome`, `empresa_id`, `status`) VALUES ('" . nome_id('usuarios',$_SESSION['usuario'],'nome') . "','" . date('d/m/Y H:i:s') . "','" . $_POST['empreendimento_nome'] . "','" . $id[0] . "','ativo')");
                    //$_SESSION = ['usuario' => $_SESSION['usuario']];
                    reload('painel.php');
                } else {
                    alert('ja existe um empreendimento com esse nome nessa empresa\nobs:verifique nos empreendimentos desativados');
                }

            } else {
                alert('É preciso prencher o nome do empreendimento');
            }
        } else {
            if ($_POST['empreendimento_nome'] != '') {
                alert('É preciso prencher a empresa do empreendimento');
            } else {
                alert('É preciso prencher a empresa e o nome do empreendimento');
            }
        }




    }
    if(isset($_SESSION['ini_empreendimento'])){
        $array_nome = select_lin('empreendimentos', 'nome', '');
        sort($array_nome);
        $php = '';

        $php = '"
            
        if(isset(\$_POST[\'butao_tabela".$l."\'])){
            modal(\'Renomear\', \'<p>Coloque um novo nome para ".$valores[$l]."</p><p><input class=\"input_text\" type=\"text\" name=\"novo_nome".$l."\" multiple=\"multiple\" autofocus/></p>\', \'botao_novo_nome".$l."\', \'Mudar\');

        }  
        if(isset(\$_POST[\'botao_novo_nome".$l."\'])){
            \$row = mysqli_num_rows(sql(\"SELECT * FROM `empreendimentos` WHERE `nome` = \'\".\$_POST[\'novo_nome".$l."\'].\"\'\"));
          
            if(!\$row){
                       
                        sql(\"INSERT INTO `historico_adm`(`info_mais`,`nome`,`id_adm`, `item`, `status`, `data_add`) VALUES (\'".$valores[$l]."\',\'" . nome_id(\'empreendimentos\',$valores[$l],\'nome\') . "\',\'' . nome_id('usuarios',$_SESSION['usuario'],'nome') . '\',\'filtros\',\'auterou_nome\',\'\".date(\'d/m/Y H:i:s\').\"\')\");
                        sql(\"UPDATE `empreendimentos` SET `nome`=\'\".\$_POST[\'novo_nome".$l."\'].\"\' WHERE `nome`=\'".$valores[$l]."\'\");
                        reload(\'painel.php\');
            }else{
                        alert(\"Já existe esse nome\");
            }
        }
        
        ";';
    
        $array_id_empresa = [];
        for ($i=0; $i < count($array_nome); $i++) { 
        array_push($array_id_empresa, select_lin('empreendimentos', 'empresa_id', '`nome` = \''.$array_nome[$i].'\'')[0]);
        }
        $array_empresa = [];
        for ($i = 0; $i < count($array_id_empresa); $i++) {
            array_push($array_empresa, select_lin('empresa', 'nome', '`id` = \'' . $array_id_empresa[$i] . '\'')[0]);
        }
        $result = tabela($array_nome, $array_empresa, ['Empreendimentos', 'Empresas/Clientes'], [], [], $php,$array_nome,'text_button');
        eval($result[1]);

        echo ($result[0]);
        
    }
}

if (true) { //empresa
    if (isset($_POST['empresa']) || isset($_SESSION['empresa'])) {
        echo ('<table  cellspacing="0" cellpadding="5">
        <form action="" method="post" enctype="multipart/form-data"><tr>
        <td><input type="submit" name="add_empresa" value="Add Empresa/Cliente" /></td>
        <td><input type="submit" name="desativar_empresa" value="Desativar Empresa/Cliente" /></td>
        <td><input type="submit" name="ativar_empresa" value="Ativar Empresa/Cliente" /></td>
        </form>
        </table>');
        $_SESSION['ini_empresa'] = true;
    }

    if (isset($_POST['desativar_empresa']) || isset($_SESSION['desativar_empresa'])) {
        $array_nome = select_lin('empresa', 'nome', '`status` = \'ativo\'');
        unset($_SESSION['ini_empresa']);

        $php = '"
        if(isset(\$_POST[\'" . $nomes_itens[$l] . $i . "\'])){
            sql(\"UPDATE `empresa` SET `status`=\'desativado\' WHERE `nome`=\'" . $valores[$i] . "\' \");
            sql(\"INSERT INTO `historico_adm`(`nome`,`id_adm`, `item`, `status`, `data_add`) VALUES (\'" . nome_id(\'empresa\',$valores[$i],\'nome\') . "\',\'' . nome_id('usuarios',$_SESSION['usuario'],'nome') . '\',\'empresa\',\'desativado\',\'\".date(\'d/m/Y H:i:s\').\"\')\");
            reload(\'painel.php\');
        }";';

        $result = tabela($array_nome, [], ['Empresas/Clientes', ' '], ['submit'], ['Desativar'], $php);
        echo ($result[0]);
        eval($result[1]);
        $_SESSION['desativar_empresa'] = true;
    }

    if (isset($_POST['ativar_empresa']) || isset($_SESSION['ativar_empresa'])) {
        $array_nome = select_lin('empresa', 'nome', '`status` = \'desativado\'');
        unset($_SESSION['ini_empresa']);

        $php = '"
        if(isset(\$_POST[\'" . $nomes_itens[$l] . $i . "\'])){
            sql(\"UPDATE `empresa` SET `status`=\'ativo\' WHERE `nome`=\'" . $valores[$i] . "\' \");
            sql(\"INSERT INTO `historico_adm`(`nome`,`id_adm`, `item`, `status`,  `data_add`) VALUES (\'" . nome_id(\'empresa\',$valores[$i],\'nome\') . "\',\'' . nome_id('usuarios',$_SESSION['usuario'],'nome') . '\',\'empresa\',\'ativo\',\'\".date(\'d/m/Y H:i:s\').\"\')\");
            reload(\'painel.php\');
        }";';

        $result = tabela($array_nome, [], ['Empresas/Clientes', ' '], ['submit'], ['Ativar'], $php);
        echo ($result[0]);
        eval($result[1]);
        $_SESSION['ativar_empresa'] = true;
    }


    if (isset($_POST['add_empresa']) || isset($_SESSION['add_empresa'])) {
        $_SESSION['ini_empresa'] = true;
        echo ('<form action="" method="POST">
        <table border="1" cellspacing="0" class="relative"cellpadding="5"><form action="" method="POST"><tr></tr><tr><td>Nome</td><td></td></tr><tr>                          
        <td><input type="text" placeholder="Insira o nome da nova Empresa/Cliente" name="empresa_nome" autofocus></td>
        <td><input type="submit" name="add_empresa1" value="Adicionar" /></td>
        </tr></table>
        </form>');
        $_SESSION['add_empresa'] = true;
    }
    if (isset($_POST['add_empresa1'])) {
        if ($_POST['empresa_nome'] != '') {
            $result = sql("SELECT * FROM `empresa` WHERE `nome` = '" . $_POST['empresa_nome'] . "'");
            if (!mysqli_num_rows($result)) {
                sql("INSERT INTO `empresa`(`individuo`, `data_hora_add`,`nome`, `status`) VALUES ('" . nome_id('usuarios',$_SESSION['usuario'],'nome') . "','" . date('d/m/Y H:i:s') . "','" . $_POST['empresa_nome'] . "','ativo')");
                //$_SESSION = ['usuario' => $_SESSION['usuario']];
                reload('painel.php');
            } else {
                alert('ja existe uma empresa com esse nome \nobs:verifique as empresas/clientes desativadas');
            }

        } else {
            alert('É preciso prencher o nome da empresa');
        }





    }
    if(isset($_SESSION['ini_empresa'])){
        $array_nome = select_lin('empresa', 'nome', '');
        
     
            $php = '"
            
            if(isset(\$_POST[\'butao_tabela".$l."\'])){
                modal(\'Renomear\', \'<p>Coloque um novo nome para ".$valores[$l]."</p><p><input class=\"input_text\" type=\"text\" name=\"novo_nome".$l."\" multiple=\"multiple\" autofocus/></p>\', \'botao_novo_nome".$l."\', \'Mudar\');

            }  
            if(isset(\$_POST[\'botao_novo_nome".$l."\'])){
                \$row = mysqli_num_rows(sql(\"SELECT * FROM `empresa` WHERE `nome` = \'\".\$_POST[\'novo_nome".$l."\'].\"\'\"));
              
                if(!\$row){
                           
                            sql(\"INSERT INTO `historico_adm`(`info_mais`,`nome`,`id_adm`, `item`, `status`, `data_add`) VALUES (\'".$valores[$l]."\',\'" . nome_id(\'empresa\',$valores[$l],\'nome\') . "\',\'' . nome_id('usuarios',$_SESSION['usuario'],'nome') . '\',\'empresa\',\'auterou_nome\',\'\".date(\'d/m/Y H:i:s\').\"\')\");
                            sql(\"UPDATE `empresa` SET `nome`=\'\".\$_POST[\'novo_nome".$l."\'].\"\' WHERE `nome`=\'".$valores[$l]."\'\");
                            reload(\'painel.php\');
                }else{
                            alert(\"Já existe esse nome\");
                }
            }
            
            ";';
            

           
           
            
            
    
    $result = tabela($array_nome, [], ['Empresas/Clientes'], [], [], $php,$array_nome,'text_button');
    echo ($result[0]);
    eval($result[1]);




    }
}

if (true) { //prioridade
    if (isset($_POST['prioridade']) || isset($_SESSION['prioridade'])) {
        echo ('<table  cellspacing="0" cellpadding="5">
        <form action="" method="post" enctype="multipart/form-data"><tr>
        <td><input type="submit" name="add_prioridade" value="Add Prioridade" /></td>
        <td><input type="submit" name="desativar_prioridade" value="Desativar Prioridade" /></td>
        <td><input type="submit" name="ativar_prioridade" value="Ativar Prioridade" /></td>
        </form>
        </table>');
        $_SESSION['ini_prioridade'] = true;
    }

    if (isset($_POST['desativar_prioridade']) || isset($_SESSION['desativar_prioridade'])) {
        $array_nome = select_lin('prioridade', 'nome', '`status` = \'ativo\'');
        unset($_SESSION['ini_prioridade']);

        $php = '"
        if(isset(\$_POST[\'" . $nomes_itens[$l] . $i . "\'])){
            sql(\"UPDATE `prioridade` SET `status`=\'desativado\' WHERE `nome`=\'" . $valores[$i] . "\' \");
            sql(\"INSERT INTO `historico_adm`(`nome`,`id_adm`, `item`, `status`,  `data_add`) VALUES (\'" . nome_id(\'prioridade\',$valores[$i],\'nome\') . "\',\'' . nome_id('usuarios',$_SESSION['usuario'],'nome') . '\',\'prioridade\',\'desativado\',\'\".date(\'d/m/Y H:i:s\').\"\')\");
            reload(\'painel.php\');
        }";';

        $result = tabela($array_nome, [], ['Prioridades', ' '], ['submit'], ['Desativar'], $php);
        echo ($result[0]);
        eval($result[1]);
        $_SESSION['desativar_prioridade'] = true;
    }

    if (isset($_POST['ativar_prioridade']) || isset($_SESSION['ativar_prioridade'])) {
        $array_nome = select_lin('prioridade', 'nome', '`status` = \'desativado\'');
        unset($_SESSION['ini_prioridade']);

        $php = '"
        if(isset(\$_POST[\'" . $nomes_itens[$l] . $i . "\'])){
            sql(\"UPDATE `prioridade` SET `status`=\'ativo\' WHERE `nome`=\'" . $valores[$i] . "\' \");
            sql(\"INSERT INTO `historico_adm`(`nome`,`id_adm`, `item`, `status`,  `data_add`) VALUES (\'" . nome_id(\'prioridade\',$valores[$i],\'nome\') . "\',\'' . nome_id('usuarios',$_SESSION['usuario'],'nome') . '\',\'prioridade\',\'ativo\',\'\".date(\'d/m/Y H:i:s\').\"\')\");
            reload(\'painel.php\');
        }";';

        $result = tabela($array_nome, [], ['Prioridades', ' '], ['submit'], ['Ativar'], $php);
        echo ($result[0]);
        eval($result[1]);
        $_SESSION['ativar_prioridade'] = true;
    }


    if (isset($_POST['add_prioridade']) || isset($_SESSION['add_prioridade'])) {
        $_SESSION['ini_prioridade'] = true;

        echo ('<form action="" method="POST">  
        <table border="1" cellspacing="0" class="relative"cellpadding="5"><form action="" method="POST"><tr></tr><tr><td>Nome</td><td></td></tr><tr>                       
        <td><input type="text" placeholder="Insira o nome da nova Prioridade" name="prioridade_nome" autofocus></td>
        <td><input type="submit" name="add_prioridade1" value="Adicionar" /></td>
        </tr></table>
        </form>');
        $_SESSION['add_prioridade'] = true;
    }
    if (isset($_POST['add_prioridade1'])) {
        if ($_POST['prioridade_nome'] != '') {
            $result = sql("SELECT * FROM `prioridade` WHERE `nome` = '" . $_POST['prioridade_nome'] . "'");
            if (!mysqli_num_rows($result)) {
                sql("INSERT INTO `prioridade`(`individuo`, `data_hora_add`,`nome`, `status`) VALUES ('" . nome_id('usuarios',$_SESSION['usuario'],'nome') . "','" . date('d/m/Y H:i:s') . "','" . $_POST['prioridade_nome'] . "','ativo')");
                //$_SESSION = ['usuario' => $_SESSION['usuario']];
                reload('painel.php');
            } else {
                alert('ja existe uma prioridade com esse nome \nobs:verifique as prioridades desativadas');
            }

        } else {
            alert('É preciso prencher o nome da prioridade');
        }





    }
    if(isset($_SESSION['ini_prioridade'])){
        $array_nome = select_lin('prioridade', 'nome', '');
        
        
     
        $php = '"
        
        if(isset(\$_POST[\'butao_tabela".$l."\'])){
            modal(\'Renomear\', \'<p>Coloque um novo nome para ".$valores[$l]."</p><p><input class=\"input_text\" type=\"text\" name=\"novo_nome".$l."\" multiple=\"multiple\" autofocus/></p>\', \'botao_novo_nome".$l."\', \'Mudar\');

        }  
        if(isset(\$_POST[\'botao_novo_nome".$l."\'])){
            \$row = mysqli_num_rows(sql(\"SELECT * FROM `prioridade` WHERE `nome` = \'\".\$_POST[\'novo_nome".$l."\'].\"\'\"));
          
            if(!\$row){
                       
                        sql(\"INSERT INTO `historico_adm`(`info_mais`,`nome`,`id_adm`, `item`, `status`, `data_add`) VALUES (\'".$valores[$l]."\',\'" . nome_id(\'prioridade\',$valores[$l],\'nome\') . "\',\'' . nome_id('usuarios',$_SESSION['usuario'],'nome') . '\',\'prioridade\',\'auterou_nome\',\'\".date(\'d/m/Y H:i:s\').\"\')\");
                        sql(\"UPDATE `prioridade` SET `nome`=\'\".\$_POST[\'novo_nome".$l."\'].\"\' WHERE `nome`=\'".$valores[$l]."\'\");
                        reload(\'painel.php\');
            }else{
                        alert(\"Já existe esse nome\");
            }
        }
        
        ";';
        

       
       
        
        

$result = tabela($array_nome, [], ['Prioridades'], [], [], $php,$array_nome,'text_button');
echo ($result[0]);
eval($result[1]);
        
    }
}

if (true) { //finalidade
    if (isset($_POST['finalidade']) || isset($_SESSION['finalidade'])) {
        echo ('<table  cellspacing="0" cellpadding="5">
        <form action="" method="post" enctype="multipart/form-data"><tr>
        <td><input type="submit" name="add_finalidade" value="Add Finalidade" /></td>
        <td><input type="submit" name="desativar_finalidade" value="Desativar Finalidade" /></td>
        <td><input type="submit" name="ativar_finalidade" value="Ativar Finalidade" /></td>
        </form>
        </table>');
        $_SESSION['ini_finalidade'] = true;
    }

    if (isset($_POST['desativar_finalidade']) || isset($_SESSION['desativar_finalidade'])) {
        $array_nome = select_lin('finalidade', 'nome', '`status` = \'ativo\'');
        unset($_SESSION['ini_finalidade']);

        $php = '"
        if(isset(\$_POST[\'" . $nomes_itens[$l] . $i . "\'])){
            sql(\"UPDATE `finalidade` SET `status`=\'desativado\' WHERE `nome`=\'" . $valores[$i] . "\' \");
            sql(\"INSERT INTO `historico_adm`(`nome`,`id_adm`, `item`, `status`,  `data_add`) VALUES (\'" . nome_id(\'finalidade\',$valores[$i],\'nome\') . "\',\'' . nome_id('usuarios',$_SESSION['usuario'],'nome') . '\',\'finalidade\',\'desativado\',\'\".date(\'d/m/Y H:i:s\').\"\')\");
            reload(\'painel.php\');
        }";';

        $result = tabela($array_nome, [], ['Finalidades', ' '], ['submit'], ['Desativar'], $php);
        echo ($result[0]);
        eval($result[1]);
        $_SESSION['desativar_finalidade'] = true;
    }

    if (isset($_POST['ativar_finalidade']) || isset($_SESSION['ativar_finalidade'])) {
        $array_nome = select_lin('finalidade', 'nome', '`status` = \'desativado\'');
        unset($_SESSION['ini_finalidade']);

        $php = '"
        if(isset(\$_POST[\'" . $nomes_itens[$l] . $i . "\'])){
            sql(\"UPDATE `finalidade` SET `status`=\'ativo\' WHERE `nome`=\'" . $valores[$i] . "\' \");
            sql(\"INSERT INTO `historico_adm`(`nome`,`id_adm`, `item`, `status`,  `data_add`) VALUES (\'" . nome_id(\'finalidade\',$valores[$i],\'nome\') . "\',\'' . nome_id('usuarios',$_SESSION['usuario'],'nome') . '\',\'finalidade\',\'ativo\',\'\".date(\'d/m/Y H:i:s\').\"\')\");
            reload(\'painel.php\');
        }";';

        $result = tabela($array_nome, [], ['Finalidades', ' '], ['submit'], ['Ativar'], $php);
        echo ($result[0]);
        eval($result[1]);
        $_SESSION['ativar_finalidade'] = true;
    }


    if (isset($_POST['add_finalidade']) || isset($_SESSION['add_finalidade'])) {
        $_SESSION['ini_finalidade'] = true;

        echo ('<form action="" method="POST">   
        <table border="1" cellspacing="0" class="relative"cellpadding="5"><form action="" method="POST"><tr></tr><tr><td>Nome</td><td></td></tr><tr>                      
        <td><input type="text" placeholder="Insira o nome da nova Finalidade" name="finalidade_nome" autofocus></td>
        <td><input type="submit" name="add_finalidade1" value="Adicionar" /></td>
        </tr></table>
        </form>');
        $_SESSION['add_finalidade'] = true;
    }
    if (isset($_POST['add_finalidade1'])) {
        if ($_POST['finalidade_nome'] != '') {
            $result = sql("SELECT * FROM `finalidade` WHERE `nome` = '" . $_POST['finalidade_nome'] . "'");
            if (!mysqli_num_rows($result)) {
                sql("INSERT INTO `finalidade`(`individuo`, `data_hora_add`,`nome`, `status`) VALUES ('" . nome_id('usuarios',$_SESSION['usuario'],'nome') . "','" . date('d/m/Y H:i:s') . "','" . $_POST['finalidade_nome'] . "','ativo')");
                //$_SESSION = ['usuario' => $_SESSION['usuario']];
                reload('painel.php');
            } else {
                alert('ja existe uma finalidade com esse nome \nobs:verifique as finalidades desativadas');
            }

        } else {
            alert('É preciso prencher o nome da finalidade');
        }





    }
    if(isset($_SESSION['ini_finalidade'])){
        $array_nome = select_lin('finalidade', 'nome', '');
       
       
        
     
        $php = '"
        
        if(isset(\$_POST[\'butao_tabela".$l."\'])){
            modal(\'Renomear\', \'<p>Coloque um novo nome para ".$valores[$l]."</p><p><input class=\"input_text\" type=\"text\" name=\"novo_nome".$l."\" multiple=\"multiple\" autofocus/></p>\', \'botao_novo_nome".$l."\', \'Mudar\');

        }  
        if(isset(\$_POST[\'botao_novo_nome".$l."\'])){
            \$row = mysqli_num_rows(sql(\"SELECT * FROM `finalidade` WHERE `nome` = \'\".\$_POST[\'novo_nome".$l."\'].\"\'\"));
          
            if(!\$row){
                       
                        sql(\"INSERT INTO `historico_adm`(`info_mais`,`nome`,`id_adm`, `item`, `status`, `data_add`) VALUES (\'".$valores[$l]."\',\'" . nome_id(\'finalidade\',$valores[$l],\'nome\') . "\',\'' . nome_id('usuarios',$_SESSION['usuario'],'nome') . '\',\'finalidade\',\'auterou_nome\',\'\".date(\'d/m/Y H:i:s\').\"\')\");
                        sql(\"UPDATE `finalidade` SET `nome`=\'\".\$_POST[\'novo_nome".$l."\'].\"\' WHERE `nome`=\'".$valores[$l]."\'\");
                        reload(\'painel.php\');
            }else{
                        alert(\"Já existe esse nome\");
            }
        }
        
        ";';
        

       
       
        
        

$result = tabela($array_nome, [], ['Finalidades'], [], [], $php,$array_nome,'text_button');
echo ($result[0]);
eval($result[1]);
    }
}

if (true) { //usuarios
    if (isset($_POST['usuarios']) || isset($_SESSION['usuarios'])) {
        echo ('<table  cellspacing="0" cellpadding="5">
        <form action="" method="post" enctype="multipart/form-data"><tr>
        <td><input tabindex="0" type="submit" name="add_usuarios" value="Add Usuarios" /></td>
        <td><input tabindex="1" type="submit" name="desativar_usuarios" value="Desativar Usuarios" /></td>
        <td><input tabindex="2" type="submit" name="ativar_usuarios" value="Ativar Usuarios" /></td>
        </form>
        </table>');
        $_SESSION['ini_usuarios'] = true;
    }

    if (isset($_POST['desativar_usuarios']) || isset($_SESSION['desativar_usuarios'])) {
        unset($_SESSION['ini_usuarios']);
        $array_nome = select_lin('usuarios', 'nome', '`status` = \'ativo\' and `nome` != \'' . $_SESSION['usuario'] . '\'');
        sort($array_nome);
        $array_tipo = [];
        for ($i=0; $i < count($array_nome); $i++) { 
        array_push($array_tipo, select_lin('usuarios', 'tipo', '`nome` = \''.$array_nome[$i].'\'')[0]);
        }
      

        $php = '"
        if(isset(\$_POST[\'" . $nomes_itens[$l] . $i . "\'])){
            sql(\"UPDATE `usuarios` SET `status`=\'desativado\' WHERE `nome`=\'" . $valores[$i] . "\' \");
            sql(\"INSERT INTO `historico_adm`(`nome`,`id_adm`, `item`, `status`,  `data_add`) VALUES (\'" . nome_id(\'usuarios\',$valores[$i],\'nome\') . "\',\'' . nome_id('usuarios',$_SESSION['usuario'],'nome') . '\',\'usuario\',\'desativado\',\'\".date(\'d/m/Y H:i:s\').\"\')\");
            reload(\'painel.php\');
        }";';

        $result = tabela($array_nome, $array_tipo, ['Usuarioss', 'Tipo'], ['submit'], ['Desativar'], $php);
        echo ($result[0]);
        eval($result[1]);
        $_SESSION['desativar_usuarios'] = true;
    }

    if (isset($_POST['ativar_usuarios']) || isset($_SESSION['ativar_usuarios'])) {
        unset($_SESSION['ini_usuarios']);
        $array_nome = select_lin('usuarios', 'nome', '`status` = \'desativado\'');
        sort($array_nome);
        $array_tipo = [];
        for ($i=0; $i < count($array_nome); $i++) { 
        array_push($array_tipo, select_lin('usuarios', 'tipo', '`nome` = \''.$array_nome[$i].'\'')[0]);
        }


        $php = '"
        if(isset(\$_POST[\'" . $nomes_itens[$l] . $i . "\'])){
            sql(\"UPDATE `usuarios` SET `status`=\'ativo\' WHERE `nome`=\'" . $valores[$i] . "\' \");
            sql(\"INSERT INTO `historico_adm`(`nome`,`id_adm`, `item`, `status`,  `data_add`) VALUES (\'" . nome_id(\'usuarios\',$valores[$i],\'nome\') . "\',\'' . nome_id('usuarios',$_SESSION['usuario'],'nome') . '\',\'usuario\',\'ativo\',\'\".date(\'d/m/Y H:i:s\').\"\')\");
            reload(\'painel.php\');
        }";';

        $result = tabela($array_nome, $array_tipo, ['Usuarioss', 'Tipo'], ['submit'], ['Ativar'], $php);
        echo ($result[0]);
        eval($result[1]);
        $_SESSION['ativar_usuarios'] = true;
    }


    if (isset($_POST['add_usuarios']) || isset($_SESSION['add_usuarios'])) {
        $_SESSION['ini_usuarios'] = true;

        echo ('<form action="" method="POST">   
        <table border="1" cellspacing="0" class="relative"cellpadding="5"><form action="" method="POST"><tr></tr><tr><td>Nome</td><td>Senha</td><td>Função</td><td></td></tr><tr>                      
        <td><input type="text" placeholder="Nome do novo usuario" name="usuarios_nome" autofocus></td>
        <td><input type="text" placeholder="Senha do novo usuario" name="usuarios_senha"></td>
        <td><select name="usuario_clase">' . cascata([['cortador'], ['desenhista'], ['adm']]) . '</select></td>
        <td><input type="submit" name="add_usuarios1" value="Adicionar" /></td>
        </tr></table>
        </form>');
        $_SESSION['add_usuarios'] = true;
    }
    if (isset($_POST['add_usuarios1'])) {
        if ($_POST['usuario_clase'] != '') {
            if ($_POST['usuarios_nome'] != '') {
                if ($_POST['usuarios_senha'] != '') {
                    $result = sql("SELECT * FROM `usuarios` WHERE `nome` = '" . $_POST['usuarios_nome'] . "'");
                    if (!mysqli_num_rows($result)) {
                        sql("INSERT INTO `usuarios`(`individuo`, `data_hora_add`,`nome`,`senha`,`tipo`, `status`)VALUES ('" . nome_id('usuarios',$_SESSION['usuario'],'nome') . "','" . date('d/m/Y H:i:s') . "','" . $_POST['usuarios_nome'] . "',md5('" . $_POST['usuarios_senha'] . "'),'" . $_POST['usuario_clase'] . "','ativo')");
                        //$_SESSION = ['usuario' => $_SESSION['usuario']];
                        reload('painel.php');
                    } else {
                        alert('ja existe uma usuarios com esse nome \nobs:verifique os usuarios desativados');
                    }
                } else {
                    alert('É preciso prencher a senha do usuario');
                }
            } else {
                if ($_POST['usuarios_senha'] != '') {
                    alert('É preciso prencher o nome do usuario');
                } else {
                    alert('É preciso prencher o nome e a senha do usuario');
                }
            }
        } else {
            alert('É preciso prencher o tipo do usuario');
        }





    }
    if (isset($_SESSION['ini_usuarios'])) {
        $array_nome = select_lin('usuarios', 'nome', '`status` != \'adm\' and `nome` != \'' . $_SESSION['usuario'] . '\'');

        
       
       
       
        
     
        $php = '"
        
        if(isset(\$_POST[\'butao_tabela".$l."\'])){
            modal(\'Renomear\', \'<p>Coloque uma nova senha para ".$valores[$l]."</p><p><input class=\"input_text\" type=\"text\" name=\"novo_nome".$l."\" multiple=\"multiple\" autofocus/></p>\', \'botao_novo_nome".$l."\', \'Mudar\');

        }  
        if(isset(\$_POST[\'botao_novo_nome".$l."\'])){
            \$row = mysqli_num_rows(sql(\"SELECT * FROM `usuarios` WHERE `nome` = \'\".\$_POST[\'novo_nome".$l."\'].\"\'\"));
          
            if(!\$row){
                       
                        sql(\"INSERT INTO `historico_adm`(`info_mais`,`nome`,`id_adm`, `item`, `status`, `data_add`) VALUES (md5(\'".$valores[$l]."\'),\'" . nome_id(\'usuarios\',$valores[$l],\'nome\') . "\',\'' . nome_id('usuarios',$_SESSION['usuario'],'nome') . '\',\'usuarios\',\'auterou_senha\',\'\".date(\'d/m/Y H:i:s\').\"\')\");
                        sql(\"UPDATE `usuarios` SET `senha`=md5(\'\".\$_POST[\'novo_nome".$l."\'].\"\') WHERE `nome`=\'".$valores[$l]."\'\");
                        reload(\'painel.php\');
            }else{
                        alert(\"Já existe esse nome\");
            }
        }
        
        ";';
        

       
       
        
        



        sort($array_nome);
        $array_tipo = [];
        for ($i=0; $i < count($array_nome); $i++) { 
        array_push($array_tipo, select_lin('usuarios', 'tipo', '`nome` = \''.$array_nome[$i].'\'')[0]);
        }
        $result = tabela($array_nome,$array_tipo, ['Usuarioss','Tipo'], [], [], $php,$array_nome,'text_button');
        echo ($result[0]);
        eval($result[1]);
    }
}

if (true) { //desenho
    if (isset($_POST['desenho']) || isset($_SESSION['desenho'])) {
        echo ('<table  cellspacing="0" cellpadding="5">
        <form action="" method="post" enctype="multipart/form-data"><tr>
        <td><input type="submit" name="corte_desenho" value="Desenho para Corte" /></td>
        <td><input type="submit" name="cortados_desenho" value="Desenhos Cortados" /></td>
        <td><input type="submit" name="relatorio_desenho" value="Gerar relatorio dos desenhos" /></td>
        </form>
        </table>');
    }
    if (isset($_POST['corte_desenho']) || isset($_SESSION['corte_desenho'])) {
        $filtro = select_lin('filtros', 'nome', "`status` = 'ativo'");
        $f = '.';
        $f .= implode(',.', $filtro);
        $result = '<tr>';
        $php = '';
        $array_nome = select('desenhos', 'nome', "`status` = 'corte' ");
        $array_caminho = select('desenhos', 'caminho', "`status` = 'corte'");

        $array_data = select('desenhos', 'data_hora_add', "`status` = 'corte'");
        $array_empreendimento = select('desenhos', 'empreendimento', "`status` = 'corte'");
        $array_prioridade = select('desenhos', 'prioridade', "`status` = 'corte'");
        $array_empresa = select('desenhos', 'empresa', "`status` = 'corte'");
        $array_finalidade = select('desenhos', 'finalidade', "`status` = 'corte'");
        $array_desenhista = select('desenhos', 'desenhista', "`status` = 'corte'");

        $result .= '<tr><td>Desenhista</td><td>Caminho</td><td>Nome do arquivo</td><td>Prioridade</td><td>Finalidade</td><td>Empresa/Cliente</td>
        <td>Empreendimento</td>
        <td>Data add</td></tr>';
        for ($i = 0; $i < count($array_nome); $i++) {
            $result .= '<tr><td align="center">' . $array_desenhista[$i][0] . '</td>';
            $result .= '<td >' . $array_caminho[$i][0] . '</td>';
            $result .= '<td align="center">' . $array_nome[$i][0] . '</td>';
            $result .= '<td align="center">' . $array_prioridade[$i][0] . '</td>';
            $result .= '<td align="center">' . $array_finalidade[$i][0] . '</td>';
            $result .= '<td align="center">' . $array_empresa[$i][0] . '</td>';
            $result .= '<td align="center">' . $array_empreendimento[$i][0] . '</td>';
            $result .= '<td align="center">' . $array_data[$i][0] . '</td>';
            $result .= '<td align="center"><input type="submit" value="Apagar" id="apagar' . $i . '" name="apagar' . $i . '"></td>';
            $result .= '<td align="center"><input type="submit" value="Subistituir" id="subistituir' . $i . '" name="subistituir' . $i . '"></td>';

            $php .= " if(isset(\$_POST['subistituir" . $i . "'])){
                \$strr_dir = strrpos(substr(\"" . $array_caminho[$i][0] . "\", 0, -1), '/');
                \$back_dir = substr(\"" . $array_caminho[$i][0] . "\", 0, \$strr_dir + 1);
                modal('Subistituir desenho',' Desenho ('.\"" . $array_nome[$i][0] . "\".') sera subistituido <br/><input type=\"file\" name=\"file\" accept=\"" . $f . "\"/>','add_subistituir" . $i . "','Próximo');
               
            }
            if(isset(\$_POST['add_subistituir" . $i . "'])){
                \$filtro = select_lin('filtros','nome',\"`status` = 'ativo'\");
                \$f = '.';
                \$f .= implode(',.', \$filtro);
                \$arquivo = \$_FILES['file'];
                \$arquivoNovo = explode('.', \$arquivo['name']);
                \$id = select(\"desenhos\",\"id\",\" `nome` = '" . $array_nome[$i][0] . "' and `caminho` = '" . $array_caminho[$i][0] . "'\")[0][0];
                if (\$arquivoNovo[sizeof(\$arquivoNovo) - 1] == 'dxf') {
            
                
                
                if(file_exists(\"" . $array_caminho[$i][0] . "\".\$arquivo['name'])){
                    alert('Já existe um arquivo com o nome de('.\$arquivo['name'].') no diretorio '.\"" . $array_caminho[$i][0] . "\");
                }else{
                    unlink(\"" . $array_caminho[$i][0] . $array_nome[$i][0] . "\");
                move_uploaded_file(\$arquivo['tmp_name'],\"" . $array_caminho[$i][0] . "\".\$arquivo['name']);
                
                \$status = select(\"desenhos\",\"status\",\" `nome` = '" . $array_nome[$i][0] . "' and `caminho` = '" . $array_caminho[$i][0] . "'\")[0][0];
            \$data_hora = select(\"desenhos\",\"data_hora_add\",\" `nome` = '" . $array_nome[$i][0] . "' and `caminho` = '" . $array_caminho[$i][0] . "'\")[0][0];
            sql(\"INSERT INTO `historico_desenhos`(`status`,`id_desenhos`, `nome`, `data_hora_add`, `data_hora_mod`,`individuo`) VALUES ('\".\$status.\" => corte','\".\$id.\"','" . $array_nome[$i][0] . "','\".\$data_hora.\"','\".date('d/m/Y H:i:s').\"','" . nome_id('usuarios',$_SESSION['usuario'],'nome') . "')\");
             sql(\"UPDATE `desenhos` SET `nome`='\".\$arquivo['name'].\"' WHERE `desenhista` = '\".\nome_id('usuarios',\$_SESSION['usuario'],'nome').\"' and `nome` = '" . $array_nome[$i][0] . "' and `caminho` = '" . $array_caminho[$i][0] . "';\");
                  
                }reload('painel.php'); 
            }else{
                
                
                sql(\"INSERT INTO `violacao`( `individuo`, `causa`, `data`) VALUES ('" . nome_id('usuarios',$_SESSION['usuario'],'nome') . "','Tentou subistituir uma deseho(id = \".\$id.\") com um arquivo não permitido, arquivo(\".\$arquivo['name'].\"), local(" . $array_caminho[$i][0] . ")','\".date('d/m/Y H:i:s').\"')\");
                
                alert(\"alert('Apenas arquivos \".\$f.\" pode ser escolhido');\");
            
            }
                 }
                 if(isset(\$_POST['apagar" . $i . "'])){
                    confirmar('Apagar desenho',\"<p> Deseja apagar o desenho (" . $array_nome[$i][0] . ") que se encontra-se no diretório (" . $array_caminho[$i][0] . ")?\",'ok_apagar" . $i . "','Apagar');
                }
            
                if(isset(\$_POST['ok_apagar" . $i . "'])){
                    \$id = select(\"desenhos\",\"id\",\" `nome` = '" . $array_nome[$i][0] . "' and `caminho` = '" . $array_caminho[$i][0] . "'\")[0][0];
                    \$caminho = select(\"desenhos\",\"caminho\",\" `nome` = '" . $array_nome[$i][0] . "' and `caminho` = '" . $array_caminho[$i][0] . "'\")[0][0];
                    \$nome = select(\"desenhos\",\"nome\",\" `nome` = '" . $array_nome[$i][0] . "' and `caminho` = '" . $array_caminho[$i][0] . "'\")[0][0];
                    \$status = select(\"desenhos\",\"status\",\" `nome` = '" . $array_nome[$i][0] . "' and `caminho` = '" . $array_caminho[$i][0] . "'\")[0][0];
            \$data_hora = select(\"desenhos\",\"data_hora_add\",\" `nome` = '" . $array_nome[$i][0] . "' and `caminho` = '" . $array_caminho[$i][0] . "'\")[0][0];
            
            sql(\"INSERT INTO `historico_desenhos`(`status`,`id_desenhos`, `nome`, `data_hora_add`, `data_hora_mod`,`individuo`) VALUES ('\".\$status.\" => apagado','\".\$id.\"','" . $array_nome[$i][0] . "','\".\$data_hora.\"','\".date('d/m/Y H:i:s').\"','" . nome_id('usuarios',$_SESSION['usuario'],'nome') . "')\");
            sql(\"UPDATE `desenhos` SET `status` = 'apagado' WHERE `nome` = '" . $array_nome[$i][0] . "' and `caminho` = '" . $array_caminho[$i][0] . "';\");
            sql(\"INSERT INTO `lixo_desenhos`( `id_desenho`, `caminho`, `nome_desenho`, `data_add`, `individuo`) VALUES ('\".\$id.\"','\".lixo_desenho(\$caminho,\$nome).\"','\".\$nome.\"','\".date('d/m/Y H:i:s').\"','" . nome_id('usuarios',$_SESSION['usuario'],'nome') . "')\");
            reload('painel.php');
                }
                
                
                
                
                ";

        }
        if ($result != '') {
            echo ('<table width=70% border="1" cellspacing="0" cellpadding="5"><form action="" method="POST"><tr>
    <form action="" method="post" enctype="multipart/form-data">'
                . $result .
                '</form></table>');

            eval($php);
        }
        $_SESSION['corte_desenho'] = true;
    }

    if (isset($_POST['cortados_desenho']) || isset($_SESSION['cortados_desenho'])) {
        $filtro = '.dxf';
        $result = '<tr>';
        $php = '';
        $array_id = select('desenhos', 'id', "`status` = 'cortado' ");
        $array_nome = select('desenhos', 'nome', "`status` = 'cortado' ");
        $array_caminho = select('desenhos', 'caminho', "`status` = 'cortado'");
        $array_cortador = select('desenhos', 'cortador', "`status` = 'cortado'");
        $array_data = select('desenhos', 'data_hora_add', "`status` = 'cortado'");
        $array_data_corte = select('desenhos', 'data_hora_add', "`status` = 'cortado'");
        $array_empreendimento = select('desenhos', 'empreendimento', "`status` = 'cortado'");
        $array_prioridade = select('desenhos', 'prioridade', "`status` = 'cortado'");
        $array_empresa = select('desenhos', 'empresa', "`status` = 'cortado'");
        $array_desenhista = select('desenhos', 'desenhista', "`status` = 'cortado'");
        $array_finalidade = select('desenhos', 'finalidade', "`status` = 'cortado'");
        $result .= '<tr><td>Desenhista</td><td>Cortador</td><td>Caminho</td><td>Nome do arquivo</td><td>Prioridade</td><td>Finalidade</td><td>Empresa/Cliente</td>
        <td>Empreendimento</td>
        <td>Data add</td><td>Data Corte</td></tr>';
        for ($i = 0; $i < count($array_nome); $i++) {
            $result .= '<tr><td>' . $array_desenhista[$i][0] . '</td>';
            $result .= '<td>' . $array_cortador[$i][0] . '</td>';
            $result .= '<td>' . $array_caminho[$i][0] . '</td>';
            $result .= '<td>' . $array_nome[$i][0] . '</td>';
            $result .= '<td>' . $array_prioridade[$i][0] . '</td>';
            $result .= '<td>' . $array_finalidade[$i][0] . '</td>';
            $result .= '<td>' . $array_empresa[$i][0] . '</td>';
            $result .= '<td>' . $array_empreendimento[$i][0] . '</td>';
            $result .= '<td>' . $array_data[$i][0] . '</td>';
            $result .= '<td>' . select('historico_desenhos', 'data_hora_mod', "`id_desenhos` = '" . $array_id[$i][0] . "' ")[0][0] . '</td></tr>';

        }
        if ($result != '') {
            echo ('<table width=70% border="1" cellspacing="0" cellpadding="5"><form action="" method="POST"><tr>
    <form action="" method="post" enctype="multipart/form-data">'
                . $result .
                '</form></table>');

        }
        $_SESSION['cortados_desenho'] = true;
    }

    if (isset($_POST['relatorio_desenho']) || isset($_SESSION['relatorio_desenho'])) {



        echo ('<br><table  cellspacing="0" cellpadding="5">
        <form action="" method="post" enctype="multipart/form-data"><tr></tr><tr><td>Mês</td><td>Ano</td><td></td></tr><tr>
        <td><select  name="desenho_mes" >' . cascata_lin([['Todos'], ['01'], ['02'], ['03'], ['04'], ['05'], ['06'], ['07'], ['08'], ['09'], ['10'], ['11'], ['12']]) . '</select></td>
        <td><input name="desenho_ano" type="text" maxlength="4" onkeypress=\'return event.charCode >= 48 && event.charCode <= 57\'/></td>
        <td align="center"><input  type="submit" name="relatorio_desenho1" value="Gerar" /></td></tr>
        </form>
        </table>
        
        ');


        $_SESSION['relatorio_desenho'] = true;
    }
    if (isset($_POST['relatorio_desenho1'])) {

        $array_id_desenhistas = select_lin('usuarios', 'nome', "`tipo`='desenhista'  ");
        $array_id_cortador = select_lin('usuarios', 'nome', "`tipo`='cortador'  ");
        $array_id_adm = select_lin('usuarios', 'nome', "`tipo`='adm'  ");
        $data = '';
        if ($_POST['desenho_mes'] != 'Todos') {
            $data .= 'do mês ' . $_POST['desenho_mes'];
        }
        if ($_POST['desenho_mes'] != 'Todos' && $_POST['desenho_ano'] != '') {
            $data .= ' ano de ';
        }
        if ($_POST['desenho_ano'] != '') {
            $data .= $_POST['desenho_ano'];
        }


        if ($_POST['desenho_mes'] != 'Todos' || $_POST['desenho_ano'] != '') {
            if ($_POST['desenho_mes'] != 'Todos') {
                $desenhos = select_lin('desenhos', 'id', " `data_hora_add` LIKE '%/" . $_POST['desenho_mes'] . '/' . $_POST['desenho_ano'] . "%'");
                $cortes = select_lin('desenhos', 'id', "`status` = 'cortado' and `data_hora_add` LIKE '%/" . $_POST['desenho_mes'] . '/' . $_POST['desenho_ano'] . "%'");
            } else {
                $desenhos = select_lin('desenhos', 'id', "`data_hora_add` LIKE '%" . '/' . $_POST['desenho_ano'] . "%'");
                $cortes = select_lin('desenhos', 'id', "`status` = 'cortado' and `data_hora_add` LIKE '%" . '/' . $_POST['desenho_ano'] . "%'");
            }
        } else {
            $desenhos = select_lin('desenhos', 'id', "");
            $cortes = select_lin('desenhos', 'id', "`status` = 'cortado'");
        }

        $html = '<center>';

        if (true) { //all desenho
            $html .= '<h2>Todos os desenhos ' . $data . ' <br> ' . count($desenhos) . ' desenhos</h2>';
            $html .= '<table width=70% border="1" cellspacing="0" cellpadding="5"><form action="" method="POST">';
            $html .= '<tr></tr><tr><td>Desenhista</td><td>Nome desenho</td><td>Empresa/Cliente</td><td>Empreendimento</td><td>Finalidade</td><td>Prioridade</td><td>Data adicionado</td><td>Cortador</td><td>Data do Corte</td><td>Tempo do corte</td></tr>';
            for ($i = 0; $i < count($array_id_desenhistas); $i++) {
                if ($_POST['desenho_mes'] != 'Todos' || $_POST['desenho_ano'] != '') {
                    if ($_POST['desenho_mes'] != 'Todos') {
                        $desenho_id = select_lin('desenhos', 'id', "`desenhista`='" . $array_id_desenhistas[$i] . "' and `data_hora_add` LIKE '%/" . $_POST['desenho_mes'] . '/' . $_POST['desenho_ano'] . "%'");
                    } else {
                        $desenho_id = select_lin('desenhos', 'id', "`desenhista`='" . $array_id_desenhistas[$i] . "' and `data_hora_add` LIKE '%" . '/' . $_POST['desenho_ano'] . "%'");
                    }
                } else {
                    $desenho_id = select_lin('desenhos', 'id', "`desenhista`='" . $array_id_desenhistas[$i] . "'");
                }


                for ($l = 0; $l < count($desenho_id); $l++) {
                    $id = $desenho_id[$l];
                    $temp = sql("SELECT * FROM `corte` WHERE `status` = 'inicio' and `id_desenho` = '" . $id . "'");
                    $data_copy = '';
                    if (mysqli_num_rows($temp)) {
                        $data_copy = str_replace(':', '/', str_replace(' ', '/', select_lin('corte', 'data_add', "`status` = 'inicio' and `id_desenho` = '" . $id . "'")[0]));
                    }
                    $temp = sql("SELECT * FROM `corte` WHERE `status` = 'finalizado' and `id_desenho` = '" . $id . "'");
                    $data_find = '';
                    if (mysqli_num_rows($temp)) {
                        $data_find = str_replace(':', '/', str_replace(' ', '/', select_lin('corte', 'data_add', "`status` = 'finalizado' and `id_desenho` = '" . $id . "'")[0]));
                    }
                    $data_cortado = select_lin('historico_desenhos', 'data_hora_mod', "`id_desenhos`='" . $id . "' and `status` = 'corte => cortado' ");
                    $str_data_cortado = '';
                    if ($data_cortado != []) {
                        $str_data_cortado = $data_cortado[0];
                    }
                    $html .= '<tr><td>' . select_lin('desenhos', 'desenhista', "`id`='" . $id . "'")[0] . '</td>';
                    $html .= '<td>' . select_lin('desenhos', 'nome', "`id`='" . $id . "'")[0] . '</td>';
                    $html .= '<td>' . select_lin('desenhos', 'empresa', "`id`='" . $id . "'")[0] . '</td>';
                    $html .= '<td>' . select_lin('desenhos', 'empreendimento', "`id`='" . $id . "'")[0] . '</td>';
                    $html .= '<td>' . select_lin('desenhos', 'finalidade', "`id`='" . $id . "'")[0] . '</td>';
                    $html .= '<td>' . select_lin('desenhos', 'prioridade', "`id`='" . $id . "'")[0] . '</td>';
                    $html .= '<td>' . select_lin('desenhos', 'data_hora_add', "`id`='" . $id . "'")[0] . '</td>';
                    if ($data_cortado != []) {
                        $html .= '<td>' . select_lin('desenhos', 'cortador', "`id`='" . $id . "'")[0] . '</td>';
                    } else {
                        $html .= '<td></td>';
                    }
                    if ($data_cortado != []) {
                        $html .= '<td>' . $str_data_cortado . '</td>';
                    } else {
                        $html .= '<td></td>';
                    }
                    if ($data_copy != '' && $data_find != '') {
                        $html .= '<td>' .
                            (hora_em_data(data_em_hora(explode('/', $data_find)) - data_em_hora(explode('/', $data_copy))))
                            . '</td></tr>';
                    } else {
                        $html .= '<td>' . '' . '</td></tr>';
                    }
                }
            }
            $html .= '</table>';
        }
        $html .= '<br/><br/>';
        if (true) { //all desenho por desenhista
            for ($i = 0; $i < count($array_id_desenhistas); $i++) {
                $html .= '<br/><br/>';
                $html .= '<h2>Desenhista ' . $array_id_desenhistas[$i] . '</h2><bt/>';
                $html .= '<h3>Desenhos do desenhista ' . $array_id_desenhistas[$i] . '</h3>';
                $html .= '<table width=70% border="1" cellspacing="0" cellpadding="5"><form action="" method="POST">';
                $html .= '<tr></tr><tr><td>Desenhista</td><td>Nome desenho</td><td>Empresa/Cliente</td><td>Empreendimento</td><td>Finalidade</td><td>Prioridade</td><td>Data adicionado</td><td>Cortador</td><td>Data do Corte</td><td>Tempo do corte</td></tr>';
                if ($_POST['desenho_mes'] != 'Todos' || $_POST['desenho_ano'] != '') {
                    if ($_POST['desenho_mes'] != 'Todos') {
                        $desenho_id = select_lin('desenhos', 'id', "`desenhista`='" . $array_id_desenhistas[$i] . "' and `data_hora_add` LIKE '%/" . $_POST['desenho_mes'] . '/' . $_POST['desenho_ano'] . "%'");
                        $violacao = select_lin('violacao', 'id', "`individuo`='" . $array_id_desenhistas[$i] . "' and `data` LIKE '%/" . $_POST['desenho_mes'] . '/' . $_POST['desenho_ano'] . "%'");
                        $substituido = select_lin('historico_desenhos', 'id', "`status` = 'corte => corte' and `individuo`='" . $array_id_desenhistas[$i] . "' and `data_hora_mod` LIKE '%/" . $_POST['desenho_mes'] . '/' . $_POST['desenho_ano'] . "%'");

                        $apagados = select_lin('historico_desenhos', 'id', "`status` = 'corte => apagado' and `individuo`='" . $array_id_desenhistas[$i] . "' and `data_hora_mod` LIKE '%/" . $_POST['desenho_mes'] . '/' . $_POST['desenho_ano'] . "%'");
                    } else {
                        $desenho_id = select_lin('desenhos', 'id', "`desenhista`='" . $array_id_desenhistas[$i] . "' and `data_hora_add` LIKE '%" . '/' . $_POST['desenho_ano'] . "%'");
                        $violacao = select_lin('violacao', 'id', "`individuo`='" . $array_id_desenhistas[$i] . "' and `data_hora_add` LIKE '%" . '/' . $_POST['desenho_ano'] . "%'");
                        $substituido = select_lin('historico_desenhos', 'id', "`status` = 'corte => apagado' and `individuo`='" . $array_id_desenhistas[$i] . "' and `data_hora_add` LIKE '%" . '/' . $_POST['desenho_ano'] . "%'");

                        $apagados = select_lin('historico_desenhos', 'id', "`status` = 'corte => corte' and `individuo`='" . $array_id_desenhistas[$i] . "' and `data_hora_add` LIKE '%" . '/' . $_POST['desenho_ano'] . "%'");
                    }
                } else {
                    $desenho_id = select_lin('desenhos', 'id', "`desenhista`='" . $array_id_desenhistas[$i] . "'");
                    $violacao = select_lin('violacao', 'id', "`individuo`='" . $array_id_desenhistas[$i] . "' ");
                    $substituido = select_lin('historico_desenhos', 'id', "`status` = 'corte => corte' and `individuo`='" . $array_id_desenhistas[$i] . "'");

                    $apagados = select_lin('historico_desenhos', 'id', "`status` = 'corte => apagado' and `individuo`='" . $array_id_desenhistas[$i] . "'");
                }


                for ($l = 0; $l < count($desenho_id); $l++) {
                    $id = $desenho_id[$l];
                    $temp = sql("SELECT * FROM `corte` WHERE `status` = 'inicio' and `id_desenho` = '" . $id . "'");
                    $data_copy = '';
                    if (mysqli_num_rows($temp)) {
                        $data_copy = str_replace(':', '/', str_replace(' ', '/', select_lin('corte', 'data_add', "`status` = 'inicio' and `id_desenho` = '" . $id . "'")[0]));
                    }
                    $temp = sql("SELECT * FROM `corte` WHERE `status` = 'finalizado' and `id_desenho` = '" . $id . "'");
                    $data_find = '';
                    if (mysqli_num_rows($temp)) {
                        $data_find = str_replace(':', '/', str_replace(' ', '/', select_lin('corte', 'data_add', "`status` = 'finalizado' and `id_desenho` = '" . $id . "'")[0]));
                    }
                    $data_cortado = select_lin('historico_desenhos', 'data_hora_mod', "`id_desenhos`='" . $id . "' and `status` = 'corte => cortado' ");
                    $str_data_cortado = '';
                    if ($data_cortado != []) {
                        $str_data_cortado = $data_cortado[0];
                    }
                    $html .= '<tr><td>' . select_lin('desenhos', 'desenhista', "`id`='" . $id . "'")[0] . '</td>';
                    $html .= '<td>' . select_lin('desenhos', 'nome', "`id`='" . $id . "'")[0] . '</td>';
                    $html .= '<td>' . select_lin('desenhos', 'empresa', "`id`='" . $id . "'")[0] . '</td>';
                    $html .= '<td>' . select_lin('desenhos', 'empreendimento', "`id`='" . $id . "'")[0] . '</td>';
                    $html .= '<td>' . select_lin('desenhos', 'finalidade', "`id`='" . $id . "'")[0] . '</td>';
                    $html .= '<td>' . select_lin('desenhos', 'prioridade', "`id`='" . $id . "'")[0] . '</td>';
                    $html .= '<td>' . select_lin('desenhos', 'data_hora_add', "`id`='" . $id . "'")[0] . '</td>';
                    if ($data_cortado != []) {
                        $html .= '<td>' . select_lin('desenhos', 'cortador', "`id`='" . $id . "'")[0] . '</td>';
                    } else {
                        $html .= '<td></td>';
                    }
                    if ($data_cortado != []) {
                        $html .= '<td>' . $str_data_cortado . '</td>';
                    } else {
                        $html .= '<td></td>';
                    }
                    if ($data_copy != '' && $data_find != '') {
                        $html .= '<td>' .
                            (hora_em_data(data_em_hora(explode('/', $data_find)) - data_em_hora(explode('/', $data_copy))))
                            . '</td></tr>';
                    } else {
                        $html .= '<td>' . '' . '</td></tr>';
                    }
                }

                $html .= '</table>';
                if ($violacao != []) {
                    $html .= '<br/><br/>';
                    $html .= '<h3>violações por ' . $array_id_desenhistas[$i] . '</h3>';
                    $html .= '<table width=70% border="1" cellspacing="0" cellpadding="5"><form action="" method="POST">';
                    $html .= '<tr></tr><tr><td>Causa</td><td>Data</td></tr>';

                    for ($l = 0; $l < count($violacao); $l++) {
                        $id = $violacao[$l];
                        $html .= '<tr><td>' . select_lin('violacao', 'causa', "`id`='" . $id . "'")[0] . '</td>';
                        $html .= '<td>' . select_lin('violacao', 'data', "`id`='" . $id . "'")[0] . '</td></tr>';
                    }
                    $html .= '</table>';
                }
                if ($apagados != []) {
                    $html .= '<br/><br/>';
                    $html .= '<h3>Desenhos apagados por ' . $array_id_desenhistas[$i] . '</h3>';
                    $html .= '<table width=70% border="1" cellspacing="0" cellpadding="5"><form action="" method="POST">';
                    $html .= '<tr></tr><tr><td>Caminho</td><td>desenho</td><td>Data</td></tr>';

                    for ($l = 0; $l < count($apagados); $l++) {
                        $id = $apagados[$l];
                        $html .= '<tr><td>' . select_lin('desenhos', 'caminho', "`id`='" . select_lin('historico_desenhos', 'id_desenhos', "`id`='" . $id . "'")[0] . "'")[0] . '</td>';
                        $html .= '<td>' . select_lin('historico_desenhos', 'nome', "`id`='" . $id . "'")[0] . '</td>';
                        $html .= '<td>' . select_lin('historico_desenhos', 'data_hora_mod', "`id`='" . $id . "'")[0] . '</td></tr>';
                    }
                    $html .= '</table>';
                }
                if ($substituido != []) {
                    $html .= '<br/><br/>';
                    $html .= '<h3>Desenhos subistituidos por ' . $array_id_desenhistas[$i] . '</h3>';
                    $html .= '<table width=70% border="1" cellspacing="0" cellpadding="5"><form action="" method="POST">';
                    $html .= '<tr></tr><tr><td>Caminho</td><td>Nome atual desenho</td><td>Nome antigo desenho</td><td>Data</td></tr>';

                    for ($l = 0; $l < count($substituido); $l++) {
                        $id = $substituido[$l];
                        $html .= '<tr><td>' . select_lin('desenhos', 'caminho', "`id`='" . select_lin('historico_desenhos', 'id_desenhos', "`id`='" . $id . "'")[0] . "'")[0] . '</td>';
                        $html .= '<td>' . select_lin('desenhos', 'nome', "`id`='" . select_lin('historico_desenhos', 'id_desenhos', "`id`='" . $id . "'")[0] . "'")[0] . '</td>';
                        $html .= '<td>' . select_lin('historico_desenhos', 'nome', "`id`='" . $id . "'")[0] . '</td>';
                        $html .= '<td>' . select_lin('historico_desenhos', 'data_hora_mod', "`id`='" . $id . "'")[0] . '</td></tr>';
                    }
                    $html .= '</table>';
                }

            }
        }

        $html .= '<br/><br/><br/>';

        if (true) { //all desenhos cortados
            $html .= '<h2>Todos os desenhos cortados ' . $data . ' <br> ' . count($cortes) . ' desenhos</h2>';
            $html .= '<table width=70% border="1" cellspacing="0" cellpadding="5"><form action="" method="POST">';
            $html .= '<tr></tr><tr><td>Cortador</td><td>Desenhista</td><td>Nome desenho</td><td>Empresa/Cliente</td><td>Empreendimento</td><td>Finalidade</td><td>Prioridade</td><td>Data adicionado</td><td>Data do Corte</td><td>Tempo do corte</td></tr>';
            for ($i = 0; $i < count($array_id_cortador); $i++) {
                if ($_POST['desenho_mes'] != 'Todos' || $_POST['desenho_ano'] != '') {
                    if ($_POST['desenho_mes'] != 'Todos') {
                        $desenho_id = select_lin('desenhos', 'id', "`cortador`='" . $array_id_cortador[$i] . "' and `data_hora_add` LIKE '%/" . $_POST['desenho_mes'] . '/' . $_POST['desenho_ano'] . "%'");
                    } else {
                        $desenho_id = select_lin('desenhos', 'id', "`cortador`='" . $array_id_cortador[$i] . "' and `data_hora_add` LIKE '%" . '/' . $_POST['desenho_ano'] . "%'");
                    }
                } else {
                    $desenho_id = select_lin('desenhos', 'id', "`cortador`='" . $array_id_cortador[$i] . "'");
                }


                for ($l = 0; $l < count($desenho_id); $l++) {
                    $id = $desenho_id[$l];
                    $temp = sql("SELECT * FROM `corte` WHERE `status` = 'inicio' and `id_desenho` = '" . $id . "'");
                    $data_copy = '';
                    if (mysqli_num_rows($temp)) {
                        $data_copy = str_replace(':', '/', str_replace(' ', '/', select_lin('corte', 'data_add', "`status` = 'inicio' and `id_desenho` = '" . $id . "'")[0]));
                    }
                    $temp = sql("SELECT * FROM `corte` WHERE `status` = 'finalizado' and `id_desenho` = '" . $id . "'");
                    $data_find = '';
                    if (mysqli_num_rows($temp)) {
                        $data_find = str_replace(':', '/', str_replace(' ', '/', select_lin('corte', 'data_add', "`status` = 'finalizado' and `id_desenho` = '" . $id . "'")[0]));
                    }
                    $html .= '<tr><td>' . select_lin('desenhos', 'cortador', "`id`='" . $id . "'")[0] . '</td>';
                    $html .= '<td>' . select_lin('desenhos', 'desenhista', "`id`='" . $id . "'")[0] . '</td>';
                    $html .= '<td>' . select_lin('desenhos', 'nome', "`id`='" . $id . "'")[0] . '</td>';
                    $html .= '<td>' . select_lin('desenhos', 'empresa', "`id`='" . $id . "'")[0] . '</td>';
                    $html .= '<td>' . select_lin('desenhos', 'empreendimento', "`id`='" . $id . "'")[0] . '</td>';
                    $html .= '<td>' . select_lin('desenhos', 'finalidade', "`id`='" . $id . "'")[0] . '</td>';
                    $html .= '<td>' . select_lin('desenhos', 'prioridade', "`id`='" . $id . "'")[0] . '</td>';
                    $html .= '<td>' . select_lin('desenhos', 'data_hora_add', "`id`='" . $id . "'")[0] . '</td>';
                    $html .= '<td>' . select_lin('historico_desenhos', 'data_hora_mod', "`id_desenhos`='" . $id . "' and `status` = 'corte => cortado' ")[0] . '</td>';
                    if ($data_copy != '' && $data_find != '') {
                        $html .= '<td>' .
                            (hora_em_data(data_em_hora(explode('/', $data_find)) - data_em_hora(explode('/', $data_copy))))
                            . '</td></tr>';
                    } else {
                        $html .= '<td>' . '' . '</td></tr>';
                    }

                }
            }
            $html .= '</table>';
        }
        $html .= '<br/><br/>';
        if (true) { //all desenho cortados por cortador
            for ($i = 0; $i < count($array_id_cortador); $i++) {
                $html .= '<br/><br/>';
                $html .= '<h2>Cortado ' . $array_id_cortador[$i] . '</h2>';
                $html .= '<h3>Desenhos cortado por ' . $array_id_cortador[$i] . '</h3>';
                $html .= '<table width=70% border="1" cellspacing="0" cellpadding="5"><form action="" method="POST">';
                $html .= '<tr></tr><tr><td>Cortador</td><td>Desenhista</td><td>Nome desenho</td><td>Empresa/Cliente</td><td>Empreendimento</td><td>Finalidade</td><td>Prioridade</td><td>Data adicionado</td><td>Data do Corte</td><td>Tempo do corte</td></tr>';
                if ($_POST['desenho_mes'] != 'Todos' || $_POST['desenho_ano'] != '') {
                    if ($_POST['desenho_mes'] != 'Todos') {
                        $desenho_id = select_lin('desenhos', 'id', "`cortador`='" . $array_id_cortador[$i] . "' and `data_hora_add` LIKE '%/" . $_POST['desenho_mes'] . '/' . $_POST['desenho_ano'] . "%'");
                        $violacao = select_lin('violacao', 'id', "`individuo`='" . $array_id_cortador[$i] . "' and `data` LIKE '%/" . $_POST['desenho_mes'] . '/' . $_POST['desenho_ano'] . "%'");

                        $apagados = select_lin('historico_desenhos', 'id', "`status` = 'corte => apagado' and `individuo`='" . $array_id_cortador[$i] . "' and `data_hora_mod` LIKE '%/" . $_POST['desenho_mes'] . '/' . $_POST['desenho_ano'] . "%'");
                    } else {
                        $desenho_id = select_lin('desenhos', 'id', "`cortador`='" . $array_id_cortador[$i] . "' and `data_hora_add` LIKE '%" . '/' . $_POST['desenho_ano'] . "%'");
                        $violacao = select_lin('violacao', 'id', "`individuo`='" . $array_id_cortador[$i] . "' and `data_hora_add` LIKE '%" . '/' . $_POST['desenho_ano'] . "%'");

                        $apagados = select_lin('historico_desenhos', 'id', "`status` = 'corte => apagado' and `individuo`='" . $array_id_cortador[$i] . "' and `data_hora_add` LIKE '%" . '/' . $_POST['desenho_ano'] . "%'");
                    }
                } else {
                    $desenho_id = select_lin('desenhos', 'id', "`cortador`='" . $array_id_cortador[$i] . "'");
                    $violacao = select_lin('violacao', 'id', "`individuo`='" . $array_id_cortador[$i] . "' ");

                    $apagados = select_lin('historico_desenhos', 'id', "`status` = 'corte => apagado' and `individuo`='" . $array_id_cortador[$i] . "'");
                }


                for ($l = 0; $l < count($desenho_id); $l++) {
                    $id = $desenho_id[$l];
                    $temp = sql("SELECT * FROM `corte` WHERE `status` = 'inicio' and `id_desenho` = '" . $id . "'");
                    $data_copy = '';
                    if (mysqli_num_rows($temp)) {
                        $data_copy = str_replace(':', '/', str_replace(' ', '/', select_lin('corte', 'data_add', "`status` = 'inicio' and `id_desenho` = '" . $id . "'")[0]));
                    }
                    $temp = sql("SELECT * FROM `corte` WHERE `status` = 'finalizado' and `id_desenho` = '" . $id . "'");
                    $data_find = '';
                    if (mysqli_num_rows($temp)) {
                        $data_find = str_replace(':', '/', str_replace(' ', '/', select_lin('corte', 'data_add', "`status` = 'finalizado' and `id_desenho` = '" . $id . "'")[0]));
                    }
                    $html .= '<tr><td>' . select_lin('desenhos', 'cortador', "`id`='" . $id . "'")[0] . '</td>';
                    $html .= '<td>' . select_lin('desenhos', 'desenhista', "`id`='" . $id . "'")[0] . '</td>';
                    $html .= '<td>' . select_lin('desenhos', 'nome', "`id`='" . $id . "'")[0] . '</td>';
                    $html .= '<td>' . select_lin('desenhos', 'empresa', "`id`='" . $id . "'")[0] . '</td>';
                    $html .= '<td>' . select_lin('desenhos', 'empreendimento', "`id`='" . $id . "'")[0] . '</td>';
                    $html .= '<td>' . select_lin('desenhos', 'finalidade', "`id`='" . $id . "'")[0] . '</td>';
                    $html .= '<td>' . select_lin('desenhos', 'prioridade', "`id`='" . $id . "'")[0] . '</td>';
                    $html .= '<td>' . select_lin('desenhos', 'data_hora_add', "`id`='" . $id . "'")[0] . '</td>';
                    $html .= '<td>' . select_lin('historico_desenhos', 'data_hora_mod', "`id_desenhos`='" . $id . "' and `status` = 'corte => cortado' ")[0] . '</td>';

                    if ($data_copy != '' && $data_find != '') {
                        $html .= '<td>' .
                            (hora_em_data(data_em_hora(explode('/', $data_find)) - data_em_hora(explode('/', $data_copy))))
                            . '</td></tr>';
                    } else {
                        $html .= '<td>' . '' . '</td></tr>';
                    }

                }

                $html .= '</table>';

                // $html .= '<h3>violações por ' . $array_id_cortador[$i] . '</h3>';
                // $html .= '<table width=70% border="1" cellspacing="0" cellpadding="5"><form action="" method="POST">';
                // $html .= '<tr></tr><tr><td>Causa</td><td>Data</td></tr>';

                // for ($l = 0; $l < count($violacao); $l++) {
                //     $id = $violacao[$l];
                //     $html .= '<tr><td>' . select_lin('violacao', 'causa', "`id`='" . $id . "'")[0] . '</td>';
                //     $html .= '<td>' . select_lin('violacao', 'data', "`id`='" . $id . "'")[0] . '</td></tr>';
                // }
                // $html .= '</table>';

                // $html .= '<h3>Desenhos apagados por ' . $array_id_cortador[$i] . '</h3>';
                // $html .= '<table width=70% border="1" cellspacing="0" cellpadding="5"><form action="" method="POST">';
                // $html .= '<tr></tr><tr><td>Caminho</td><td>desenho</td><td>Data</td></tr>';

                // for ($l = 0; $l < count($apagados); $l++) {
                //     $id = $apagados[$l];
                //     $html .= '<tr><td>' . select_lin('desenhos', 'caminho', "`id`='" . select_lin('historico_desenhos', 'id_desenhos', "`id`='" . $id . "'")[0] . "'")[0] . '</td>';
                //     $html .= '<td>' . select_lin('historico_desenhos', 'nome', "`id`='" . $id . "'")[0] . '</td>';
                //     $html .= '<td>' . select_lin('historico_desenhos', 'data_hora_mod', "`id`='" . $id . "'")[0] . '</td></tr>';
                // }
                // $html .= '</table>';


            }

        }

        $html .= '<br/><br/><br/>';
        if (true) { //adm
            for ($i = 0; $i < count($array_id_adm); $i++) {
                $html .= '<h2>Adm ' . $array_id_adm[$i] . '</h2>';
                $date = '';
                if ($_POST['desenho_mes'] != 'Todos' || $_POST['desenho_ano'] != '') {

                    if ($_POST['desenho_mes'] != 'Todos') {
                        $date = " and `data` LIKE '%/" . $_POST['desenho_mes'] . '/' . $_POST['desenho_ano'] . "%'";
                    } else {
                        $date = " and `data_hora_add` LIKE '%" . '/' . $_POST['desenho_ano'] . "%'";
                    }
                }

                $violacao = select_lin('violacao', 'id', "`individuo`='" . $array_id_adm[$i] . "'" . $date);
                $substituido = select_lin('historico_desenhos', 'id', "`status` = 'corte => corte' and `individuo`='" . $array_id_desenhistas[$i] . "'" . $date);
                $apagados = select_lin('historico_desenhos', 'id', "`status` = 'corte => apagado' and `individuo`='" . $array_id_adm[$i] . "' " . $date);
                $empreendimento_add = select_lin('empreendimentos', 'id', " `individuo`='" . $array_id_adm[$i] . "' " . $date);
                $empresa_add = select_lin('empresa', 'id', " `individuo`='" . $array_id_adm[$i] . "' " . $date);
                $filtros_add = select_lin('filtros', 'id', " `individuo`='" . $array_id_adm[$i] . "' " . $date);
                $finalidade_add = select_lin('finalidade', 'id', " `individuo`='" . $array_id_adm[$i] . "' " . $date);
                $prioridade_add = select_lin('finalidade', 'id', " `individuo`='" . $array_id_adm[$i] . "' " . $date);
                $usuarios_add = select_lin('usuarios', 'id', " `individuo`='" . $array_id_adm[$i] . "' " . $date);




                if ($violacao != []) {
                    $html .= '<h3>violações por ' . $array_id_adm[$i] . '</h3>';
                    $html .= '<table width=70% border="1" cellspacing="0" cellpadding="5"><form action="" method="POST">';
                    $html .= '<tr></tr><tr><td>Causa</td><td>Data</td></tr>';

                    for ($l = 0; $l < count($violacao); $l++) {
                        $id = $violacao[$l];
                        $html .= '<tr><td>' . select_lin('violacao', 'causa', "`id`='" . $id . "'")[0] . '</td>';
                        $html .= '<td>' . select_lin('violacao', 'data', "`id`='" . $id . "'")[0] . '</td></tr>';
                    }
                    $html .= '</table>';
                }
                if ($apagados != []) {
                    $html .= '<br/><br/>';
                    $html .= '<h3>Desenhos apagados por ' . $array_id_adm[$i] . '</h3>';
                    $html .= '<table width=70% border="1" cellspacing="0" cellpadding="5"><form action="" method="POST">';
                    $html .= '<tr></tr><tr><td>Desenhista</td><td>Caminho</td><td>desenho</td><td>Data</td></tr>';

                    for ($l = 0; $l < count($apagados); $l++) {
                        $id = $apagados[$l];
                        $html .= '<tr><td>' . select_lin('desenhos', 'desenhista', "`id`='" . select_lin('historico_desenhos', 'id_desenhos', "`id`='" . $id . "'")[0] . "'")[0] . '</td>';
                        $html .= '<td>' . select_lin('desenhos', 'caminho', "`id`='" . select_lin('historico_desenhos', 'id_desenhos', "`id`='" . $id . "'")[0] . "'")[0] . '</td>';
                        $html .= '<td>' . select_lin('historico_desenhos', 'nome', "`id`='" . $id . "'")[0] . '</td>';
                        $html .= '<td>' . select_lin('historico_desenhos', 'data_hora_mod', "`id`='" . $id . "'")[0] . '</td></tr>';
                    }
                    $html .= '</table>';
                }
                if ($substituido != []) {
                    $html .= '<br/><br/>';
                    $html .= '<h3>Desenhos subistituidos por ' . $array_id_adm[$i] . '</h3>';
                    $html .= '<table width=70% border="1" cellspacing="0" cellpadding="5"><form action="" method="POST">';
                    $html .= '<tr></tr><tr><td>Desenhista</td><td>Caminho</td><td>Nome atual desenho</td><td>Nome antigo desenho</td><td>Data</td></tr>';

                    for ($l = 0; $l < count($substituido); $l++) {
                        $id = $substituido[$l];
                        $html .= '<tr><td>' . select_lin('desenhos', 'desenhista', "`id`='" . select_lin('historico_desenhos', 'id_desenhos', "`id`='" . $id . "'")[0] . "'")[0] . '</td>';
                        $html .= '<td>' . select_lin('desenhos', 'caminho', "`id`='" . select_lin('historico_desenhos', 'id_desenhos', "`id`='" . $id . "'")[0] . "'")[0] . '</td>';
                        $html .= '<td>' . select_lin('desenhos', 'nome', "`id`='" . select_lin('historico_desenhos', 'id_desenhos', "`id`='" . $id . "'")[0] . "'")[0] . '</td>';
                        $html .= '<td>' . select_lin('historico_desenhos', 'nome', "`id`='" . $id . "'")[0] . '</td>';
                        $html .= '<td>' . select_lin('historico_desenhos', 'data_hora_mod', "`id`='" . $id . "'")[0] . '</td></tr>';
                    }
                    $html .= '</table>';
                }
                if ($empresa_add != []) {
                    $html .= '<br/><br/>';
                    $html .= '<h3>Empresa/Cliente add por ' . $array_id_adm[$i] . '</h3>';
                    $html .= '<table width=70% border="1" cellspacing="0" cellpadding="5"><form action="" method="POST">';
                    $html .= '<tr></tr><tr><td>Empresa/Cliente</td><td>Data</td></tr>';
                    for ($l = 0; $l < count($empresa_add); $l++) {
                        $id = $empresa_add[$l];
                        $html .= '<tr><td>' . select_lin('empresa', 'nome', "`id`='" . $id . "'")[0] . '</td>';
                        $html .= '<td>' . select_lin('empresa', 'data_hora_add', "`id`='" . $id . "'")[0] . '</td></tr>';
                    }
                    $html .= '</table>';
                }
                if ($filtros_add != []) {
                    $html .= '<br/><br/>';
                    $html .= '<h3>Tipo de Arquivo add por ' . $array_id_adm[$i] . '</h3>';
                    $html .= '<table width=70% border="1" cellspacing="0" cellpadding="5"><form action="" method="POST">';
                    $html .= '<tr></tr><tr><td>Tipo de Arquivo</td><td>Data</td></tr>';
                    for ($l = 0; $l < count($filtros_add); $l++) {
                        $id = $filtros_add[$l];
                        $html .= '<tr><td>' . select_lin('filtros', 'nome', "`id`='" . $id . "'")[0] . '</td>';
                        $html .= '<td>' . select_lin('filtros', 'data_hora_add', "`id`='" . $id . "'")[0] . '</td></tr>';
                    }
                    $html .= '</table>';
                }
                
                if ($empreendimento_add != []) {
                    $html .= '<br/><br/>';
                    $html .= '<h3>Empreendimento add por ' . $array_id_adm[$i] . '</h3>';
                    $html .= '<table width=70% border="1" cellspacing="0" cellpadding="5"><form action="" method="POST">';
                    $html .= '<tr></tr><tr><td>Empresa/Cliente</td><td>Empreendimento</td><td>Data</td></tr>';
                    for ($l = 0; $l < count($empreendimento_add); $l++) {
                        $id = $empreendimento_add[$l];
                        $html .= '<tr><td>' . select_lin('empresa', 'nome', "`id`='" . select_lin('empreendimentos', 'empresa_id', "`id`='" . $id . "'")[0] . "'")[0] . '</td>';
                        $html .= '<td>' . select_lin('empreendimentos', 'nome', "`id`='" . $id . "'")[0] . '</td>';
                        $html .= '<td>' . select_lin('empreendimentos', 'data_hora_add', "`id`='" . $id . "'")[0] . '</td></tr>';
                    }
                    $html .= '</table>';
                }
                if ($finalidade_add != []) {
                    $html .= '<br/><br/>';
                    $html .= '<h3>Finalidade add por ' . $array_id_adm[$i] . '</h3>';
                    $html .= '<table width=70% border="1" cellspacing="0" cellpadding="5"><form action="" method="POST">';
                    $html .= '<tr></tr><tr><td>Empresa/Cliente</td><td>Data</td></tr>';
                    for ($l = 0; $l < count($finalidade_add); $l++) {
                        $id = $finalidade_add[$l];
                        $html .= '<tr><td>' . select_lin('empresa', 'nome', "`id`='" . $id . "'")[0] . '</td>';
                        $html .= '<td>' . select_lin('empresa', 'data_hora_add', "`id`='" . $id . "'")[0] . '</td></tr>';
                    }
                    $html .= '</table>';
                }
                if ($prioridade_add != []) {
                    $html .= '<br/><br/>';
                    $html .= '<h3>Prioridade add por ' . $array_id_adm[$i] . '</h3>';
                    $html .= '<table width=70% border="1" cellspacing="0" cellpadding="5"><form action="" method="POST">';
                    $html .= '<tr></tr><tr><td>Empresa/Cliente</td><td>Data</td></tr>';
                    for ($l = 0; $l < count($prioridade_add); $l++) {
                        $id = $prioridade_add[$l];
                        $html .= '<tr><td>' . select_lin('empresa', 'nome', "`id`='" . $id . "'")[0] . '</td>';
                        $html .= '<td>' . select_lin('empresa', 'data_hora_add', "`id`='" . $id . "'")[0] . '</td></tr>';
                    }
                    $html .= '</table>';
                }
                if ($usuarios_add != []) {
                    $html .= '<br/><br/>';
                    $html .= '<h3>Usuario add por ' . $array_id_adm[$i] . '</h3>';
                    $html .= '<table width=70% border="1" cellspacing="0" cellpadding="5"><form action="" method="POST">';
                    $html .= '<tr></tr><tr><td>Empresa/Cliente</td><td>Data</td></tr>';
                    for ($l = 0; $l < count($usuarios_add); $l++) {
                        $id = $usuarios_add[$l];
                        $html .= '<tr><td>' . select_lin('empresa', 'nome', "`id`='" . $id . "'")[0] . '</td>';
                        $html .= '<td>' . select_lin('empresa', 'data_hora_add', "`id`='" . $id . "'")[0] . '</td></tr>';
                    }
                    $html .= '</table>';
                }


            }

        }

        $html .= '<br/><br/><br/>';




        $html .= '</center>';
        gerar_pdf ($html);





    }



}
function hora_em_data($hora)
{
    $minuto = ($hora - (int) $hora) * 60;
    $segundo = ($minuto - (int) $minuto) * 60;
    return (int) $hora . ':' . (int) $minuto . ':' . (int) $segundo;
}
function data_em_hora($data)
{
    $hora = 0.0;
    for ($i = 0; $i < count($data); $i++) {
        switch ($i) {
            case 0:
                $hora += floatval($data[0]) * 8760;
                break;
            case 1:
                $hora += floatval($data[1]) * 730;
                break;
            case 2:
                $hora += floatval($data[2]) * 24;
                break;
            case 3:
                $hora += floatval($data[3]);
                break;
            case 4:
                $hora += floatval($data[4]) / 60;
                break;
            case 5:
                $hora += floatval($data[5]) / 3600;
                break;

        }
    }
    return $hora;
}
function gerar_pdf($html)
{
    echo "<script>

        var style = '<style>';
        style = style + 'tr:nth-child(even) {background-color: rgb(100, 100, 100,0.2)}/* colocar intercalado os traços da lista */';
        style = style + 'padding: 2px 3px;text-align: center;}';
        style = style + '</style>';
        style = style +  '" . $html . "';
        // CRIA UM OBJETO WINDOW
        var win = window.open('','', 'height=700,width=700');
        win.document.write('<html><head>');
        win.document.write('<title>Empregados</title>');   // <title> CABEÇALHO DO PDF.
        win.document.write(style);                                     // INCLUI UM ESTILO NA TAB HEAD
        win.document.write('</head>');
        win.document.write('<body>');
     
        win.document.close(); 	
        win.save('oi.pdf');                                             // FECHA A JANELA
    
        
        </script>";
}

echo '</div>';
?>