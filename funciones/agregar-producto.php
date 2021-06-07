<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css">
    <title>David's Toys - Add Product</title>
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
                    <label for="stock">Stock:</label>
                    <input type="number" min=20 max=5000 class="form-control" id="stock" name="stock" placeholder="Set stock" required>
                </div>

                <div class="form-group">
                    <label for="price">Price:</label>
                    <input type="number" min=20 max=5000 class="form-control" id="price" name="price" placeholder="Set price" required>
                </div>

                <div class="form-group">
                    <label for="category">Category: </label>
                    <select class="form-select" id="idCategory" name="idCategory">
                        <?php 
                            include '../database/connectorMYSQLI.php';
                            $query = "SELECT * FROM categories";
                            $result = $mysqli->query($query);
                            while ($row = mysqli_fetch_array($result)) {
                                echo '<option value="'.$row["id"].'">'.$row["name"].'</option>';
                            }
                            ?>
                        ?>
                    </select>
                </div>

                <button id="register" name="register" value="register" type="submit" class="btn btn-success">Submit</button>
            </form>
        </section>
    </content>
</body>

<?php
if (isset($_POST["register"])) {
    include '../database/connectorPDO.php';

    $sql = "SELECT * FROM products WHERE products.name = '".$_POST['name']."'";
    $query = $conn->prepare($sql);
    $query->execute();

    if ($query->rowCount() > 0) {
        echo "<script type='text/javascript'>
        alert('Product already exists');
        window.location.replace('http://proyectosinformaticatnl.ceti.mx/pyvdj-21/funciones/agregar-producto.php');
        </script>";
    } else {
        $sql = "INSERT INTO products (
            `id` ,
            `name` ,
            `price` ,
            `stock` ,
            `idCategory`
            )
            VALUES (
            NULL, '".$_POST['name']."',".$_POST['price'].",".$_POST['stock'].",".$_POST['idCategory']." 
            );";

        $query = $conn->prepare($sql);
        if ($query->execute()) {
            echo "<script type='text/javascript'>
            window.location.replace('http://proyectosinformaticatnl.ceti.mx/pyvdj-21/funciones/ver-productos.php');
            </script>";
        } else {
            echo "<script type='text/javascript'>
            alert('Error while adding product');
            window.location.replace('http://proyectosinformaticatnl.ceti.mx/pyvdj-21/funciones/agregar-producto.php');
            </script>";
        }
    }
}
?>

</html>