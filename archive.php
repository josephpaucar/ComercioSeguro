<?php get_header(); 
      $current_term = single_term_title( "", false );
?>

<main class="container">

  <div class="row">
    <div class="col-12">
      <h1 class="text-center text-md-start cs-page-title"><?php echo $current_term; ?></h1>
    </div>  
    <div class="col-12 col-md-2 ">
      <div class="cs-filtros d-flex flex-column align-items-center d-md-block">
        <h2>Filtros</h2>

        <?php dynamic_sidebar('filtros'); ?>
      </div>      
    </div>

    <div class="col-12 col-md-10">
      <div class="row">
      
      <?php if(have_posts(  )){
        while(have_posts()) {
          the_post(  ); ?>

        <div class="col-12 col-sm-6 col-lg-4 d-flex justify-content-center mb-5">
          <div class="card cs-card" style="width: 18rem;">
            <a href="<?php the_permalink(  ); ?>" >
              <img src="<?php the_post_thumbnail_url(); ?>" class="card-img-top object-fit-cover h-" style="height: 13rem;" alt="logo">
            </a>
            <div class="card-body text-center">
              <h4 class="card-title cs-card-title"><?php the_title(  ); ?></h4>
              <div class="d-flex justify-content-center mt-3">
                <a href="<?php the_permalink(  ); ?>" class="btn cs-link">Descubre más</a>
              </div>
            </div>
          </div>
        </div>

      <?php 
          }
        }
      ?>
      </div>

      <nav class="pagination d-flex justify-content-center">
        <?php pagination_bar(); ?>
      </nav>
    </div>
  </div>
  
</div>

</main>

<?php get_footer(); ?>