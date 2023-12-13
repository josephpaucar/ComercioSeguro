<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <?php wp_head() ?>
</head>
<body>
  <header>
    <div class="container">
      <div class="row align-items-center">
        <div class="col-2">
          <a class="navbar-brand" href="#">
            <img src="<?php echo get_template_directory_uri() ?>/assets/img/logo.png" alt="Logo" width="98" height="auto" class="d-inline-block align-text-top">
          </a>
        </div>
        
        <div class="col-7">
          <nav class="navbar navbar-expand-lg">
          <?php 
            wp_nav_menu( 
              array(
                'theme_location' => 'top_menu',
                'menu_class' => 'navbar-nav',
                'container_class' => 'collapse navbar-collapse justify-content-center',
                'container_id' => 'navbarNavDropdown',
                'add_li_class'  => 'nav-item'
              )
            )
          ?>
          </nav>
        </div>

        <div class="col-3 d-flex justify-content-end">
          <button type="button" class="btn cs-btn-outline">Encuentra tu negocio</button>
        </div>
      </div>
    </div>
  </header>