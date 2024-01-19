<!DOCTYPE html>
<html>
<head>
  <title>Inventario</title>
  <link rel="stylesheet" type="text/css" href="styles.css">
  <link rel="stylesheet" type="text/css" href="Scrollbar.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@700&display=swap" rel="stylesheet">
  <script src="filtrador.js"></script>
  <link href="fontawesome/fontawesome-free-6.4.0-web/css/all.css" rel="stylesheet">
  <link rel="stylesheet" href="responsive.css">
</head>

<body>
<h1></h1><br>
  <h1 class="titulo">Inventario</h1> <br><br><br>
  <form method="post" action="agregar_producto.php">
    <div class="agregar_productos"><label for="producto">Producto:</label>
    <input class="imputs_para_agregar_productos" type="text" name="producto" id="producto" name="nombre_producto" required>
    <label for="stock">Stock:</label></div>
    <input class="imputs_para_agregar_productos" type="number" name="stock" id="stock" required>
    <button class="boton1" type="submit">Agregar</button>
  </form>
<!-- Buscador de productos -->
  <div class="buscador">
    <form method="GET" action="index.php">
      <input type="text" name="busqueda" id="busqueda" placeholder="Buscar producto" value="<?php echo isset($_GET['busqueda']) ? $_GET['busqueda'] : '' ?>">
      <button type="submit">🔍︎</button>
    </form>
  </div>
<!--  filtra los productos en todos los productos,bajo stock y stock suficiente -->
<nav class="filtrador">
  <ul>
    <li class="LI_detodoslosproductos"><a href="#" onclick="mostrarTodos()" class="todoslosproductos">Todos los productos</a></li>
    <li class="dropdown">
      <a href="#" class="filtrostockss">Filtrar por stock</a>
      <ul class="dropdown-menu">
        <li><a href="#" class="filtrostocks" onclick="mostrarMenosDe10()">Stock bajo</a></li>
        <li><a href="#" class="filtrostocks" onclick="mostrarConStock()">Stock suficiente</a></li>
      </ul>
    </li>
  </ul>
</nav>

<a href="historial_inventario.php" class="historial">Historial del inventario</a>

  <br><br><br>

  <div class="columas" id="contenedorresultados">
    <table id="resultados">
      <thead>
        <tr>
          <th>ID</th>
          <th>Producto</th>
          <th>Stock</th>
          <th class="columna_icono_borrarElemento">xxx</th>
        </tr>
      </thead>
      <tbody>
        <?php
          // Conexión a la base de datos
          $conn = mysqli_connect("localhost", "root", "", "ControlStock");

          // Verificar la conexión
          if(!$conn){
              die("Conexión fallida: " . mysqli_connect_error());
          }
          
          // Consulta para obtener los productos filtrados si hay una búsqueda en el input
          if(isset($_GET['busqueda']) && !empty($_GET['busqueda'])){
            $busqueda = $_GET['busqueda'];
            $sql = "SELECT * FROM productos WHERE producto LIKE '%$busqueda%'";
          }else{
            // Consulta para obtener todos los productos
            $sql = "SELECT * FROM productos";
          }
          
          $result = mysqli_query($conn, $sql);

          // Mostrar cada producto en la tabla
          while ($row = mysqli_fetch_assoc($result)) {
            $id = $row["id"];
            $producto = $row["producto"];
            $stock = $row["stock"];
            $class = $stock < 10 ? "low-stock" : "suficiente-stock"; 

            // Mostrar el producto, el stock y un enlace para modificar el stock
            echo "<tr class='$class'>";
            echo "<td>$id</td>";
            echo "<td>$producto</td>";
            echo "<td>";
            echo "<form method='post' action='guardar_stock.php'>";
            echo "<input type='hidden' name='id' value='$id'>";
            echo "<input class='center' type='number' name='stock' value='$stock' required>";
            echo "<button class='boton-modificar' type='submit'>Modificar</button>";
            echo "</form>";
            echo "</td>";
            echo "<td class='iconoborrarelemento'>";
            echo "<form method='post' action='eliminar_producto.php'>";
            echo "<button type='submit' name='borrar' value='$id' class='boton-borrar'  onclick='return confirm(\"¿Estás seguro de que deseas eliminar este producto?\")'><i class='fas fa-trash' style='color: red; font-size: 18px;'></i></button>";
            echo "</form>";            
           echo "</td>";
           echo "</tr>"; 
          }

          // Cerrar la conexión a la base de datos
          mysqli_close($conn);
        ?>
      </tbody>
    </table>
  </div>
  <br> <br> <br> <br>

