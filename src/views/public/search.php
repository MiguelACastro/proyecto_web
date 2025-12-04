<main class="tw:max-w-7xl tw:mx-auto tw:px-6 tw:py-12">
    <div class="tw:flex tw:justify-between tw:items-center tw:mb-8">
        <h1 class="tw:text-3xl tw:font-bold tw:text-gray-900">
            Resultados de búsqueda para: "<?= $query ?>"
        </h1>
        
        <form method="GET" action="<?=BASE_PATH?>search" class="tw:flex tw:items-center tw:gap-2">
            <input type="hidden" name="q" value="<?= $query ?>">
            <span>Mostrar:</span>
            <select name="limit" id="limit" onchange="this.form.submit()">
                <option value="5" <?= $limit == 5 ? 'selected' : '' ?>>5</option>
                <option value="10" <?= $limit == 10 ? 'selected' : '' ?>>10</option>
                <option value="20" <?= $limit == 20 ? 'selected' : '' ?>>20</option>
                <option value="50" <?= $limit == 50 ? 'selected' : '' ?>>50</option>
                <option value="100" <?= $limit == 100 ? 'selected' : '' ?>>100</option>
            </select>
            <span>por página</span>
        </form>
    </div>

    <?php if (empty($products)): ?>
        <div class="tw:text-center tw:py-12">
            <p class="tw:text-xl">No se encontraron productos que coincidan con tu búsqueda.</p>
            <a href="<?=BASE_PATH?>" class="tw:btn tw:btn-primary tw:rounded-2xl tw:mt-4">Volver al inicio</a>
        </div>
    <?php else: ?>
        <section class="container">
            <?php foreach($products as $producto): ?>
            <div class="card">
                <img class="card-image" src="<?=RESOURCES_PATH?>/img/<?= $producto->mainImage ?>" alt="">
                <h2 class="card-title"><?= $producto->name ?></h2>
                <p class="card-text"><?= $producto->shortDescription ?></p>
                <a class="card-button"  href="<?=BASE_PATH?>products/<?=$producto->id?>">Leer Más</a>
            </div>
            <?php endforeach; ?>
        </section>

        <?php if ($totalPages > 1): ?>
        <div class="tw:flex tw:justify-center tw:mt-12">
            <nav class="tw:flex tw:gap-2">
                <?php if ($currentPage > 1): ?>
                    <a href="<?=BASE_PATH?>search?q=<?=urlencode($query)?>&page=<?=$currentPage-1?>&limit=<?=$limit?>" 
                       class="tw:btn tw:btn-outline tw:btn-secondary tw:rounded-md tw:px-4 tw:py-2">
                        Anterior
                    </a>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <a href="<?=BASE_PATH?>search?q=<?=urlencode($query)?>&page=<?=$i?>&limit=<?=$limit?>" 
                       class="tw:btn tw:btn-outline tw:rounded-md tw:px-4 tw:py-2" <?= $i == $currentPage ? 'tw:bg-blue-600 tw:text-white tw:border-blue-600' : 'tw:border-gray-300 tw:hover:bg-gray-50 tw:text-gray-700' ?> tw:rounded-lg">
                        <?= $i ?>
                    </a>
                <?php endfor; ?>

                <?php if ($currentPage < $totalPages): ?>
                    <a href="<?=BASE_PATH?>search?q=<?=urlencode($query)?>&page=<?=$currentPage+1?>&limit=<?=$limit?>" 
                       class="tw:btn tw:btn-outline tw:btn-secondary tw:rounded-md tw:px-4 tw:py-2">
                        Siguiente
                    </a>
                <?php endif; ?>
            </nav>
        </div>
        <?php endif; ?>
    <?php endif; ?>
</main>
