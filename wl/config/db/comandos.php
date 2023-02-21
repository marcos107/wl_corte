<?php
function valid($dado)
{
    include('conexao.php');
    return mysqli_real_escape_string($conexao, $dado);
}
function sql($sql)
{
    include('conexao.php');
    $result = mysqli_query($conexao, $sql);
    return $result;
}
function select_lin($tabela, $coluna, $where)
{
    $temp = select($tabela, $coluna, $where);
    $result = [];
    for ($i = 0; $i < count($temp); $i++) {
        array_push($result, $temp[$i][0]);
    }
    return $result;
}

function mensagem_whatsapp($template, $idioma, $telefone, $var1 = [], $var2 = [], $var3 = [], $var4 = [], $var5 = [])
{
    $b = 0;

    if (mysqli_num_rows(sql("SELECT  * FROM `tokens` WHERE `local` = 'whatsapp'"))) {
        $data_add = select_lin('tokens', 'data_hora_add', '`local` = \'whatsapp\'')[0];
        //  echo (data_em_hora_str($data_add) + 50);
        //  echo "<br>";
        //  echo data_em_hora_str(date('d/m/Y H:i:s'));
        //  echo "<br>";
        if ((data_em_hora_str($data_add) + 5) < data_em_hora_str(date('d/m/Y H:i:s'))) {
            $novo_token = curl_get("https://ikonis.com.br/token?nome=ian,senha=123");
            sql("UPDATE `tokens` SET `code`='" . $novo_token . "',`data_hora_add`='" . date('d/m/Y H:i:s') . "' WHERE `local` = 'whatsapp'");
        }
        do {
            $a = false;
            $token = select_lin('tokens', 'code', '`local` = \'whatsapp\'')[0];
            $body_mensagem = "type=template,name=" . $template . ",idioma=" . $idioma . ",token=" . $token . ",";

            $header = "https://ikonis.com.br/messagem?";
            $numero = 'numero=';
            $var1_str = 'parametros1=';
            $var2_str = 'parametros2=';
            $var3_str = 'parametros3=';
            $var4_str = 'parametros4=';
            $var5_str = 'parametros5=';
            for ($i = 0; $i < count($telefone); $i++) {

                $numero .= $telefone[$i];
                if (count($telefone) - 1 != 0) {
                    $numero .= ';';
                }
                if ($var1 != []) {
                    $var1_str .= str_replace(' ', '%20', $var1[$i]);
                    if (count($telefone) - 1 != 0) {
                        $var1_str .= ';';
                    }
                }
                if ($var2 != []) {
                    $var2_str .= str_replace(' ', '%20', $var2[$i]);
                    if (count($telefone) - 1 != 0) {
                        $var2_str .= ';';
                    }
                }
                if ($var3 != []) {
                    $var3_str .= str_replace(' ', '%20', $var3[$i]);
                    if (count($telefone) - 1 != 0) {
                        $var3_str .= ';';
                    }
                }
                if ($var4 != []) {
                    $var4_str .= str_replace(' ', '%20', $var4[$i]);
                    if (count($telefone) - 1 != 0) {
                        $var4_str .= ';';
                    }
                }
                if ($var5 != []) {
                    $var5_str .= str_replace(' ', '%20', $var5[$i]);
                    if (count($telefone) - 1 != 0) {
                        $var5_str .= ';';
                    }
                }
            }
            $body_mensagem .= $numero;
            if ($var1_str != 'parametros1=') {
                $body_mensagem .= "," . $var1_str;
            }
            if ($var2_str != 'parametros2=') {
                $body_mensagem .= "," . $var2_str;
            }
            if ($var3_str != 'parametros3=') {
                $body_mensagem .= "," . $var3_str;
            }
            if ($var4_str != 'parametros4=') {
                $body_mensagem .= "," . $var4_str;
            }
            if ($var5_str != 'parametros5=') {
                $body_mensagem .= "," . $var5_str;
            }



            // echo $header . $body_mensagem;

            $mensagem = curl_get($header . $body_mensagem);

            if ($mensagem == "solicitação INVALIDA" || $mensagem == "token expirou") {
                $a = true;
                $b++;
                $novo_token = curl_get("https://ikonis.com.br/token?nome=ian,senha=123");
                sql("UPDATE `tokens` SET `code`='" . $novo_token . "',`data_hora_add`='" . date('d/m/Y H:i:s') . "' WHERE `local` = 'whatsapp'");

            }
        } while ($a && $b != 2);


    }

}

