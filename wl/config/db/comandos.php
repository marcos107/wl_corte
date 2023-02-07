<?php

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
function lixo_desenho($caminho, $nome)
{
    $caminho_base = "../../../../hd/lixo/";
    $caminho = str_replace("../../../../", "", $caminho);

    do {
        $caminho_novo = $caminho_base . $caminho . date('d-m-Y--H-i-s') . "/";

    } while (is_dir($caminho_novo));

    mkdir($caminho_novo, 0700, true);
    rename("../../../../" . $caminho . $nome, $caminho_novo . $nome);
    return $caminho_novo;

}
function add_pasta($caminho)
{
    if (isset($_POST['add_pasta'])) {
        modal("Nova pasta", '<p>Coloque o nome da nova pasta</p><p><input class="input_text" type="text" name="name_pasta" multiple="multiple"/></p>', "nome_pasta", "Criar");



    }

    if (isset($_POST['nome_pasta'])) {
        if ($_POST['name_pasta'] != '') {
            mkdir($caminho . $_POST['name_pasta'], 0755, true);
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
            <input type="submit" name="' . $acao_botao . '" class="btn btn-primary" value="' . $titulo_botao . '"/>
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
    $diretorio = dir($pasta);
    while ($arquivo = $diretorio->read()) {



        if ($arquivo != '.' && $arquivo != '..') {

            if (is_dir($pasta . $arquivo)) {
                $p = array_merge($p, map_pasta1($pasta . $arquivo . '\\', $p));
                //echo $pasta . '\\' . $arquivo . ' (1)<br/>';

            } else {
                array_push($p, ($pasta . $arquivo));
                //echo $pasta . '\\' . $arquivo . ' (2)<br/>';

            }


        }

    }

    $diretorio->close();


    return array_unique($p);
}
function deletar_diretorio($pasta)
{

    $iterator = new RecursiveDirectoryIterator($pasta, FilesystemIterator::SKIP_DOTS);
    $rec_iterator = new RecursiveIteratorIterator($iterator, RecursiveIteratorIterator::CHILD_FIRST);

    foreach ($rec_iterator as $file) {
        $file->isFile() ? unlink($file->getPathname()) : rmdir($file->getPathname());
    }

    rmdir($pasta);
}

function cascata($array)
{
    $result = '<option>Nada</option>';
    for ($i = 0; $i < count($array); $i++) {
        $result .= '<option>' . $array[$i][0] . '</option>';
    }
    return $result;
}
function cascata_lin($array)
{
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

table input[type=submit]:active {
  background-color: #3e8e41;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}

    </style>

';
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
  width:  90%;
  position: absolute;
  z-index:-4;
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
    input[type=text],input[type=number] {
  width: 300px;
  padding: 10px 18px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
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