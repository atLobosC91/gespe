<!-- ======= Hero Section ======= -->
<section id="hero">
  <div class="hero-container">
    <div id="heroCarousel" data-bs-interval="5000" class="carousel slide carousel-fade" data-bs-ride="carousel">

      <ol class="carousel-indicators" id="hero-carousel-indicators"></ol>

      <div class="carousel-inner" role="listbox">

        <!-- Slide 1 -->
        <div class="carousel-item active" style="background-image: url(/assets/img/slide/slide-1.jpg);">
          <div class="carousel-container">
            <div class="carousel-content">
              <h2 class="animate__animated animate__fadeInDown">INSID LTDA.</h2>
              <p class="animate__animated animate__fadeInUp">Ofrecemos soluciones integrales en montaje, mantenimiento
                eléctrico, instrumentación y comunicación.</p>
              <div>
                <a href="<?= site_url('/about_us'); ?>" class="btn-get-started animate__animated animate__fadeInUp scrollto">Saber Más</a>
              </div>
            </div>
          </div>
        </div>

        <!-- Slide 2 -->
        <div class="carousel-item" style="background-image: url(/assets/img/slide/slide-2.jpg);">
          <div class="carousel-container">
            <div class="carousel-content">
              <h2 class="animate__animated animate__fadeInDown">INSID LTDA.</h2>
              <p class="animate__animated animate__fadeInUp">Nos especializamos en el diseño y ejecución de proyectos
                industriales, asegurando la calidad y eficiencia en cada etapa.</p>
              <div>
                <a href="<?= site_url('/about_us'); ?>" class="btn-get-started animate__animated animate__fadeInUp scrollto">Saber Más</a>
              </div>
            </div>
          </div>
        </div>

        <!-- Slide 3 -->
        <div class="carousel-item" style="background-image: url(/assets/img/slide/slide-3.jpg);">
          <div class="carousel-container">
            <div class="carousel-content">
              <h2 class="animate__animated animate__fadeInDown">INSID LTDA.</h2>
              <p class="animate__animated animate__fadeInUp">Nuestro equipo altamente capacitado trabaja con
                tecnología de punta para garantizar el cumplimiento de los estándares más exigentes.</p>
              <div>
                <a href="<?= site_url('/about_us'); ?>" class="btn-get-started animate__animated animate__fadeInUp scrollto">Saber Más</a>
              </div>
            </div>
          </div>
        </div>

      </div>

      <a class="carousel-control-prev" href="#heroCarousel" role="button" data-bs-slide="prev">
        <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
      </a>

      <a class="carousel-control-next" href="#heroCarousel" role="button" data-bs-slide="next">
        <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
      </a>

    </div>
  </div>
</section><!-- End Hero -->

