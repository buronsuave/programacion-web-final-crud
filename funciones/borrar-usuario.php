<?php 

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    include "../database/connectorMYSQLI.php";
    $sql = "SELECT * FROM users WHERE id = ".$id.";";
    $result = $mysqli->query($sql);
    if ($result->num_rows > 0) {
        $row = mysqli_fetch_array($result);
        $file_pointer = $row["imageUrl"];
        $file_pointer = str_replace("http://proyectosinformaticatnl.ceti.mx/pyvdj-21/files/", "../files/", $file_pointer);
        if (!unlink($file_pointer)) {
            echo "<script type='text/javascript'>
            alert('An error happened while removing the image from the server');
            </script>";
        }

        $sql = "DELETE FROM users WHERE id = ".$id.";";
        if ($mysqli->query($sql) !== TRUE) {
            echo "Error: ".$sql."<br>".$mysqli->error;
        }

        echo "<script type='text/javascript'>
        window.location.replace('http://proyectosinformaticatnl.ceti.mx/pyvdj-21/funciones/ver-usuarios.php');
        </script>";

    } else {
        echo "<script type='text/javascript'>
        alert('Something went wrong removing the user');
        window.location.replace('http://proyectosinformaticatnl.ceti.mx/pyvdj-21/funciones/ver-usuarios.php');
        </script>";
    }
} else {
    echo "<script type='text/javascript'>
    window.location.replace('http://proyectosinformaticatnl.ceti.mx/pyvdj-21/funciones/ver-usuarios.php');
    </script>";
}

?>