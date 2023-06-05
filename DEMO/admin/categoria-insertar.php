<?php
include("../conex.php");

$nombre = $_POST["nombre_es"];
$ingles = $_POST["ingles_en"];
$foto = $_FILES["foto"];

$rutaDestino = "" . $foto["name"];
move_uploaded_file($foto["tmp_name"], $rutaDestino);

$insertar = "INSERT INTO categorias (nombre_es, nombre_en, foto, estatus, orden) VALUES ('$nombre', '$ingles', '$rutaDestino', 'si', '$orden')";

$resultado = mysqli_query($conexion, $insertar);

if ($resultado) {
    echo "<script>alert('Se ha actualizado con éxito');
          window.location='/DEMO/admin/categorias.php'</script>";
} else {
    echo "<script>alert('No se pudo registrar la categoría');
          window.history.go(-1);</script>";
}     