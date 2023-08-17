<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <link rel="shortcut icon" href="../images/icons/icono.png" />
    <title>Saving table</title>
</head>

<body>
    <?php
    if (isset($_POST['createBackUp'])) {
        $table = $_POST['createBackUp'];
        include "../database/connectorMYSQLI.php";

        switch ($table) {
            case "categories":
                $query = "SELECT * FROM categories";
                $result = $mysqli->query($query);

                $categories = new domdocument("1.0");
                $root = new domelement("categories");
                $root = $categories->appendChild($root);

                while ($row = mysqli_fetch_array($result)) {
                    $id = $row['id'];
                    $name = $row['name'];

                    $category = new domelement("category");
                    $category = $root->appendChild($category);
                    $category->setAttribute("id", $id);

                    $nameElm = new domelement("name", $name);
                    $nameElm = $category->appendChild($nameElm);
                }

                $categories->preserveWhiteSpace = false;
                $categories->formatOutput = true;
                $categories->save("../backups/categories-bkp.xml");

                echo "<br>Create Backup was successful<br>";

                echo "<script type='text/javascript'>
                    alert('Create Backup was successful');
                    window.location.replace('http://localhost/web/funciones/ver-categorias.php');
                    </script>";

                break;

            case "products":
                $query = "SELECT * FROM products";
                $result = $mysqli->query($query);

                $products = new domdocument("1.0");
                $root = new domelement("products");
                $root = $products->appendChild($root);

                while ($row = mysqli_fetch_array($result)) {
                    $id = $row['id'];
                    $name = $row['name'];
                    $price = $row['price'];
                    $stock = $row['stock'];
                    $idCategory = $row['idCategory'];

                    $product = new domelement("product");
                    $product = $root->appendChild($product);
                    $product->setAttribute("id", $id);

                    $nameElm = new domelement("name", $name);
                    $nameElm = $product->appendChild($nameElm);

                    $priceElm = new domelement("price", $price);
                    $priceElm = $product->appendChild($priceElm);

                    $stockElm = new domelement("stock", $stock);
                    $stockElm = $product->appendChild($stockElm);

                    $idCategoryElm = new domelement("idCategory", $idCategory);
                    $idCategoryElm = $product->appendChild($idCategoryElm);
                }

                $products->preserveWhiteSpace = false;
                $products->formatOutput = true;
                $products->save("../backups/products-bkp.xml");

                echo "<br>Create Backup was successful<br>";

                echo "<script type='text/javascript'>
                    alert('Create Backup was successful');
                    window.location.replace('http://localhost/web/funciones/ver-productos.php');
                    </script>";

                break;

            case "providers":
                $query = "SELECT * FROM providers";
                $result = $mysqli->query($query);

                $providers = new domdocument("1.0");
                $root = new domelement("providers");
                $root = $providers->appendChild($root);

                while ($row = mysqli_fetch_array($result)) {
                    $id = $row['id'];
                    $name = $row['name'];
                    $firstDelivery = $row['firstDelivery'];

                    $provider = new domelement("provider");
                    $provider = $root->appendChild($provider);
                    $provider->setAttribute("id", $id);

                    $nameElm = new domelement("name", $name);
                    $nameElm = $provider->appendChild($nameElm);

                    $firstDeliveryElm = new domelement("firstDelivery", $firstDelivery);
                    $firstDeliveryElm = $provider->appendChild($firstDeliveryElm);
                }

                $providers->preserveWhiteSpace = false;
                $providers->formatOutput = true;
                $providers->save("../backups/providers-bkp.xml");

                echo "<br>Create Backup was successful<br>";

                echo "<script type='text/javascript'>
                    alert('Create Backup was successful');
                    window.location.replace('http://localhost/web/funciones/ver-proveedores.php');
                    </script>";

                break;

            case "users":
                $query = "SELECT * FROM users";
                $result = $mysqli->query($query);

                $users = new domdocument("1.0");
                $root = new domelement("users");
                $root = $users->appendChild($root);

                while ($row = mysqli_fetch_array($result)) {
                    $id = $row['id'];
                    $username = $row['username'];
                    $name = $row['name'];
                    $lastName = $row['lastName'];
                    $password = $row['password'];
                    $imageUrl = $row['imageUrl'];
                    $idUserType = $row['idUserType'];

                    $user = new domelement("user");
                    $user = $root->appendChild($user);
                    $user->setAttribute("id", $id);

                    $usernameElm = new domelement("username", $username);
                    $usernameElm = $user->appendChild($usernameElm);

                    $nameElm = new domelement("name", $name);
                    $nameElm = $user->appendChild($nameElm);

                    $lastNameElm = new domelement("lastName", $lastName);
                    $lastNameElm = $user->appendChild($lastNameElm);

                    $passwordElm = new domelement("password", $password);
                    $passwordElm = $user->appendChild($passwordElm);

                    $imageUrlElm = new domelement("imageUrl", $imageUrl);
                    $imageUrlElm = $user->appendChild($imageUrlElm);

                    $idUserTypeElm = new domelement("idUserType", $idUserType);
                    $idUserTypeElm = $user->appendChild($idUserTypeElm);
                }

                $users->preserveWhiteSpace = false;
                $users->formatOutput = true;
                $users->save("../backups/users-bkp.xml");

                echo "<br>Create Backup was successful<br>";

                echo "<script type='text/javascript'>
                    alert('Create Backup was successful');
                    window.location.replace('http://localhost/web/funciones/ver-usuarios.php');
                    </script>";

                break;
        }
    }
    ?>
</body>

</html>