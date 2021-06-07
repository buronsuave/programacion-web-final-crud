<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.24/b-1.7.0/b-html5-1.7.0/b-print-1.7.0/datatables.min.css" />

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.24/b-1.7.0/b-html5-1.7.0/b-print-1.7.0/datatables.min.js"></script>

    <script src="../js/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">

    <title>David's Toys - Backup</title>
    <link rel="shortcut icon" href="../images/icons/icono.png" />

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
            <?php

            if (isset($_POST['showBackUp'])) {
                $table = $_POST['showBackUp'];

                switch ($table) {
                    case "categories":
                        $xml = simplexml_load_file("../backups/categories-bkp.xml");
                        echo '<br><br>';
                        echo '<a role="button" href = "ver-categorias.php" class="btn btn-danger">Back</a>';
                        echo '<br><br>';

                        echo '<table id="tablaCategorias" class="display" style="width:100%">';
                        echo "<thead>";
                        echo "<tr>";
                        echo "<th>#</th>";
                        echo "<th>Category</th>";
                        echo "</tr>";
                        echo "</thead>";
                        echo "<tbody>";

                        foreach ($xml->category as $category) {
                            echo "<tr>";
                            echo "<td> " . $category['id'] . "</td>";
                            echo "<td> " . $category->name . "</td>";
                            echo "</tr>";
                        }

                        echo "</tbody>";
                        echo "</table>";
                        break;

                    case "products":
                        $xml = simplexml_load_file("../backups/products-bkp.xml");
                        echo '<br><br>';
                        echo '<a role="button" href = "ver-productos.php" class="btn btn-danger">Back</a>';
                        echo '<br><br>';

                        echo '<table id="tablaProductos" class="display" style="width:100%">';
                        echo "<thead>";
                        echo "<tr>";
                        echo "<th>Name</th>";
                        echo "<th>Category</th>";
                        echo "<th>Price</th>";
                        echo "<th>Stock</th>";
                        echo "</tr>";
                        echo "</thead>";
                        echo "<tbody>";

                        foreach ($xml->product as $product) {
                            echo "<tr>";
                            echo "<td> " . $product->name . "</td>";
                            echo "<td> " . $product->idCategory . "</td>";
                            echo "<td> " . $product->price . "</td>";
                            echo "<td> " . $product->stock . "</td>";
                            echo "</tr>";
                        }

                        echo "</tbody>";
                        echo "</table>";
                        break;

                    case "providers":
                        $xml = simplexml_load_file("../backups/providers-bkp.xml");
                        echo '<br><br>';
                        echo '<a role="button" href = "ver-proveedores.php" class="btn btn-danger">Back</a>';
                        echo '<br><br>';

                        echo '<table id="tablaProveedores" class="display" style="width:100%">';
                        echo "<thead>";
                        echo "<tr>";
                        echo "<th>ID</th>";
                        echo "<th>Name</th>";
                        echo "<th>First Delivery</th>";
                        echo "</tr>";
                        echo "</thead>";
                        echo "<tbody>";

                        foreach ($xml->provider as $provider) {
                            echo "<tr>";
                            echo "<td> " . $provider['id'] . "</td>";
                            echo "<td> " . $provider->name . "</td>";
                            echo "<td> " . $provider->firstDelivery . "</td>";
                            echo "</tr>";
                        }

                        echo "</tbody>";
                        echo "</table>";
                        break;

                    case "users":
                        $xml = simplexml_load_file("../backups/users-bkp.xml");
                        echo '<br><br>';
                        echo '<a role="button" href = "ver-usuarios.php" class="btn btn-danger">Back</a>';
                        echo '<br><br>';

                        echo '<table id="tablaUsuarios" class="display" style="width:100%">';
                        echo "<thead>";
                        echo "<tr>";
                        echo "<th>Name</th>";
                        echo "<th>Lastname</th>";
                        echo "<th>Username</th>";
                        echo "<th>User Type</th>";
                        echo "<th>Image</th>";
                        echo "</tr>";
                        echo "</thead>";
                        echo "<tbody>";

                        foreach ($xml->user as $user) {
                            echo "<tr>";
                            echo "<td> " . $user->name . "</td>";
                            echo "<td> " . $user->lastName . "</td>";
                            echo "<td> " . $user->username . "</td>";
                            echo "<td> " . $user->idUserType . "</td>";

                            if (empty($user->imageUrl)) {
                                echo "<td> " . '<img style="max-width: 75px; max-height: 75px" src="'
                                    . "http://proyectosinformaticatnl.ceti.mx/pyvdj-21/files/default.png"
                                    . '"></td>';
                            } else {
                                echo "<td> " . '<img style="max-width: 75px; max-height: 75px" src="'
                                    . $user->imageUrl
                                    . '" onerror="imageLoadError(this)">'
                                    . "</td>";
                            }

                            echo "</tr>";
                        }

                        echo "</tbody>";
                        echo "</table>";
                        break;

                    default:
                        echo "<script type='text/javascript'>
                        alert('unsupported index');
                        window.location.replace('http://proyectosinformaticatnl.ceti.mx/pyvdj-21/');
                        </script>";
                }
            } else {
                echo "<script type='text/javascript'>
                alert('Post variable not set');
                window.location.replace('http://proyectosinformaticatnl.ceti.mx/pyvdj-21/');
                </script>";
            }
            ?>
        </section>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
        <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>

        <script type="text/javascript">
            $(document).ready(function() {
                $('#tablaCategorias').DataTable({
                    rowReorder: {
                        selector: 'td:nth-child(2)'
                    },
                    responsive: true,
                    dom: 'lBfrtip',
                    buttons: [{
                        extend: 'excelHtml5',
                        exportOptions: {
                            columns: [0, 1]
                        }
                    }, {
                        extend: 'pdfHtml5',
                        exportOptions: {
                            columns: [0, 1]
                        }
                    }, {
                        extend: 'print',
                        exportOptions: {
                            columns: [0, 1]
                        }
                    }, {
                        extend: 'copyHtml5',
                        exportOptions: {
                            columns: [0, 1]
                        }
                    }, ],
                    'lengthMenu': [
                        [10, 25, 50, -1],
                        [10, 25, 50, "All"]
                    ]
                });
            });
        </script>

        <script type="text/javascript">
            $(document).ready(function() {
                $('#tablaProductos').DataTable({
                    rowReorder: {
                        selector: 'td:nth-child(2)'
                    },
                    responsive: true,
                    dom: 'lBfrtip',
                    buttons: [{
                        extend: 'excelHtml5',
                        exportOptions: {
                            columns: [0, 1, 2, 3]
                        }
                    }, {
                        extend: 'pdfHtml5',
                        exportOptions: {
                            columns: [0, 1, 2, 3]
                        }
                    }, {
                        extend: 'print',
                        exportOptions: {
                            columns: [0, 1, 2, 3]
                        }
                    }, {
                        extend: 'copyHtml5',
                        exportOptions: {
                            columns: [0, 1, 2, 3]
                        }
                    }, ],
                    'lengthMenu': [
                        [10, 25, 50, -1],
                        [10, 25, 50, "All"]
                    ]
                });
            });
        </script>

        <script type="text/javascript">
            $(document).ready(function() {
                $('#tablaProveedores').DataTable({
                    rowReorder: {
                        selector: 'td:nth-child(2)'
                    },
                    responsive: true,
                    dom: 'lBfrtip',
                    buttons: [{
                        extend: 'excelHtml5',
                        exportOptions: {
                            columns: [0, 1, 2]
                        }
                    }, {
                        extend: 'pdfHtml5',
                        exportOptions: {
                            columns: [0, 1, 2]
                        }
                    }, {
                        extend: 'print',
                        exportOptions: {
                            columns: [0, 1, 2]
                        }
                    }, {
                        extend: 'copyHtml5',
                        exportOptions: {
                            columns: [0, 1, 2]
                        }
                    }, ],
                    'lengthMenu': [
                        [10, 25, 50, -1],
                        [10, 25, 50, "All"]
                    ]
                });
            });
        </script>

        <script type="text/javascript">
            $(document).ready(function() {
                $('#tablaUsuarios').DataTable({
                    rowReorder: {
                        selector: 'td:nth-child(2)'
                    },
                    responsive: true,
                    dom: 'lBfrtip',
                    buttons: [{
                        extend: 'excelHtml5',
                        exportOptions: {
                            columns: [0, 1, 2, 3]
                        }
                    }, {
                        extend: 'pdfHtml5',
                        exportOptions: {
                            columns: [0, 1, 2, 3]
                        }
                    }, {
                        extend: 'print',
                        exportOptions: {
                            columns: [0, 1, 2, 3]
                        }
                    }, {
                        extend: 'copyHtml5',
                        exportOptions: {
                            columns: [0, 1, 2, 3]
                        }
                    }, ],
                    'lengthMenu': [
                        [10, 25, 50, -1],
                        [10, 25, 50, "All"]
                    ]
                });
            });
        </script>

        <script>
            const imageLoadError = context => {
                context.onerror = null;
                context.src = 'http://proyectosinformaticatnl.ceti.mx/pyvdj-21/files/default.png';
            }
        </script>
    </content>
</body>

</html>