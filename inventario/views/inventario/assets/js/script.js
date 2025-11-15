function confirmarEliminar(id) {
    if (confirm("¿Seguro que deseas eliminar este registro de inventario?")) {
        window.location.href = "?eliminar=" + id;
    }
}

document.addEventListener('DOMContentLoaded', function () {
    const inputBuscar = document.getElementById('buscar');
    const filas = document.querySelectorAll('table tbody tr');

    // --- Filtro por texto ---
    if (inputBuscar) {
        inputBuscar.addEventListener('keyup', function () {
            const filtro = inputBuscar.value.toLowerCase();

            filas.forEach(function (fila) {
                const textoProducto  = fila.cells[1].textContent.toLowerCase();
                const textoProveedor = fila.cells[2].textContent.toLowerCase();

                if (
                    textoProducto.includes(filtro) ||
                    textoProveedor.includes(filtro)
                ) {
                    fila.style.display = '';
                } else {
                    fila.style.display = 'none';
                }
            });
        });
    }

    // --- Selección de fila y autollenado de formularios ---
    filas.forEach(function (fila) {
        fila.addEventListener('click', function () {
            filas.forEach(f => f.classList.remove('seleccionado'));
            this.classList.add('seleccionado');

            const idInventario = this.dataset.idInventario;
            const idProducto   = this.dataset.idProducto;
            const idProveedor  = this.dataset.idProveedor;

            const nombreProducto = this.dataset.nombreProducto || '';
            const precioProducto = this.dataset.precioProducto || '';
            const cantidad       = this.dataset.cantidad || '';

            const nombreProveedor = this.dataset.nombreProveedor || '';
            const telProveedor    = this.dataset.telefonoProveedor || '';
            const emailProveedor  = this.dataset.emailProveedor || '';

            // --- Formulario proveedor ---
            const inputNomProv = document.querySelector('input[name="nombre_proveedor"]');
            const inputTelProv = document.querySelector('input[name="telefono_proveedor"]');
            const inputMailProv = document.querySelector('input[name="email_proveedor"]');
            const hiddenProv   = document.getElementById('id_proveedor_editar');
            const btnEditProv  = document.getElementById('btn_editar_proveedor');

            if (inputNomProv && hiddenProv) {
                inputNomProv.value = nombreProveedor;
                if (inputTelProv) inputTelProv.value = telProveedor;
                if (inputMailProv) inputMailProv.value = emailProveedor;
                hiddenProv.value = idProveedor || '';
                if (btnEditProv) btnEditProv.style.display = 'inline-flex';
            }

            // --- Formulario producto ---
            const inputNomProd = document.querySelector('input[name="nombre_producto"]');
            const inputPrecioProd = document.querySelector('input[name="precio_producto"]');
            const selectProvProd = document.querySelector('select[name="id_proveedor_producto"]');
            const hiddenProd   = document.getElementById('id_producto_editar');
            const btnEditProd  = document.getElementById('btn_editar_producto');

            if (inputNomProd && hiddenProd) {
                inputNomProd.value = nombreProducto;
                if (inputPrecioProd) inputPrecioProd.value = precioProducto;
                if (selectProvProd && idProveedor) {
                    selectProvProd.value = idProveedor;
                }
                hiddenProd.value = idProducto || '';
                if (btnEditProd) btnEditProd.style.display = 'inline-flex';
            }

            // --- Formulario inventario ---
            const selectProdInv = document.querySelector('select[name="id_producto_inventario"]');
            const inputCantInv  = document.querySelector('input[name="cantidad_inventario"]');
            const hiddenInv     = document.getElementById('id_inventario_editar');
            const btnEditInv    = document.getElementById('btn_editar_inventario');

            if (selectProdInv && inputCantInv && hiddenInv) {
                selectProdInv.value = idProducto || '';
                inputCantInv.value  = cantidad;
                hiddenInv.value     = idInventario || '';
                if (btnEditInv) btnEditInv.style.display = 'inline-flex';
            }
        });
    });
});