<?php
// Verificar si se han recibido las variables 'id' y 'stock'
if (isset($_POST['id']) && isset($_POST['stock'])) {
    $id = $_POST['id'];
    $stock = $_POST['stock'];

    // Conexión a la base de datos
    $conn = mysqli_connect('localhost', 'root', '', 'ControlStock');

    // Verificar la conexión
    if (!$conn) {
        die("Conexión fallida: " . mysqli_connect_error());
    }

    // Obtener los datos necesarios del producto
    $producto = obtenerNombreDelProducto($id);
    $stock_anterior = obtenerStockAnteriorDelProducto($id);

    // Consulta para actualizar el stock del producto en la tabla 'productos'
    $sql = "UPDATE productos SET stock='$stock' WHERE id='$id'";

    // Ejecutar la consulta y verificar si se ha actualizado correctamente
    if (mysqli_query($conn, $sql)) {
        echo "El stock ha sido actualizado correctamente.";

        // Consulta para insertar el registro en la tabla 'historial'
        $sqlHistorial = "INSERT INTO historial (producto, stock_anterior, stock_nuevo)
                        VALUES ('$producto', '$stock_anterior', '$stock')";

        // Ejecutar la consulta de historial
        if (mysqli_query($conn, $sqlHistorial)) {
            echo "Historial actualizado correctamente.";
        } else {
            echo "Error al actualizar el historial: " . mysqli_error($conn);
        }
    } else {
        echo "Error al actualizar el stock: " . mysqli_error($conn);
    }

    // Cerrar la conexión a la base de datos
    mysqli_close($conn);
} else {
    echo "No se han recibido las variables 'id' y 'stock'";
}

header("Location: index.php");
?>

<?php
// Función para obtener el nombre del producto por su ID
function obtenerNombreDelProducto($id) {
    // Conexión a la base de datos
    $conn = mysqli_connect('localhost', 'root', '', 'ControlStock');

    // Verificar la conexión
    if (!$conn) {
        die("Conexión fallida: " . mysqli_connect_error());
    }

    // Consulta para obtener el nombre del producto por su ID
    $sql = "SELECT producto FROM productos WHERE id='$id'";
    $result = mysqli_query($conn, $sql);

    // Verificar si se encontró el producto
    if ($row = mysqli_fetch_assoc($result)) {
        $nombreProducto = $row['producto'];
        return $nombreProducto;
    }

    // Cerrar la conexión a la base de datos
    mysqli_close($conn);
}

// Función para obtener el stock anterior del producto por su ID
function obtenerStockAnteriorDelProducto($id) {
    // Conexión a la base de datos
    $conn = mysqli_connect('localhost', 'root', '', 'ControlStock');

    // Verificar la conexión
    if (!$conn) {
        die("Conexión fallida: " . mysqli_connect_error());
    }

    // Consulta para obtener el stock anterior del producto por su ID
    $sql = "SELECT stock FROM productos WHERE id='$id'";
    $result = mysqli_query($conn, $sql);

    // Verificar si se encontró el stock anterior
    if ($row = mysqli_fetch_assoc($result)) {
        $stockAnterior = $row['stock'];
        return $stockAnterior;
    }
 
    // Cerrar la conexión a la base de datos
    mysqli_close($conn);
}
?>























































