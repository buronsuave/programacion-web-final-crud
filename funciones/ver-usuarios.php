<!DOCTYPE html>
<html>

<head>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.24/b-1.7.0/b-html5-1.7.0/b-print-1.7.0/datatables.min.js"></script>
    <script src="../js/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>

    <meta charset="UTF-8">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.24/b-1.7.0/b-html5-1.7.0/b-print-1.7.0/datatables.min.css" />
    <link rel="shortcut icon" href="../images/icons/icono.png" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>David's Toys - Users</title>
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
            <table id="datatable" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Lastname</th>
                        <th>Username</th>
                        <th>User Type</th>
                        <th>Image</th>
                        <th>Options</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include '../database/connectorPDO.php';
                    $query = "SELECT users.id, users.name, users.lastName, users.username, users.idUserType, usertypes.name AS type, users.imageUrl
                            FROM users LEFT JOIN usertypes ON users.iduserType = usertypes.id";
                    $result = $conn->prepare($query);
                    $result->execute();

                    if ($result->rowCount() > 0) {
                        foreach (($result->fetchAll(PDO::FETCH_OBJ)) as $row) {
                            echo "<tr>";
                            echo "<td>" . $row->name . "</td>";
                            echo "<td>" . $row->lastName . "</td>";
                            echo "<td>" . $row->username . "</td>";
                            echo "<td>" . $row->type . "</td>";
                            echo "<td>" . '<img style="max-width: 75px; max-height: 75px" src="' . $row->imageUrl . '"onerror="imageLoadError(this)"/>' . "</td>";
                            echo '<td>' .  '<a role="button" href = "./editar-usuario.php?id=' . $row->id . '" class="btn btn-info">Edit</a>' .
                                '          ' . '<a role="button" href = "./borrar-usuario.php?id=' . $row->id . '" class="btn btn-danger">Delete</button>' . '</td>';
                            echo "</tr>";
                        }
                    } else {
                        echo    '<tr>
                                    <td colspan="6" align="center">-- Empty Table --</td>"
                                </tr>';
                    }
                    ?>
                </tbody>
            </table>

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
                    $('#datatable').DataTable({
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

            <br>
            <div class="row">
                <div class="col">
                    <a role="button" href="./agregar-usuario.php" class="btn btn-success">Add User</a>
                </div>
                <form method=POST action="crear-copia.php">
                    <div class="col">
                        <button name="createBackUp" value="users" type="submit" class="btn btn-secondary">Create backup</button>
                    </div>
                </form>
                <form method=POST action="cargar-copia.php">
                    <div class="col">
                        <button name="showBackUp" value="users" type="submit" class="btn btn-secondary">View backup</button>
                    </div>
                </form>
                <form method=POST action="graficar.php">
                    <div class="col">
                        <button name="showGraph" value="users" type="submit" class="btn btn-info" disabled>Graph</button>
                    </div>
                </form>
            </div>
        </section>
        <section class="container">
            <article class="mt-5 text-center
        font-weight-bold font-bold
        text-uppercase">
                David's Toys.
            </article>
            <article class="bg-dark text-white p-4 w-25 float-left mr-4">
                Check about<br><br>
                <nav class="nav nav-tabs">
                    <ul class="list-unstyled">
                        <li class="nav-item bg-primary"><a class="nav-link active bg-primary text-white" href="./ver-productos.php">
                                Products</a></li>
                        <li class="nav-item bg-primary"><a class="nav-link active bg-primary text-white" href="./ver-categorias.php">
                                Categories</a></li>
                        <li class="nav-item bg-primary"><a class="nav-link active bg-primary text-white" href="./ver-usuarios.php">
                                Users</a></li>
                        <li class="nav-item bg-primary"><a class="nav-link active bg-primary text-white" href="./ver-proveedores.php">
                                Providers</a></li>
                    </ul>
                </nav>
            </article>

            <article class="bg-secondary text-justify text-white p-4 w-50 float-left mr-4">
                We are a company dedicated to the sale of educational toys to develop mathematics in
                children in the early stages of their development and of medium range. Our variety of
                products covers all dimensions of what concerns toys, tackling different puzzles, board games,
                card games and even video games that have been designed to stimulate the mathematical and
                logical side of the little ones.
            </article>

            <article class="text-justify">
            </article>
        </section>
    </content>
    <footer class="bg-dark text-center text-white">
        <div class="container p-4">
            <section class="mb-4">
                <p>
                    If you want to know more about the company, you can consult our social networks
                </p>
            </section>
            <section class="mb-4">
                <a class="btn btn-outline-light btn-floating m-1" href="https://facebook.com/davidstoys" role="button"><i class="fab fa-facebook-f"></i></a>
                <a class="btn btn-outline-light btn-floating m-1" href="https://twitter.com/davidstoys" role="button"><i class="fab fa-twitter"></i></a>
                <a class="btn btn-outline-light btn-floating m-1" href="https://google.com/davidstoys" role="button"><i class="fab fa-google"></i></a>
                <a class="btn btn-outline-light btn-floating m-1" href="https://instagram.com/davidstoys" role="button"><i class="fab fa-instagram"></i></a>
                <a class="btn btn-outline-light btn-floating m-1" href="https://linkedin.com/davidstoys" role="button"><i class="fab fa-linkedin-in"></i></a>
                <a class="btn btn-outline-light btn-floating m-1" href="https://github.com/davidstoys" role="button"><i class="fab fa-github"></i></a>
            </section>
        </div>

        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
            © 2021 Copyright:
            <a class="text-white">Powered with Bootstrap</a>
        </div>
    </footer>
</body>

</html>