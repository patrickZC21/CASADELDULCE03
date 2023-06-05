<?php
include("../conex.php");
$id = $_GET["id"];

$eliminar = "DELETE FROM categorias WHERE id = '$id'";

$resultadoEliminar = mysqli_query($conexion, $eliminar);

if ($resultadoEliminar) {
    header("location: categorias.php");
} else {
    echo "<script>alert('No se pudo eliminar la categoría');
          window.history.go(-1);</script>";
}