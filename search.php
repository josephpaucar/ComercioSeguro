<?php
/*
Template Name: Search Page
*/
?>
<?php
get_header(); ?>

<?php 
    /* Initiate the search with the wp_query */ 
    $s = get_search_query();
    $args = array(
                    'post_type' => 'comercios',
                    'post_status' => 'publish',
                    's' => $s,
                    'posts_per_page' => 10,
                );
    // The Query
    $the_query = new WP_Query( $args );
?>

<main class="container cs-search">
  <div class="row">
    <div class="col-12">
      <h1 class="text-center text-md-start cs-page-title mb-3">Resultados de la busqueda: <?php echo get_search_query(); ?></h1>
      <?php if( $the_query->found_posts == 1 ): ?>
        <p class="text-center text-md-start subtitle">Se encontró <?php echo $the_query ->found_posts.' empresa.'; ?></p>
      <?php else: ?>
        <p class="text-center text-md-start subtitle">Se encontraron <?php echo $the_query ->found_posts.' empresas.'; ?></p>
      <?php endif; ?>
    </div>
    <div class="col-12 my-5">
      <div class="row">
        <?php if ( $the_query->have_posts() ): ?>
          <?php while ( $the_query->have_posts() ):
              $the_query->the_post(); ?>
              
            <div class="col-12 col-sm-6 col-lg-4 d-flex justify-content-center mb-5">
              <div class="card cs-card" style="width: 18rem;">
                <a href="<?php the_permalink(  ); ?>" >
                  <img src="<?php the_post_thumbnail_url(); ?>" class="card-img-top object-fit-cover h-" style="height: 13rem;" alt="logo">
                </a>
                <div class="card-body text-center d-flex flex-column justify-content-between">
                  <h4 class="card-title cs-card-title"><?php the_title(  ); ?></h4>
                  <div>
                    <a href="<?php the_permalink(  ); ?>" class="btn cs-link">Descubre más</a>
                  </div>
                </div>
              </div>
            </div>

            <?php endwhile; ?>
        <?php else: ?>
        <div class="post-card card-container order-auto not-found">
            <h2 class="mb-2">No se encontro ninguna empresa</h2>
            <a class="cs-link" href="<?php echo get_home_url( ); ?>">Volver al inicio</a>
            <div class="alert alert-info mt-4">
                <p>Lo sentimos, pero nada concuerda con tu busqueda, por favor intenta de nuevo con otras palabras.</p>
            </div>
        </div>
        <?php endif; ?>
      </div>
      
      <?php if( $the_query->found_posts > 10 ): ?>
      <nav class="pagination d-flex justify-content-center">
        <?php pagination_bar(); ?>
      </nav>
      <?php endif; ?>
    </div>
  </div>
</main>

<?php get_footer(); ?>