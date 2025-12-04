<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Electromax</title>
    <link rel="stylesheet" href="<?=BASE_PATH?>output.css">
    <link rel="icon" type="image/x-icon" href="<?=RESOURCES_PATH?>/img/logo.png">
</head>

<body class="tw:bg-gray-100">
    <header>
        <div class="main-header">
            <a href="<?=BASE_PATH?>" class="logo-container">
                <img class="logo" src="<?=RESOURCES_PATH?>/img/logo.png"><span>Electromax</span>
            </a>
            <form class="search-bar" action="<?=BASE_PATH?>search" method="GET">
                <input class="search-input" type="search" name="q" placeholder="Buscar producto" value="<?= $_GET['q'] ?? '' ?>">
                <button class="search-button" type="submit">
                    <img id="search-icon" src="<?=RESOURCES_PATH?>/icons/search_icon.svg">
                </button>
            </form>

            <input id="menu-toggle" class="menu-toggle" type="checkbox">
            <label class="menu-button" for="menu-toggle">☰</label>
            <nav class="action-container">
                <ul class="action-bar">
                    <?php if(isAuth()): ?>
                    <li>
                        <a class="action-item" href="<?=BASE_PATH?>logout">
                            <img class="action-icon" src="<?=RESOURCES_PATH?>/icons/account_icon.svg">Cerrar sesión
                        </a>
                    </li>
                    <li>
                        <a class="action-item" href="<?=BASE_PATH?>admin/products">
                            <img class="action-icon" src="<?=RESOURCES_PATH?>/icons/admin.svg">Administrador
                        </a>
                    </li>
                    <?php else: ?>
                    <li>
                        <a class="action-item" href="<?=BASE_PATH?>login">
                            <img class="action-icon" src="<?=RESOURCES_PATH?>/icons/account_icon.svg">Iniciar Sesión
                        </a>
                    </li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>

        <nav class="category-nav">
            <ul class="category-list">
                <li>
                    <a href="<?=BASE_PATH?>category/<?=urlencode('Computación')?>" class="category-item">
                        <img class="category-icon" src="<?=RESOURCES_PATH?>/icons/computer.svg">
                        <p class="category-name">Computación</p>
                    </a>
                </li>
                <li>
                    <a href="<?=BASE_PATH?>category/<?=urlencode('Telefonía')?>" class="category-item">
                        <img class="category-icon" src="<?=RESOURCES_PATH?>/icons/smartphone.svg">
                        <p class="category-name">Telefonía</p>
                    </a>
                </li>
                <li>
                    <a href="<?=BASE_PATH?>category/<?=urlencode('TV y Video')?>" class="category-item">
                        <img class="category-icon" src="<?=RESOURCES_PATH?>/icons/tv.svg">
                        <p class="category-name">TV y Video</p>
                    </a>
                </li>
                <li class="extra-category">
                    <a href="<?=BASE_PATH?>category/Audio" class="category-item">
                        <img class="category-icon" src="<?=RESOURCES_PATH?>/icons/headphone.svg">
                        <p class="category-name">Audio</p>
                    </a>
                </li>
                <li class="extra-category">
                    <a href="<?=BASE_PATH?>category/Videojuegos" class="category-item">
                        <img class="category-icon" src="<?=RESOURCES_PATH?>/icons/game.svg">
                        <p class="category-name">Videojuegos</p>
                    </a>
                </li>
                <li class="extra-category">
                    <a href="<?=BASE_PATH?>category/<?=urlencode('Energía')?>" class="category-item">
                        <img class="category-icon" src="<?=RESOURCES_PATH?>/icons/battery.svg">
                        <p class="category-name">Energía</p>
                    </a>
                </li>
                <li class="extra-category">
                    <a href="<?=BASE_PATH?>category/Herramientas" class="category-item">
                        <img class="category-icon" src="<?=RESOURCES_PATH?>/icons/tool.svg">
                        <p class="category-name">Herramientas</p>
                    </a>
                </li>
                <li class="extra-category">
                    <a href="<?=BASE_PATH?>category/Cables" class="category-item">
                        <img class="category-icon" src="<?=RESOURCES_PATH?>/icons/cable.svg">
                        <p class="category-name">Cables</p>
                    </a>
                </li>
                <li class="extra-category">
                    <a href="<?=BASE_PATH?>category/<?=urlencode('Smart Home')?>" class="category-item">
                        <img class="category-icon" src="<?=RESOURCES_PATH?>/icons/smart-home.svg">
                        <p class="category-name">Smart Home</p>
                    </a>
                </li>
            </ul>

            <details class="more-categories">
                <summary>Más categorías</summary>
                <ul class="category-list extra-list">
                    <li>
                        <a href="<?=BASE_PATH?>category/Audio" class="category-item">
                            <img class="category-icon" src="<?=RESOURCES_PATH?>/icons/headphone.svg">
                            <p class="category-name">Audio</p>
                        </a>
                    </li>
                    <li>
                        <a href="<?=BASE_PATH?>category/Videojuegos" class="category-item">
                            <img class="category-icon" src="<?=RESOURCES_PATH?>/icons/game.svg">
                            <p class="category-name">Videojuegos</p>
                        </a>
                    </li>
                    <li>
                        <a href="<?=BASE_PATH?>category/<?=urlencode('Energía')?>" class="category-item">
                            <img class="category-icon" src="<?=RESOURCES_PATH?>/icons/battery.svg">
                            <p class="category-name">Energía</p>
                        </a>
                    </li>
                    <li>
                        <a href="<?=BASE_PATH?>category/Herramientas" class="category-item">
                            <img class="category-icon" src="<?=RESOURCES_PATH?>/icons/tool.svg">
                            <p class="category-name">Herramientas</p>
                        </a>
                    </li>
                    <li>
                        <a href="<?=BASE_PATH?>category/Cables" class="category-item">
                            <img class="category-icon" src="<?=RESOURCES_PATH?>/icons/cable.svg">
                            <p class="category-name">Cables</p>
                        </a>
                    </li>
                    <li>
                        <a href="<?=BASE_PATH?>category/<?=urlencode('Smart Home')?>" class="category-item">
                            <img class="category-icon" src="<?=RESOURCES_PATH?>/icons/smart-home.svg">
                            <p class="category-name">Smart Home</p>
                        </a>
                    </li>
                </ul>
            </details>
        </nav>
    </header>