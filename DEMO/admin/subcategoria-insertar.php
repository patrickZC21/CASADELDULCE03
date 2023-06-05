
<?php
include("../conex.php");

$nombre = $_POST["nombre_es"];
$id_categoria = $_POST['id'];




$insertar = "INSERT INTO subcategorias (id_categoria, nombre_es, nombre_en, estatus) VALUES ('$id_categoria','$nombre', '$nombre','si')";

$resultado = mysqli_query($conexion, $insertar);

if ($resultado) {
    echo "<script>alert('Se ha actualizado con éxito');
          window.location='/DEMO/admin/categorias.php'</script>";
} else {
    echo "<script>alert('No se pudo registrar la categoría');
          window.history.go(-1);</script>";
}     