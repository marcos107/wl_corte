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
menu($_SESSION['usuario'],'<li><input type="submit" name="add_desenho" value="Add desenho" /></li>');
echo '<div class="main">';

if(isset($_POST['fechar_modal'])){
    reload('painel.php');
}
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
?>



<style>

td {
    border: 4px solid rgb(0, 0, 0,0);
}
</style>