<?php 
    require 'includes/app.php';
    incluirTemplate('header');
?>

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


<?php 
    incluirTemplate('footer');
?>