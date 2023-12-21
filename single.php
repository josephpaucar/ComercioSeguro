<?php get_header(); 
  $terms = get_the_terms( $post->ID, 'categorias' );
  $field = get_field_object( 'zona' );
  $value = $field['value'];
  $label = $field['choices'][ $value ];
  $gallery = get_field('galeria_de_imagenes');
  $sellos = get_field('sellos_municipales');
  $datos_empresa = get_field('datos_de_la_empresa');
  $redes_sociales = get_field('redes_sociales');
?>

<main class="container cs-single-comercio">

  <?php if (function_exists('the_breadcrumb')) the_breadcrumb(); ?>

<?php 
  if(have_posts(  )){
    while(have_posts()) {
      the_post(  ); 
?>

  <div class="row">    
    <div class="col-12 col-md-6 col-lg-4 d-flex justify-content-center justify-content-center align-items-center">
      <div class="avatar">
        <?php the_post_thumbnail( 'large' ); ?>
      </div>
    </div>
    <div class="col-12 col-md-6 col-lg-8">
      <div class="cs-single-header mt-4 mt-md-0 d-flex flex-column justify-content-center align-items-center align-items-md-start">
        <h1 class="text-start"><?php the_title(  ); ?></h1>
        <div class="cs-single-links">
          <?php if ( !empty( $terms ) ){
            $term = array_shift( $terms ); ?>
            <a href="<?php echo get_term_link( $term->slug, 'categorias' ) ?>"> <?php echo $term->name;?> </a>
            <span class="separador"></span>
            <a href="<?php echo get_home_url(). '/categoria'.'/' .$term->slug.'/?_zone='.$value; ?>"> <?php echo $label;?> </a>
          <?php } ?>
        </div>
      </div>
    </div>

    <div class="col-12">
      <div class="image-gallery">
      <?php if( $gallery ): ?>
        <img src="<?php echo esc_url( $gallery['imagen_1']['url'] ); ?>" alt="img1">
        <img src="<?php echo esc_url( $gallery['imagen_2']['url'] ); ?>" alt="img1">
        <img src="<?php echo esc_url( $gallery['imagen_3']['url'] ); ?>" alt="img1">
        <img src="https://source.unsplash.com/random/600x600?bear,seed=${400}" alt="img1">
      <?php endif; ?>
      </div>
    </div>
  </div>

  <div class="cs-single-sellos">
    <div class="container">
      <div class="row text-center justify-content-center">
        <div class="col-12">
          <h2 class="mb-3">Sellos Municipales</h2>
        </div>
        <?php if( $sellos && in_array('fiscalizacion', $sellos) ): ?>
        <div class="col-4">
          <img src="<?php echo get_template_directory_uri() ?>/assets/img/fiscalizacion.png" alt="Sello de Fiscalización" width="auto" height="123" class="d-inline-block align-text-top">
          <h4 class="mt-2 sellos_caption">Fiscalización</h4>
        </div>
        <?php endif; ?>
        <?php if( $sellos && in_array('autorizacion', $sellos) ): ?>
        <div class="col-4">
          <img src="<?php echo get_template_directory_uri() ?>/assets/img/autorizacion.png" alt="Sello de Autorizacón" width="auto" height="123" class="d-inline-block align-text-top">
          <h4 class="mt-2 sellos_caption">Autorización</h4>
        </div>
        <?php endif; ?>
        <?php if( $sellos && in_array('seguridad', $sellos) ): ?>
        <div class="col-4">
          <img src="<?php echo get_template_directory_uri() ?>/assets/img/seguridad.png" alt="Sello de Seguridad" width="auto" height="123" class="d-inline-block align-text-top">
          <h4 class="mt-2 sellos_caption">Seguridad</h4>
        </div>
        <?php endif; ?>
      </div>
    </div>
  </div>

  <div class="row cs-single-info">
    <div class="col-12">
      <ul class="nav nav-tabs cs-tabs-nav d-flex justify-content-center" id="myTab" role="tablist">
        <li class="nav-item mb-0" role="presentation">
          <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Resumen</button>
        </li>
        <li class="nav-item mb-0" role="presentation">
          <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Opiniones</button>
        </li>
      </ul>

      <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
          <div class="row">
            <div class="col-12 col-md-6 col-lg-7">
              <div class="resume-section">
                <div class="resume-section__left">
                  Empresa:
                </div>
                <p class="resume-section__right">
                  <?php the_title(  ); ?>
                </p>
              </div>
              <div class="resume-section resume-section-content">
                <div class="resume-section__left">
                  Acerca de:
                </div>
                <?php the_content(  ); ?>
              </div>
              <div class="resume-section">
                <div class="resume-section__left">
                  Horario laboral:
                </div>
                <p class="resume-section__right">
                  <?php echo wp_kses_post ( $datos_empresa['horario_de_atencion'] ); ?> 
                </p>
              </div>
              <div class="resume-section">
                <div class="resume-section__left">
                  Dirección:
                </div>
                <p class="resume-section__right">
                  <?php echo esc_html( $datos_empresa['direccion'] ); ?>
                </p>
              </div>
              <div class="resume-section">
                <div class="resume-section__left">
                  Correo:
                </div>
                <p class="resume-section__right">
                  <a href="<?php echo esc_url( 'mailto:' . antispambot( $datos_empresa['correo'] ) ); ?>">
                    <?php echo esc_html( antispambot( $datos_empresa['correo'] ) ); ?>
                  </a>
                </p>
              </div>
              <div class="resume-section">
                <div class="resume-section__left">
                  Teléfono:
                </div>
                <p class="resume-section__right">
                  <?php echo esc_html( $datos_empresa['telefono'] ); ?>
                </p>
              </div>
              <div class="resume-section">
                <div class="resume-section__left">
                  Redes sociales:
                </div>
                <div class="resume-section__right">
                  <a href="<?php echo esc_url( $redes_sociales['facebook'] ); ?>" target="_blank"> 
                    Facebook
                  </a>
                  <a href="<?php echo esc_url( $redes_sociales['instagram'] ); ?>" target="_blank"> 
                    Instagram
                  </a>
                  <a href="<?php echo esc_url( $redes_sociales['twitter'] ); ?>" target="_blank"> 
                    Twitter
                  </a>
                  <a href="<?php echo esc_url( $redes_sociales['youtube'] ); ?>" target="_blank"> 
                    Youtube
                  </a>
                </div>
              </div>
            </div>
            <div class="col-12 col-md-6 col-lg-5 mt-4 mt-md-0 cs-resume-map">
              <?php the_field('direccion_en_mapa'); ?>
            </div>
          </div>
        </div>
        <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
          <div class="row">
            <?php 
                comments_template();
            ?>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php 
    }
  }
?>

</main>

<?php get_footer(); ?>