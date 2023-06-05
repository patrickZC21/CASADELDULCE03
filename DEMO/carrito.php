<?php
include("conex.php");
session_start();

// Verificar si el formulario de agregar al carrito fue enviado
if (isset($_POST['agregar_carrito'])) {
    // Obtener los valores del formulario
    $producto_id = $_POST['producto_id'];
    $cantidad = $_POST['cantidad'];
    $precio = $_POST['precio'];
    $fecha = date('Y-m-d');
    $id_talla = $_POST['id_talla'];

    // Verificar si el producto ya está en el carrito del usuario
    $query = "SELECT * FROM orden_carrito WHERE id_producto = $producto_id";

    $resultado = mysqli_query($conexion, $query);

    if (mysqli_num_rows($resultado) > 0) {
        // El producto ya está en el carrito, actualizar la cantidad
        $query = "UPDATE orden_carrito SET cantidad = cantidad + $cantidad WHERE id_producto = $producto_id";
    } else {
        // El producto no está en el carrito, insertarlo como un nuevo registro
        $query = "INSERT INTO orden_carrito (id_producto, cantidad, precio) VALUES ($producto_id, $cantidad, $precio)";
    }

    // Ejecutar la consulta
    mysqli_query($conexion, $query);
}

// Obtener la cantidad de productos en el carrito del usuario
$query_carrito = "SELECT SUM(cantidad) AS total FROM orden_carrito";
$resultado_carrito = mysqli_query($conexion, $query_carrito);
$carrito = mysqli_fetch_assoc($resultado_carrito);
$total_carrito = $carrito['total'];
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>Zay Shop eCommerce HTML CSS Template</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="assets/img/apple-icon.png">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/templatemo.css">
    <link rel="stylesheet" href="assets/css/custom.css">

    <!-- Load fonts style after rendering the layout styles -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap">
    <link rel="stylesheet" href="assets/css/fontawesome.min.css">
<!--
    
TemplateMo 559 Zay Shop

https://templatemo.com/tm-559-zay-shop

-->
</head>

<body>
    <!-- Start Top Nav -->
    <nav class="navbar navbar-expand-lg bg-dark navbar-light d-none d-lg-block" id="templatemo_nav_top">
        <div class="container text-light">
            <div class="w-100 d-flex justify-content-between">
                <div>
                    <i class="fa fa-envelope mx-2"></i>
                    <a class="navbar-sm-brand text-light text-decoration-none" href="mailto:info@company.com">info@company.com</a>
                    <i class="fa fa-phone mx-2"></i>
                    <a class="navbar-sm-brand text-light text-decoration-none" href="tel:010-020-0340">010-020-0340</a>
                </div>
                <div>
                    <a class="text-light" href="https://fb.com/templatemo" target="_blank" rel="sponsored"><i class="fab fa-facebook-f fa-sm fa-fw me-2"></i></a>
                    <a class="text-light" href="https://www.instagram.com/" target="_blank"><i class="fab fa-instagram fa-sm fa-fw me-2"></i></a>
                    <a class="text-light" href="https://twitter.com/" target="_blank"><i class="fab fa-twitter fa-sm fa-fw me-2"></i></a>
                    <a class="text-light" href="https://www.linkedin.com/" target="_blank"><i class="fab fa-linkedin fa-sm fa-fw"></i></a>
                </div>
            </div>
        </div>
    </nav>
    <!-- Close Top Nav -->


    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-light shadow">
        <div class="container d-flex justify-content-between align-items-center">

            <a class="navbar-brand text-success logo h1 align-self-center" href="index.html">
                Zay
            </a>

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#templatemo_main_nav" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="align-self-center collapse navbar-collapse flex-fill  d-lg-flex justify-content-lg-between" id="templatemo_main_nav">
                <div class="flex-fill">
                    <ul class="nav navbar-nav d-flex justify-content-between mx-lg-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="index.html">INICIO</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="about.html">PRODUCTOS</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="shop.html">NOSOSTROS</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="contact.html">CONTACTOS</a>
                        </li>
                    </ul>
                </div>
                <div class="navbar align-self-center d-flex">
                    <div class="d-lg-none flex-sm-fill mt-3 mb-4 col-7 col-sm-auto pr-3">
                        <div class="input-group">
                            <input type="text" class="form-control" id="inputMobileSearch" placeholder="Search ...">
                            <div class="input-group-text">
                                <i class="fa fa-fw fa-search"></i>
                            </div>
                        </div>
                    </div>
                    <a class="nav-icon d-none d-lg-inline" href="#" data-bs-toggle="modal" data-bs-target="#templatemo_search">
                        <i class="fa fa-fw fa-search text-dark mr-2"></i>
                    </a>
                                      <a class="nav-icon position-relative text-decoration-none" href="#">
  <i class="fa fa-fw fa-cart-arrow-down text-dark mr-1"></i>
  <span class="position-absolute top-0 left-100 translate-middle badge rounded-pill bg-light text-dark">
    <?php echo $total_carrito; ?>
  </span>
