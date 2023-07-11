<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="./assets/styles/global.css">
</head>
<body>
    <header class="header">
        <h1 class="header__logo">
            Music Ecommerce
        </h1>

        <nav class="navbar">
            <ul class="navbar__list">
                <li class="navbar__list-item"><a href="/">Produtos</a></li>
                <li class="navbar__list-item"><a href="/">Carrinho</a></li>
            </ul>
        </nav>
    </header>

    <div class="container">
        <?php require $view; ?>
    </div>
</body>
</html>