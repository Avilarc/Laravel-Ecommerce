<h1>🛒 API RESTful E-Commerce con Laravel</h1>

<p>Este proyecto implementa una API RESTful para gestionar productos y categorías en un ecommerce B2C, utilizando Laravel como framework de backend y una interfaz frontend básica con HTML, JavaScript y Bootstrap.</p>

<blockquote>
    <strong>💡 Tip:</strong> Si trabajas en Linux, puedes ejecutar directamente el script <code>deploy.sh</code> para automatizar el proceso de instalación y configuración.
</blockquote>

<hr/>

<h2>⚙️ Requisitos previos</h2>
<ul>
    <li><strong>PHP 8.x</strong></li>
    <li><strong>Composer</strong> (gestor de dependencias de PHP)</li>
    <li><strong>MySQL</strong> (o tu base de datos preferida configurada en el <code>.env</code>)</li>
    <li><strong>Node.js y npm</strong> *(opcional para dependencias del frontend)*</li>
</ul>

<hr/>

<h2>🚀 Pasos de instalación y configuración</h2>

<h3>1️⃣ Clonar el repositorio</h3>
<pre><code>git clone https://github.com/tuusuario/tu-repo.git
cd tu-repo
</code></pre>

<h3>2️⃣ Ejecutar el script de despliegue (Linux)</h3>
<pre><code>./deploy.sh</code></pre>

<blockquote>
    <p><strong>Este script realizará automáticamente las siguientes tareas:</strong></p>
    <ul>
        <li>Instalar dependencias con Composer</li>
        <li>Configurar el archivo <code>.env</code></li>
        <li>Ejecutar migraciones y seeders</li>
        <li>Iniciar el servidor Laravel</li>
        <li>Ajustar permisos necesarios</li>
    </ul>
</blockquote>

<h3>3️⃣ Instalación manual (alternativa)</h3>

<h4>➤ Instalar dependencias</h4>
<pre><code>composer install</code></pre>

<h4>➤ Configurar el archivo <code>.env</code></h4>
<pre><code>cp .env.example .env</code></pre>
<p>Edita el archivo <code>.env</code> con tu configuración de base de datos.</p>

<h4>➤ Generar la clave de aplicación</h4>
<pre><code>php artisan key:generate</code></pre>

<h4>➤ Crear las tablas de la base de datos</h4>
<pre><code>php artisan migrate</code></pre>

<h4>➤ Poblar la base de datos con datos de prueba</h4>
<pre><code>php artisan db:seed</code></pre>

<h4>➤ Iniciar el servidor</h4>
<pre><code>php artisan serve</code></pre>

<hr/>

<h2>🛠️ Endpoints disponibles</h2>

<h3>📂 Categorías</h3>
<table border="1" cellspacing="0" cellpadding="5">
    <thead>
        <tr>
            <th>Método</th>
            <th>Endpoint</th>
            <th>Descripción</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>GET</td>
            <td>/api/categories</td>
            <td>Listar todas las categorías</td>
        </tr>
        <tr>
            <td>POST</td>
            <td>/api/categories</td>
            <td>Crear una nueva categoría</td>
        </tr>
        <tr>
            <td>PUT</td>
            <td>/api/categories/{id}</td>
            <td>Actualizar una categoría</td>
        </tr>
        <tr>
            <td>DELETE</td>
            <td>/api/categories/{id}</td>
            <td>Eliminar una categoría</td>
        </tr>
    </tbody>
</table>

<p><strong>📑 Ejemplo (POST):</strong></p>
<pre><code>{
    "name": "Electrónica"
}</code></pre>

<h3>📦 Productos</h3>
<table border="1" cellspacing="0" cellpadding="5">
    <thead>
        <tr>
            <th>Método</th>
            <th>Endpoint</th>
            <th>Descripción</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>GET</td>
            <td>/api/products</td>
            <td>Listar productos (paginación y filtros)</td>
        </tr>
        <tr>
            <td>POST</td>
            <td>/api/products</td>
            <td>Crear un nuevo producto</td>
        </tr>
        <tr>
            <td>PUT</td>
            <td>/api/products/{id}</td>
            <td>Actualizar un producto</td>
        </tr>
        <tr>
            <td>DELETE</td>
            <td>/api/products/{id}</td>
            <td>Eliminar un producto</td>
        </tr>
    </tbody>
