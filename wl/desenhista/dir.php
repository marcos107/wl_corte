<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script src="https://code.jquery.com/jquery-3.6.3.js"></script>
<?php
include('../config/login/verifica_login.php');
verifica_login('desenhista');
include('../config/db/comandos.php');
include('../config/db/conexao.php');
date_default_timezone_set('America/Sao_Paulo');
?>
<style>
td {
    border: 3px solid rgb(0, 0, 0,0);
    height: 20px;
}
.none{
    border: none;
    background: none;
    cursor: pointer;
    margin: 0;
    padding: 0;
}
/* link que ainda não foi visitado */
a:link {
   color: black;
}

/* link que foi visitado */
a:visited {
    color: black;
}

/* mouse over */
a:hover {
    color: black;
}

/* link selecionado */
a:active {
    color: black;
}




</style>

<?php


function add_arquivo($abre_dir){

    include('../config/db/conexao.php');
    if (isset($_POST['file_plus'])) {
        $filtro = select_lin('filtros','nome',"`status` = 'ativo'");
        $f = '.';
        $f .= implode(',.', $filtro);
        modal('Adicionar desenho','<p>Escolha um arquivo que esteja num desses formatos ('. $f .')</p><p><input type="file" name="file[]" multiple="multiple" accept="'. $f .'"   /></p>','file_plus1','Próximo');
   
    
    }




if (isset($_POST['file_plus1'])) {
    do{
       $caminho_temp = '/hd/temp/'.rand(1000,100000).'/';//cria um caminho temporario
       //$caminho_temp = 'Z:temp/'.rand(1000,100000).'/';//cria um caminho temporario
    }while(is_dir($caminho_temp));
    sql("INSERT INTO `desenhos_temp`(`destino`,`diretorio`, `individuo`, `data_add`, `status`) VALUES ('".$abre_dir."','".str_replace('/','/',$caminho_temp)."','".$_SESSION['usuario']."','".date('d/m/Y H:i:s')."','processando')");
    mkdir($caminho_temp, 0777, true);//cria uma pasta teporaria
    $arquivo = $_FILES['file'];//abre os arquivos selecionados
    $lista = '';
    $java  = '';
    $alert = '';
    $arquivos_temp=[];
    $arquivos_name = [];
    $arquivos_diretorio = [];




        // move os arquivos para a pasta temp e descompacta os arquivo zip
        for ($i = 0; $i < count($arquivo['name']); $i++) {
        $arquivoNovo = explode('.', $arquivo['name'][$i]);
        if($arquivoNovo[sizeof($arquivoNovo) - 1] == 'zip'){
            move_uploaded_file($arquivo['tmp_name'][$i], $caminho_temp . $arquivo['name'][$i]);
            descompactar_arquivo($caminho_temp . $arquivo['name'][$i],$caminho_temp);
        }else{
            move_uploaded_file($arquivo['tmp_name'][$i], $caminho_temp . $arquivo['name'][$i]);
        }
        }
        //fim

        $arquivos_pasta = map_pasta($caminho_temp);
       

        
        
        for($i=0; $i < count($arquivos_pasta); $i++){
            array_push($arquivos_diretorio, substr($arquivos_pasta[$i], strlen($caminho_temp)));
        }

        $filtro = select_lin('filtros','nome',"`status` = 'ativo'");
        // verifica se o arquivo é dxf e se ja existe no diretorio se ja existir ou não for dxf ele apaga
        for ($i=0; $i < count($arquivos_pasta); $i++) { 
            $arquivoNovo = explode('.', $arquivos_pasta[$i]);
            if (!file_exists($abre_dir .  $arquivos_diretorio[$i])) {
                if (in_array($arquivoNovo[sizeof($arquivoNovo) - 1],$filtro)) {
                    array_push($arquivos_temp, $arquivos_pasta[$i]);
                } else {
                    $alert .= 'apenas arquivos '.implode(",\.", $filtro).' ou zip são permitidos, arquivo como ('. substr($arquivos_pasta[$i], strrpos(substr($arquivos_pasta[$i], 0, -1), '/') + 1, strlen($arquivos_pasta[$i])) .') no diretorio ' . $abre_dir.' não são permitidos\n';
                    sql("INSERT INTO `violacao`( `individuo`, `causa`, `data`) VALUES ('".nome_id('usuarios',$_SESSION['usuario'],'nome')."','Tentou upar um arquivo não permitido, arquivo(".substr($arquivos_pasta[$i], strrpos(substr($arquivos_pasta[$i], 0, -1), '/') + 1, strlen($arquivos_pasta[$i]))."), local(".$abre_dir.")','".date('d/m/Y H:i:s')."')");
                    unlink($arquivos_pasta[$i]);
                }
            }else{
                $alert .= 'Já existe um arquivo com o nome de(' . substr($arquivos_pasta[$i], strrpos(substr($arquivos_pasta[$i], 0, -1), '/') + 1, strlen($arquivos_pasta[$i])) . ',) no diretorio ' . $abre_dir.'\n';
                unlink($arquivos_pasta[$i]);
            }
        }
        // fim

        // pega os nomes dos arquivos
        for($i=0; $i < count($arquivos_temp); $i++){
            array_push($arquivos_name, substr($arquivos_temp[$i], strrpos(substr($arquivos_temp[$i], 0, -1), '/') + 1, strlen($arquivos_temp[$i]))); // pega o nome do arquivo 
        }
        //fim
        
                 //////////////////
        
                 /////////////////

        $_SESSION['diretorio_temp'] = $caminho_temp;//passa o diretorio temporario
        $_SESSION['arquivos_temp'] = $arquivos_temp;//passa o diretorio de cada arquivo
        $_SESSION['arquivo_name'] =  $arquivos_name;//passa o nome de cada arquivo

    $empreendimento = cascata(select('empreendimentos','nome','`status` = \'ativo\''));
    $empresa = cascata(select('empresa','nome','`status` = \'ativo\''));
    $finalidade = cascata(select('finalidade','nome','`status` = \'ativo\''));
    $prioridade = cascata(select('prioridade','nome','`status` = \'ativo\''));
       if(!$arquivos_name == null){
          
       
       
    
   
        for ($i = 0; $i < count($arquivos_name); $i++) {
            
                $lista .= '<tr><td>' . $arquivos_name[$i] . '</td> 
        
        <td> <select id="empresa' . $i  . '" name="empresa' . $i . '">' . $empresa . '</select></td>
        <td> <select id="empreendimento' . $i  . '" name="empreendimento' . $i . '">' . $empreendimento . '</select></td>
        <td> <select id="finalidade' . $i . '" name="finalidade' . $i . '" >' . $finalidade . '</select></td>
        <td> <select id="prioridade' . $i . '" name="prioridade' . $i . '" >' . $prioridade . '</select></td></tr>';

                $java .= " $('#empresa" . $i . "').change(function(){
            $('#empresa option').remove();
            var valor = document.getElementById('empresa" . $i . "').value;
           if(valor != ''){
            $.post('pop.php?dir='+valor+'&modo=empreendimento', function(retorna){
              $('#empreendimento" . $i . "').html(retorna);
            });
        
        }else{
          $.post('pop.php?dir= &modo=empreendimentos', function(retorna){
              $('#empreendimento" . $i . "').html(retorna);
            });
        }
        })
        ";
            
        }


echo '<span class="not-visible" id="file">'.count($arquivos_name).'</span>';
modal('Descrever Desenhos','
    
    <table width="100%" border="1" cellspacing="0" cellpadding="5"><form action="" method="POST"><tr>
    <td>Nome</td>
    <td>Emepresa/Cliente</td>
    <td>Empreendimento</td>
    <td>Finalidade</td>
    <td>Prioridade</td>
    </tr>
     <tr>
    <td align="center">*</td>
              
              <td><select id="empresas" name="empresas"  /> '.$empresa.'  </select></td>
              <td> <select id="empreendimentos" name="empreendimentos">'.$empreendimento.'</select></td>
              <td> <select id="finalidades" name="finalidades" >'.$finalidade.'</select></td>
              <td> <select id="prioridades" name="prioridades" >'.$prioridade.'</select></td>
              
              </tr>'.$lista.     
           '
    </table>

   

    ','file_plus2','Próximo');
    echo "<script type='text/javascript'>

    $('#empreendimentos').change(function(){ 

        var valor = document.getElementById('empreendimentos').value;
        document.getElementById('file').value;
        
        for (let i = 0; i < parseInt(document.getElementById('file').innerHTML); i++) {
            document.getElementById('empreendimento'+i).value = valor;      
        }

    })
    $('#finalidades').change(function(){ 

        var valor = document.getElementById('finalidades').value;
        document.getElementById('file').value;
        for (let i = 0; i < parseInt(document.getElementById('file').innerHTML); i++) {
            document.getElementById('finalidade'+i).value = valor;      
        }

    })
    $('#prioridades').change(function(){ 

        var valor = document.getElementById('prioridades').value;
        document.getElementById('file').value;
        for (let i = 0; i < parseInt(document.getElementById('file').innerHTML); i++) {
            document.getElementById('prioridade'+i).value = valor;      
        }

    })
    $('#empresas').change(function(){ 

        var valor = document.getElementById('empresas').value;
        document.getElementById('file').value;
        for (let i = 0; i < parseInt(document.getElementById('file').innerHTML); i++) {

            document.getElementById('empresa'+i).value = valor;
            if(valor != ''){
               
                $.post('pop.php?dir='+valor+'&modo=empreendimento', function(retorna){
                  $('#empreendimento'+i).html(retorna);
                });
            
            
            }else{
              
              $.post('pop.php?dir= &modo=empreendimentos', function(retorna){
                  $('#empreendimento'+i).html(retorna);
                });
            
        }
        if(valor != ''){
               
            $.post('pop.php?dir='+valor+'&modo=empreendimento', function(retorna){
              $('#empreendimentos').html(retorna);
            });
        
        
        }else{
          
          $.post('pop.php?dir= &modo=empreendimentos', function(retorna){
              $('#empreendimentos').html(retorna);
            });
        
    }
    }
    if(valor != ''){
               
        $.post('pop.php?dir='+valor+'&modo=empreendimento', function(retorna){
          $('#empreendimentos').html(retorna);
        });
    
    
    }else{
      
      $.post('pop.php?dir= &modo=empreendimentos', function(retorna){
          $('#empreendimentos').html(retorna);
        });
    
}
    })
    
    ".$java."

 
    
</script>";
        } else {
            sql("UPDATE `desenhos_temp` SET `status`='finalizado', `data_finalizado` = '".date('d/m/Y H:i:s')."' WHERE `status` = 'processando' and `diretorio` = '".str_replace('/','/',$_SESSION['diretorio_temp'])."' and `individuo` = '".$_SESSION['usuario']."'");
            deletar_diretorio($_SESSION['diretorio_temp']);
            $_SESSION = ['usuario' => $_SESSION['usuario'],'categoria_usuario' => $_SESSION['categoria_usuario']];
        }
        if ($alert != '') {
            alert($alert);
        }
}




