<!-- // Conexión a la base de datos -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>historial inventario</title>
<link rel="stylesheet" href="../inventario/historial_inventario/styles_historial.css">
<script src="../inventario/historial_inventario/filtrador_historial.js"></script>
<link rel="stylesheet" href="../inventario/historial_inventario/responsive_historial.css">
</head>
<body>
    <br><br>
    <h1 class="titulo"> Historial</h1>
    <br>
    <a href="index.php" class="regresar_al_inventario">Regresar</a>
    <a href=".//historial_inventario/productos_agregados.php" class="productos_Agregados_Y_eliminados">Productos agregados y eliminados</a>



    <!-- Buscador para filtrar los cambios de un producto en especifico -->
  <div class="buscador_del_historial">
    <form method="GET" action="historial_inventario.php">
      <input type="text" name="busqueda" id="busqueda" placeholder="Buscar producto" value="<?php echo isset($_GET['busqueda']) ? $_GET['busqueda'] : '' ?>">
      <button type="submit">🔍︎</button>
    </form>
  </div>


    <!-- Filtrar el historial por tiempo trancurrido de la fecha de cambio -->
    <nav class="filtrador">
  <ul>
    <li class="historial_completo"><a href="#" onclick="mostrarTodos()" class="todoslosproductos">Historial completo</a></li>
    <li class="dropdown">
      <a href="#" class="filtro_historiall">Filtrar por tiempo</a>
      <ul class="dropdown-menu">
      <li><a href="#" class="filtro_tiempo" onclick="mostrarUltimas24hrs()">Últimas 24 horas</a></li>
        <li><a href="#" class="filtro_tiempo" onclick="mostrarUltimos7dias()">Últimos 7 dias</a></li>
        <li><a href="#" class="filtro_tiempo" onclick="mostrarUltimoMes()">Útimo mes</a></li>
        <li><a href="#" class="filtro_tiempo" onclick="mostrarUltimos6Meses()">Últimos 6 meses</a></li>
        <li><a href="#" class="filtro_tiempo" onclick="mostrarUltimoAño()">Último año</a></li>
      </ul>
    </li>
  </ul>
</nav>
    <br><br><br><br><br>
</body>
</html>
<?php
$conn = mysqli_connect("localhost", "root", "", "ControlStock");

// Verificar la conexión
if(!$conn){
    die("Conexión fallida: " . mysqli_connect_error());
}

// Consulta para obtener el historial de modificaciones
$sql = "SELECT * FROM historial ORDER BY fecha_modificacion DESC";
$result = mysqli_query($conn, $sql);

// Consulta para obtener los productos filtrados si hay una búsqueda en el input
if (isset($_GET['busqueda']) && !empty($_GET['busqueda'])) {
  $busqueda = $_GET['busqueda'];
  $sql = "SELECT * FROM historial WHERE producto LIKE '%$busqueda%'";
} else {
  // Consulta para obtener todos los productos
  $sql = "SELECT * FROM historial";
}

// Agrega el filtrado por fecha si se proporciona un valor en el URL
if (isset($_GET['fecha_filtro']) && !empty($_GET['fecha_filtro'])) {
  $fechaFiltro = $_GET['fecha_filtro'];
  if (strpos($sql, 'WHERE') === false) {
    $sql .= " WHERE DATE(fecha_modificacion) >= '$fechaFiltro'";
  } else {
    $sql .= " AND DATE(fecha_modificacion) >= '$fechaFiltro'";
  }
}

$result = mysqli_query($conn, $sql);


// Mostrar el historial en una tabla
echo "<table>";
echo "<tr><th>Producto</th><th>Stock anterior</th><th>Stock nuevo</th><th>Fecha de modificación</th></tr>";

while ($row = mysqli_fetch_assoc($result)) {
    $producto = $row['Producto'];
    $stock_anterior = $row['stock_anterior'];
    $stock_nuevo = $row['stock_nuevo'];
    $fecha_modificacion = $row['fecha_modificacion'];

    echo "<tr>";
    echo "<td>$producto</td>";
    echo "<td>$stock_anterior</td>";
    echo "<td>$stock_nuevo</td>";
    echo "<td>$fecha_modificacion</td>";
    echo "</tr>";
}

echo "</table>"; 
?>
<br><br><br><br>
<!-- // Cerrar la conexión a la base de datos -->


