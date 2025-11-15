<?php
require_once __DIR__ . '/../config/db.php';

class InventarioModel {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    /* ========== SELECT ========== */

    // Lista de inventario con JOIN (producto + proveedor + datos extra para edición)
    public function obtenerInventario() {
        $sql = "SELECT 
                    i.id,
                    i.id_producto,
                    p.nombre AS producto,
                    p.precio,
                    pr.id AS id_proveedor,
                    pr.nombre AS proveedor,
                    pr.telefono,
                    pr.email,
                    i.cantidad
                FROM inventarios i
                INNER JOIN productos p ON i.id_producto = p.id
                INNER JOIN proveedores pr ON p.id_proveedor = pr.id
                ORDER BY i.id DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Para llenar <select> de productos
    public function obtenerProductos() {
        $sql = "SELECT p.id, p.nombre FROM productos p ORDER BY p.nombre ASC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Para llenar <select> de proveedores
    public function obtenerProveedores() {
        $sql = "SELECT id, nombre FROM proveedores ORDER BY nombre ASC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /* ========== INSERT ========== */

    public function insertarProveedor($nombre, $telefono, $email) {
        $sql = "INSERT INTO proveedores (nombre, telefono, email)
                VALUES (:nombre, :telefono, :email)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':nombre'   => $nombre,
            ':telefono' => $telefono,
            ':email'    => $email
        ]);
    }

    public function insertarProducto($nombre, $precio, $id_proveedor) {
        $sql = "INSERT INTO productos (nombre, precio, id_proveedor)
                VALUES (:nombre, :precio, :id_proveedor)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':nombre'       => $nombre,
            ':precio'       => $precio,
            ':id_proveedor' => $id_proveedor
        ]);
    }

    public function insertarInventario($id_producto, $cantidad) {
        $sql = "INSERT INTO inventarios (id_producto, cantidad)
                VALUES (:id_producto, :cantidad)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':id_producto' => $id_producto,
            ':cantidad'    => $cantidad
        ]);
    }

    /* ========== UPDATE (para edición) ========== */

    public function actualizarProveedor($id, $nombre, $telefono, $email) {
        $sql = "UPDATE proveedores
                SET nombre = :nombre,
                    telefono = :telefono,
                    email = :email
                WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':nombre'   => $nombre,
            ':telefono' => $telefono,
            ':email'    => $email,
            ':id'       => $id
        ]);
    }

    public function actualizarProducto($id, $nombre, $precio, $id_proveedor) {
        $sql = "UPDATE productos
                SET nombre = :nombre,
                    precio = :precio,
                    id_proveedor = :id_proveedor
                WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':nombre'       => $nombre,
            ':precio'       => $precio,
            ':id_proveedor' => $id_proveedor,
            ':id'           => $id
        ]);
    }

    public function actualizarInventario($id, $id_producto, $cantidad) {
        $sql = "UPDATE inventarios
                SET id_producto = :id_producto,
                    cantidad = :cantidad
                WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':id_producto' => $id_producto,
            ':cantidad'    => $cantidad,
            ':id'          => $id
        ]);
    }

    /* ========== DELETE ========== */

    public function eliminarInventario($id) {
        $sql = "DELETE FROM inventarios WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
}