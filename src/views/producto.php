    <main>
    <div class="tw:flex tw:flex-col-reverse tw:md:flex-row tw:gap-8 tw:m-12">
        <div class="tw:carousel tw:carousel-start tw:self-center tw:w-full tw:bg-neutral tw:max-w-md tw:rounded-box tw:space-x-4 tw:p-4">
            <div class="tw:carousel-item">
                <img src="<?=RESOURCES_PATH?>/<?=$product->image?>" class="tw:h-60 tw:md:h-80 tw:w-full tw:object-cover tw:rounded-box" />
            </div>
        </div>
        
        <div>
            <h1 class="tw:text-4xl tw:font-semibold"><?=$product->name?></h1>
            <div class="tw:rating tw:items-center tw:mt-2 tw:mr-3">
                <div class="tw:mask tw:mask-star" aria-label="1 star"></div>
                <div class="tw:mask tw:mask-star" aria-label="2 star"></div>
                <div class="tw:mask tw:mask-star" aria-label="3 star" aria-current="true"></div>
                <div class="tw:mask tw:mask-star" aria-label="4 star"></div>
                <div class="tw:mask tw:mask-star" aria-label="5 star"></div>
            </div>
            <p class="tw:textarea-xl">10 reseñas</p>
            <div class="tw:divider"></div>
            <span class="tw:text-4xl tw:text-red-600 tw:mr-2">$<?=number_format($product->price, 2)?></span>
            <div class="tw:divider"></div>
            <label for="cantidad" class="tw:block tw:text-xl tw:mb-1.5">Cantidad: </label>
            <input type="number" id="cantidad" class="tw:input tw:input-primary tw:text-xl tw:rounded-1xl tw:mb-5" />
            <button class="tw:btn tw:w-1/1 tw:btn-primary tw:rounded-1xl">Añadir al carrito</button>
        </div>
    </div>
    <div class="descripcion tw:m-12">
        <h2 class="tw:text-3xl tw:font-bold">Descripción</h2>
        <div class="tw:divider"></div>
        <?=$product->description?>
    </div>
    <div class="tw:m-12">
        <h2 class="tw:text-3xl tw:font-bold">Productos relacionados</h2>
        <div class="tw:divider"></div>
        <section class="container">
            <div class="card">
                <img class="card-image" src="<?=RESOURCES_PATH?>/joy-cons.png">
                <h2 class="card-title">Joy-Cons</h2>
                <p class="card-text">Lleva tu experiencia de juego al siguiente nivel con los Controles Azul y Rojo, diseñados para
                    ofrecerte una inmersión total y un rendimiento superior</p>
                <button class="card-button">Ver producto</button>
                </div>
                
                <div class="card">
                    <img class="card-image" src="<?=RESOURCES_PATH?>/pro-controller.png">
                    <h2 class="card-title">Pro Controller</h2>
                    <p class="card-text">El Control Pro inalámbrico está diseñado para brindar una experiencia de juego precisa, cómoda
                        y duradera en cada sesión de juego</p>
                    <button class="card-button">Ver producto</button>
                </div>
                
                <div class="card">
                    <img class="card-image" src="<?=RESOURCES_PATH?>/sd-card.png">
                    <h2 class="card-title">Memoria MicroSD 256GB</h2>
                    <p class="card-text">Expande el almacenamiento de tu Nintnendo Switch 2 con esta memoria diseñada para ofrecer
                        velocidad y rendimiento óptimo.</p>
                    <button class="card-button">Ver producto</button>
                </div>
        </section>
    </div>
    <div class="tw:divider"></div>