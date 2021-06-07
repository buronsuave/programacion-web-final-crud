<?php

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    include "../database/connectorMYSQLI.php";
    $sql = "DELETE FROM providers WHERE id = ".$id.";";
    if ($mysqli->query($sql) !== TRUE) {
        echo "Error: ".$sql."<br>".$mysqli->error;
    }
}
echo "<script type='text/javascript'>
    window.location.replace('http://proyectosinformaticatnl.ceti.mx/pyvdj-21/funciones/ver-proveedores.php');
    </script>";

?>