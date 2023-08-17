<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css">
    <title>David's Toys - Add User</title>
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
                    <label for="username">Username:</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Set username" required>
                </div>

                <div class="form-group">
                    <label for="name">First Name:</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Set name" required>
                </div>

                <div class="form-group">
                    <label for="lastName">Last Name:</label>
                    <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Set last name" required>
                </div>

                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Set password" required>
                </div>

                <div class="form-group">
                    <label for="idUserType">User Type: </label>
                    <select class="form-select" id="idUserType" name="idUserType">
                        <?php 
                            include '../database/connectorMYSQLI.php';
                            $query = "SELECT * FROM usertypes";
                            $result = $mysqli->query($query);
                            while ($row = mysqli_fetch_array($result)) {
                                echo '<option value="'.$row["id"].'">'.$row["name"].'</option>';
                            }
                            ?>
                        ?>
                    </select>
                </div>

                <br>
                <div class="form-check">
                    <label for="imageFile">Profile picture:</label>
                    <input type="file" class="form-control-file" id="imageFile" name="imageFile" accept=".jpeg,.jpg,.png" required>
                    <small id="imageFile" class="form-text text-muted">We'll never share your picture with anyone else.</small>
                </div>
                <br><br>

                <button id="register" name="register" value="register" type="submit" class="btn btn-success">Submit</button>
            </form>
        </section>
    </content>
</body>

<?php
if (isset($_POST["register"])) {
    include '../database/connectorMYSQLI.php';

    $sql = "SELECT * FROM users WHERE users.username = '" . $_POST['username'] . "'";
    $query = $mysqli->query($sql);

    if ($query->num_rows > 0) {
        echo "<script type='text/javascript'>
        alert('Username already exists');
        window.location.replace('http://localhost/web/funciones/agregar-usuario.php');
        </script>";
    } else {
        $sql = "INSERT INTO users (
            `id` ,
            `imageUrl`,
            `username`, 
            `name`, 
            `lastName`, 
            `password`,
            `idUserType`
            )
            VALUES (
            NULL, 
            NULL,
            '" . $_POST['username'] . "', 
            '" . $_POST['name'] . "', 
            '" . $_POST['lastName'] . "', 
            '" . MD5($_POST['password']) . "', 
            " . $_POST['idUserType'] . "
            );";

        if ($mysqli->query($sql) === TRUE) {
            $sql = "SELECT * FROM users WHERE users.username = '" . $_POST['username'] . "'";
            $query = $mysqli->query($sql);

            if ($row = mysqli_fetch_array($query)) {
                $target_path = "../files/" . $row["id"];
                $target_path = $target_path . basename($_FILES['imageFile']['name']);
                $target_path = preg_replace('/\s+/', '', $target_path);
                if (move_uploaded_file($_FILES['imageFile']['tmp_name'], $target_path)) {
                    $sql = "UPDATE users SET `imageUrl` = '" . "http://localhost/web/files/" .
                        $row["id"] . preg_replace('/\s+/', '', basename($_FILES['imageFile']['name'])) . "' WHERE id =" . $row["id"] . ";";
                } else {
                    $sql = "DELETE FROM users WHERE id = " . $row["id"] . ";";
                }

                $mysqli->query($sql);
            }

            echo "<script type='text/javascript'>
            window.location.replace('http://localhost/web/funciones/ver-usuarios.php');
            </script>";
        } else {
            echo "<script type='text/javascript'>
            alert('Error while adding user');
            window.location.replace('http://localhost/web/funciones/agregar-usuario.php');
            </script>";
        }
    }
}
?>

</html>