</table>

<p><strong>📑 Ejemplo (POST):</strong></p>
<pre><code>{
    "name": "Laptop Gamer",
    "price": 1500.99,
    "stock": 10,
    "active": true,
    "category_id": 1
}</code></pre>

<h3>🖼️ Imágenes de Productos</h3>
<table border="1" cellspacing="0" cellpadding="5">
    <thead>
        <tr>
            <th>Método</th>
            <th>Endpoint</th>
            <th>Descripción</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>POST</td>
            <td>/api/products/{id}/images</td>
            <td>Agregar una imagen al producto</td>
        </tr>
        <tr>
            <td>DELETE</td>
            <td>/api/products/{id}/images/{image_id}</td>
            <td>Eliminar una imagen</td>
        </tr>
    </tbody>
</table>

<p><strong>📑 Ejemplo (POST):</strong></p>
<pre><code>{
    "url": "https://example.com/images/product1.png"
}</code></pre>

<hr/>

<h2>✅ Validaciones implementadas</h2>
<ul>
    <li><strong>Categorías:</strong> <code>name</code>: Obligatorio, único.</li>
    <li><strong>Productos:</strong> 
        <ul>
            <li><code>name</code>: Obligatorio</li>
            <li><code>price</code>: Decimal, mayor a 0</li>
            <li><code>stock</code>: Entero, mayor o igual a 0</li>
            <li><code>category_id</code>: Debe existir en la tabla <code>categories</code></li>
        </ul>
    </li>
    <li><strong>Imágenes:</strong> <code>url</code>: Obligatorio.</li>
</ul>

<hr/>

<h2>🌐 Interfaz Frontend</h2>
<p>La aplicación incluye una vista simple con las siguientes funcionalidades:</p>
<ul>
    <li>Listar productos en una tabla.</li>
    <li>Filtros por categoría y estado.</li>
    <li>Paginación (cada 10 productos).</li>
    <li>Formulario para crear productos con validación en tiempo real.</li>
    <li>Checkbox para activar/desactivar productos directamente desde la lista.</li>
</ul>

<p><strong>🔍 Acceso:</strong> Abre el archivo <code>index.html</code> en tu navegador o accede a <a href="http://localhost:8000">http://localhost:8000</a>.</p>

<hr/>

<h2>🔍 Consultas y ejemplos con <code>curl</code></h2>

<h3>Obtener todas las categorías</h3>
<pre><code>curl -X GET http://localhost:8000/api/categories</code></pre>

<h3>Crear un nuevo producto</h3>
<pre><code>curl -X POST http://localhost:8000/api/products \
-H "Content-Type: application/json" \
-d '{
    "name": "Tablet Pro",
    "price": 699.99,
    "stock": 15,
    "active": true,
    "category_id": 2
}'</code></pre>

<hr/>

<h2>🌱 Estructura de la base de datos</h2>

<p>Se han creado las siguientes tablas con sus respectivos índices:</p>
<ul>
    <li><strong>categories</strong>: Índice único en <code>name</code>.</li>
    <li><strong>products</strong>: Índices en <code>category_id</code> y <code>active</code>.</li>
    <li><strong>product_images</strong>: Clave foránea a <code>products.id</code>.</li>
</ul>

<p><strong>🛠️ Relaciones:</strong></p>
<ul>
    <li>Un producto pertenece a una categoría.</li>
    <li>Un producto puede tener múltiples imágenes.</li>
</ul>

<hr/>

<h2>🌐 Acceso a la aplicación</h2>
<ul>
    <li><h3>Lanzala con el comando php artisan serve, y aqui tienes los enlaces:</h3></li>
    <li><strong>API:</strong> <a href="http://localhost:8000/api">http://localhost:8000/api</a></li>
    <li><strong>Frontend:</strong> <a href="http://localhost:8000">http://localhost:8000</a></li>
</ul>

<hr/>

<p>🎯 <strong>¡Listo!</strong> Ahora tienes tu ecommerce en funcionamiento. 💻🛒</p>