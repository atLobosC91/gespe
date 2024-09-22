<!-- ======= Project Details Section ======= -->
<section id="project-details" class="project-details py-5" style="background-color: #f5f7fa;">
    <div class="container">
        <!-- Section Title -->
        <div class="section-title text-center mb-5">
            <h2 class="text-uppercase" style="font-weight: 700; color: #0095D7;"><?= $proyecto['titulo']; ?></h2>
            <p class="text-muted w-75 mx-auto"><?= $proyecto['descripcion']; ?></p>
        </div>

        <!-- Collage of Images -->
        <div class="row">
            <?php if (!empty($imagenes)): ?>
                <?php foreach ($imagenes as $imagen): ?>
                    <div class="col-lg-4 col-md-6 mb-4">
                        <img src="<?= $imagen['ruta_imagen']; ?>" class="img-fluid" alt="Imagen del proyecto">
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No hay imágenes disponibles para este proyecto.</p>
            <?php endif; ?>
        </div>
    </div>
</section>
<!-- End Project Details Section -->