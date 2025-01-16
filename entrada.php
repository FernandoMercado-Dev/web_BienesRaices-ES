<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienes Raices</title>
    <link rel="stylesheet" href="build/css/app.css">
</head>
<body>
    
    <header class="header">
        <div class="contenedor contenido-header">
            <div class="barra">
                <a href="/">
                    <img src="build/img/logo.svg" alt="logotipo de Bienes Raices">
                </a>

                <div class="mobile-menu">
                    <img src="build/img/barras.svg" alt="icono menuresponsive">
                </div>

                <div class="derecha">
                    <img src="build/img/dark-mode.svg" class="dark-mode-boton">

                    <nav class="navegacion">
                        <a href="nosotros.php">Nosotros</a>
                        <a href="anuncios.php">Anuncios</a>
                        <a href="blog.php">Blog</a>
                        <a href="contacto.php">Contacto</a>
                    </nav>
                </div>
            </div> 
            <!-- .barra -->
        </div>
    </header>

    <main class="contenedor seccion contenido-centrado">
        <h1>Guía para la decoración de tu hogar</h1>


        <picture>
            <source srcset="build/img/destacada2.webp" type="image/webp">
            <source srcset="build/img/destacada2.jpg" type="image/jpeg">
            <img loading="lazy" src="build/img/destacada2.jpg" alt="imagen de la propiedad">
        </picture>
        
        <p class="informacion-meta">Escrito el: <span>20/10/2024</span> por: <span>Admin</span></p>

        <div class="resumen-propiedad">
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Autem, nobis. Sunt explicabo consequuntur, natus enim dolore ad hic officia voluptas sed facilis unde libero soluta laborum ipsum laboriosam reprehenderit aut? Lorem ipsum dolor sit amet consectetur adipisicing elit. Eos laboriosam quam, consequatur et animi laborum. Veniam officiis quos, placeat explicabo dignissimos, eos accusamus praesentium tempora sequi magnam temporibus. Iusto, eveniet?</p>

            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Numquam veritatis ab animi in porro, architecto temporibus impedit atque beatae iure explicabo? Adipisci, laborum sed. Accusamus in fuga qui dignissimos laudantium?</p>
        </div>
    </main>

    <footer class="footer seccion">
        <div class="contenedor contenedor-footer">
            <nav class="navegacion">
                <a href="nosotros.php">Nosotros</a>
                <a href="anuncios.php">Anuncios</a>
                <a href="blog.php">Blog</a>
                <a href="contacto.php">Contacto</a>
            </nav>
        </div>

        <p class="copyright">Todos los derechos reservados 2024 &copy;</p>
    </footer>


    <script src="build/js/bundle.min.js"></script>
</body>
</html>