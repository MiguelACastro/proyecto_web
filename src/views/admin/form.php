<div class="tw:max-w-5xl tw:mx-auto tw:py-12 tw:px-4 sm:tw:px-6 lg:tw:px-8">
    <div class="tw:card tw:bg-base-100 tw:shadow-xl">
        <div class="tw:card-body">
            <h2 class="tw:card-title tw:text-2xl tw:justify-center">
                <?= $product ? 'Editar Producto' : 'Nuevo Producto' ?>
            </h2>

            <?php if (isset($_SESSION['errors']) && !empty($_SESSION['errors'])): ?>
                <ul>
                    <?php foreach ($_SESSION['errors'] as $error): ?>
                        <li class="tw:text-red-600 tw:text-sm"><?= $error ?></li>
                    <?php endforeach; ?>
                </ul>
                <?php unset($_SESSION['errors']); ?>
            <?php endif; ?>

            <form action="<?=BASE_PATH?>admin/products/<?= $product ? 'edit/'.$product->id : 'create'?>" 
                  method="POST"
                  enctype="multipart/form-data"
                  id="productForm"
                  novalidate>

                <?php if ($product): ?>
                    <input type="hidden" name="id" value="<?= $product->id ?>">
                    <input type="hidden" name="_method" value="PUT">
                <?php endif; ?>

                <div class="tw:grid tw:grid-cols-1 lg:tw:grid-cols-2 tw:gap-8">
                        <div class="tw:w-full">
                            <label for="name">
                                Nombre del producto
                            </label>
                            <input type="text"
                                   name="name"
                                   id="name"
                                   required
                                   maxlength="255"
                                   value="<?= $_SESSION['oldData']['name'] ?? ($product->name ?? '') ?>"
                                   class="tw:input tw:w-full tw:rounded-lg"
                                   placeholder="Nombre del producto">
                            <span class="tw:text-red-600 tw:text-sm tw:hidden" id="name-error"></span>
                        </div>

                        <div class="tw:w-full">
                            <label for="short-description">
                                Descripción Corta
                            </label>
                            <input type="text"
                                   name="shortDescription"
                                   id="short-description"
                                   required
                                   maxlength="1023"
                                   value="<?= $_SESSION['oldData']['shortDescription'] ?? ($product->shortDescription ?? '') ?>"
                                   class="tw:input tw:w-full tw:rounded-lg"
                                   placeholder="Breve resumen del producto">
                            <span class="tw:text-red-600 tw:text-sm tw:hidden" id="short-description-error"></span>
                        </div>

                        <div class="tw:grid tw:grid-cols-2 tw:gap-4">
                            <div class="tw:w-full">
                                <label for="price">
                                    Precio
                                </label>
                                <input type="number"
                                        name="price"
                                        id="price"
                                        step="0.50"
                                        required
                                        value="<?= $_SESSION['oldData']['price'] ?? ($product->price ?? '') ?>"
                                        class="tw:input tw:w-full tw:rounded-lg"
                                        placeholder="0.00">
                                <span class="tw:text-red-600 tw:text-sm tw:hidden" id="price-error"></span>
                            </div>
                            <div class="tw:w-full">
                                <label for="discount">
                                    Descuento (Opcional)
                                </label>
                                <input type="number"
                                       name="discount"
                                       id="discount"
                                       min="0"
                                       max="100"
                                       value="<?= $_SESSION['oldData']['discount'] ?? ($product->discount ?? '') ?>"
                                       class="tw:input tw:w-full tw:rounded-lg"
                                       placeholder="0">
                                <span class="tw:text-red-600 tw:text-sm tw:hidden" id="discount-error"></span>
                            </div>
                        </div>

                        <div class="tw:w-full">
                            <label for="category">
                                Categoría
                            </label>
                            <select name="category"
                                    id="category"
                                    required
                                    class="tw:input tw:w-full tw:rounded-lg">
                                <option value="" disabled <?= !isset($_SESSION['oldData']['category']) && !isset($product->category) ? 'selected' : '' ?>>Seleccionar categoría</option>
                                <?php
                                $categories = ['Computación', 'Telefonía', 'TV y Video', 'Audio', 'Videojuegos', 'Energía', 'Herramientas', 'Cables', 'Smart Home'];
                                $selectedCategory = $_SESSION['oldData']['category'] ?? ($product->category ?? '');
                                foreach ($categories as $cat): ?>
                                    <option value="<?= $cat ?>" <?= $selectedCategory === $cat ? 'selected' : '' ?>>
                                        <?= $cat ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <span class="tw:text-red-600 tw:text-sm tw:hidden" id="category-error"></span>
                        </div>

                        <div class="tw:w-full">
                            <label for="description">
                                Descripción                            </label>
                            <textarea name="description"
                                      id="description"
                                      required
                                      class="tw:textarea tw:w-full tw:h-32 tw:rounded-lg"
                                      placeholder="Descripción detallada del producto..."><?= $_SESSION['oldData']['description'] ?? ($product->description ?? '') ?></textarea>
                            <span class="tw:text-red-600 tw:text-sm tw:hidden" id="description-error"></span>
                        </div>

                        <div class="tw:w-full">
                            <label for="image">
                                Imagen Principal
                            </label>
                            <input type="file"
                                   name="image"
                                   id="image"
                                   accept="image/*"
                                   <?= !$product ? 'required' : '' ?>
                                   class="tw:file-input tw:w-full tw:rounded-lg" />
                            <span class="tw:text-red-600 tw:text-sm tw:hidden" id="image-error"></span>
                            <?php if ($product): ?>
                                <p class="tw:text-sm tw:text-gray-500">Imagen actual</p>
                            <?php endif; ?>
                            <?php if (!empty($product->mainImage)): ?>
                                <img src="<?=RESOURCES_PATH?>/img/<?= $product->mainImage ?>" class="tw:w-1/3 tw:object-cover tw:rounded-md tw:border tw:border-base-400">
                            <?php endif; ?>
                        </div>

                        <div class="tw:w-full">
                            <label for="images">
                                Imágenes del Carrusel
                            </label>
                            <input type="file"
                                   name="images[]"
                                   id="images"
                                   multiple
                                   accept="image/*"
                                   class="tw:file-input tw:w-full tw:rounded-lg" />
                            <span class="tw:text-red-600 tw:text-sm tw:hidden" id="images-error"></span>
                            <?php if ($product): ?>
