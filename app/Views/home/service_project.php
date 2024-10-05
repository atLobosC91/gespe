<br><br>
<!-- ======= Projects Section ======= -->
<section id="projects" class="projects py-5" style="background-color: #f5f7fa;">
    <div class="container">
        <!-- Section Title -->
        <div class="section-title text-center mb-5">
            <h2 class="text-uppercase" style="font-weight: 700; color: #0095D7;">Mira nuestros proyectos de <?= $servicio['titulo'] ?></h2>
            <p class="text-muted w-75 mx-auto">Descubre nuestros proyectos de alta calidad en <?= $servicio['titulo'] ?>, diseñados para satisfacer las necesidades más exigentes de la industria. Nos comprometemos con la excelencia y la innovación para garantizar los mejores resultados.</p>
        </div>

        <!-- Project Cards -->
        <div class="row">
            <?php if (!empty($proyectos)): ?>
                <?php foreach ($proyectos as $proyecto): ?>
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card h-100 shadow-sm border-0 text-center project-card">
                            <?php if (isset($proyecto['url_imagen'])): ?>
                                <img class="card-img-top img-fluid" src="<?= $proyecto['ruta_imagen'] ?>" alt="<?= $proyecto['titulo'] ?>">
                            <?php else: ?>
                                <img class="card-img-top img-fluid" src="/ruta/default_image.jpg" alt="<?= $proyecto['titulo'] ?>">
                            <?php endif; ?>
                            <div class="card-body d-flex flex-column p-4">
                                <h2 class="card-title"><?= $proyecto['titulo'] ?></h2>
                                <p class="card-text text-muted"><strong>Fecha:</strong> <?= $proyecto['fecha'] ?></p>
                                <a href="<?= site_url('project_detail/' . $proyecto['id_proyecto']); ?>" class="btn btn-primary mt-auto">Ver Detalles</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No hay proyectos disponibles en este momento.</p>
            <?php endif; ?>
        </div>

    </div>
</section>
<!-- End Projects Section -->