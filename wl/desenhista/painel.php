<head>
<meta charset="utf-8"/>
</head>


<?php
include('../config/login/verifica_login.php');
verifica_login('desenhista');
include('../config/db/comandos.php');
include('../config/db/conexao.php');
date_default_timezone_set('America/Sao_Paulo');
if(isset($_POST['add_desenho'])){
    header('Location: desenho_pendente.php');
}
if(isset($_POST['sair'])){
    header('Location: ../config/login/logout.php');
}
menu($_SESSION['usuario'],'<li><input type="submit" name="add_desenho" value="Add desenho" /></li><li><input type="submit" name="meus_desenhos" value="Meus desenhos" /></li><li><input type="submit" name="empreendimento" value="Empreendimento" /></li>');
echo '<div class="main">';

if(isset($_POST['meus_desenhos'])){
    retorne('meus_desenhos', 'meus_desenhos');
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
            for ($i = 0; $i < count($array_nome); $i++) {
                array_push($array_id_empresa, select_lin('empreendimentos', 'empresa_id', '`nome` = \'' . $array_nome[$i] . '\'')[0]);
            }
            $array_empresa = [];
    
            $php = '"
        if(isset(\$_POST[\'" . $nomes_itens[$l] . $i . "\'])){
            \$id = select_lin(\'empresa\',\'id\',\"`nome`=\'" . $valores1[0][$i] . "\'\");
            sql(\"UPDATE `empreendimentos` SET `status`=\'desativado\' WHERE `nome`=\'" . $valores[$i] . "\' and `empresa_id` = \'\".\$id[0].\"\'\");
            sql(\"INSERT INTO `historico_adm`(`info_mais`,`nome`,`id_adm`, `item`, `status`, `data_add`) VALUES (\'\".\$id[0].\"\',\'" . nome_id(\'empreendimentos\',$valores[$i],\'nome\') . "\',\'' . nome_id('usuarios', $_SESSION['usuario'], 'nome') . '\',\'empreendimento\',\'desativado\',\'\".date(\'d/m/Y H:i:s\').\"\')\");
            reload(\'painel.php\');
        }";';
            for ($i = 0; $i < count($array_id_empresa); $i++) {
                array_push($array_empresa, select_lin('empresa', 'nome', '`id` = \'' . $array_id_empresa[$i] . '\'')[0]);
            }
    
            $result = tabela($array_nome, [$array_empresa], ['Empreendimentos', 'Empresas/Clientes', ' '], ['submit'], ['Desativar'], $php);
            echo ($result[0]);
            eval($result[1]);
    
        }
    
        if (isset($_POST['ativar_empreendimento']) || isset($_SESSION['ativar_empreendimento'])) {
            unset($_SESSION['ini_empreendimento']);
            $array_nome = select_lin('empreendimentos', 'nome', '`status` = \'desativado\'');
            sort($array_nome);
            $array_id_empresa = [];
            for ($i = 0; $i < count($array_nome); $i++) {
                array_push($array_id_empresa, select_lin('empreendimentos', 'empresa_id', '`nome` = \'' . $array_nome[$i] . '\'')[0]);
            }
            $array_empresa = [];
            for ($i = 0; $i < count($array_id_empresa); $i++) {
                array_push($array_empresa, select_lin('empresa', 'nome', '`id` = \'' . $array_id_empresa[$i] . '\'')[0]);
            }
    
    
            $php = '"
        if(isset(\$_POST[\'" . $nomes_itens[$l] . $i . "\'])){
            \$id = select_lin(\'empresa\',\'id\',\"`nome`=\'" . $valores1[0][$i] . "\'\");
            sql(\"UPDATE `empreendimentos` SET `status`=\'ativo\' WHERE `nome`=\'" . $valores[$i] . "\' and `empresa_id` = \'\".\$id[0].\"\'\");
            sql(\"INSERT INTO `historico_adm`(`info_mais`,`nome`,`id_adm`, `item`, `status`, `data_add`) VALUES (\'\".\$id[0].\"\',\'" . nome_id(\'empreendimentos\',$valores[$i],\'nome\') . "\',\'' . nome_id('usuarios', $_SESSION['usuario'], 'nome') . '\',\'empreendimento\',\'ativo\',\'\".date(\'d/m/Y H:i:s\').\"\')\");
            reload(\'painel.php\');
        }";';
            $result = tabela($array_nome, [$array_empresa], ['Empreendimentos', 'Empresas/Clientes', ' '], ['submit'], ['Ativar'], $php);
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
                        sql("INSERT INTO `empreendimentos`(`individuo`, `data_hora_add`,`nome`, `empresa_id`, `status`) VALUES ('" . nome_id('usuarios', $_SESSION['usuario'], 'nome') . "','" . date('d/m/Y H:i:s') . "','" . $_POST['empreendimento_nome'] . "','" . $id[0] . "','ativo')");
                        //$_SESSION = ['categoria_usuario' => $_SESSION['categoria_usuario'],'usuario' => $_SESSION['usuario']];
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
        if (isset($_SESSION['ini_empreendimento']) && isset($_SESSION['empreendimento'])) {
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
                           
                            sql(\"INSERT INTO `historico_adm`(`info_mais`,`nome`,`id_adm`, `item`, `status`, `data_add`) VALUES (\'".$valores[$l]."\',\'" . nome_id(\'empreendimentos\',$valores[$l],\'nome\') . "\',\'' . nome_id('usuarios', $_SESSION['usuario'], 'nome') . '\',\'filtros\',\'auterou_nome\',\'\".date(\'d/m/Y H:i:s\').\"\')\");
                            sql(\"UPDATE `empreendimentos` SET `nome`=\'\".\$_POST[\'novo_nome".$l."\'].\"\' WHERE `nome`=\'".$valores[$l]."\'\");
                            reload(\'painel.php\');
                }else{
                            alert(\"Já existe esse nome\");
                }
            }
            
            ";';
    
            $array_id_empresa = [];
            for ($i = 0; $i < count($array_nome); $i++) {
                array_push($array_id_empresa, select_lin('empreendimentos', 'empresa_id', '`nome` = \'' . $array_nome[$i] . '\'')[0]);
            }
            $array_empresa = [];
            for ($i = 0; $i < count($array_id_empresa); $i++) {
                array_push($array_empresa, select_lin('empresa', 'nome', '`id` = \'' . $array_id_empresa[$i] . '\'')[0]);
            }
            $result = tabela($array_nome, [$array_empresa], ['Empreendimentos', 'Empresas/Clientes'], [], [], $php, $array_nome, 'text_button');
            eval($result[1]);
    
            echo ($result[0]);
    
        }
    }
    

if(!isset($_POST['empreendimento']) && !isset($_SESSION['empreendimento'])){
$filtro = select_lin('filtros','nome',"`status` = 'ativo'");
        
    $result = '';
    $php = '';
    $array_nome = select('desenhos', 'nome', "`status` = 'corte' AND `desenhista` = '" .nome_id('usuarios',$_SESSION['usuario'],'nome') . "'");
    $array_caminho = select('desenhos', 'caminho', "`status` = 'corte' AND `desenhista` = '" .nome_id('usuarios',$_SESSION['usuario'],'nome') . "'");
 

    $array_data = select('desenhos', 'data_hora_add', "`status` = 'corte'  AND `desenhista` = '" .nome_id('usuarios',$_SESSION['usuario'],'nome') . "'");
    $array_empreendimento = select('desenhos', 'empreendimento', "`status` = 'corte'  AND `desenhista` = '" .nome_id('usuarios',$_SESSION['usuario'],'nome') . "'");
    $array_prioridade = select('desenhos', 'prioridade', "`status` = 'corte'  AND `desenhista` = '" .nome_id('usuarios',$_SESSION['usuario'],'nome') . "'");
    $array_empresa = select('desenhos', 'empresa', "`status` = 'corte'  AND `desenhista` = '" .nome_id('usuarios',$_SESSION['usuario'],'nome') . "'");
    $array_finalidade = select('desenhos', 'finalidade', "`status` = 'corte'  AND `desenhista` = '" .nome_id('usuarios',$_SESSION['usuario'],'nome') . "'");
    $result .= '<tr><td>Caminho</td><td>Nome do arquivo</td><td>Prioridade</td><td>Finalidade</td><td>Emepresa/Cliente</td><td>Empreendimento</td>
    <td>Data add</td><td></td><td></td></tr>';
    $filtro = select_lin('filtros','nome',"`status` = 'ativo'");
    $f = '.';
    $f .= implode(',.', $filtro);
    for ($i = 0; $i < count($array_nome); $i++) {
        $result .= '<tr><td >' . $array_caminho[$i][0] . '</td>';
        $result .= '<td align="center">' . $array_nome[$i][0] . '</td>';
        $result .= '<td align="center">' . id_nome('prioridade',$array_prioridade[$i][0],'nome') . '</td>';
        $result .= '<td align="center">' . id_nome('finalidade',$array_finalidade[$i][0],'nome') . '</td>';
        $result .= '<td align="center">' . id_nome('empresa',$array_empresa[$i][0],'nome') . '</td>';
        $result .= '<td align="center">' . id_nome('empreendimentos',$array_empreendimento[$i][0],'nome') . '</td>';
        $result .= '<td align="center">' . $array_data[$i][0] . '</td>';
        $result .= '<td align="center"><input type="submit" value="Apagar" id="apagar' . $i . '" name="apagar' . $i . '"></td>';
        $result .= '<td align="center"><input type="submit" value="Subistituir" id="subistituir' . $i . '" name="subistituir' . $i . '"></td>';

        $php .= " if(isset(\$_POST['subistituir" . $i . "'])){
        \$strr_dir = strrpos(substr(\"".$array_caminho[$i ][0]."\", 0, -1), '/');
        \$back_dir = substr(\"".$array_caminho[$i ][0]."\", 0, \$strr_dir + 1);
        modal('Subistituir desenho',' Desenho ('.\"".$array_nome[ $i ][0]."\".') sera subistituido <br/><input type=\"file\" name=\"file\" accept=\"". $f ."\"/>','add_subistituir" . $i . "','Próximo');
       
    }
    if(isset(\$_POST['add_subistituir" . $i . "'])){
        
        \$arquivo = \$_FILES['file'];
        \$arquivoNovo = explode('.', \$arquivo['name']);
        \$id = select(\"desenhos\",\"id\",\"`desenhista` = '\".nome_id('usuarios',\$_SESSION['usuario'],'nome').\"' and `nome` = '".$array_nome[ $i ][0]."' and `caminho` = '".$array_caminho[$i ][0]."'\")[0][0];
        if (in_array(\$arquivoNovo[sizeof(\$arquivoNovo) - 1],\$filtro)) {
        
        if(file_exists(\"".$array_caminho[$i ][0]."\".\$arquivo['name'])){
            alert('Já existe um arquivo com o nome de('.\$arquivo['name'].') no diretorio '.\"".$array_caminho[$i ][0]."\");
        }else{
            
            unlink(\"".$array_caminho[$i ][0].$array_nome[ $i ][0]."\");
        move_uploaded_file(\$arquivo['tmp_name'],\"".$array_caminho[$i ][0]."\".\$arquivo['name']);
       
        \$status = select(\"desenhos\",\"status\",\"`desenhista` = '\".nome_id('usuarios',\$_SESSION['usuario'],'nome').\"' and `nome` = '".$array_nome[ $i ][0]."' and `caminho` = '".$array_caminho[$i ][0]."'\")[0][0];
\$data_hora = select(\"desenhos\",\"data_hora_add\",\"`desenhista` = '\".nome_id('usuarios',\$_SESSION['usuario'],'nome').\"' and `nome` = '".$array_nome[ $i ][0]."' and `caminho` = '".$array_caminho[$i ][0]."'\")[0][0];
sql(\"INSERT INTO `historico_desenhos`(`status`,`id_desenhos`, `nome`, `data_hora_add`, `data_hora_mod`, `individuo`) VALUES ('\".\$status.\" => corte','\".\$id.\"','\".\$array_nome[".$i."][0].\"','\".\$data_hora.\"','\".date('d/m/Y H:i:s').\"','".nome_id('usuarios',$_SESSION['usuario'],'nome')."')\");
     sql(\"UPDATE `desenhos` SET `nome`='\".\$arquivo['name'].\"' WHERE `desenhista` = '\".nome_id('usuarios',\$_SESSION['usuario'],'nome').\"' and `nome` = '".$array_nome[ $i ][0]."' and `caminho` = '".$array_caminho[$i ][0]."';\");
          
        }reload('painel.php'); 
    }else{
        sql(\"INSERT INTO `violacao`( `individuo`, `causa`, `data`) VALUES ('" .nome_id('usuarios',$_SESSION['usuario'],'nome') . "','Tentou subistituir uma deseho(id = \".\$id.\") com um arquivo não permitido, arquivo(\".\$arquivo['name'].\"), local(".$array_caminho[$i][0].")','\".date('d/m/Y H:i:s').\"')\");

        alert('Apenas arquivos ".$f." pode ser escolhido');
    }
         }
        if(isset(\$_POST['apagar" . $i . "'])){
            confirmar('Apagar desenho',\"<p> Deseja apagar o desenho (".$array_nome[ $i ][0].") que se encontra-se no diretório (".$array_caminho[$i ][0].")?\",'ok_apagar" . $i . "','Apagar');
        }
        if(isset(\$_POST['ok_apagar" . $i . "'])){
            \$id = select(\"desenhos\",\"id\",\"`desenhista` = '\".nome_id('usuarios',\$_SESSION['usuario'],'nome').\"' and `nome` = '".$array_nome[ $i ][0]."' and `caminho` = '".$array_caminho[$i ][0]."'\")[0][0];
            \$caminho = select(\"desenhos\",\"caminho\",\"`desenhista` = '\".nome_id('usuarios',\$_SESSION['usuario'],'nome').\"' and `nome` = '".$array_nome[ $i ][0]."' and `caminho` = '".$array_caminho[$i ][0]."'\")[0][0];
            \$nome = select(\"desenhos\",\"nome\",\"`desenhista` = '\".nome_id('usuarios',\$_SESSION['usuario'],'nome').\"' and `nome` = '".$array_nome[ $i ][0]."' and `caminho` = '".$array_caminho[$i ][0]."'\")[0][0];
            \$status = select(\"desenhos\",\"status\",\"`desenhista` = '\".nome_id('usuarios',\$_SESSION['usuario'],'nome').\"' and `nome` = '".$array_nome[ $i ][0]."' and `caminho` = '".$array_caminho[$i ][0]."'\")[0][0];
    \$data_hora = select(\"desenhos\",\"data_hora_add\",\"`desenhista` = '\".nome_id('usuarios',\$_SESSION['usuario'],'nome').\"' and `nome` = '".$array_nome[ $i ][0]."' and `caminho` = '".$array_caminho[$i ][0]."'\")[0][0];

    sql(\"INSERT INTO `historico_desenhos`(`status`,`id_desenhos`, `nome`, `data_hora_add`, `data_hora_mod`,`individuo`) VALUES ('\".\$status.\" => apagado','\".\$id.\"','\".\$array_nome[".$i."][0].\"','\".\$data_hora.\"','\".date('d/m/Y H:i:s').\"','".nome_id('usuarios',$_SESSION['usuario'],'nome')."')\");
    sql(\"UPDATE `desenhos` SET `status` = 'apagado' WHERE `desenhista` = '\".nome_id('usuarios',\$_SESSION['usuario'],'nome').\"' and `nome` = '".$array_nome[ $i ][0]."' and `caminho` = '".$array_caminho[$i ][0]."';\");
    sql(\"INSERT INTO `lixo_desenhos`( `id_desenho`, `caminho`, `nome_desenho`, `data_add`, `individuo`) VALUES ('\".\$id.\"','\".lixo_desenho(\$caminho,\$nome).\"','\".\$nome.\"','\".date('d/m/Y H:i:s').\"','".nome_id('usuarios',$_SESSION['usuario'],'nome')."')\");
    
            reload('painel.php');
        }
        
        
        
        
        ";
    }

  
    if($result!=''){
    echo '<table border="1" cellspacing="0" cellpadding="5"><form action="" method="POST"><tr>';
    echo '<form action="" method="post" enctype="multipart/form-data">';
    echo $result;
    echo '</form></table>';
    eval($php);
}
echo '</div>';
}
?>



<style>

td {
    border: 4px solid rgb(0, 0, 0,0);
}
</style>