<?php
include("../conex.php");
$id = $_POST["id"];
$nombre = $_POST["nombre_es"];
$ingles = $_POST["ingles_en"];
$foto = $_FILES["foto"];

$rutaDestino = "" . $foto["name"];
move_uploaded_file($foto["tmp_name"], $rutaDestino);

$actualizar = "UPDATE categorias SET nombre_es='$nombre', nombre_en='$ingles', foto='$rutaDestino', estatus='si'
    WHERE id='$id'";


$resultado = mysqli_query($conexion, $actualizar);

if ($resultado) {
    echo "<script>alert('Se ha actualizado con éxito');
          window.location='/DEMO/admin/categorias.php'</script>";
} else {
    echo "<script>alert('No se pudo registrar la categoría');
          window.history.go(-1);</script>";
}
