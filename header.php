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
    <div class="container-fluid container-md">
      <div class="row py-2 align-items-center cs-header-top">
        <div class="col-12 col-md-3 col-lg-2 d-flex align-items-center justify-content-start">
          <a class="navbar-brand" href="<?php echo get_home_url( ); ?>">
            <img src="<?php echo get_template_directory_uri() ?>/assets/img/logo.png" alt="Logo" class="d-inline-block align-text-top">
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
        <div class="d-none col-md-9 col-lg-10 d-md-flex justify-content-end align-items-center">
          <?php dynamic_sidebar('header'); ?>
        </div>
      </div>
      <div class="d-none d-md-block cs-lg-menu">
        <nav class="navbar navbar-expand-md">
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
    </div>

    <nav id="cs-mobile-navigation" class="cs-mobile-navigation d-md-none" data-visible="false">
      <div class="mb-4 cs-mobile-header-top d-flex flex-column-reverse">
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
    </nav>
  </header>