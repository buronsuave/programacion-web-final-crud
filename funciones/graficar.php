<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css">
    <title>David's Toys - Graph</title>
    <link rel="shortcut icon" href="../images/icons/icono.png">
</head>

<header class="p-3 bg-dark text-white">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start"></div>
    </div>
</header>

<?php

$printArray = "[";
$graphTitle;
$returnDir;

if (isset($_POST['showGraph'])) {
    $showGraph = $_POST['showGraph'];
    include "../database/connectorMYSQLI.php";

    switch ($showGraph) {
        case "products":
            $printArray .= "['Product', 'Price'],";
            $graphTitle = "Price of products";
            $returnDir = "ver-productos.php";

            $sql = "SELECT name, price FROM products ORDER BY price";
            $result = $mysqli->query($sql);

            while ($row = mysqli_fetch_array($result)) {
                $printArray .= "['" . $row['name'] . "', " . $row["price"] . "],";
            }

            break;

        case "providers":
            $printArray .= "['Provider', 'Days of service'],";
            $graphTitle = "Days of service of providers";
            $returnDir = "ver-proveedores.php";

            $sql = "SELECT name, DATEDIFF( CURDATE( ) , firstDelivery ) AS days, firstDelivery
                    FROM `providers` ORDER BY firstDelivery";
            $result = $mysqli->query($sql);

            while ($row = mysqli_fetch_array($result)) {
                $printArray .= "['" . $row['name'] . " (".$row['firstDelivery'].")', " . $row["days"] . "],";
            }
            break;

        default:
            echo "<script type='text/javascript'>
                alert('Table could not be graphed');
                window.location.replace('http://proyectosinformaticatnl.ceti.mx/pyvdj-21/');
                </script>";
    }

    $printArray .= "]";
} else {
    echo "<script type='text/javascript'>
        alert('Post variable not set');
        window.location.replace('http://proyectosinformaticatnl.ceti.mx/pyvdj-21/');
        </script>";
}
?>

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

    <script>
        google.load('visualization', '1', {
            packages: ['corechart']
        });
        google.setOnLoadCallback(paintGraph);

        function paintGraph() {
            var data = google.visualization.arrayToDataTable(<?php echo $printArray ?>);
            var options = {
                title: '<?php echo $graphTitle ?>'
            }
            new google.visualization.ColumnChart(
                document.getElementById('graph')
            ).draw(data, options);
        }
    </script>

    <section class="container">
        <div calss="container">
            <br><br>
            <a role="button" href="<?php echo $returnDir ?>" class="btn btn-outline-danger">Back</a>
        </div>
        <div id="graph" style="width: 800px; height: 600px">
        </div>
    </section>

</body>

</html>