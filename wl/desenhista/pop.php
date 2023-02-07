<?php
include("../config/db/conexao.php");

if($_GET['modo'] == 'empreendimento'){
$query = "SELECT empreendimentos.nome FROM empresa LEFT JOIN empreendimentos ON empresa.id=empreendimentos.empresa_id AND empresa.nome = '".$_GET['dir']."';";

}else if($_GET['modo'] == 'empresa'){
    $query = "SELECT empresa.nome FROM empreendimentos LEFT JOIN empresa ON empresa.id=empreendimentos.empresa_id AND empreendimentos.nome = '".$_GET['dir']."';";

}else if($_GET['modo'] == 'empreendimentos'){
    $query = "SELECT `nome` FROM `empreendimentos` WHERE 1";
}else if($_GET['modo'] == 'empresas'){
    $query = "SELECT `nome` FROM `empresa` WHERE 1";
}else{
    exit;
}
if($_GET['modo'] != 'empresa'){
    echo '<option>Nada</option>';
}

$result = mysqli_query($conexao, $query);

if(($result) and ($result->num_rows != 0)){
    while($row = mysqli_fetch_assoc($result)) {
        $array = array();
        $keys = array_keys($row);
        for ($i=0; $i < $result->field_count; $i++) {
            if($row["nome"]!=null){
            echo "<option>".$row["nome"] . "</option>";
            }
        }
        
      }
}else{
    echo 'erro';
}
if($_GET['modo'] == 'empresa'){
    echo '<option>Nada</option>';
}


?>