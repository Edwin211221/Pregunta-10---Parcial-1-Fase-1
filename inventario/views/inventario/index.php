<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Sistema de Inventario de Productos y Proveedores</title>

    <!-- Fuente moderna -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- CSS externo (ruta absoluta desde http://localhost/inventario/) -->
    <link rel="stylesheet" href="/inventario/views/inventario/assets/css/style.css">

    <!-- JS externo -->
    <script src="/inventario/views/inventario/assets/js/script.js" defer></script>
</head>
<body>

<div class="layout">
    <!-- SIDEBAR -->
    <aside class="sidebar">
        <div class="sidebar-header">
            <div class="sidebar-logo">
                <img src="/inventario/views/inventario/assets/img/Bat_Logo.png" alt="Bat logo">
            </div>
            <div class="sidebar-title-block">
                <div class="sidebar-title">BatInventory</div>
                <div class="sidebar-subtitle">Control de Stock</div>
            </div>
        </div>

        <nav class="sidebar-nav">
            <div class="sidebar-section-title">Panel</div>

            <div class="nav-item active">
                <svg viewBox="0 0 24 24" fill="none">
                    <path d="M4 12.75V5.5C4 4.67 4.67 4 5.5 4H10"
                          stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                    <path d="M20 11.25V18.5C20 19.33 19.33 20 18.5 20H9"
                          stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                    <rect x="10" y="4" width="10" height="7.5" rx="1.5"
                          stroke="currentColor" stroke-width="1.5"/>
                    <rect x="4" y="12.5" width="9" height="7.5" rx="1.5"
                          stroke="currentColor" stroke-width="1.5"/>
                </svg>
                <span>Inventario</span>
            </div>

            <div class="nav-item">
                <svg viewBox="0 0 24 24" fill="none">
                    <path d="M5 19V7.5C5 6.67 5.67 6 6.5 6H14"
                          stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                    <path d="M10 18H17.5C18.33 18 19 17.33 19 16.5V9"
                          stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                    <rect x="10" y="4" width="9" height="4" rx="1"
                          stroke="currentColor" stroke-width="1.5"/>
                    <rect x="5" y="14" width="7" height="4" rx="1"
                          stroke="currentColor" stroke-width="1.5"/>
                </svg>
                <span>Productos</span>
            </div>

            <div class="nav-item">
                <svg viewBox="0 0 24 24" fill="none">
                    <path d="M6.5 7.5C6.5 5.57 8.02 4 10 4C11.98 4 13.5 5.57 13.5 7.5C13.5 9.43 11.98 11 10 11C8.02 11 6.5 9.43 6.5 7.5Z"
                          stroke="currentColor" stroke-width="1.5"/>
                    <path d="M4 19.25C4 16.9 6.01 15 8.5 15H11.5C14 15 16 16.9 16 19.25"
                          stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                    <path d="M16.5 4.75H20" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                    <path d="M18.25 3V6.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                </svg>
                <span>Proveedores</span>
            </div>
        </nav>

        <div class="sidebar-footer">
            Modo vigilante activado 🦇
        </div>
    </aside>

    <!-- MAIN -->
    <div class="main">
        <header class="topbar">
            <div class="topbar-title-block">
                <div class="topbar-title">Sistema de Inventario</div>
                <div class="topbar-subtitle">Productos y proveedores vinculados en tiempo real</div>
            </div>
            <div class="topbar-right">
                <div class="badge-pills">
                    MVC · PHP · MySQL
                </div>
                <div class="avatar">
                    E
                </div>
            </div>
        </header>

        <section class="content">
            <div class="card-main">
                <div class="card-main-header">
                    <div>
                        <h2>Inventario actual</h2>
                        <span>Busca, selecciona y edita cualquier producto de tu bodega Wayne.</span>
                    </div>
                </div>

                <div class="buscador">
                    <label for="buscar">Buscar producto o proveedor:</label>
                    <input type="text" id="buscar" placeholder="Escribe para filtrar...">
                </div>

                <div class="dashboard-grid">
                    <!-- TABLA -->
                    <div>
                        <table>
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Producto</th>
                                <th>Proveedor</th>
                                <th>Precio (USD)</th>
                                <th>Cantidad</th>
                                <th>Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if (!empty($inventario)): ?>
                                <?php foreach ($inventario as $item): ?>
                                    <?php $agotado = ($item['cantidad'] <= 0); ?>
                                    <tr
                                        class="<?php echo $agotado ? 'agotado' : ''; ?>"
                                        data-id-inventario="<?php echo $item['id']; ?>"
                                        data-id-producto="<?php echo $item['id_producto']; ?>"
                                        data-id-proveedor="<?php echo $item['id_proveedor']; ?>"
                                        data-nombre-producto="<?php echo htmlspecialchars($item['producto'], ENT_QUOTES, 'UTF-8'); ?>"
                                        data-precio-producto="<?php echo $item['precio']; ?>"
                                        data-cantidad="<?php echo $item['cantidad']; ?>"
                                        data-nombre-proveedor="<?php echo htmlspecialchars($item['proveedor'], ENT_QUOTES, 'UTF-8'); ?>"
                                        data-telefono-proveedor="<?php echo htmlspecialchars($item['telefono']); ?>"
                                        data-email-proveedor="<?php echo htmlspecialchars($item['email']); ?>"
                                    >
                                        <td><?php echo htmlspecialchars($item['id']); ?></td>
                                        <td><?php echo htmlspecialchars($item['producto']); ?></td>
                                        <td><?php echo htmlspecialchars($item['proveedor']); ?></td>
                                        <td><?php echo number_format($item['precio'], 2); ?></td>
                                        <td>
                                            <?php
                                            if ($agotado) {
                                                echo '0 (agotado)';
                                            } else {
                                                echo htmlspecialchars($item['cantidad']);
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <a href="javascript:void(0);"
                                               class="eliminar"
                                               onclick="confirmarEliminar(<?php echo $item['id']; ?>)">
                                                Eliminar
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6">No hay registros de inventario.</td>
                                </tr>
                            <?php endif; ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- FORMULARIOS -->
                    <div class="forms-column">
                        <!-- Proveedor -->
                        <form method="post">
                            <div class="form-header">
                                <div class="form-title-group">
                                    <span class="badge badge-proveedor">Proveedor</span>
                                    <span class="form-title">Gestión de proveedores</span>
                                </div>
                            </div>

                            <input type="hidden" name="id_proveedor_editar" id="id_proveedor_editar">

                            <label>Nombre del proveedor:</label>
                            <input type="text" name="nombre_proveedor" required>

                            <label>Teléfono:</label>
                            <input type="text" name="telefono_proveedor">

                            <label>Correo:</label>
                            <input type="email" name="email_proveedor">

                            <div class="buttons-row">
                                <button type="submit" name="accion" value="agregar_proveedor" class="btn-primary">
                                    Agregar proveedor
                                </button>
                                <button type="submit" id="btn_editar_proveedor"
                                        name="accion" value="editar_proveedor"
                                        class="btn-editar" style="display:none;">
                                    Editar proveedor
                                </button>
                            </div>
                        </form>

                        <!-- Producto -->
                        <form method="post">
                            <div class="form-header">
                                <div class="form-title-group">
                                    <span class="badge badge-producto">Producto</span>
                                    <span class="form-title">Datos del producto</span>
                                </div>
                            </div>

                            <input type="hidden" name="id_producto_editar" id="id_producto_editar">

                            <label>Nombre del producto:</label>
                            <input type="text" name="nombre_producto" required>

                            <label>Precio:</label>
                            <input type="number" step="0.01" name="precio_producto" required>

                            <label>Proveedor:</label>
                            <select name="id_proveedor_producto" required>
                                <option value="">Seleccione un proveedor</option>
                                <?php foreach ($proveedores as $prov): ?>
                                    <option value="<?php echo $prov['id']; ?>">
                                        <?php echo htmlspecialchars($prov['nombre']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>

                            <div class="buttons-row">
                                <button type="submit" name="accion" value="agregar_producto" class="btn-primary">
                                    Agregar producto
                                </button>
                                <button type="submit" id="btn_editar_producto"
                                        name="accion" value="editar_producto"
                                        class="btn-editar" style="display:none;">
                                    Editar producto
                                </button>
                            </div>
                        </form>

                        <!-- Inventario -->
                        <form method="post">
                            <div class="form-header">
                                <div class="form-title-group">
                                    <span class="badge badge-inventario">Inventario</span>
                                    <span class="form-title">Existencias por producto</span>
                                </div>
                            </div>

                            <input type="hidden" name="id_inventario_editar" id="id_inventario_editar">

                            <label>Producto:</label>
                            <select name="id_producto_inventario" required>
                                <option value="">Seleccione un producto</option>
                                <?php foreach ($productos as $prod): ?>
                                    <option value="<?php echo $prod['id']; ?>">
                                        <?php echo htmlspecialchars($prod['nombre']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>

                            <label>Cantidad:</label>
                            <input type="number" name="cantidad_inventario" required>

                            <div class="helper-text">
                                Si la cantidad llega a 0, el producto se marcará como agotado.
                            </div>

                            <div class="buttons-row">
                                <button type="submit" name="accion" value="agregar_inventario" class="btn-primary">
                                    Agregar al inventario
                                </button>
                                <button type="submit" id="btn_editar_inventario"
                                        name="accion" value="editar_inventario"
                                        class="btn-editar" style="display:none;">
                                    Editar inventario
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

</body>
</html>