</a>
                    <a class="nav-icon position-relative text-decoration-none" href="#">
                        <i class="fa fa-fw fa-user text-dark mr-3"></i>
                        <span class="position-absolute top-0 left-100 translate-middle badge rounded-pill bg-light text-dark">+99</span>
                    </a>
                </div>
            </div>

        </div>
    </nav>
    <!-- Close Header -->

    <!-- Modal -->
   
 <div class="container-fluid">

                    <!-- Page Heading -->
                <div class="d-flex gap-2 mb-3">
  
</div>
                       

                 
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">

                        <div class="card-header py-3">
                            
                            <h6 class="m-0 font-weight-bold text-primary">CARRITO DE COMPRAS</h6>
                        </div>
                        <div class="card-body">
    <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>id</th>
                    <th>productos</th>
                    <th>cantidad</th>
                    <th>precio</th>
                    <th>subtotal</th>
                    <th>operaciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "SELECT * FROM orden_carrito";
                $resultado = mysqli_query($conexion, $query);
                $total = 0; // Variable para almacenar la suma total
                while ($row = mysqli_fetch_assoc($resultado)) {
                    // Calcula el subtotal de cada producto
                    $subtotal = $row['cantidad'] * $row['precio'];
                    $total += $subtotal; // Suma el subtotal al total
                    ?>
                    <tr>
                        <td><?php echo $row['id'] ?></td>
                        <td><?php echo $row['id_producto'] ?></td>
                        <td><?php echo $row['cantidad'] ?></td>
                        <td><?php echo $row['precio'] ?></td>
                        <td><?php echo $subtotal ?></td>
                        <td class="text-center">
                            <a href="categorias-eliminar.php?id=<?php echo $row["id"]; ?>">
                                <button type="button" class="btn btn-danger">eliminar</button>
                            </a>
                        </td>
                    </tr>
                <?php
                }
                mysqli_free_result($resultado);
                ?>
            </tbody>
        </table>
    </div>
   <table class="table table-bordered" width="100%" cellspacing="0">
    <tbody>
        <tr>
            <td class="text-right float-right">Total:</td>
            <td class="text-right float-right"><?php echo $total; ?> <i class="fas fa-money-bill-wave"></i></td>
        </tr>
    </tbody>
</table>
<td class="text-right">
    <a href="pago.php">
        <button type="button" class="btn btn-dark">PAGAR</button>
    </a>
</td>

</div>




                    </div>

                </div>



















    <!-- End Banner Hero -->

    <!-- Start Footer -->
    <footer class="bg-dark text-white pt-5">
        <div class="container text-center text-md-left">
            <div class="row text-center text-md-left">
                <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
                    <h5 class="text-uppercase mb-4 font-weight-bold text-warning">Zay Shop</h5>
                    <p>Here you can use rows and columns to organize your footer content. Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                </div>
                <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mt-3">
                    <h5 class="text-uppercase mb-4 font-weight-bold text-warning">Products</h5>
                    <p>
                        <a href="#" class="text-white">Product 1</a>
                    </p>
                    <p>
                        <a href="#" class="text-white">Product 2</a>
                    </p>
                    <p>
                        <a href="#" class="text-white">Product 3</a>
                    </p>
                    <p>
                        <a href="#" class="text-white">Product 4</a>
                    </p>
                </div>
                <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mt-3">
                    <h5 class="text-uppercase mb-4 font-weight-bold text-warning">Useful links</h5>
                    <p>
                        <a href="#" class="text-white">About Us</a>
                    </p>
                    <p>
                        <a href="#" class="text-white">Contact Us</a>
                    </p>
                    <p>
                        <a href="#" class="text-white">Support</a>
                    </p>
                    <p>
                        <a href="#" class="text-white">Shipping</a>
                    </p>
                </div>
                <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-3">
                    <h5 class="text-uppercase mb-4 font-weight-bold text-warning">Contact</h5>
                    <p>
                        <i class="fa fa-home mr-3"></i> New York, NY 10012, US</p>
                    <p>
                        <i class="fa fa-envelope mr-3"></i> info@example.com</p>
                    <p>
                        <i class="fa fa-phone mr-3"></i> + 01 234 567 88</p>
                    <p>
                        <i class="fa fa-print mr-3"></i> + 01 234 567 89</p>
                </div>
            </div>
            <hr class="mb-4">
            <div class="row align-items-center">
                <div class="col-md-7 col-lg-8">
                    <p class="text-center text-md-left">
                        <span>&copy; 2023 Zay Shop. All rights reserved.</span>
                    </p>
                </div>
                <div class="col-md-5 col-lg-4">
                    <div class="text-center text-md-right">
                        <ul class="list-unstyled list-inline">
                            <li class="list-inline-item">
                                <a href="#" class="btn-floating btn-sm text-white" style="background-color: #3b5998;"><i class="fa fa-facebook"></i></a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#" class="btn-floating btn-sm text-white" style="background-color: #1da1f2;"><i class="fa fa-twitter"></i></a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#" class="btn-floating btn-sm text-white" style="background-color: #dd4b39;"><i class="fa fa-google"></i></a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#" class="btn-floating btn-sm text-white" style="background-color: #ac2bac;"><i class="fa fa-instagram"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- End Footer -->

    <script src="assets/js/jquery-1.11.0.min.js"></script>
    <script src="assets/js/jquery-migrate-1.2.1.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/templatemo.js"></script>
    <script src="assets/js/custom.js"></script>

</body>

</html>