if ((isset($_POST['file_plus2']) && (isset($_SESSION['arquivo_name'])))) {
  
    $user = $_SESSION['usuario'];
    $arquivo = $_SESSION['arquivo_name'];

    $alert='';

    for ($i = 0; $i < count($arquivo); $i++) {
        if(htmlentities($_POST['prioridade'.$i], ENT_QUOTES, "UTF-8")!=''){
            if(htmlentities($_POST['finalidade'.$i], ENT_QUOTES, "UTF-8")!=''){
            if(htmlentities($_POST['empreendimento'.$i], ENT_QUOTES, "UTF-8")!=''){
            if(htmlentities($_POST['empresa'.$i], ENT_QUOTES, "UTF-8")!=''){
           // echo 'Upload foi feito com sucesso!';
           $strr_dir = strrpos(substr($_SESSION['arquivos_temp'][$i], 0, -1), '/'); //pega o penultimo / da estring $caminho
           $caminho = substr($_SESSION['arquivos_temp'][$i], 0, $strr_dir + 1); // pega o nome da pasta anterior

            $caminho =substr($caminho, strlen($_SESSION['diretorio_temp']));//pega o diretorio do arquivo
           $query = "INSERT INTO `desenhos`(`nome`, `caminho`, `desenhista`,`status`, `prioridade`, `finalidade`, `empreendimento`, `empresa`, `data_hora_add`) VALUES ('" . $arquivo[$i] . "','" .  mysqli_real_escape_string($conexao,str_replace('/','/',$abre_dir.$caminho)) . "','" . nome_id('usuarios',$user,'nome','') . "','corte','" . nome_id('prioridade',htmlentities($_POST['prioridade'.$i], ENT_QUOTES, "UTF-8"),'nome') . "','" .  nome_id('finalidade',htmlentities($_POST['finalidade'.$i], ENT_QUOTES, "UTF-8"),'nome') . "','" .  nome_id('empreendimentos',htmlentities($_POST['empreendimento'.$i], ENT_QUOTES, "UTF-8"),'nome','`empresa_id` =\''.nome_id('empresa',htmlentities($_POST['empresa'.$i], ENT_QUOTES, "UTF-8"),'nome').'\'') . "','" . nome_id('empresa',htmlentities($_POST['empresa'.$i], ENT_QUOTES, "UTF-8"),'nome') . "','".date('d/m/Y H:i:s')."')";
           $result = mysqli_query($conexao, $query);
           
           
       
            if(!is_dir($abre_dir.$caminho)){
                mkdir($abre_dir.$caminho, 0777,true);
            }
 
     
            rename($_SESSION['arquivos_temp'][$i], $abre_dir . substr($_SESSION['arquivos_temp'][$i], strlen($_SESSION['diretorio_temp'])));

          
            //echo $_SESSION['caminho_temp'][$i].' -de para- '.$_SESSION['caminho'] . $arquivo['name'][$i];
        }else{$alert.= 'Arquivo ('. $arquivo[$i] .') não foi selecionada uma prioridade.\n';}
    }else{$alert.= 'Arquivo ('. $arquivo[$i] .') não foi selecionada uma finalidade.\n';}
    }else{$alert.= 'Arquivo ('. $arquivo[$i] .') não foi selecionada uma empreendimento.\n';}
    }else{$alert.= 'Arquivo ('. $arquivo[$i] .') não foi selecionada uma empresa.\n';}
    

    }
    if($alert!=''){
        alert($alert);
    }
    
    sql("UPDATE `desenhos_temp` SET `status`='finalizado', `data_finalizado` = '".date('d/m/Y H:i:s')."' WHERE `status` = 'processando' and `diretorio` = '".str_replace('/','/',$_SESSION['diretorio_temp'])."' and `individuo` = '".$_SESSION['usuario']."'");
    deletar_diretorio($_SESSION['diretorio_temp']);
    $_SESSION = ['usuario' => $_SESSION['usuario'], 'categoria_usuario' => $_SESSION['categoria_usuario']];
}

}


