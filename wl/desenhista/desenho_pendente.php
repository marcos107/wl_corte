<script src="https://code.jquery.com/jquery-3.6.3.js"></script>
<?php
include('../config/login/verifica_login.php');
verifica_login('desenhista');
include('../config/db/comandos.php');
include('../config/db/conexao.php');

$result = sql("SELECT `id` FROM `desenhos_temp` WHERE `individuo` = '".$_SESSION['usuario']."' and `status` = 'processando'");

$row = mysqli_num_rows($result);

if ($row) {
    $lista = '';
    $java  = '';
    $alert = '';
    $arquivos_name1 = [];
    $arquivos_temp1=[];
    $caminho_temp1 = [];
    $abre_dir1 = [];
    $data1 = [];


    $id = select_lin('desenhos_temp','id',"`individuo` = '".valid($_SESSION['usuario'])."' and `status` = 'processando'");
    for ($g=0; $g < count($id); $g++) {

        $caminho = select_lin('desenhos_temp','diretorio',"`id` = '".$id[$g]."'")[0];
        $abre_dir = select_lin('desenhos_temp','destino',"`id` = '".$id[$g]."'")[0];
        $data = select_lin('desenhos_temp','data_add',"`id` = '".$id[$g]."'")[0];
     
        
        $arquivos_diretorio = [];
        $arquivos_name = [];
        $arquivos_temp=[];
         $caminho_temp = [];
        array_push($caminho_temp,$caminho);


        $arquivos_pasta = map_pasta($caminho_temp[0]);







        for ($i = 0; $i < count($arquivos_pasta); $i++) {
            array_push($arquivos_diretorio, substr($arquivos_pasta[$i], strlen($caminho_temp[0])));

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
                    sql("INSERT INTO `violacao`( `individuo`, `causa`, `data`) VALUES ('".$_SESSION['usuario']."','Tentou upa um arquivo não permitido, arquivo(".substr($arquivos_pasta[$i], strrpos(substr($arquivos_pasta[$i], 0, -1), '/') + 1, strlen($arquivos_pasta[$i]))."), local(".$abre_dir.")','".date('d/m/Y H:i:s')."')");
                    unlink($arquivos_pasta[$i]);
                }
            }else{
                $alert .= 'Já existe um arquivo com o nome de(' . substr($arquivos_pasta[$i], strrpos(substr($arquivos_pasta[$i], 0, -1), '/') + 1, strlen($arquivos_pasta[$i])) . ',) no diretorio ' . $abre_dir.'\n';
                unlink($arquivos_pasta[$i]);
            }
        }
        // fim
        if($arquivos_pasta==null){
            sql("UPDATE `desenhos_temp` SET `status`='finalizado', `data_finalizado` = '".date('d/m/Y H:i:s')."' WHERE `status` = 'processando' and `diretorio` = '".str_replace('/','/',$caminho_temp[0])."' and `individuo` = '".$_SESSION['usuario']."'");
          //  echo $caminho_temp[0].'<br>';
            deletar_diretorio($caminho_temp[0]);
            header('Refresh:0');

        }
        // pega os nomes dos arquivos
        for($i=0; $i < count($arquivos_temp); $i++){
            $temp = $arquivos_temp[$i];
            $temp = str_replace("/", "/", $temp);



            array_push($arquivos_name, substr( $temp, strrpos(substr( $temp, 0, -1), '/') + 1, strlen( $temp))); // pega o nome do arquivo
        }
    for ($i=0; $i < count($arquivos_name); $i++) {
            array_push($arquivos_name1 , $arquivos_name[$i]) ;
            array_push($arquivos_temp1,$arquivos_temp[$i]);
            array_push( $caminho_temp1 , $caminho_temp[0]);
            array_push($abre_dir1,$abre_dir);
            array_push($data1,$data);

    }


    }
   
    $apagar_array = [];
