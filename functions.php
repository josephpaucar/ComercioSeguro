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
  wp_register_style( 'nunito', 'https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600&display=swap','','1.0', 'all');
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

function create_comercios_cpt() {

  $labels = array(
    'name'                => _x( 'Comercios', 'Post Type General Name', 'comercioseguro' ),
    'singular_name'       => _x( 'Comercio', 'Post Type Singular Name', 'comercioseguro' ),
    'menu_name'           => __( 'Comercios', 'comercioseguro' ),
    'parent_item_colon'   => __( 'Comercio Padre', 'comercioseguro' ),
    'all_items'           => __( 'Todos los Comercios', 'comercioseguro' ),
    'view_item'           => __( 'Ver Comercio', 'comercioseguro' ),
    'add_new_item'        => __( 'Añadir nuevo Comercio', 'comercioseguro' ),
    'add_new'             => __( 'Añadir nuevo', 'comercioseguro' ),
    'edit_item'           => __( 'Editar Comercio', 'comercioseguro' ),
    'update_item'         => __( 'Actualizar Comercio', 'comercioseguro' ),
    'search_items'        => __( 'Buscar Comercio', 'comercioseguro' ),
    'not_found'           => __( 'Comercio No encontrado', 'comercioseguro' ),
    'not_found_in_trash'  => __( 'Comercio No encontrado en Papelera', 'comercioseguro' ),
    'add_new_item'             => __( 'Añadir nuevo Comercio', 'comercioseguro' ),
    'new_item'                 => __( 'Nuevo Comercio', 'comercioseguro' ),
    'view_items'               => __( 'Ver Comercios', 'comercioseguro' ),
    'archives'                 => __( 'Archivos de Comercios', 'comercioseguro' ),
    'attributes'               => __( 'Atributos de Comercio', 'comercioseguro' ),
    'insert_into_item'         => __( 'Insertar en Comercio', 'comercioseguro' ),
    'uploaded_to_this_item'    => __( 'Cargar a este Comercio', 'comercioseguro' ),
    'featured_image'           => __( 'Imagen Destacada', 'comercioseguro' ),
    'set_featured_image'       => __( 'Establecer Imagen Destacada', 'comercioseguro' ),
    'remove_featured_image'    => __( 'Remover Imagen Destacada', 'comercioseguro' ),
    'use_featured_image'       => __( 'Usar como Imagen Destacada', 'comercioseguro' ),
    'filter_items_list'        => __( 'Filtrar Lista de Comercios', 'comercioseguro' ),
    'filter_by_date'           => __( 'Filtrar por Fecha', 'comercioseguro' ),
    'items_list_navigation'    => __( 'Lista de Navegación de Comercios', 'comercioseguro' ),
    'items_list'               => __( 'Lista de Comercios', 'comercioseguro' ),
    'item_published'           => __( 'Comercio Publicado.', 'comercioseguro' ),
    'item_published_privately' => __( 'Comercio Publicado de forma privada.', 'comercioseguro' ),
    'item_reverted_to_draft'   => __( 'Comercio convertido a Borrador.', 'comercioseguro' ),
    'item_scheduled'           => __( 'Comercio Programado.', 'comercioseguro' ),
    'item_updated'             => __( 'Comercio Cargado.', 'comercioseguro' ),
    'item_link'                => __( 'Enlace al Comercio', 'comercioseguro' ),
    'item_link_description'    => __( 'Un enlace al Comercio.', 'comercioseguro' ),
  );
    
  $args = array(
      'label'               => __( 'comercios', 'comercioseguro' ),
      'description'         => __( 'Comercios afiliados a la plataforma', 'comercioseguro' ),
      'labels'              => $labels,
      // Features this CPT supports in Post Editor
      'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
      'taxonomies'          => array( 'categoria' ),
      'hierarchical'        => false,
      'public'              => true,
      'show_ui'             => true,
      'show_in_menu'        => true,
      'show_in_nav_menus'   => true,
      'show_in_admin_bar'   => true,
      'menu_position'       => 5,
      'menu_icon'           => 'dashicons-store',
      'rewrite'               => array( 'slug' => 'comercios' ),
      'query_var'             => true,
      'can_export'          => true,
      'delete_with_user'      => false,
      'has_archive'         => true,
      'exclude_from_search' => false,
      'publicly_queryable'  => true,
      'capability_type'     => 'post',
      'show_in_rest' => true,

  );

  register_post_type( 'comercios', $args );

}

add_action( 'init', 'create_comercios_cpt' );
  
function create_comercios_taxonomy() {
  
  $labels = array(
    'name' => _x( 'Categorias', 'taxonomy general name' ),
    'singular_name' => _x( 'Categoria', 'taxonomy singular name' ),
    'search_items' =>  __( 'Buscar Categorias' ),
    'popular_items' => __( 'Categorias Populares' ),
    'all_items' => __( 'Todas las Categorias' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Editar Categoria' ), 
    'update_item' => __( 'Actualizar Categoria' ),
    'add_new_item' => __( 'Añadir nueva Categoria' ),
    'new_item_name' => __( 'Nuevo Nombre de Categoria' ),
    'separate_items_with_commas' => __( 'Separar Categorias con coma' ),
    'add_or_remove_items' => __( 'Añadir o Eliminar Categoria' ),
    'choose_from_most_used' => __( 'Elegir entre las categorias más utilizadas' ),
    'menu_name' => __( 'Categorias' ),
  ); 
  
// Now register the non-hierarchical taxonomy like tag
  $args = array(
    'hierarchical' => false,
    'labels' => $labels,
    'show_ui' => true,
    'show_in_rest' => true,
    'show_admin_column' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'categoria' ),
  );

  register_taxonomy('categorias', 'comercios', $args);
}

add_action( 'init', 'create_comercios_taxonomy', 0 );