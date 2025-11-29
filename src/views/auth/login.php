<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link href="<?=BASE_PATH?>/output.css" rel="stylesheet">
</head>

<body class="tw:bg-base-200 tw:flex tw:items-center tw:justify-center tw:min-h-screen tw:p-4">

    <div class="tw:card tw:w-full tw:max-w-sm tw:shadow-2xl tw:bg-base-100">
        <div class="tw:card-body">
            <h2 class="tw:card-title tw:justify-center tw:text-2xl tw:font-bold tw:mb-4">Iniciar Sesión</h2>

            <?php if (isset($error)): ?>
                <p class="tw:text-red-500 tw:mb-2 tw:text-center tw:font-bold">
                    <?= $error ?>
                </p>
            <?php endif; ?>

            <form method="POST" action="<?=BASE_PATH?>/login">
                <div>
                    <label for="email">
                        Email
                    </label>
                    <input type="email" 
                           id="email"
                           name="email" 
                           class="tw:input tw:w-full tw:rounded-lg" 
                           required />
                </div>
                <div class="tw:mt-4">
                    <label for="password">
                        Contraseña
                    </label>
                    <input type="password"
                           id="password"
                           name="password" 
                           class="tw:input tw:w-full tw:rounded-lg" 
                           required />
                </div>
                <div class="tw:card-actions tw:mt-6">
                    <button type="submit" class="tw:btn tw:btn-primary tw:rounded-lg tw:w-full">Entrar</button>
                </div>
            </form>
        </div>
    </div>

</body>
</html>