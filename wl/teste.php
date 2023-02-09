<script src="https://code.jquery.com/jquery-3.6.3.js"></script>
<style>
.not_efeito{
    background-color: rgb(0,0,0,0);
    border-color: rgb(0,0,0,0);
}

</style>
<form action="" method="post" enctype="multipart/form-data">
<table>
    <tr>
        <td>1</td>
        <td>2.dxf</td>
    </tr>
    <tr>
        <td>2</td>
        <td><input name="ian" class="not_efeito" value="2.dxf" type="submit"/></td>
    </tr>
</table>
</form>

<?php
if (isset($_POST['ian'])) {
    echo 'ian';
}
if (isset($_POST['olo'])) {
    echo 'olo';
}


?>