function curl_get($url)
{

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    $res = curl_exec($ch);
    return $res;
}

function select($tabela, $coluna, $where)
{

    if ($tabela != '') {
        include('conexao.php');
        $tabela = mysqli_real_escape_string($conexao, $tabela);

        if ($coluna != '') {
            $coluna = mysqli_real_escape_string($conexao, $coluna);
            $query = 'SELECT `' . $coluna . '` FROM `' . $tabela . '` ';
        }
        if ($coluna == '') {
            $query = 'SELECT * FROM `' . $tabela . '` ';
        }

        if ($where != '') {
            $query .= 'WHERE ' . $where;
        } else {
            $query .= 'WHERE true;';
        }
        //echo $query;
        $result = sql($query);
        $oi = array();

        while ($row = mysqli_fetch_assoc($result)) {
            $array = array();
            $keys = array_keys($row);
            for ($i = 0; $i < $result->field_count; $i++) {
                array_push($array, $row[$keys[$i]]);
            }
            array_push($oi, $array);
        }
        mysqli_close($conexao);
        if ($oi != null) {
            return $oi;
        }

    }

    return [];
}
function random_str_generator($len_of_gen_str)
{
    $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
    $var_size = strlen($chars);
    $rando_caracter = '';
    for ($x = 0; $x < $len_of_gen_str; $x++) {
        $random_str = $chars[rand(0, $var_size - 1)];
        $rando_caracter .= $random_str;
    }
    return $rando_caracter;
}
function random_int_generator($len_of_gen_str)
{
    $int = "1234567890";
    $var_size = strlen($int);
    $rando_caracter = '';
    for ($x = 0; $x < $len_of_gen_str; $x++) {
        $random_str = $int[rand(0, $var_size - 1)];
        $rando_caracter .= $random_str;
    }
    return $rando_caracter;
}
function lixo_desenho($caminho, $nome)
{
    // /
    $caminho_base = "/hd/lixo/";
    $caminho = str_replace("/", "", $caminho);

    do {
        $caminho_novo = $caminho_base . $caminho . date('d-m-Y--H-i-s') . "/";

    } while (is_dir($caminho_novo));

    mkdir($caminho_novo, 0777, true);
    rename("/" . $caminho . $nome, $caminho_novo . $nome);
    return $caminho_novo;

}
function add_pasta($caminho)
{
    if (isset($_POST['add_pasta'])) {
        modal("Nova pasta", '<p>Coloque o nome da nova pasta</p><p><input class="input_text" type="text" name="name_pasta" multiple="multiple" autofocus/></p>', "nome_pasta", "Criar");



    }

    if (isset($_POST['nome_pasta'])) {
        if ($_POST['name_pasta'] != '') {
            mkdir($caminho . $_POST['name_pasta'], 0777, true);
        }
    }
}