for ($i=0; $i < count($abre_dir1); $i++) { 
for ($l=count($abre_dir1)-1; $l >= $i; $l--) { 
    if(($abre_dir1[$i] . substr($arquivos_temp1[$i], strlen($caminho_temp1[$i])) == $abre_dir1[$l] . substr($arquivos_temp1[$l], strlen($caminho_temp1[$l])))&& $l!=$i){

                if(!strtotime($data1[$i]) > strtotime($data1[$l]))
                {
                    array_push($apagar_array, $i);
                }
    }
}

}

sort($apagar_array, SORT_STRING);
for ($l=count($apagar_array)-1; $l >= 0 ; $l--) {
        unlink($arquivos_temp1[$apagar_array[$l]]);
    unset($caminho_temp1[$apagar_array[$l]]);
     unset($arquivos_temp1[$apagar_array[$l]]);
     unset($arquivos_name1[$apagar_array[$l]]);
     unset($abre_dir1[$apagar_array[$l]]);
        
}
$caminho_temp1= array_ordena_index($caminho_temp1);
$arquivos_temp1=    array_ordena_index($arquivos_temp1);
$arquivos_name1 =   array_ordena_index($arquivos_name1);
$abre_dir1 =   array_ordena_index($abre_dir1);



        //fim
        $_SESSION['diretorio_temp'] = $caminho_temp1;//passa o diretorio temporario
        $_SESSION['arquivos_temp'] = $arquivos_temp1;//passa o diretorio de cada arquivo
        $_SESSION['arquivo_name'] =  $arquivos_name1;//passa o nome de cada arquivo
        $_SESSION['abre_dir'] =  $abre_dir1;//passa o nome de cada arquivo

    $empreendimento = cascata(select('empreendimentos','nome','`status` = \'ativo\''));
    $empresa = cascata(select('empresa','nome','`status` = \'ativo\''));
    $finalidade = cascata(select('finalidade','nome','`status` = \'ativo\''));
    $prioridade = cascata(select('prioridade','nome','`status` = \'ativo\''));
       if(!$arquivos_name1 == null){





        for ($i = 0; $i < count($arquivos_name1); $i++) {

                $lista .= '<tr><td>' . $arquivos_name1[$i] . '</td>

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


echo '<span class="not-visible" id="file">'.count($arquivos_name1).'</span>';

modal('Descrever Desenhos Pendentes ','

    <table width="90%" border="1" cellspacing="0" cellpadding="5"><form action="" method="POST"><tr>
    <td>Nome</td>
    <td>Empresa</td>
    <td>Empreendimento</td>
    <td>Finalidade</td>
    <td>Prioridade</td>
    </tr>

    <tr>
    <td></td>

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
            $_SESSION = ['usuario' => $_SESSION['usuario'],'categoria_usuario' => $_SESSION['categoria_usuario']];
        }
        if ($alert != '') {
            alert($alert);
        reload('desenho_pendente.php');
        }

    if ((isset($_POST['file_plus2']) && (isset($_SESSION['arquivo_name'])))) {

        $user = $_SESSION['usuario'];
        $arquivo = $_SESSION['arquivo_name'];
        $diretorio = $_SESSION['diretorio_temp'][0];

        $alert = '';
        $erro = true;
        for ($i = 0; $i < count($arquivo); $i++) {
            if (htmlentities($_POST['prioridade' . $i], ENT_QUOTES, "UTF-8") != '') {
                if (htmlentities($_POST['finalidade' . $i], ENT_QUOTES, "UTF-8") != '') {
                    if (htmlentities($_POST['empreendimento' . $i], ENT_QUOTES, "UTF-8") != '') {
                        if (htmlentities($_POST['empresa' . $i], ENT_QUOTES, "UTF-8") != '') {
                            // echo 'Upload foi feito com sucesso!';
                            $strr_dir = strrpos(substr($_SESSION['arquivos_temp'][$i], 0, -1), '/'); //pega o penultimo / da estring $caminho
                            $caminho = substr($_SESSION['arquivos_temp'][$i], 0, $strr_dir + 1); // pega o nome da pasta anterior
                            $abre_dir = $_SESSION['abre_dir'][$i];
                            $caminho = substr($caminho, strlen($_SESSION['diretorio_temp'][$i])); //pega o diretorio do arquivo
                            $query = "INSERT INTO `desenhos`(`nome`, `caminho`, `desenhista`,`status`, `prioridade`, `finalidade`, `empreendimento`, `empresa`, `data_hora_add`) VALUES ('" . $arquivo[$i] . "','" . mysqli_real_escape_string($conexao, str_replace('/', '/', $abre_dir . $caminho)) . "','" . $user . "','corte','" . htmlentities($_POST['prioridade' . $i], ENT_QUOTES, "UTF-8") . "','" . htmlentities($_POST['finalidade' . $i], ENT_QUOTES, "UTF-8") . "','" . htmlentities($_POST['empreendimento' . $i], ENT_QUOTES, "UTF-8") . "','" . htmlentities($_POST['empresa' . $i], ENT_QUOTES, "UTF-8") . "','" . date('d/m/Y H:i:s') . "')";
                            $result = mysqli_query($conexao, $query);



                            if (!is_dir($abre_dir . $caminho)) {
                                mkdir($abre_dir . $caminho, 0777, true);
                            }


                            rename($_SESSION['arquivos_temp'][$i], $abre_dir . substr($_SESSION['arquivos_temp'][$i], strlen($_SESSION['diretorio_temp'][$i])));
                            if(count($_SESSION['diretorio_temp'])>$i + 1){
                            if ($diretorio != $_SESSION['diretorio_temp'][$i + 1]) {

                                $diretorio = $_SESSION['diretorio_temp'][$i];
                                if ($erro) {
                                    deletar_diretorio($diretorio);
                                    sql("UPDATE `desenhos_temp` SET `status`='finalizado', `data_finalizado` = '" . date('d/m/Y H:i:s') . "' WHERE `status` = 'processando' and `diretorio` = '" . str_replace('/', '/', $diretorio) . "' and `individuo` = '" . $_SESSION['usuario'] . "'");
                                }
                                $diretorio = $_SESSION['diretorio_temp'][$i + 1];
                                $erro = true;

                            }
                        }

                            //echo $_SESSION['caminho_temp'][$i].' -de para- '.$_SESSION['caminho'] . $arquivo['name'][$i];
                        } else {
                            $alert .= 'Arquivo (' . $arquivo[$i] . ') não foi selecionada uma prioridade.\n';
                            $erro = false;
                        }
                    } else {
                        $alert .= 'Arquivo (' . $arquivo[$i] . ') não foi selecionada uma finalidade.\n';
                        $erro = false;
                    }
                } else {
                    $alert .= 'Arquivo (' . $arquivo[$i] . ') não foi selecionada uma empreendimento.\n';
                    $erro = false;
                }
            } else {
                $alert .= 'Arquivo (' . $arquivo[$i] . ') não foi selecionada uma emepresa/cliente.\n';
                $erro = false;
            }


        }
        if ($alert != '') {
            alert($alert);
        }


        if ($erro) {
            sql("UPDATE `desenhos_temp` SET `status`='finalizado', `data_finalizado` = '" . date('d/m/Y H:i:s') . "' WHERE `status` = 'processando' and `diretorio` = '" . str_replace('/', '/', $diretorio) . "' and `individuo` = '" . $_SESSION['usuario'] . "'");
            deletar_diretorio($diretorio);
        }
        $_SESSION = ['usuario' => $_SESSION['usuario'],'categoria_usuario' => $_SESSION['categoria_usuario']];
        echo "<script type='text/javascript'>window.location.href = 'desenho_pendente.php';</script>";
    }

}else{
    reload('dir.php');
   
}
if (isset($_POST['x_tela_sobre_tela'])) {
    reload('dir.php');
}
$result = sql("SELECT `id` FROM `desenhos_temp` WHERE `individuo` = '".$_SESSION['usuario']."' and `status` = 'processando'");

$row = mysqli_num_rows($result);
if(!$row){
    reload('dir.php');
}





?>
<style>
tr:nth-child(even) {background-color: rgb(100, 100, 100,0.2)}/* colocar intercalado os traços da lista */
</style>