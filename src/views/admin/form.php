<div class="tw:max-w-5xl tw:mx-auto tw:py-12 tw:px-4 sm:tw:px-6 lg:tw:px-8">
    <div class="tw:card tw:bg-base-100 tw:shadow-xl">
        <div class="tw:card-body">
            <h2 class="tw:card-title tw:text-2xl tw:justify-center">
                <?= $product ? 'Editar Producto' : 'Nuevo Producto' ?>
            </h2>

            <form action="<?=BASE_PATH?>admin/products/<?= $product ? 'edit/'.$product->id : 'create'?>" 
                  method="POST"
                  enctype="multipart/form-data">

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
                                   value="<?= $product->name ?? '' ?>"
                                   class="tw:input tw:w-full tw:rounded-lg"
                                   placeholder="Nombre del producto">
                        </div>

                        <div class="tw:w-full">
                            <label for="short-description">
                                Descripción Corta
                            </label>
                            <input type="text"
                                   name="shortDescription"
                                   id="short-description"
                                   required
                                   value="<?= $product->shortDescription ?? '' ?>"
                                   class="tw:input tw:w-full tw:rounded-lg"
                                   placeholder="Breve resumen del producto">
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
                                        value="<?= $product->price ?? '' ?>"
                                        class="tw:input tw:w-full tw:rounded-lg"
                                        placeholder="0.00">
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
                                       value="<?= $product->discount ?? '' ?>"
                                       class="tw:input tw:w-full tw:rounded-lg"
                                       placeholder="0">
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
                                <option value="" disabled <?= !isset($product->category) ? 'selected' : '' ?>>Seleccionar categoría</option>
                                <?php
                                $categories = ['Computación', 'Telefonía', 'TV y Video', 'Audio', 'Videojuegos', 'Energía', 'Herramientas', 'Cables', 'Smart Home'];
                                foreach ($categories as $cat): ?>
                                    <option value="<?= $cat ?>" <?= (isset($product->category) && $product->category === $cat) ? 'selected' : '' ?>>
                                        <?= $cat ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="tw:w-full">
                            <label for="description">
                                Descripción                            </label>
                            <textarea name="description"
                                      id="description"
                                      required
                                      class="tw:textarea tw:w-full tw:h-32 tw:rounded-lg"
                                      placeholder="Descripción detallada del producto..."><?= $product->description ?? '' ?></textarea>
                        </div>

                        <div class="tw:w-full">
                            <label for="image">
                                Imagen Principal
                            </label>
                            <input type="file"
                                   name="image"
                                   id="image"
                                   accept="image/*"
                                   class="tw:file-input tw:w-full tw:rounded-lg" />
                            <p class="tw:text-sm tw:text-gray-500">Imagen actual</p>
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
                            <p class="tw:text-sm tw:text-gray-500">Imagenes actuales.</p>
                            
                            <?php if (!empty($product->carrouselImages)): ?>
                                <div class="tw:mt-2 tw:grid tw:grid-cols-4 tw:gap-2">
                                    <?php foreach ($product->carrouselImages as $img): ?>
                                        <img src="<?=RESOURCES_PATH?>/img/<?= $img ?>" class="tw:w-full tw:object-cover tw:rounded-md tw:border tw:border-base-400">
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