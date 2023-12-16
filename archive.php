<?php get_header(); 
      $current_term = single_term_title( "", false );
      $zonas = get_field_object( 'zona' );
      $choices = $zonas['choices'];
?>

<main class="container">

  <div class="row">
    <div class="col-9">
      <h1 class="my-4 cs-page-title"><?php echo $current_term; ?></h1>
    </div>  
    <div class="col-3 d-flex align-items-center">
      <div class="cs-filtros">
        <?php dynamic_sidebar('filtros'); ?>
      </div>      
    </div>
  </div>
  
<div class="row mb-5">
<?php 
  if(have_posts(  )){
    while(have_posts()) {
      the_post(  ); ?>
      
  <div class="col-4">
    <div class="card cs-card" style="width: 18rem;">
      <a href="<?php the_permalink(  ); ?>" >
        <img src="<?php the_post_thumbnail_url(); ?>" class="card-img-top object-fit-cover h-" style="height: 13rem;" alt="logo">
      </a>
      <div class="card-body text-center">
        <h4 class="card-title cs-card-title"><?php the_title(  ); ?></h4>
        <?php the_excerpt(  ); ?>
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

</main>

<?php get_footer(); ?>