function confirmar($titulo, $texto, $acao_botao, $titulo_botao)
{

    echo '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- Modal -->
    <div class="modall">
      <div class="modal-dialog">
        <!-- Conteúdo do modal-->
        <div class="modal-content">
          <!-- Cabeçalho do modal -->
          <div class="modal-header">
            <h4 class="modal-title">' . $titulo . '</h4>
          </div>
          <!-- Corpo do modal -->
          <div class="modal-body">
          ' . $texto . '
          </div>
          <!-- Rodapé do modal-->
          <div class="modal-footer">
          <form action="" method="post" enctype="multipart/form-data">
            <input type="submit" name="fechar_modal" class="btn btn-danger" data-dismiss="modal" value="Cancelar";/>
            <input type="submit" name="' . $acao_botao . '" class="btn btn-primary" value="' . $titulo_botao . '"/>
            </form>
          </div>
        </div>
      </div>
      </div>';




}
function hora_em_data($hora)
{
    $minuto = ($hora - (int) $hora) * 60;
    $segundo = ($minuto - (int) $minuto) * 60;
    return (int) $hora . ':' . (int) $minuto . ':' . (int) $segundo;
}
function data_em_hora_str($data)
{
    return data_em_hora(explode('/', str_replace(':', '/', $data)));
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
function modal($titulo, $texto, $acao_botao, $titulo_botao)
{
    echo '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- Modal -->
    <div class="modall">
    <form action="" method="post" enctype="multipart/form-data">
      <div class="modall-dialog">
        <!-- Conteúdo do modal-->
        <div class="modal-content" >
          <!-- Cabeçalho do modal -->
          <div class="modal-header">
            <h4 class="modal-title">' . $titulo . '</h4>
            <input type="submit" name="x_tela_sobre_tela" class="close" data-dismiss="modal" value="&times">
          </div>
          <!-- Corpo do modal -->
          <div class="modal-body">
          ' . $texto . '
          </div>
          <!-- Rodapé do modal-->
          <div class="modal-footer">
          <form action="" method="post" enctype="multipart/form-data">
            <input type="submit" name="' . $acao_botao . '" class="btn btn-primary" value="' . $titulo_botao . '" autofocus/>
          </div>
        </div>
      </div>
      </form>
      </div>';
}
function tela_sobre_tela($texto)
{

    echo '<div class="modall">
    <div class="content">      
      
    <form action="" method="post" enctype="multipart/form-data">
    <button type="submit" name="x_tela_sobre_tela" ><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
    </button><center>
     </br>
     ' . $texto . '
     </form>
    </center>
  
    </div>
    </div>';

}

function descompactar_arquivo($caminho_arquivo, $destino)
{
    $zip = new ZipArchive;
    $zip->open($caminho_arquivo);
    $status = false;
    if ($zip->extractTo($destino) == TRUE) {
        $status = true;

    } else {
        $status = false;
    }
    $zip->close();
    if ($status) {
        unlink($caminho_arquivo);
    }
    return $status;
}

function map_pasta($pasta)
{
    return map_pasta1($pasta, array());
}
function map_pasta1($pasta, $p)
{
    if (file_exists($pasta)) {
        $diretorio = dir($pasta);
        while ($arquivo = $diretorio->read()) {



            if ($arquivo != '.' && $arquivo != '..') {

                if (is_dir($pasta . $arquivo)) {
                    $p = array_merge($p, map_pasta1($pasta . $arquivo . '/', $p));
                    //echo $pasta . '/' . $arquivo . ' (1)<br/>';

                } else {
                    array_push($p, ($pasta . $arquivo));
                    //echo $pasta . '/' . $arquivo . ' (2)<br/>';

                }


            }

        }

        $diretorio->close();

    }
    return array_unique($p);

}
function deletar_diretorio($pasta)
{
    if (file_exists($pasta)) {
        $iterator = new RecursiveDirectoryIterator($pasta, FilesystemIterator::SKIP_DOTS);
        $rec_iterator = new RecursiveIteratorIterator($iterator, RecursiveIteratorIterator::CHILD_FIRST);

        foreach ($rec_iterator as $file) {
            $file->isFile() ? unlink($file->getPathname()) : rmdir($file->getPathname());
        }

        rmdir($pasta);
    }
}
function nome_id($tabela, $name, $coluna, $where = '')
{ // nome para id
    if ($where == '') {
        return select_lin($tabela, 'id', "`" . $coluna . "` = '" . $name . "' ")[0];
    }
    return select_lin($tabela, 'id', "`" . $coluna . "` = '" . $name . "' and " . $where)[0];
}
function id_nome($tabela, $id, $coluna)
{ // id para nome
    return select_lin($tabela, $coluna, "`id` = '" . $id . "' ")[0];
}
function cascata($array)
{
    sort($array);
    $result = '<option></option>';
    for ($i = 0; $i < count($array); $i++) {
        $result .= '<option>' . $array[$i][0] . '</option>';
    }
    return $result;
}
function cascata_lin($array)
{
    sort($array);
    $result = '';
    for ($i = 0; $i < count($array); $i++) {
        $result .= '<option>' . $array[$i][0] . '</option>';
    }
    return $result;
}


function table($array)
{
    $result = '';
    for ($i = 0; $i < count($array); $i++) {
        $result .= '<tr><td>' . $array[$i][0] . '</td></tr>';
    }
    return $result;
}

function reload($pagina)
{
    echo "<script type='text/javascript'>window.location.href = '" . $pagina . "';</script>";
}
function array_ordena_index($array)
{
    $array_temp = [];
    $keys = array_keys($array);
    for ($i = 0; $i < count($keys); $i++) {
        array_push($array_temp, $array[$keys[$i]]);
    }
    return $array_temp;
}
function alert($mensagem)
{
    // cria um alerte em javascript
    echo "
    <script language='javascript'>
        alert('" . $mensagem . "');
    </script>
    ";
}
function menu($name, $input)
{



    echo '<div  class="menu effect">
    <ul>
    <center>
    <li>Bem vindo <br> ' . $name . ' </li>
    </center>
    <form action="" method="post" enctype="multipart/form-data">
    ' . $input . '    
    <li><input type="submit" name="sair" value="Sair" /></li>
        
        </form>
        
    </ul>
</div>

<br>';
    echo '<style>
:root {
    --menu-size: 210px;
}





.menu {
    position: fixed;
    top: 0%;
    width: var(--menu-size);
    height: 100%;
    background-color: rgb(40, 42, 54);
}



.menu ul li {
    display: block;
    color: #fff;
    font-size: 19px;
    text-decoration: none;
    text-transform: uppercase;
    padding: 10px 15px;
}

.menu ul li input {
    display: block;
    color: #fff;
    font-size: 19px;
    text-decoration: none;
    text-transform: uppercase;
    padding: 10px 15px;
    background-color: rgb(40, 42, 54,0.8);
}

.menu ul li input:hover {
    background-color: rgb(49, 54, 85);
}



body { overflow-x: hidden; }

tr:nth-child(even) {background-color: rgb(100, 100, 100,0.2)}/* colocar intercalado os traços da lista */

td {
    border: 3px solid rgb(0, 0, 0,0);
    font-size: 15px;
}
.relative {
   position: relative;

}
.main {
    position: relative;
    z-index: 0;
     left: 300px;
}
table {
    height: 19px; 

}
table input[type=submit] {
    display: block;
    color: #fff;
    font-size: 15px;
    text-decoration: none;
    text-transform: uppercase;
    padding: 10px 15px;
    background-color: rgb(40, 42, 54,0.8);
}
table input[type=submit]:hover {background-color: #3e8e41}
 input[type=submit]:focus {background-color: rgb(49, 54, 85);}


    </style>

';
}
function retorne($session_origem, $session)
{
    $_SESSION = ['categoria_usuario' => $_SESSION['categoria_usuario'], 'usuario' => $_SESSION['usuario'], $session => true, $session_origem => true];

}
function tabela($valores, $valores1, $titulo, $itens, $nomes_itens, $php, $html = [], $type = '')
{


    if ($valores1 == []) {
        sort($valores);
    }


    $result = '<table class="table" width=70% cellspacing="0" cellpadding="5"><form action="" method="POST"><form action="" method="post" enctype="multipart/form-data"><tr></tr><tr>';
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
                $result .= '<td>' . $valores1[0][$i] . '</td>';
                if (count($valores1) > 1) {
                    $result .= '<td>' . $valores1[1][$i] . '</td>';
                }
                if (count($valores1) > 2) {
                    $result .= '<td>' . $valores1[2][$i] . '</td>';
                }
                if (count($valores1) > 3) {
                    $result .= '<td>' . $valores1[3][$i] . '</td>';
                }
            }
        } else {

            $result .= '<tr><td><button name="butao_tabela' . $i . '" class="not_efeito" type="submit">' . $i + 1 . '</button></td>';

            $result .= '<td><button name="butao_tabela' . $i . '" class="not_efeito" type="submit">' . $valores[$i] . '</button></td>';
            if ($valores1 != []) {

                $result .= '<td><button name="butao_tabela' . $i . '" class="not_efeito" type="submit">' . $valores1[0][$i] . '</button></td>';
                if (count($valores1) >= 2) {
                    $result .= '<td><button name="butao_tabela' . $i . '" class="not_efeito" type="submit">' . $valores1[1][$i] . '</button></td>';
                }
                if (count($valores1) >= 3) {
                    $result .= '<td><button name="butao_tabela' . $i . '" class="not_efeito" type="submit">' . $valores1[2][$i] . '</button></td>';
                }
                if (count($valores1) >= 4) {
                    $result .= '<td><button name="butao_tabela' . $i . '" class="not_efeito" type="submit">' . $valores1[3][$i] . '</button></td>';
                }
            }
        }
        for ($l = 0; $l < count($itens); $l++) {
            $result .= '<td align="center"><input type="' . $itens[$l] . '" value="' . $nomes_itens[$l] . '" id="' . $nomes_itens[$l] . $i . '" name="' . $nomes_itens[$l] . $i . '"></td>';
            if ($php != '') {
                eval('$php_result.=' . $php);
            }
        }

        $result .= '</tr>';
    }
    if ($php != '') {
        for ($l = 0; $l < count($html); $l++) {

            eval('$php_result.=' . $php);



        }
    }

    return [$result . '</form></table>', $php_result];
}