?>

<?php
menu($_SESSION['usuario'],'<li><input type="submit" name="voltar" value="Voltar" /></li>');
echo '<div class="main">';
$base_dir = '/hd/wl_desenhos/';
//$base_dir = 'Z:wl_desenhos/';
//$base_dir = 'OneDrive';
if (isset($_GET['dir'])) {
    $abre_dir = ($_GET['dir'] != '' ? $_GET['dir'] : $base_dir);
}else{
    $abre_dir = $base_dir;
}

if(substr($abre_dir,0,strlen($base_dir)) != $base_dir){
    $abre_dir = $base_dir;
  
}


$open_dir = dir($abre_dir);//le a pasta que esta em $caminho
$strr_dir = strrpos(substr($abre_dir, 0, -1), '/'); //pega o penultimo / da estring $caminho
$back_dir = substr($abre_dir, 0, $strr_dir + 1); // pega o nome da pasta anterior


// apaga a pasta que esta no caminho da variavel $abre_dir
if(isset($_POST['apagar_pasta'])){
    $arquivo = false;
    while ($arq = $open_dir->read()) {
        if($arq != '.' && $arq !='..'){
            $arquivo = true;
        }
   }
   
   //verifica se a pasta esta vazia
   if($arquivo){
    alert('É preciso que a pasta esteja vazia');
   }else{;
    rmdir($abre_dir);
    reload('Location: dir.php?dir=' . $back_dir); 
   }
    

}
// fim


