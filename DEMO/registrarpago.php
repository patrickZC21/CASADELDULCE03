<?php
include("conex.php");

$email = $_POST["email"];
$nombre = $_POST["nombre"];
$apellido = $_POST["apellido"];
$direccion = $_POST["direccion"];
$contraseña = $_POST["contraseña"];
$ciudad = $_POST["ciudad"];
$telefono = $_POST["telefono"];

$metodopago = $_POST["metodopago"];
$envio = $_POST["envio"];
$precio = $_POST["precio"];

// Insertar en la tabla "_usuarios"
$insertar_usuario = "INSERT INTO _usuarios (email, nombres, apellidos, direccion, clave, ciudad, phone) VALUES ('$email', '$nombre', '$apellido', '$direccion', '$contraseña', '$ciudad', '$telefono')";

$resultado_usuario = mysqli_query($conexion, $insertar_usuario);

if (!$resultado_usuario) {
    echo "<script>alert('No se pudo registrar el usuario');
          window.history.go(-1);</script>";
    exit;
}

// Obtener el ID del usuario recién insertado
$id_usuario = mysqli_insert_id($conexion);

// Insertar en la tabla "orden"
$insertar_orden = "INSERT INTO orden (id_cliente, tipo_pago_pago, id_envio, cupon_total) VALUES ('$id_usuario', '$metodopago', '$envio', '$precio')";

$resultado_orden = mysqli_query($conexion, $insertar_orden);

if ($resultado_orden) {
    // Eliminar productos del carrito de la sesión
    unset($_SESSION['carrito']);

    echo "<script>alert('Usuario y orden registrados con éxito');
          window.location='/DEMO/index.php'</script>";
} else {
    // Eliminar el usuario recién insertado en caso de error en la inserción de la orden
    $eliminar_usuario = "DELETE FROM _usuarios WHERE id = '$id_usuario'";
    mysqli_query($conexion, $eliminar_usuario);

    echo "<script>alert('No se pudo registrar la orden');
          window.history.go(-1);</script>";
}
?>

