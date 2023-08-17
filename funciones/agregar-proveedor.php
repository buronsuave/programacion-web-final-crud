<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css">
    <title>David's Toys - Add Provider</title>
    <link rel="shortcut icon" href="../images/icons/icono.png">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="../">Home</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarColor01">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="./ver-productos.php">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./ver-categorias.php">Categories</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./ver-usuarios.php">Users</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./ver-proveedores.php">Providers</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <content>
        <section class="container">
            <br><br>
            <form method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Set name" required>
                </div>

                <div class="form-group">
                    <label for="firstDelivery">First Delivery Date:</label>
                    <input type="date" id="firstDelivery" name="firstDelivery" required>
                </div>

                <button id="register" name="register" value="register" type="submit" class="btn btn-success">Submit</button>
            </form>
        </section>
    </content>
</body>

<?php
if (isset($_POST["register"])) {
    include '../database/connectorMYSQLI.php';

    $sql = "SELECT * FROM providers WHERE providers.name = '" . $_POST['name'] . "'";
    $query = $mysqli->query($sql);

    if ($query->num_rows > 0) {
        echo "<script type='text/javascript'>
        alert('Provider already exists');
        window.location.replace('http://localhost/web/funciones/agregar-proveedor.php');
        </script>";
    } else {
        $sql = "INSERT INTO providers (
            `id` ,
            `name`, 
            `firstDelivery`
            )
            VALUES (
            NULL, '".$_POST['name']."', '".$_POST['firstDelivery']."'
            );";

        if ($mysqli->query($sql) === TRUE) {
            echo "<script type='text/javascript'>
            window.location.replace('http://localhost/web/funciones/ver-proveedores.php');
            </script>";
        } else {
            echo "<script type='text/javascript'>
            alert('Error while adding provider');
            window.location.replace('http://localhost/web/funciones/agregar-proveedor.php');
            </script>";
        }
    }
}
?>

</html>