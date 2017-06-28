<?php

session_start();
include('admin/core/clases/conec.class.php');
require_once('admin/core/clases/mp.class.php');

$co = new Conec();
$con = $co->base();

$usuario = $_GET['user'];
$id      = $_GET['id'];
$active  = $_GET['idactive'];

$control = false;

$a = $con->query("SELECT * FROM glob_usuarios WHERE usuario  = '$usuario' AND cedula = '$id' AND idactive = '$active' AND estatus = 'inactivo'");
$t = mysqli_num_rows($a);

if($t==1){

    $b = $con->query("UPDATE glob_usuarios SET estatus = 'Activo' WHERE cedula = '$id'");
    $control = true;
}else{
    $control = false;
}

?>
<script src="assets2/plugins/jquery.min.js"></script>
<script src="/javascripts/application.js" type="text/javascript" charset="utf-8" async defer></script>
<script type="text/javascript" src="assets/js/plugins/alertify/alertify.min.js"></script>
<link rel="stylesheet" type="text/css" href="assets/js/plugins/alertify/alertify.core.css"">
<link rel="stylesheet" type="text/css" href="assets/js/plugins/alertify/alertify.default.css"">


<?php if($control){ ?>
<script>
$(function(){

    alertify.confirm("Su Usuario se ha activado correctamente, presione OK para ingresar, cancelar para ir a la pagina principal", function (e) {
        if (e) {
            window.location.href="admin/"
        } else {
            // user clicked "cancel"
            window.location.href="index.php"
        }
    });
})
</script>
<?php }else{ ?>
<script>
$(function(){

    alertify.confirm("Este codigo ya fué activado o el usuario no existe, por favor, contacte al administrador del sistema", function (e) {
        if (e) {
            window.location.href="index.php"
        } else {
            // user clicked "cancel"
            window.location.href="index.php"
        }
    });
})
</script>
<?php } ?>