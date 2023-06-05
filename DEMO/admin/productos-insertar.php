<?php
include("../conex.php");

$nombre = $_POST["nombre_es"];
$descripcion = $_POST["descripcion_es"];
$especificaciones = $_POST["especificaciones_es"];
$ingles = $_POST["nombre_en"];
$descripcion_en = $_POST["descripcion_en"];
$especificaciones_en = $_POST["especificaciones_en"];
$id_categoria = $_POST["id_categoria"]; // Se asume que el campo del formulario tiene el nombre "id_categoria"
$id_subcategoria = $_POST["id_subcategoria"]; // Se asume que el campo del formulario tiene el nombre "id_subcategoria"
$peso = $_POST["peso"];
$dimensiones = $_POST["dimensiones"];
$precio = $_POST["precio"];
$descuento = $_POST["descuento"];
$descuento_caduca = $_POST["descuento_caduca"];

$insertar = "INSERT INTO productos (nombre_es, descripcion_es, especificaciones_es, nombre_en, descripcion_en, especificaciones_en, id_categoria, id_subcategoria, peso, dimensiones, precio, descuento, descuento_caduca) VALUES ('$nombre', '$descripcion', '$especificaciones', '$ingles', '$descripcion_en', '$especificaciones_en', '$id_categoria', '$id_subcategoria', '$peso', '$dimensiones', '$precio', '$descuento', '$descuento_caduca')";

$resultado = mysqli_query($conexion, $insertar);

if ($resultado) {
    echo "<script>alert('Se ha registrado el producto con éxito');
          window.location='/DEMO/admin/productos.php'</script>";
} else {
    echo "<script>alert('No se pudo registrar el producto');
          window.history.go(-1);</script>";
}
?>
