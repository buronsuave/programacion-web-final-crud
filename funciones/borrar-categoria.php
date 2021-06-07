<?php

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    include "../database/connectorPDO.php";
    $sql = "DELETE FROM products WHERE idCategory = ".$id.";";
    $query = $conn->prepare($sql);
    if ($query->execute()) {
        $sql = "DELETE FROM categories WHERE id = ".$id.";";
        $query = $conn->prepare($sql);
        if ($query->execute()) {
            echo "<script type='text/javascript'>
            window.location.replace('http://proyectosinformaticatnl.ceti.mx/pyvdj-21/funciones/ver-categorias.php');
            </script>";
        } else {
            echo "<script type='text/javascript'>
            alert('Error while removing the category');
            window.location.replace('http://proyectosinformaticatnl.ceti.mx/pyvdj-21/funciones/ver-categorias.php');
            </script>";
        }
    }
} else {
    echo "<script type='text/javascript'>
        window.location.replace('http://proyectosinformaticatnl.ceti.mx/pyvdj-21/funciones/ver-categorias.php');
        </script>";
}

?>