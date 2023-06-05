<?php
include ("../conex.php");

// Obtener el ID de la categoría seleccionada
if (isset($_GET['id_categoria'])) {
  $categoriaId = $_GET['id_categoria'];

  // Consultar las subcategorías correspondientes a la categoría seleccionada
  $query = "SELECT id, nombre_es FROM subcategorias WHERE id_categoria = '$categoriaId'";
  $resultado = mysqli_query($conexion, $query);

  // Crear un array para almacenar las subcategorías
  $subcategorias = array();

  // Iterar sobre los resultados y agregar las subcategorías al array
  while ($row = mysqli_fetch_assoc($resultado)) {
      $subcategoria = array(
          'id' => $row['id'],
          'nombre' => $row['nombre_es']
      );
      $subcategorias[] = $subcategoria;
  }

  // Devolver las subcategorías como respuesta en formato JSON
  header('Content-Type: application/json');
  echo json_encode($subcategorias);
} else {
  // Manejar el caso cuando no se proporciona el ID de la categoría
  echo "No se ha proporcionado el ID de la categoría";
}
?>
