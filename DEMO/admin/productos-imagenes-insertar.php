<?php
include("../conex.php");

$id_producto = $_POST["id_producto"];
$foto = $_FILES["foto"];

$rutaDestino = "" . $foto["name"];
move_uploaded_file($foto["tmp_name"], $rutaDestino);

$orden = NULL; // Define el valor correcto para la variable $orden

$insertar = "INSERT INTO productos_imagenes (id_producto, foto) VALUES ('$id_producto', '$rutaDestino')";

$resultado = mysqli_query($conexion, $insertar);

if ($resultado) {
    echo "<script>alert('Se ha actualizado con éxito');
          window.location='/DEMO/admin/productos.php'</script>";
} else {
    echo "<script>alert('No se pudo registrar la imagen del producto');
          window.history.go(-1);</script>";
}
?>
