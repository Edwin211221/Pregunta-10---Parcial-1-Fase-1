<?php
require_once __DIR__ . '/../models/InventarioModel.php';

class InventarioController {
    private $model;

    public function __construct() {
        $this->model = new InventarioModel();
    }

    public function index() {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $accion = $_POST['accion'] ?? '';

            switch ($accion) {
                /* ===== INSERTAR ===== */
                case 'agregar_proveedor':
                    $this->model->insertarProveedor(
                        $_POST['nombre_proveedor'],
                        $_POST['telefono_proveedor'],
                        $_POST['email_proveedor']
                    );
                    break;

                case 'agregar_producto':
                    // Precio no negativo
                    $precio = floatval($_POST['precio_producto']);
                    if ($precio < 0) {
                        $precio = 0;
                    }
                    $this->model->insertarProducto(
                        $_POST['nombre_producto'],
                        $precio,
                        $_POST['id_proveedor_producto']
                    );
                    break;

                case 'agregar_inventario':
                    // Cantidad no negativa
                    $cantidad = intval($_POST['cantidad_inventario']);
                    if ($cantidad < 0) {
                        $cantidad = 0;
                    }
                    $this->model->insertarInventario(
                        $_POST['id_producto_inventario'],
                        $cantidad
                    );
                    break;

                /* ===== EDITAR ===== */
                case 'editar_proveedor':
                    $idProv = isset($_POST['id_proveedor_editar']) ? (int)$_POST['id_proveedor_editar'] : 0;
                    if ($idProv > 0) {
                        $this->model->actualizarProveedor(
                            $idProv,
                            $_POST['nombre_proveedor'],
                            $_POST['telefono_proveedor'],
                            $_POST['email_proveedor']
                        );
                    }
                    break;

                case 'editar_producto':
                    $idProd = isset($_POST['id_producto_editar']) ? (int)$_POST['id_producto_editar'] : 0;
                    if ($idProd > 0) {
                        // Precio no negativo
                        $precio = floatval($_POST['precio_producto']);
                        if ($precio < 0) {
                            $precio = 0;
                        }
                        $this->model->actualizarProducto(
                            $idProd,
                            $_POST['nombre_producto'],
                            $precio,
                            $_POST['id_proveedor_producto']
                        );
                    }
                    break;

                case 'editar_inventario':
                    $idInv = isset($_POST['id_inventario_editar']) ? (int)$_POST['id_inventario_editar'] : 0;
                    $cantidad = intval($_POST['cantidad_inventario']);
                    if ($cantidad < 0) {
                        $cantidad = 0; // nunca negativo
                    }
                    if ($idInv > 0) {
                        $this->model->actualizarInventario(
                            $idInv,
                            $_POST['id_producto_inventario'],
                            $cantidad
                        );
                    }
                    break;
            }
        }

        if (isset($_GET['eliminar']) && is_numeric($_GET['eliminar'])) {
            $this->model->eliminarInventario($_GET['eliminar']);
        }

        // SELECT para la vista
        $inventario  = $this->model->obtenerInventario();
        $productos   = $this->model->obtenerProductos();
        $proveedores = $this->model->obtenerProveedores();

        require __DIR__ . '/../views/inventario/index.php';
    }
}