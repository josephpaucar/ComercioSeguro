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

function comercios_type() {

  $labels = array(
    
    'name' => 'Comercios',
    'singular_name' => 'Comercio',
    'menu_name' => 'Comercios',

  );

  $args = array(

    'label' => 'Comercios',
    'description' => 'Comercios afiliados',
    'labels' => $labels,
    'supports' => array('title', 'editor', 'thumbnail', 'revisions')

  );

  register_post_type( 'comercio', $args );
}

function comercios_cpt() {

  $labels = array(

     'name'                     => __( 'Comercios', 'TEXTDOMAINHERE' ),
     'singular_name'            => __( 'Comercio', 'TEXTDOMAINHERE' ),
     'add_new'                  => __( 'Añadir nuevo', 'TEXTDOMAINHERE' ),
     'add_new_item'             => __( 'Añadir nuevo Comercio', 'TEXTDOMAINHERE' ),
     'edit_item'                => __( 'Editar Comercio', 'TEXTDOMAINHERE' ),
     'new_item'                 => __( 'Nuevo Comercio', 'TEXTDOMAINHERE' ),
     'view_item'                => __( 'Ver Comercio', 'TEXTDOMAINHERE' ),
     'view_items'               => __( 'Ver Comercios', 'TEXTDOMAINHERE' ),
     'search_items'             => __( 'Buscar Comercios', 'TEXTDOMAINHERE' ),
     'not_found'                => __( 'No se encontró Comercio.', 'TEXTDOMAINHERE' ),
     'not_found_in_trash'       => __( 'No se encontró Comercio en la papelera.', 'TEXTDOMAINHERE' ),
     'parent_item_colon'        => __( 'Comercios Padre:', 'TEXTDOMAINHERE' ),
     'all_items'                => __( 'Todos los Comercios', 'TEXTDOMAINHERE' ),
     'archives'                 => __( 'Archivo de Comercios', 'TEXTDOMAINHERE' ),
     'attributes'               => __( 'Comercio Atributos', 'TEXTDOMAINHERE' ),
     'insert_into_item'         => __( 'Insertar en Comercio', 'TEXTDOMAINHERE' ),
     'uploaded_to_this_item'    => __( 'Subido a este Comercio', 'TEXTDOMAINHERE' ),
     'featured_image'           => __( 'Imagen destacada', 'TEXTDOMAINHERE' ),
     'set_featured_image'       => __( 'Insertar imagen destacada', 'TEXTDOMAINHERE' ),
     'remove_featured_image'    => __( 'Remover imagen destacada', 'TEXTDOMAINHERE' ),
     'use_featured_image'       => __( 'Usar como imagen destacada', 'TEXTDOMAINHERE' ),
     'menu_name'                => __( 'Comercios', 'TEXTDOMAINHERE' ),
     'filter_items_list'        => __( 'Filtar lista de Comercios', 'TEXTDOMAINHERE' ),
     'filter_by_date'           => __( 'Filtrar por fecha', 'TEXTDOMAINHERE' ),
     'items_list_navigation'    => __( 'Comercios Lista de navegaciòn', 'TEXTDOMAINHERE' ),
     'items_list'               => __( 'Lista de Comercios', 'TEXTDOMAINHERE' ),
     'item_published'           => __( 'Comercio publicado.', 'TEXTDOMAINHERE' ),
     'item_published_privately' => __( 'Comercio publicado de forma privada.', 'TEXTDOMAINHERE' ),
     'item_reverted_to_draft'   => __( 'Comercio guardado como borrador.', 'TEXTDOMAINHERE' ),
     'item_scheduled'           => __( 'Comercio Programado.', 'TEXTDOMAINHERE' ),
     'item_updated'             => __( 'Comercio actualizado.', 'TEXTDOMAINHERE' ),
     'item_link'                => __( 'Enlace del Comercio', 'TEXTDOMAINHERE' ),
     'item_link_description'    => __( 'Un enlace al Comercio.', 'TEXTDOMAINHERE' ),

  );

  $args = array(

     'labels'                => $labels,
     'description'           => __( 'Comercios afiliados', 'TEXTDOMAINHERE' ),
     'public'                => true,
     'hierarchical'          => false,
     'exclude_from_search'   => false,
     'publicly_queryable'    => true,
     'show_ui'               => true,
     'show_in_menu'          => true,
     'show_in_nav_menus'     => false,
     'show_in_admin_bar'     => false,
     'show_in_rest'          => true,
     'menu_position'         => 5,
     'menu_icon'             => 'dashicons-store',
     'capability_type'       => 'post',
     'capabilities'          => array(),
     'supports'              => array( 'title', 'editor', 'revisions' ),
     'taxonomies'            => array(),
     'has_archive'           => false,
     'rewrite'               => array( 'slug' => 'cpar_comercio' ),
     'query_var'             => true,
     'can_export'            => true,
     'delete_with_user'      => false,
     'template'              => array(),
     'template_lock'         => false,

  );

  register_post_type( 'comercios_cpt', $args );

}

add_action( 'init', 'comercios_cpt' );