<?php
    require __DIR__.'/../src/views/layouts/header.php';
    $productos = getProductos();
?> 
    <main>
        <section class="hero">
            <div class="hero-content">
                <h1 class="hero-title">ThinkPad X1</h1>
                <p class="hero-text">
                    La serie Lenovo ThinkPad X1 ofrece laptops de alta gama para profesionales, combinando diseño
                    elegante, rendimiento
                    excepcional y versatilidad, desde ultraligeras hasta 2 en 1 y plegables, con fiabilidad, seguridad y
                    durabilidad
                    garantizadas.
                </p>
                <button class="hero-button">Ver producto</button>
            </div>
        </section>

        <h1 class="section-title">Ofertas del día</h1>
        <section class="container">
            <?php foreach($productos as $producto): ?>
            <div class="card">
                <img class="card-image" src="<?=RESOURCES_PATH?>/<?= $producto['imagen'] ?>" alt="">
                <h2 class="card-title"><?= $producto['nombre'] ?></h2>
                <p class="card-text"><?= $producto['descripcion'] ?></p>
                <button class="card-button" onclick="location.href='../src/views/producto.php'">Leer Más</button>
            </div>
            <?php endforeach; ?>
        </section>

        <img src="<?=RESOURCES_PATH?>/imagen 2.png" class="content-image">

        <h1 class="section-title">Mas vendidos</h1>
        <section class="container">
            <?php foreach($productos as $producto): ?>
            <div class="card">
                <img class="card-image" src="<?=RESOURCES_PATH?>/<?= $producto['imagen'] ?>" alt="">
                <h2 class="card-title"><?= $producto['nombre'] ?></h2>
                <p class="card-text"><?= $producto['descripcion'] ?></p>
                <button class="card-button" onclick="location.href='../src/views/producto.php'">Leer Más</button>
            </div>
            <?php endforeach; ?>
        </section>

        <section class="newsletter">
            <div>
                <h3 class="newsletter-title">Suscribete al newsletter</h3>
                <p class="newsletter-text">Registra tu correo para recibir noticias y promociones</p>
            </div>
            <form action="post">
                <input type="email" placeholder="Ingresa tu correo" id="email" class="email-input">
                <button type="submit" class="submit-button">Enviar</button>
            </form>
        </section>
     </main>
<?php
    include __DIR__.'/../src/views/layouts/footer.php';
?>