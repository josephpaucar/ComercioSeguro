<?php 

function init_template(){

    add_theme_support('post-thumbnails');
    add_theme_support('title-tag');

    register_nav_menus(
        array(
            'top_menu' => 'Menú Principal'
        )
    );

}

add_action( 'after_setup_theme', 'init_template');

function assets(){

  wp_register_style( 'bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css', '', '5.3.2', 'all');
  wp_register_style( 'quicksand', 'https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;700&display=swap','','1.0','all');
  wp_register_style( 'nunito', 'https://fonts.googleapis.com/css2?family=Nunito:wght@200&display=swap','','1.0', 'all');
  wp_register_style( 'amatic', 'https://fonts.googleapis.com/css2?family=Amatic+SC:wght@700&display=swap','','1.0', 'all');

  wp_enqueue_style('estilos', get_stylesheet_uri(), array('bootstrap', 'quicksand', 'nunito', 'amatic'), '1.0', 'all');

  wp_register_script( 'popper', 'https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js', '', '2.11.8', true );

  wp_enqueue_script( 'boostrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js', array('popper'), '5.3.2', true );

  wp_enqueue_script( 'custom', get_template_directory_uri(  ).'/assets/js/custom.js', '', '1.0', true );
}

add_action( 'wp_enqueue_scripts', 'assets' );


function add_additional_class_on_li($classes, $item, $args) {
  if(isset($args->add_li_class)) {
      $classes[] = $args->add_li_class;
  }
  return $classes;
}
add_filter('nav_menu_css_class', 'add_additional_class_on_li', 1, 3);

function add_link_atts($atts) {
  $atts['class'] = "nav-link";
  return $atts;
}
add_filter( 'nav_menu_link_attributes', 'add_link_atts');

function sidebar() {
  register_sidebar( 
    array(
      'name' => 'Pie de página',
      'id' => 'footer',
      'description' => 'Zona de Widgets para pie de página',
      'before_title' => '<h2>',
      'after_title' => '</h2>',
      'before_widget' => '<div id="%1$s" class="%2$s">',
      'after_widget' => '</div>'
    )
  );
}

add_action( 'widgets_init', 'sidebar' );
