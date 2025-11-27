<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Electromax</title>
    <link rel="stylesheet" href="<?=BASE_PATH?>output.css">
</head>

<body class="tw:bg-gray-100">
    <header>
        <div class="main-header">
            <div class="logo-container">
                <img class="logo" src="<?=RESOURCES_PATH?>/logo.png"><span>Electromax</span>
            </div>
            <div class="search-bar">
                <input class="search-input" type="search" placeholder="Buscar producto">
                <button class="search-button">
                    <img id="search-icon" src="<?=RESOURCES_PATH?>/icons/search_icon.svg">
                </button>
            </div>

            <input id="menu-toggle" class="menu-toggle" type="checkbox">
            <label class="menu-button" for="menu-toggle">☰</label>
            <nav class="action-container">
                <ul class="action-bar">
                    <li>
                        <a class="action-item" href="#">
                            <img class="action-icon" src="<?=RESOURCES_PATH?>/icons/account_icon.svg">Iniciar Sesión
                        </a>
                        <ul class="submenu">
                            <li>
                                <a href="#" class="action-item">Iniciar Sesión</a>
                            </li>
                            <li>
                                <a href="#" class="action-item">Registrarse</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a class="action-item" href="#">
                            <img class="action-icon" src="<?=RESOURCES_PATH?>/icons/cart_icon.svg">Carrito de compra
                        </a>
                    </li>
                </ul>
            </nav>
        </div>

        <nav class="category-nav">
            <ul class="category-list">
                <li>
                    <a href="#" class="category-item">
                        <img class="category-icon" src="<?=RESOURCES_PATH?>/icons/computer.svg">
                        <p class="category-name">Computación</p>
                    </a>
                </li>
                <li>
                    <a href="#" class="category-item">
                        <img class="category-icon" src="<?=RESOURCES_PATH?>/icons/smartphone.svg">
                        <p class="category-name">Telefonía</p>
                    </a>
                </li>
                <li>
                    <a href="#" class="category-item">
                        <img class="category-icon" src="<?=RESOURCES_PATH?>/icons/tv.svg">
                        <p class="category-name">TV y Video</p>
                    </a>
                </li>
                <li class="extra-category">
                    <a href="#" class="category-item">
                        <img class="category-icon" src="<?=RESOURCES_PATH?>/icons/headphone.svg">
                        <p class="category-name">Audio</p>
                    </a>
                </li>
                <li class="extra-category">
                    <a href="#" class="category-item">
                        <img class="category-icon" src="<?=RESOURCES_PATH?>/icons/game.svg">
                        <p class="category-name">Videojuegos</p>
                    </a>
                </li>
                <li class="extra-category">
                    <a href="#" class="category-item">
                        <img class="category-icon" src="<?=RESOURCES_PATH?>/icons/battery.svg">
                        <p class="category-name">Energía</p>
                    </a>
                </li>
                <li class="extra-category">
                    <a href="#" class="category-item">
                        <img class="category-icon" src="<?=RESOURCES_PATH?>/icons/tool.svg">
                        <p class="category-name">Herramientas</p>
                    </a>
                </li>
                <li class="extra-category">
                    <a href="#" class="category-item">
                        <img class="category-icon" src="<?=RESOURCES_PATH?>/icons/cable.svg">
                        <p class="category-name">Cables</p>
                    </a>
                </li>
                <li class="extra-category">
                    <a href="#" class="category-item">
                        <img class="category-icon" src="<?=RESOURCES_PATH?>/icons/smart-home.svg">
                        <p class="category-name">Smart Home</p>
                    </a>
                </li>
            </ul>

            <details class="more-categories">
                <summary>Más categorías</summary>
                <ul class="category-list extra-list">
                    <li>
                        <a href="#" class="category-item">
                            <img class="category-icon" src="<?=RESOURCES_PATH?>/icons/headphone.svg">
                            <p class="category-name">Audio</p>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="category-item">
                            <img class="category-icon" src="<?=RESOURCES_PATH?>/icons/game.svg">
                            <p class="category-name">Videojuegos</p>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="category-item">
                            <img class="category-icon" src="<?=RESOURCES_PATH?>/icons/battery.svg">
                            <p class="category-name">Energía</p>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="category-item">
                            <img class="category-icon" src="<?=RESOURCES_PATH?>/icons/tool.svg">
                            <p class="category-name">Herramientas</p>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="category-item">
                            <img class="category-icon" src="<?=RESOURCES_PATH?>/icons/cable.svg">
                            <p class="category-name">Cables</p>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="category-item">
                            <img class="category-icon" src="<?=RESOURCES_PATH?>/icons/smart-home.svg">
                            <p class="category-name">Smart Home</p>
                        </a>
                    </li>
                </ul>
            </details>
        </nav>
    </header>