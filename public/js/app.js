document.addEventListener('DOMContentLoaded', function () {
    const productTableBody = document.getElementById('productTableBody');
    const categoryFilter = document.getElementById('categoryFilter');
    const statusFilter = document.getElementById('statusFilter');
    const pagination = document.getElementById('pagination');
    const categorySelect = document.getElementById('productCategory');

    let currentPage = 1;
    let totalPages = 1;

    // Cargar categorías para el filtro y el formulario
    fetch('/api/categories')
        .then(response => response.json())
        .then(data => {
            // Para el filtro de categorías
            data.forEach(category => {
                const optionFilter = document.createElement('option');
                optionFilter.value = category.id;
                optionFilter.textContent = category.name;
                categoryFilter.appendChild(optionFilter);
            });

            // Para el select del formulario
            categorySelect.innerHTML = '<option value="">Seleccione una categoría</option>';
            data.forEach(category => {
                const optionForm = document.createElement('option');
                optionForm.value = category.id;
                optionForm.textContent = category.name;
                categorySelect.appendChild(optionForm);
            });
        })
        .catch(error => console.error('Error al cargar las categorías:', error));

    // Cargar productos
    function loadProducts(page = 1, categoryId = '', status = '') {
        let url = `/api/products?page=${page}`;
        if (categoryId) url += `&category_id=${categoryId}`;
        if (status) url += `&active=${status}`;

        fetch(url)
            .then(response => response.json())
            .then(data => {
                productTableBody.innerHTML = '';
                data.data.forEach(product => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${product.name}</td>
                        <td>${product.price}</td>
                        <td>${product.stock}</td>
                        <td>${product.category?.name || 'Sin categoría'}</td>
                        <td>
                            <input type="checkbox" ${product.active ? 'checked' : ''} 
                                   onchange="toggleProductStatus(${product.id}, this.checked)">
                            ${product.active ? 'Activo' : 'Inactivo'}
                        </td>
                        <td>
                            <button class="btn btn-danger btn-sm" onclick="deleteProduct(${product.id})">Eliminar</button>
                        </td>
                    `;
                    productTableBody.appendChild(row);
                });

                totalPages = data.last_page;
                updatePagination();
            })
            .catch(error => console.error('Error al cargar productos:', error));
    }

    // Cambiar estado del producto
    window.toggleProductStatus = function (productId, active) {
        fetch(`/api/products/${productId}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ active: active }),
        })
            .then(response => response.json())
            .then(() => {
                loadProducts(currentPage, categoryFilter.value, statusFilter.value);
            })
            .catch(error => console.error('Error al cambiar el estado:', error));
    };

    // Eliminar producto
    window.deleteProduct = function (productId) {
        if (confirm('¿Estás seguro de eliminar este producto?')) {
            fetch(`/api/products/${productId}`, { method: 'DELETE' })
                .then(response => {
                    if (response.ok) {
                        loadProducts(currentPage, categoryFilter.value, statusFilter.value);
                    }
                })
                .catch(error => console.error('Error al eliminar producto:', error));
        }
    };

    // Actualizar paginación
    function updatePagination() {
        pagination.innerHTML = '';
        for (let i = 1; i <= totalPages; i++) {
            const li = document.createElement('li');
            li.className = `page-item ${i === currentPage ? 'active' : ''}`;
            li.innerHTML = `<a class="page-link" href="#" onclick="changePage(${i})">${i}</a>`;
            pagination.appendChild(li);
        }
    }

    // Cambiar de página
    window.changePage = function (page) {
        currentPage = page;
        loadProducts(page, categoryFilter.value, statusFilter.value);
    };

    // Aplicar filtros
    categoryFilter.addEventListener('change', () => loadProducts(1, categoryFilter.value, statusFilter.value));
    statusFilter.addEventListener('change', () => loadProducts(1, categoryFilter.value, statusFilter.value));

    // Listener para el formulario de agregar producto
    document.getElementById('addProductForm').addEventListener('submit', function (event) {
        event.preventDefault();

        const name = document.getElementById('productName').value;
        const price = parseFloat(document.getElementById('productPrice').value);
        const stock = parseInt(document.getElementById('productStock').value);
        const categoryId = categorySelect.value;

        // Validaciones
        if (!name || price <= 0 || stock < 0 || !categoryId) {
            alert('Por favor, complete todos los campos correctamente.');
            return;
        }

        // Enviar datos a la API
        fetch('/api/products', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ 
                name: name, 
                price: price, 
                stock: stock, 
                category_id: categoryId, 
                active: true 
            }),
        })
            .then(response => response.json())
            .then(() => {
                alert('Producto agregado correctamente.');
                loadProducts(currentPage, categoryFilter.value, statusFilter.value);
            })
            .catch(error => {
                console.error('Error al agregar el producto:', error);
                alert('Hubo un error al agregar el producto.');
            });
    });

    // Cargar productos iniciales
    loadProducts();
});