<p class="tw:text-sm tw:text-gray-500 ">Imagenes actuales. (Selecciona las imagenes que deseas eliminar)</p>
                            <?php endif; ?>
                            
                            <?php if (!empty($product->carrouselImages)): ?>
                                <div class="tw:mt-2 tw:grid tw:grid-cols-2 tw:sm:grid-cols-4 tw:gap-4">
                                    <?php foreach ($product->carrouselImages as $img): ?>
                                        <div class="tw:relative">
                                            <img src="<?=RESOURCES_PATH?>/img/<?= $img ?>" class="tw:w-full tw:object-cover tw:rounded-md tw:border tw:border-base-400">
                                            <div class="tw:absolute tw:top-1 tw:right-1">
                                                <label class="tw:label tw:cursor-pointer tw:rounded-full tw:p-1">
                                                    <input type="checkbox" name="deletedImages[]" value="<?= $img ?>" class="tw:checkbox tw:checkbox-error tw:checkbox-xs" />
                                                </label>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    
                </div>

                <div class="tw:card-actions tw:justify-end tw:mt-8">
                    <a href="<?=BASE_PATH?>admin/products" 
                       class="tw:btn tw:btn-secondary tw:btn-ghost tw:rounded-lg">
                        Cancelar
                    </a>
                    <button type="submit"
                            class="tw:btn tw:btn-primary tw:rounded-lg">
                        <?= $product ? 'Actualizar Producto' : 'Guardar Producto' ?>
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
<?php 
if(isset($_SESSION['oldData'])) {
    unset($_SESSION['oldData']);
}
?>
<script>
document.getElementById('productForm').addEventListener('submit', function(e) {
    let isValid = true;
    
    const showError = (id, message) => {
        const input = document.getElementById(id);
        const errorInput = document.getElementById(id + '-error');
        if(errorInput) {
            errorInput.textContent = message;
            errorInput.classList.remove('tw:hidden');
        }
        input.classList.add('tw:input-error');
        isValid = false;
    };

    const clearError = (id) => {
        const input = document.getElementById(id);
        const errorInput = document.getElementById(id + '-error');
        if(errorInput) {
            errorInput.textContent = '';
            errorInput.classList.add('tw:hidden');
        }
        input.classList.remove('tw:input-error');
    };

    const name = document.getElementById('name');
    clearError('name');
    if (!name.value.trim()) {
        showError('name', 'El nombre es obligatorio');
    } else if (name.value.length > 255) {
        showError('name', 'El nombre no puede exceder 255 caracteres');
    }

    const shortDesc = document.getElementById('short-description');
    clearError('short-description');
    if (!shortDesc.value.trim()) {
        showError('short-description', 'La descripción corta es obligatoria');
    } else if (shortDesc.value.length > 1023) {
        showError('short-description', 'La descripción corta no puede exceder 1023 caracteres');
    }

    const desc = document.getElementById('description');
    clearError('description');
    if (!desc.value.trim()) {
        showError('description', 'La descripción es obligatoria');
    } else if (desc.value.length > 65535) {
        showError('description', 'La descripción no puede exceder 65535 caracteres');
    }

    const price = document.getElementById('price');
    clearError('price');
    if (!price.value) {
        showError('price', 'El precio es obligatorio');
    } else if (isNaN(price.value) || Number(price.value) < 0) {
        showError('price', 'El precio debe ser un número válido');
    }

    const discount = document.getElementById('discount');
    clearError('discount');
    if (discount.value) {
        if (isNaN(discount.value) || Number(discount.value) < 0 || Number(discount.value) > 100) {
            showError('discount', 'El descuento debe ser un número entre 0 y 100');
        }
    }

    const category = document.getElementById('category');
    clearError('category');
    if (!category.value) {
        showError('category', 'La categoría es obligatoria');
    }

    const image = document.getElementById('image');
    clearError('image');
    <?php if (!$product): ?>
    if (!image.files || image.files.length === 0) {
        showError('image', 'La imagen principal es obligatoria');
    }
    <?php endif; ?>


    const images = document.getElementById('images');
    clearError('images');
    <?php if (!$product): ?>
    if (!images.files || images.files.length === 0) {
        showError('images', 'Las imágenes del carrusel son obligatorias');
    }
    <?php endif; ?>

    if (!isValid) {
        e.preventDefault();
    }
});
</script>