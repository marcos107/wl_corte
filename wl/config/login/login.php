<?php
session_start();

include('../db/conexao.php');

if(empty($_POST['usuario']) || empty($_POST['senha'])){

  $_SESSION['nao_prenchido'] = true;
  //header('Location: ../../index.php');
  exit();
}

$usuario = mysqli_real_escape_string($conexao,$_POST['usuario']);
$senha = mysqli_real_escape_string($conexao,$_POST['senha']);

$query = "SELECT * FROM `usuarios` WHERE nome = '{$usuario}' and senha = md5('{$senha}') and (status = 'ativo' or status = 'adm');";

$result = mysqli_query($conexao, $query);

$row = mysqli_num_rows($result);

if($row){
  $rows = mysqli_fetch_assoc($result);
  if($rows['tipo']=="desenhista"){
   $_SESSION['usuario'] = $usuario;
   header('Location: ../../desenhista/painel.php');
  exit();
  }else if($rows['tipo']=="cortador"){
    $_SESSION['usuario'] = $usuario;
    header('Location: ../../corte/painel.php');
  exit();
  }else if($rows['tipo']=="adm"){
    $_SESSION['usuario'] = $usuario;
    header('Location: ../../adm/painel.php');
    exit();
  }else{
    header('Location: ../../index.php');
    exit();
  }
}else{
  $_SESSION['nao_autenticado'] = true;
  header('Location: ../../index.php');
  exit();
}
?>