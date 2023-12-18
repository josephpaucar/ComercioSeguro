<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <?php wp_head() ?>
</head>
<body>
  <header class="py-2">
    <div class="container-fluid container-md">
      <div class="row">
        <div class="col-12 d-flex align-items-center justify-content-start justify-content-md-center">
          <a class="navbar-brand" href="<?php echo get_home_url( ); ?>">
            <img src="<?php echo get_template_directory_uri() ?>/assets/img/logo.png" alt="Logo" width="130" height="auto" class="d-inline-block align-text-top">
          </a>
          <div>
            <button class="d-block d-md-none hamburger-menu" aria-controls="cs-mobile-navigation" aria-expanded="false">
              <svg class="hamburger viewBox="0 0 50 50" width="50">
                <rect class="line top" width="30" height="5" x="10" y="60" rx="5"></rect>
                <rect class="line middle" width="30" height="5" x="10" y="70" rx="5"></rect>
                <rect class="line bottom" width="30" height="5" x="10" y="80" rx="5"></rect>
              </svg>
            </button>
          </div>
        </div>
        <div class="col-12 d-none d-md-block">
          <div class="row align-items-center">
            <div class="col-4 col-lg-3">
              <?php dynamic_sidebar('header'); ?>
            </div>
            <div class="col-8 col-lg-6 text-center">
              <nav class="navbar navbar-expand-md">
              <?php 
                wp_nav_menu( 
                  array(
                    'theme_location' => 'top_menu',
                    'menu_class' => 'navbar-nav',
                    'container_class' => 'collapse navbar-collapse justify-content-end justify-content-lg-center',
                    'container_id' => 'navbarNavDropdown',
                    'add_li_class'  => 'nav-item'
                  )
                )
              ?>
              </nav>
            </div>
            <div class="d-none d-lg-block col-lg-3 text-end">
              <a type="button" class="btn cs-btn-outline">Encuentra tu negocio</a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <nav id="cs-mobile-navigation" class="cs-mobile-navigation" data-visible="false">
      <div class="mb-4">
        <?php dynamic_sidebar('header'); ?>
      </div>
      <?php 
        wp_nav_menu( 
          array(
            'theme_location' => 'top_menu',
            'menu_class' => 'mobile-navbar',
            'container_class' => 'justify-content-center',
            'container_id' => 'mobile-navbar',
            'add_li_class'  => 'nav-item'
          )
        )
      ?>
      <div class="text-start mt-3">
        <a type="button" class="btn cs-btn-outline">Encuentra tu negocio</a>
      </div>
    </nav>
  </header>