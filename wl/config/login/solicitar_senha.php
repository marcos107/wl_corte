
<?php
session_save_path();
session_start();
date_default_timezone_set('America/Sao_Paulo');
include('../db/comandos.php');
include('../db/conexao.php');
if (isset($_POST['usuario'])) {
    $usuario = mysqli_real_escape_string($conexao, $_POST['usuario']);
    $_SESSION['usuario'] = $usuario;
}

if(isset($_POST['Reinviar'])){
    $usuario = $_SESSION['usuario'];
    $whatsapp = select_lin('usuarios', 'whatsapp', '`nome` = \'' . valid($usuario) . '\'')[0];

    do {
        $code = random_int_generator(8);
        $row = mysqli_num_rows(sql("SELECT * FROM `code_troca_senha` WHERE `status` = 'processando' and `code` = '" . $code . "';"));
    } while ($row);
   
    sql("INSERT INTO `code_troca_senha`(`code`, `data_hora_add`, `status`, `user`) VALUES ('" . $code . "','" . date('d/m/Y H:i:s') . "','processando','" . nome_id('usuarios', $usuario, 'nome') . "')");
    mensagem_whatsapp("trocar_senha","pt_BR",[$whatsapp],[$usuario],[$code]);
    
    $_SESSION['code_reco'] = $code;
}
if(isset($_POST['x_tela_sobre_tela'])){
    sql("UPDATE `code_troca_senha` SET `status`='finalizado' WHERE `code`='".$_SESSION['code_reco']."' and `status`='processando'");
    session_destroy();
    reload('../../index.php');
}

if (!isset($_POST['nova_senha_bt'])&&!isset($_POST['trocar_senha'])) {
   $usuario = $_SESSION['usuario'];
   
    $whatsapp = sql("SELECT  `whatsapp` FROM `usuarios` WHERE `nome` = '" . $usuario . "'");


    if (mysqli_num_rows($whatsapp)) {
        $whatsapp = select_lin('usuarios', 'whatsapp', '`nome` = \'' . valid($usuario) . '\'')[0];

        do {
            $code = random_int_generator(8);
            $row = mysqli_num_rows(sql("SELECT * FROM `code_troca_senha` WHERE `status` = 'processando' and `code` = '" . $code . "';"));
        } while ($row);
        if(!isset($_SESSION['code_reco'])){
        sql("INSERT INTO `code_troca_senha`(`code`, `data_hora_add`, `status`, `user`) VALUES ('" . $code . "','" . date('d/m/Y H:i:s') . "','processando','" . nome_id('usuarios', $usuario, 'nome') . "')");
        mensagem_whatsapp("trocar_senha","pt_BR",[$whatsapp],[$usuario],[$code]);
        
        $_SESSION['code_reco'] = $code;
        }
        
        
        modal("Insira o código recebido do whazapp",'<p><input name="codigo_senha" name="text" class="input is-large" placeholder="Seu código" autofocus=""></p><p><input type="submit" name="Reinviar" value="Reinviar código" /></p>','trocar_senha','Validar');

    }else{
        session_destroy();
        reload('../../index.php');
    }
}



if (isset($_POST['trocar_senha'])) {
if($_POST['codigo_senha']==$_SESSION['code_reco']){
    
        modal("Insira a nova senha",' <p><input name="nova_senha" name="text" class="input is-large" placeholder="Sua nova senha" autofocus=""></p><p><input name="nova_senha1" name="text" class="input is-large" placeholder="Repita a senha" autofocus=""><p>','nova_senha_bt','Validar');
}else{
        alert("codigo errado");
        modal("Insira o código recebido do whazapp",'<p><input name="codigo_senha" name="text" class="input is-large" placeholder="Seu código" autofocus=""></p><p><input type="submit" name="Reinviar" value="Reinviar código" /></p>','trocar_senha','Validar');
}
}
if (isset($_POST['nova_senha_bt'])) {
    if($_POST['nova_senha']!=$_POST['nova_senha1']){
        modal("Insira a nova senha",'<p>As senhas tem que ser iguais</p> <p><input name="nova_senha" name="text" class="input is-large" placeholder="Sua nova senha" autofocus=""></p><p><input name="nova_senha1" name="text" class="input is-large" placeholder="Repita a senha" autofocus=""><p>','nova_senha_bt','Validar');
    }else{
        $nova_senha = mysqli_real_escape_string($conexao, $_POST['nova_senha']);
        sql("UPDATE `usuarios` SET `senha`=md5('".$nova_senha."') WHERE `nome` = '".$_SESSION['usuario']."'");
        sql("UPDATE `code_troca_senha` SET `status`='finalizado',`data_hora_finalizado`='".date('d/m/Y H:i:s')."' WHERE `code`='".$_SESSION['code_reco']."' and `status`='processando'");
        $whatsapp = select_lin('usuarios', 'whatsapp', '`nome` = \'' . valid($_SESSION['usuario']) . '\'')[0];
        mensagem_whatsapp("trocar_senha_sucesso","pt_BR",[$whatsapp],[$_SESSION['usuario']]);
        session_destroy();
        
        reload('../../index.php');
    }

}



?>