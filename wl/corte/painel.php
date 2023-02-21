<script src="https://code.jquery.com/jquery-3.6.3.js"></script>
<?php

date_default_timezone_set('America/Sao_Paulo');
include('../config/login/verifica_login.php');
verifica_login('cortador');
include('../config/db/comandos.php');
include('../config/db/conexao.php');
menu($_SESSION['usuario'], '');
echo '<div class="main">';
if (isset($_POST['sair'])) {
    header('Location: ../config/login/logout.php');
}

function copy_t($text)
{
    echo '
    <script language=\'javascript\'>
    navigator.clipboard.writeText("' . $text . '");
    </script>
    ';
}

echo '<table width=70% border="1" cellspacing="0" class="relative"cellpadding="5"><form action="" method="POST"><tr>';
echo '<form action="" method="post" enctype="multipart/form-data">';
$result = '';
$php = '';

$array_prioridade = select('desenhos', 'prioridade', "`status` = 'corte'");
$array_nome = select('desenhos', 'nome', "`status` = 'corte'");
$array_caminho = select('desenhos', 'caminho', "`status` = 'corte'");
$array_empreendimento = select('desenhos', 'empreendimento', "`status` = 'corte'");
$array_empresa = select('desenhos', 'empresa', "`status` = 'corte'");
$array_finalidade = select('desenhos', 'finalidade', "`status` = 'corte'");
$id = select('desenhos', 'id', "`status` = 'corte'");

$result .= '<tr><td align="center">Nome desenho</td>';
$result .= '<td align="center">Empresa</td>';
$result .= '<td align="center">Empreendimento</td>';
$result .= '<td align="center">Finalidade</td>';
$result .= '<td align="center">Prioridade</td>';
$result .= '<td></td><td></td></tr>';
for ($i = 0; $i < count($array_nome); $i++) {
    $result .= '<tr align="center"><td>' . $array_nome[$i][0] . '</td>';
    
   
        
        $result .= '<td align="center">' . id_nome('empresa',$array_empresa[$i][0],'nome') . '</td>';
        $result .= '<td align="center">' . id_nome('empreendimentos',$array_empreendimento[$i][0],'nome') . '</td>';
    
    $result .= '<td align="center">' . id_nome('finalidade',$array_finalidade[$i][0],'nome') . '</td>';
    $result .= '<td align="center">' . id_nome('prioridade',$array_prioridade[$i][0],'nome') . '</td>';
    $result .= '<td align="center"><input type="submit" value="Cortar" id="cortar' . $i . '" name="cortar' . $i . '"></td>';
    $result .= '<td align="center"><input type="submit" value="Confirmar" id="confirmar' . $i . '" name="confirmar' . $i . '"></td></tr>';

    $php .= 'if(isset($_POST[\'cortar' . $i . '\'])){
        copy_t(str_replace(\'\\\\\',\'/\',\'' . $array_caminho[$i][0] . $array_nome[$i][0] . '\'));
        alert("Desenho copiado para a área de transferência.");
        
        if(!mysqli_num_rows(sql("SELECT * FROM `corte` WHERE `id_desenho` = \'' . $id[$i][0] . '\' and `cortador` = \'' . nome_id('usuarios',$_SESSION['usuario'],'nome') . '\'"))){
            sql("INSERT INTO `corte`(`id_desenho`, `cortador`, `data_add`, `status`) VALUES (\'' . $id[$i][0] . '\',\'' . nome_id('usuarios',$_SESSION['usuario'],'nome') . '\',\'".date(\'d/m/Y H:i:s\')."\',\'inicio\')");
        }else{
            //sql("UPDATE `corte` SET `data_add`=\'".date(\'d/m/Y H:i:s\')."\' WHERE `id_desenho` = \'' . $id[$i][0] . '\';");
        }
    }
     if(isset($_POST["confirmar' . $i . '"])){
        confirmar("Confirmar corte","Deseja confirmar o corte do desenho ' . $array_nome[$i][0] . ' que se encontra-se no diretório ' . $array_caminho[$i][0] . ' ?","ok_confirmar' . $i . '","Confirmar corte");
    }
     if(isset($_POST[\'ok_confirmar' . $i . '\'])){
    $id = select("desenhos","id"," `nome` = \'' . mysqli_real_escape_string($conexao, $array_nome[$i][0]) . '\' and `caminho` = \'' . mysqli_real_escape_string($conexao, $array_caminho[$i][0]) . '\'")[0][0];
    $caminho = select("desenhos","caminho","`nome` = \'' . mysqli_real_escape_string($conexao, $array_nome[$i][0]) . '\' and `caminho` = \'' . mysqli_real_escape_string($conexao, $array_caminho[$i][0]) . '\'")[0][0];
    $nome = select("desenhos","nome","`nome` = \'' . mysqli_real_escape_string($conexao, $array_nome[$i][0]) . '\' and `caminho` = \'' . mysqli_real_escape_string($conexao, $array_caminho[$i][0]) . '\'")[0][0];
    $status = select("desenhos","status","`nome` = \'' . mysqli_real_escape_string($conexao, $array_nome[$i][0]) . '\' and `caminho` = \'' . mysqli_real_escape_string($conexao, $array_caminho[$i][0]) . '\'")[0][0];
    $data_hora = select("desenhos","data_hora_add","`nome` = \'' . mysqli_real_escape_string($conexao, $array_nome[$i][0]) . '\' and `caminho` = \'' . mysqli_real_escape_string($conexao, $array_caminho[$i][0]) . '\'")[0][0];
    
    sql("INSERT INTO `corte`(`id_desenho`, `cortador`, `data_add`, `status`) VALUES (\'' . $id[$i][0] . '\',\'' . nome_id('usuarios',$_SESSION['usuario'],'nome') . '\',\'".date(\'d/m/Y H:i:s\')."\',\'finalizado\')");
    sql("INSERT INTO `historico_desenhos`(`status`,`id_desenhos`, `nome`, `data_hora_add`, `data_hora_mod`,`individuo`) VALUES (\'$status => cortado\',\'$id\',\'' . mysqli_real_escape_string($conexao, $array_nome[$i][0]) . '\',\'$data_hora\',\'".date(\'d/m/Y H:i:s\')."\',\'' . nome_id('usuarios',$_SESSION['usuario'],'nome') . '\')");
    sql("UPDATE `desenhos` SET `status` = \'cortado\',`cortador` = \'' . nome_id('usuarios',$_SESSION['usuario'],'nome') . '\' WHERE `nome` = \'' . mysqli_real_escape_string($conexao, $array_nome[$i][0]) . '\' and `caminho` = \'' . mysqli_real_escape_string($conexao, $array_caminho[$i][0]) . '\';");
    reload("painel.php");   
}
     ';
}
echo $result;
echo '</form></table>';
eval($php);
echo '</div>';



?>