add_pasta($abre_dir);


// quando aperta no botão de voltar ele vai para a pagina '\painel.php'
if(isset($_POST['voltar'])){
    reload('painel.php');
}
// fim
if(isset($_POST['sair'])){
    reload('../config/login/logout.php');
}




add_arquivo($abre_dir);
$open_dir = dir($abre_dir);//le a pasta que esta em $caminho
$strr_dir = strrpos(substr($abre_dir, 0, -1), '/'); //pega o penultimo / da estring $caminho
$back_dir = substr($abre_dir, 0, $strr_dir + 1); // pega o nome da pasta anterior





echo '<table width="50%" border="1" cellspacing="0" cellpadding="5">';

  
                            
   echo '<form action="" method="POST">';
   echo '<tr></tr>';
   if($abre_dir != $base_dir){
    
        echo '<tr>';
        echo '<td width="30"><a href="dir.php?dir=' . $back_dir . '"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left-circle"><circle cx="12" cy="12" r="10"></circle><polyline points="12 8 8 12 12 16"></polyline><line x1="16" y1="12" x2="8" y2="12"></line></svg></a></td>';
        echo '<td ></td>';
        echo '<td width="30" align="center"><button type="submit" name="apagar_pasta" class="none" ><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-folder-minus"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"></path><line x1="9" y1="14" x2="15" y2="14"></line></svg></button></td>';
        echo '<td width="30" align="center"><button type="submit" name="add_pasta" class="none" ><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-folder-plus"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"></path><line x1="12" y1="11" x2="12" y2="17"></line><line x1="9" y1="14" x2="15" y2="14"></line></svg></button></td>';
        echo '<td width="30" align="center"><button type="submit" name="file_plus" class="none" ><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-plus"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="12" y1="18" x2="12" y2="12"></line><line x1="9" y1="15" x2="15" y2="15"></line></svg></button></td>';
        echo '</tr>';
    }else{
        echo '<tr>';
        echo '<td width="30"></td>';
        echo '<td ></td>';
        echo '<td width="30" align="center"><button type="submit" name="apagar_pasta" class="none" ><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-folder-minus"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"></path><line x1="9" y1="14" x2="15" y2="14"></line></svg></button></td>';
        echo '<td width="30" align="center"><button type="submit" name="add_pasta" class="none" ><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-folder-plus"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"></path><line x1="12" y1="11" x2="12" y2="17"></line><line x1="9" y1="14" x2="15" y2="14"></line></svg></button></td>';
        echo '<td width="30" align="center"><button type="submit" name="file_plus" class="none"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-plus"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="12" y1="18" x2="12" y2="12"></line><line x1="9" y1="15" x2="15" y2="15"></line></svg></button></td>';
        echo '</tr>';
    }

while ($arq = $open_dir->read()) {

    if ($arq != '.' && $arq != '..') {
        if (is_dir($abre_dir . $arq)) {
            echo '<tr>';
            echo '<td><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-folder"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"></path></svg></td>';
            echo '<td>' . $arq . '</td>';
            echo '<td align="center"><a href="dir.php?dir=' . $abre_dir . $arq . '/"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right-circle"><circle cx="12" cy="12" r="10"></circle><polyline points="12 16 16 12 12 8"></polyline><line x1="8" y1="12" x2="16" y2="12"></line></svg></a></td>';
            echo '<td></td>';
            echo '<td></td>';
            echo '</tr>';
        } else {
            echo '<tr>';
            echo '<td><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file"><path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path><polyline points="13 2 13 9 20 9"></polyline></svg></td>';
            echo '<td>' . $arq . '</td>';
            echo '<td></td>';
            echo '<td></td>';
            echo '<td></td>';
            echo '</tr>';
        }
    }
}
    echo '</form>';
echo '</table>';

echo '</div>';


?>