<main id="main">

  <!-- ======= About Section ======= -->
  <section id="about" class="about">
    <div class="container">

      <div class="row no-gutters align-items-center">
        <!-- Bloque de imagen -->
        <div class="col-xl-5 d-flex align-items-center justify-content-center">
          <div class="about-img-placeholder">
            <img src="/assets/img/about.jpg" alt="Imagen de la empresa" class="img-fluid">
          </div>
        </div>

        <!-- Contenido de texto -->
        <div class="col-xl-7 ps-0 ps-lg-5 pe-lg-1">
          <div class="content section-title">
            <h2>¿Quiénes Somos?</h2>
            <p>
              Contamos con más de 11 años de experiencia en mantenimiento y montaje industrial. Ofrecemos servicios de
              montaje de instalaciones industriales, mantención preventiva y montaje de equipos industriales. Además,
              poseemos certificaciones CCS LEVINTON e ISO 9001:2015, que respaldan nuestra capacidad en redes industriales
              con cable estructurado y fibra óptica.
            </p>
            <p>Es por esto, que nuestros valores forman parte de cuatro pilares fundamentales.</p>

            <!-- Botón "Conocer más" -->
            <a href="/about_us" class="btn-learn-more">Conocer más</a>

          </div>
        </div>
      </div>

    </div>
  </section>
  <!-- End About Section -->



  <!-- ======= Counts Section ======= -->
  <section id="counts" class="counts">
    <div class="container">
      <div class="row no-gutters">

        <div class="col-lg-3 col-md-6 d-md-flex align-items-md-stretch">
          <div class="count-box">
            <i class="bi bi-emoji-smile"></i>
            <span data-purecounter-start="0" data-purecounter-end="25" data-purecounter-duration="1" class="purecounter"></span>
            <p><strong>Clientes Satisfechos</strong><br /> Satisfacción garantizada.</p>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 d-md-flex align-items-md-stretch">
          <div class="count-box">
            <i class="bi bi-journal-richtext"></i>
            <span data-purecounter-start="0" data-purecounter-end="133" data-purecounter-duration="1" class="purecounter"></span>
            <p><strong>Proyectos Ejecutados</strong><br /> Eficiencia y calidad.</p>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 d-md-flex align-items-md-stretch">
          <div class="count-box">
            <i class="bi bi-people"></i>
            <span data-purecounter-start="0" data-purecounter-end="60" data-purecounter-duration="1" class="purecounter"></span>
            <p><strong>Colaboradores</strong><br /> Equipo experto y dedicado.</p>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 d-md-flex align-items-md-stretch">
          <div class="count-box">
            <i class="bi bi-star"></i>
            <span data-purecounter-start="0" data-purecounter-end="11" data-purecounter-duration="1" class="purecounter"></span>
            <p><strong>Años de Experiencia</strong><br /> Más de una década.</p>
          </div>
        </div>

      </div>
    </div>
  </section>
  <!-- End Counts Section -->

  <!-- ======= Clients Section ======= -->
  <section id="clients" class="clients section-bg">
    <div class="container">
      <div class="row">
        <?php if (!empty($clientes)): ?>
          <?php foreach ($clientes as $cliente): ?>
            <div class="col-lg-3 col-md-4 col-6 d-flex align-items-center justify-content-center">
              <a href="<?= $cliente->url_pagina ?>" target="_blank">
                <img src="<?= $cliente->logo ?>" class="img-fluid" alt="<?= $cliente->nombre_cliente ?>">
              </a>
            </div>
          <?php endforeach; ?>
        <?php else: ?>
          <p>No hay clientes disponibles en este momento.</p>
        <?php endif; ?>
      </div>
    </div>
  </section>
  <!-- End Clients Section -->


  <!-- ======= Services Section ======= -->
  <section id="services" class="services">
    <div class="container">
      <div class="section-title text-center mb-5">
        <h2>¿QUÉ OFRECEMOS?</h2>
        <p>Descubre nuestros servicios especializados en ingeniería industrial. Nos enfocamos en ofrecer soluciones integrales y de alta calidad en montaje, electricidad, automatización y comunicación industrial, adaptándonos a las necesidades de cada cliente. Nuestro equipo está comprometido con los más altos estándares de seguridad y eficiencia para garantizar resultados confiables en cada proyecto.</p>
      </div>

      <div class="row">
        <?php if (!empty($servicios)): ?>
          <?php foreach ($servicios as $servicio): ?>
            <!-- Service Card -->
            <div class="col-lg-3 col-md-6 mb-4">
              <div class="card h-100 shadow-sm">
                <img class="card-img-top" src="<?= $servicio->url_imagen ?>" alt="<?= $servicio->titulo ?>">
                <div class="card-body d-flex flex-column">
                  <h4 class="card-title"><?= $servicio->titulo ?></h4>
                  <a href="<?= site_url('Home/service_project/' . $servicio->id_servicio); ?>" class="btn btn-primary mt-auto">Ver Proyectos</a>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        <?php else: ?>
          <p>No hay servicios disponibles en este momento.</p>
        <?php endif; ?>
      </div>
    </div>
  </section>

  <!-- End Services Section -->



  <!-- ======= Contact Section ======= -->
  <section id="contact" class="contact ">
    <div class="container">
      <div class="section-title text-center mb-5">
        <h2>Contacto</h2>
        <p>Si tienes alguna pregunta o deseas conocer más sobre nuestros servicios, no dudes en contactarnos. Estamos aquí para ayudarte.</p>
      </div>

      <div class="row">
        <!-- Contact Form -->
        <div class="col-lg-6">
          <div class="form">
            <form action="forms/contact.php" method="post" role="form" class="php-email-form">
              <div class="row">
                <div class="col-md-6 form-group">
                  <input type="text" name="name" class="form-control" id="name" placeholder="Nombre" required>
                </div>
                <div class="col-md-6 form-group mt-3 mt-md-0">
                  <input type="email" class="form-control" name="email" id="email" placeholder="Email" required>
                </div>
              </div>
              <div class="form-group mt-3">
                <input type="text" class="form-control" name="subject" id="subject" placeholder="Asunto" required>
              </div>
              <div class="form-group mt-3">
                <textarea class="form-control" name="message" rows="5" placeholder="Mensaje" required></textarea>
              </div>
              <div class="my-3">
                <div class="loading">Cargando</div>
                <div class="error-message"></div>
                <div class="sent-message">Tu mensaje ha sido enviado. ¡Gracias!</div>
              </div>
              <div class="text-center"><button type="submit">Enviar Mensaje</button></div>
            </form>
          </div>
        </div>

        <!-- Google Map -->
        <div class="col-lg-6 mt-4 mt-lg-0 justify-content-center">
          <div class="map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d12974.57292865322!2d-71.61480563014463!3d-35.61186614807127!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x9665ed72120457fb%3A0xbf38f4ee5ab64728!2sINSID%20Ltda.!5e0!3m2!1ses-419!2scl!4v1725471563693!5m2!1ses-419!2scl" style="border:0; width: 100%; height: 380px;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
          </div>
        </div>
      </div>
    </div>
  </section><!-- End Contact Section -->



</main><!-- End #main -->