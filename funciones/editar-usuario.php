<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css">
    <title>David's Toys - Edit User</title>
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

    <?php
    include "../database/connectorMYSQLI.php";

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM users WHERE id = " . $id;

        $result = $mysqli->query($sql);
        $row = mysqli_fetch_array($result);

        $username = $row["username"];
        $name = $row["name"];
        $lastName = $row["lastName"];
        $password = $row["password"];
        $imageUrl = $row["imageUrl"];
        $idUserType = $row["idUserType"];

    } else if (!isset($_POST["register"])) {
        echo "<script type='text/javascript'>
        window.location.replace('http://localhost/web/funciones/ver-usuarios.php');
        </script>";
    }

    ?>

    <content>
        <section class="container">
            <br><br>
            <form method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="username">Username:</label>
                    <?php
                    echo '<input type="text" class="form-control" id="username" name="username" placeholder="Set username" value="' . $username . '" required>';
                    ?>
                </div>

                <div class="form-group">
                    <label for="name">Name:</label>
                    <?php
                    echo '<input type="text" class="form-control" id="name" name="name" placeholder="Set name" value="' . $name . '" required>';
                    ?>
                </div>

                <div class="form-group">
                    <label for="lastName">Last name:</label>
                    <?php
                    echo '<input type="text" class="form-control" id="lastName" name="lastName" placeholder="Set last name" value="' . $lastName . '" required>';
                    ?>
                </div>

                <div class="form-group">
                    <label for="lastName">Last name:</label>
                    <?php
                    echo '<input type="text" class="form-control" id="lastName" name="lastName" placeholder="Set last name" value="' . $lastName . '" required>';
                    ?>
                </div>

                <div class="form-group">
                    <label for="oldPassword">Current password:</label>
                    <input type="password" class="form-control" id="oldPassword" name="oldPassword" placeholder="Enter your current password" required>
                </div>

                <div class="form-group">
                    <label for="password">New Password:</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter your new password">
                    <small id="password" class="form-text text-muted">Optional.</small>
                </div>
                <br>

                <div class="form-group">
                    <label for="idUserType">User Type: </label>
                    <select class="form-select" id="idUserType" name="idUserType">
                        <?php 
                            include '../database/connectorMYSQLI.php';
                            $query = "SELECT * FROM usertypes";
                            $result = $mysqli->query($query);
                            while ($row = mysqli_fetch_array($result)) {
                                if ($row["id"] != $idUserType) {
                                    echo '<option value="'.$row["id"].'">'.$row["name"].'</option>';
                                } else {
                                    echo '<option value="'.$row["id"].'" selected>'.$row["name"].'</option>';
                                }
                            }
                        ?>
                    </select>
                </div>

                <br>
                <div class="form-check">
                    <label for="imageFile">
                        Profile Picture:</label>
                    <input type="file" class="form-control-file" id="imageFile" name="imageFile" accept=".jpeg,.jpg,.png">
                    <small id="imageFile" class="form-text text-muted">Optional.</small>
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

    $sql = "SELECT * FROM users WHERE username = '" . $_POST['username'] . "' AND id != " . $id;
    $query = $mysqli->query($sql);

    if ($query->num_rows > 0) {
        echo "<script type='text/javascript'>
        alert('Username already exists');
        window.location.replace('http://localhost/web/funciones/ver-proveedores.php');
        </script>";
    } else {
        if (md5($_POST["oldPassword"]) === $password) {    
            // If there is a valid change of password
            if (isset($_POST["password"]) && $_POST["password"] != "") {
                $sql = "UPDATE users SET password = '".md5($_POST['password'])."' WHERE id = ".$id;
                $mysqli->query($sql);
            }

            // If there is a valid change of image
            if (file_exists($_FILES['imageFile']['tmp_name']) || is_uploaded_file($_FILES['imageFile']['tmp_name'])) {
                
                //Delete current file
                $file_pointer = $imageUrl;
                $file_pointer = str_replace("http://localhost/web/files/", "../files/", $file_pointer);

                if (!unlink($file_pointer)) {
                    echo "<script type='text/javascript'>
                    alert('Error deleating the current image');
                    </script>";
                }

                //Upload new file
                $target_path = "../files/" . $id;
                $target_path = $target_path . basename($_FILES['imageFile']['name']);
                $target_path = preg_replace('/\s+/', '', $target_path);
                if (move_uploaded_file($_FILES['imageFile']['tmp_name'], $target_path)) {
                    $sql = "UPDATE users SET imageUrl = '" . "http://localhost/web/files/" .
                        $id . preg_replace('/\s+/', '', basename($_FILES['imageFile']['name'])) . "' WHERE id =" . $id . ";";
                } else {
                    $sql = "UPDATE usuarios SET usuarios.Imagen = NULL;";
                }

                $mysqli->query($sql);
            } 

            // Regular updates

            $sql = "UPDATE users SET 
            username = '" . $_POST['username'] . "', 
            name = '" . $_POST['name'] . "', 
            lastName = '" . $_POST['lastName'] . "', 
            idUserType = ".$_POST['idUserType']."
            WHERE id = " . $id . "
            ;";

            if ($mysqli->query($sql) === TRUE) {
                echo "<script type='text/javascript'>
                window.location.replace('http://localhost/web/funciones/ver-usuarios.php');
                </script>";
            } else {
                echo "<script type='text/javascript'>
                alert('Error while editing user');
                window.location.replace('http://localhost/web/funciones/ver-usuarios.php');
                </script>";
            }

        } else {
            echo "<script type='text/javascript'>
            alert('Wrong password');
            window.location.replace('http://localhost/web/funciones/ver-usuarios.php');
            </script>";
        }
    }
}
?>

</html>