?>
<style>
    * {
        margin: 0;
        padding: 0;
        border: none;
        box-sizing: border-box;
        outline: none;
        font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
    }

    .modall-dialog {

        width: 900px;
        margin: .5rem;


    }

    .not-visible {
        visibility: hidden;
        height: 90%;
        width: 90%;
        position: absolute;
        z-index: -4;
    }

    .modal.fade .modall-dialog {
        transition: -webkit-transform .3s ease-out;
        transition: transform .3s ease-out;
        transition: transform .3s ease-out, -webkit-transform .3s ease-out;
        -webkit-transform: translate(0, -50px);
        transform: translate(0, -50px)
    }

    @media (prefers-reduced-motion:reduce) {
        .modal.fade .modall-dialog {
            transition: none
        }
    }

    .modal.show .modall-dialog {
        -webkit-transform: none;
        transform: none
    }

    .modal-dialog-scrollable {
        display: -ms-flexbox;
        display: flex;
        max-height: calc(100% - 1rem)
    }

    input[type=text],
    input[type=number] {
        width: 300px;
        padding: 10px 18px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }

    input[type=text]:focus,
    input[type=number]:focus,
    select:focus {
        border-style: solid;
        border-width: 1px;
        border-color: black;

    }




    .input_text {
        background-color: rgb(100, 100, 100, 0);
        border-width: 1px;
        border-style: dashed;
        border-color: #f00;
    }

    .input_text:hover {
        background-color: rgb(100, 100, 100, 0);
    }

    .input:active {
        background-color: rgb(100, 100, 100, 0);
    }

    .modall {
        background-color: rgb(100, 100, 100, 0.3);
        height: 100vw;
        width: 100vw;
        position: fixed;
        top: 0;
        left: 0;
        display: flex;
        flex-direction: row;
        justify-content: center;


    }

    .content {
        margin: 0 auto;
        margin-top: 5%;
        max-width: 600px;
        background-color: #eee;
        padding: 10px;
        box-sizing: 0 0 2px #fff;
    }
</style>