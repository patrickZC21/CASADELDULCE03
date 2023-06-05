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
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

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
    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow" style="background-color: white;">
    <div class="container d-flex justify-content-between align-items-center">
        <a class="navbar-brand text-success logo h1 align-self-center" href="index.html">
            Zay
        </a>
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#templatemo_main_nav" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="align-self-center collapse navbar-collapse flex-fill d-lg-flex justify-content-lg-between" id="templatemo_main_nav">
            <div class="flex-fill">
                <ul class="nav navbar-nav d-flex justify-content-between mx-lg-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.html">INICIO</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about.html">PRODUCTOS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="shop.html">NOSOTROS</a>
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
   
                                <div class="container-fluid">
    <form method="post" action="registrarpago.php" enctype="multipart/form-data">
        <div class="row">

            <div class="col-xl-4 col-md-6 mb-4">
                <div class="col">
                    <div class="icon-demo mb-4 border rounded-3 d-flex align-items-center justify-content-center p-3 py-6" style="font-size: 6em" role="img" aria-label="1 circle fill - large preview">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-1-circle-fill" viewBox="0 0 16 16">
                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0ZM9.283 4.002H7.971L6.072 5.385v1.271l1.834-1.318h.065V12h1.312V4.002Z"></path>
                        </svg>
                    </div>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">DIRECCION</h6>
                        </div>
                        <div class="card-body">
    <div class="form-group">
        
        <input name="email" class="form-control" type="text" placeholder="EMAIl">
    </div>

    <div class="form-group">
        
        <input name="nombre" class="form-control" type="text" placeholder="NOMBRE">
    </div>

    <div class="form-group">
       <input name="apellido" class="form-control" type="text" placeholder="APELLIDO">
    </div>

    <div class="form-group">
        <input name="direccion" class="form-control" type="text" placeholder="DIRECCION COMPLETA">
    </div>

    <div class="form-group">
         <input name="contraseña" class="form-control" type="text" placeholder="PUNTO DE REFERENCIA">
    </div>
    <div class="form-group">
         <input name="ciudad" class="form-control" type="text" placeholder="CIUDAD">
    </div>
    <div class="form-group">
         <input name="telefono" class="form-control" type="text" placeholder="TELEFONO">
    </div>
</div>

                    </div>
                </div>
            </div>
          
                                          <div class="col-xl-4 col-md-6 mb-4">
                                           <div class="col">
                                              <div class="icon-demo mb-4 border rounded-3 d-flex align-items-center justify-content-center p-3 py-6" style="font-size: 6em" role="img" aria-label="2 circle fill - large preview">
                                                      <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-2-circle-fill" viewBox="0 0 16 16">
                                                      <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0ZM6.646 6.24c0-.691.493-1.306 1.336-1.306.756 0 1.313.492 1.313 1.236 0 .697-.469 1.23-.902 1.705l-2.971 3.293V12h5.344v-1.107H7.268v-.077l1.974-2.22.096-.107c.688-.763 1.287-1.428 1.287-2.43 0-1.266-1.031-2.215-2.613-2.215-1.758 0-2.637 1.19-2.637 2.402v.065h1.271v-.07Z"></path>
                                                      </svg>
                                              </div>
                                                     <div class="card shadow mb-4">
                                                        <div class="card-header py-3">
                                                         <h6 class="m-0 font-weight-bold text-primary">PAGO Y ENVIO</h6>
                                                        </div>
                                              <div class="card-body">
  <label for="descripcion">TIPO DE PAGO</label>
  <select name="metodopago" id="categoria" class="form-control">
    <option value="">Seleccione...</option>
    <?php
    // Obtener registros de la tabla de categorías y generar las opciones del select
    $query = "SELECT id, banco FROM datosbancarios";
    $result = $conexion->query($query);

    while ($row = $result->fetch_assoc()) {
      $categoriaId = $row['id'];
      $categoriaNombre = $row['banco'];
      echo "<option value='$categoriaId'>$categoriaNombre</option>";
    }
    ?>
  </select>
</div>

<div class="card-body">
  <label for="subcategoria">METODO DE ENVIO</label>
  <select name="envio" id="subcategoria" class="form-control">
    <option value="">Seleccione...</option>
     <?php
    // Obtener registros de la tabla de categorías y generar las opciones del select
    $query = "SELECT id, nombre_es FROM envio";
    $result = $conexion->query($query);

    while ($row = $result->fetch_assoc()) {
      $categoriaId = $row['id'];
      $categoriaNombre = $row['nombre_es'];
      echo "<option value='$categoriaId'>$categoriaNombre</option>";
    }
    ?>
  </select>
</div>




      </div>
                                       </div>
                                     </div>



            <div class="col-xl-4 col-md-6 mb-4">
                <div class="col">
                    <div class="icon-demo mb-4 border rounded-3 d-flex align-items-center justify-content-center p-3 py-6" style="font-size: 6em" role="img" aria-label="3 circle fill - large preview">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-3-circle-fill" viewBox="0 0 16 16">
                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0Zm-8.082.414c.92 0 1.535.54 1.541 1.318.012.791-.615 1.36-1.588 1.354-.861-.006-1.482-.469-1.54-1.066H5.104c.047 1.177 1.05 2.144 2.754 2.144 1.653 0 2.954-.937 2.93-2.396-.023-1.278-1.031-1.846-1.734-1.916v-.07c.597-.1 1.505-.739 1.482-1.876-.03-1.177-1.043-2.074-2.637-2.062-1.675.006-2.59.984-2.625 2.12h1.248c.036-.556.557-1.054 1.348-1.054.785 0 1.348.486 1.348 1.195.006.715-.563 1.237-1.342 1.237h-.838v1.072h.879Z"></path>
                        </svg>
                    </div>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">ORDEN RESUMEN</h6>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <div class="form-group">
    <label for="peso">pagar:</label>
    <?php
    $query = "SELECT * FROM orden_carrito";
    $resultado = mysqli_query($conexion, $query);
    $total = 0; // Variable para almacenar la suma total
    while ($row = mysqli_fetch_assoc($resultado)) {
        // Calcula el subtotal de cada producto
        $subtotal = $row['cantidad'] * $row['precio'];
        $total += $subtotal; // Suma el subtotal al total
    }
    mysqli_free_result($resultado);
    ?>
    <span class="text-right float-right"><?php echo $total; ?> <i class="fas fa-money-bill-wave"></i></span>
     <input type="hidden" name="precio" value="<?php echo $total; ?>">
</div>

                
                



                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 d-flex justify-content-end gap-2 mb-3">
                <button type="submit" class="btn btn-primary btn-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                        <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"></path>
                    </svg>
                    PAGAR
                </button>

            </div>
        </div>
      </div>

    </form>
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
