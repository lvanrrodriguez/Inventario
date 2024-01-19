<?php
// Conexión a la base de datos
$conn = mysqli_connect("localhost", "root", "", "ControlStock");

// Verificar la conexión
if (!$conn) {
    die("Conexión fallida: " . mysqli_connect_error());
}

// Obtener el ID del producto a eliminar
$id = $_POST['borrar'];

// Consulta para obtener los datos del producto a eliminar
$sql_select_producto = "SELECT * FROM productos WHERE id='$id'";
$result = mysqli_query($conn, $sql_select_producto);
$row = mysqli_fetch_assoc($result);
$producto_eliminado = $row['producto'];
$stock_eliminado = $row['stock'];

// Consulta para eliminar el producto de la tabla 'productos'
$sql_delete_producto = "DELETE FROM productos WHERE id='$id'";

// Consulta para insertar el producto eliminado en la tabla 'historial_eliminados'
$sql_insert_historial_eliminados = "INSERT INTO historial_eliminados (producto, stock) VALUES ('$producto_eliminado', '$stock_eliminado')";

// Ejecutar ambas consultas
if (mysqli_query($conn, $sql_delete_producto) && mysqli_query($conn, $sql_insert_historial_eliminados)) {
    echo "Producto eliminado correctamente.";

    // Redireccionar al usuario a la página principal u otra ubicación después de eliminar el producto
    header("Location: index.php");
    exit();
} else {
    echo "Error al eliminar el producto: " . mysqli_error($conn);
}

// Cerrar la conexión a la base de datos
mysqli_close($conn);
?>
