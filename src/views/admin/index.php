<div class="tw:max-w-7xl tw:mx-auto tw:px-6 tw:py-12">
    <div class="tw:flex tw:justify-between tw:items-center tw:mb-6">
        <div>
            <h2 class="tw:text-3xl tw:font-bold">Productos</h2>
        </div>
        <a href="<?=BASE_PATH?>admin/products/create" 
           class="tw:btn tw:btn-primary tw:rounded-2xl tw:px-4 tw:py-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
            </svg>
            Nuevo Producto
        </a>
    </div>

    <div class="tw:bg-white tw:rounded-xl tw:shadow-sm tw:border tw:border-gray-100 tw:overflow-hidden">
        <div class="tw:overflow-x-auto">
            <table class="tw:min-w-full tw:divide-y tw:divide-gray-200">
                <thead class="tw:bg-gray-50">
                    <tr>
                        <th scope="col" class="tw:px-6 tw:py-4 tw:text-left tw:text-sm tw:font-semibold tw:text-gray-600">
                            Nombre
                        </th>
                        <th scope="col" class="tw:px-6 tw:py-4 tw:text-left tw:text-sm tw:font-semibold tw:text-gray-600">
                            Descripción
                        </th>
                        <th scope="col" class="tw:px-6 tw:py-4 tw:text-left tw:text-sm tw:font-semibold tw:text-gray-600">
                            Categoría
                        </th>
                        <th scope="col" class="tw:px-6 tw:py-4 tw:text-right tw:text-sm tw:font-semibold tw:text-gray-600">
                            Acciones
                        </th>
                    </tr>
                </thead>
                <tbody class="tw:bg-white tw:divide-y tw:divide-gray-200">
                    <?php foreach ($products as $product): ?>
                    <tr>
                        <td class="tw:px-6 tw:py-4">
                            <div class="tw:text-sm"><?= $product->name ?></div>
                        </td>
                        <td class="tw:px-6 tw:py-4">
                            <div class="tw:text-sm tw:line-clamp-4"><?= $product->shortDescription ?></div>
                        </td>
                        <td class="tw:px-6 tw:py-4">
                            <div class="tw:text-sm"><?= ucfirst($product->category) ?></div>
                        </td>
                        <td class="tw:px-6 tw:py-4 tw:text-right tw:text-sm">
                            <div class="tw:flex tw:justify-end tw:gap-3">
                                <a href="<?=BASE_PATH?>/admin/products/edit/<?= $product->id ?>" class="tw:text-blue-900">
                                    Editar
                                </a>
                                <a href="<?=BASE_PATH?>/admin/products/delete/<?= $product->id ?>" onclick="return confirm('¿Estás seguro de que deseas eliminar este producto?')" class="tw:text-red-900">
                                   Eliminar
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>