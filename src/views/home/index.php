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
            <?php foreach($products as $producto): ?>
            <div class="card">
                <img class="card-image" src="<?=RESOURCES_PATH?>/<?= $producto->mainImage ?>" alt="">
                <h2 class="card-title"><?= $producto->name ?></h2>
                <p class="card-text"><?= $producto->shortDescription ?></p>
                <a class="card-button"  href="<?=BASE_PATH?>products/<?=$producto->id?>">Leer Más</a>
            </div>
            <?php endforeach; ?>
        </section>

        <img src="<?=RESOURCES_PATH?>/imagen 2.png" class="content-image">

        <h1 class="section-title">Mas vendidos</h1>
        <section class="container">
            <?php foreach($products as $producto): ?>
            <div class="card">
                <img class="card-image" src="<?=RESOURCES_PATH?>/<?= $producto->mainImage ?>" alt="">
                <h2 class="card-title"><?= $producto->name ?></h2>
                <p class="card-text"><?= $producto->shortDescription ?></p>
                <a class="card-button"  href="<?=BASE_PATH?>products/<?=$producto->id?>">Leer Más</a>
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