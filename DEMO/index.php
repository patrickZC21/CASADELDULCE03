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
    
    <!-- Close Top Nav -->


    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" style="background-color: white;">
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
                                      <a class="nav-icon position-relative text-decoration-none" href="carrito.php">
  <i class="fa fa-fw fa-cart-arrow-down text-dark mr-1"></i>
  <span class="position-absolute top-0 left-100 translate-middle badge rounded-pill bg-light text-dark">
    <?php echo $total_carrito; ?>
  </span>
</a>
                    <a class="nav-icon position-relative text-decoration-none" href="#">
                        <i class="fa fa-fw fa-user text-dark mr-3"></i>
                        <span class="position-absolute top-0 left-100 translate-middle badge rounded-pill bg-light text-dark"></span>
                    </a>
                </div>
            </div>

        </div>
    </nav>
    <!-- Close Header -->

    <!-- Modal -->
    <div class="modal fade bg-white" id="templatemo_search" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="w-100 pt-1 mb-5 text-right">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="get" class="modal-content modal-body border-0 p-0">
                <div class="input-group mb-2">
                    <input type="text" class="form-control" id="inputModalSearch" name="q" placeholder="Search ...">
                    <button type="submit" class="input-group-text bg-success text-light">
                        <i class="fa fa-fw fa-search text-white"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>


    <!-- Start Banner Hero -->
    <section class="bg-light">
    <div class="container py-5">
        <div class="row justify-content-center">
            <?php
            $query = "SELECT p.*, pi.foto FROM productos p LEFT JOIN productos_imagenes pi ON p.id = pi.id_producto";
            $resultado = mysqli_query($conexion, $query);

            // Iterar sobre los productos y mostrar la tarjeta de cada uno
            while ($producto = mysqli_fetch_assoc($resultado)) {
            ?>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100 text-center">
                        <div class="card-body">
                            <img class="card-img-top mx-auto" src="items/<?php echo $producto['foto']; ?>" alt="" style="max-width: 50%;">
                        </div>

                        <div class="card-body">
                            <h5 class="card-title"><?php echo $producto['nombre_es']; ?></h5>
                            <p class="card-text"><?php echo $producto['precio']; ?></p>
                            
                            <form method="POST" action="">
                                <input type="hidden" name="producto_id" value="<?php echo $producto['id']; ?>">
                                <input type="hidden" name="precio" value="<?php echo $producto['precio']; ?>">
                                <input type="hidden" name="id_talla" value="<?php echo isset($producto['id_talla']) ? $producto['id_talla'] : ''; ?>">
                                <div class="form-group">
                                    <label for="cantidad">Cantidad:</label>
                                    <input type="number" name="cantidad" id="cantidad" class="form-control" value="1" min="1">
                                </div>
                               
                                 <div class="card-body">
                                  <button type="submit" name="agregar_carrito" class="btn btn-primary">Agregar </button>
                                </div>
                            </form>
                        </div>
                         
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</section>


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
