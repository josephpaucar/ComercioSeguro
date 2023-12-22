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
  wp_register_style( 'quicksand', 'https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap','','1.0','all');
  wp_register_style( 'nunito', 'https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600&display=swap','','1.0', 'all');
  wp_register_style( 'amatic', 'https://fonts.googleapis.com/css2?family=Amatic+SC:wght@700&display=swap','','1.0', 'all');

  wp_enqueue_style('estilos', get_stylesheet_uri(), array('bootstrap', 'quicksand', 'nunito', 'amatic'), '1.0', 'all');

  wp_register_script( 'popper', 'https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js', '', '2.11.8', true );

  wp_enqueue_script( 'boostrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js', array('popper'), '5.3.2', true );

  wp_enqueue_script( 'custom', get_template_directory_uri(  ).'/assets/js/custom.js', '', '1.0', true );
  
  wp_localize_script( 'custom', 'cs', array(
    'ajaxurl' => admin_url( 'admin-ajax.php' ),
    'nonce' 	=> wp_create_nonce( 'prefix_public_nonce' ),
  ));
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

function header_search() {
  register_sidebar( 
    array(
      'name' => 'Header Search',
      'id' => 'header',
      'description' => 'Zona de Widgets para el header',
      'before_title' => '<h2>',
      'after_title' => '</h2>',
      'before_widget' => '<div id="%1$s" class="%2$s">',
      'after_widget' => '</div>'
    )
  );
}

add_action( 'widgets_init', 'header_search' );

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

function filter_widget() {
  register_sidebar( 
    array(
      'name' => 'Filtros',
      'id' => 'filtros',
      'description' => 'Zona de Widgets para filtrar Comercios',
      'before_title' => '<h2>',
      'after_title' => '</h2>',
      'before_widget' => '<div id="%1$s" class="%2$s">',
      'after_widget' => '</div>'
    )
  );
}

add_action( 'widgets_init', 'filter_widget' );

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


function pagination_bar() {
  global $wp_query;

  $total_pages = $wp_query->max_num_pages;

  if ($total_pages > 1){
      $current_page = max(1, get_query_var('paged'));

      echo paginate_links(array(
          'base' => get_pagenum_link(1) . '%_%',
          'format' => '/page/%#%',
          'current' => $current_page,
          'total' => $total_pages,
      ));
  }
}

// Custom Breadcrumb Navigation Function
function the_breadcrumb() {
  $showOnHome = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
  $delimiter = '&raquo;'; // delimiter between crumbs
  $home = 'Home'; // text for the 'Home' link
  $showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
  $before = '<span class="current">'; // tag before the current crumb
  $after = '</span>'; // tag after the current crumb

  global $post;
  $homeLink = get_bloginfo('url');
  if (is_home() || is_front_page()) {
      if ($showOnHome == 1) {
          echo '<div id="crumbs"><a href="' . $homeLink . '">' . $home . '</a></div>';
      }
  } else {
      echo '<div id="crumbs"><a href="' . $homeLink . '">' . $home . '</a> ' . $delimiter . ' ';
      if (is_category()) {
          $thisCat = get_category(get_query_var('cat'), false);
          if ($thisCat->parent != 0) {
              echo get_category_parents($thisCat->parent, true, ' ' . $delimiter . ' ');
          }
          echo $before . 'Archive by category "' . single_cat_title('', false) . '"' . $after;
      } elseif (is_search()) {
          echo $before . 'Search results for "' . get_search_query() . '"' . $after;
      } elseif (is_day()) {
          echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
          echo '<a href="' . get_month_link(get_the_time('Y'), get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
          echo $before . get_the_time('d') . $after;
      } elseif (is_month()) {
          echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
          echo $before . get_the_time('F') . $after;
      } elseif (is_year()) {
          echo $before . get_the_time('Y') . $after;
      } elseif (is_single() && !is_attachment()) {
          if (get_post_type() != 'post') {
              $post_type = get_post_type_object(get_post_type());
              $slug = $post_type->rewrite;
              echo '<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a>';
              if ($showCurrent == 1) {
                  echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
              }
          } else {
              $cat = get_the_category();
              $cat = $cat[0];
              $cats = get_category_parents($cat, true, ' ' . $delimiter . ' ');
              if ($showCurrent == 0) {
                  $cats = preg_replace("#^(.+)\s$delimiter\s$#", "$1", $cats);
              }
              echo $cats;
              if ($showCurrent == 1) {
                  echo $before . get_the_title() . $after;
              }
          }
      } elseif (!is_single() && !is_page() && get_post_type() != 'post' && !is_404()) {
          $post_type = get_post_type_object(get_post_type());
          echo $before . $post_type->labels->singular_name . $after;
      } elseif (is_attachment()) {
          $parent = get_post($post->post_parent);
          $cat = get_the_category($parent->ID);
          $cat = $cat[0];
          echo get_category_parents($cat, true, ' ' . $delimiter . ' ');
          echo '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a>';
          if ($showCurrent == 1) {
              echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
          }
      } elseif (is_page() && !$post->post_parent) {
          if ($showCurrent == 1) {
              echo $before . get_the_title() . $after;
          }
      } elseif (is_page() && $post->post_parent) {
          $parent_id  = $post->post_parent;
          $breadcrumbs = array();
          while ($parent_id) {
              $page = get_page($parent_id);
              $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
              $parent_id  = $page->post_parent;
          }
          $breadcrumbs = array_reverse($breadcrumbs);
          for ($i = 0; $i < count($breadcrumbs); $i++) {
              echo $breadcrumbs[$i];
              if ($i != count($breadcrumbs)-1) {
                  echo ' ' . $delimiter . ' ';
              }
          }
          if ($showCurrent == 1) {
              echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
          }
      } elseif (is_tag()) {
          echo $before . 'Posts tagged "' . single_tag_title('', false) . '"' . $after;
      } elseif (is_author()) {
          global $author;
          $userdata = get_userdata($author);
          echo $before . 'Articles posted by ' . $userdata->display_name . $after;
      } elseif (is_404()) {
          echo $before . 'Error 404' . $after;
      }
      if (get_query_var('paged')) {
          if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author()) {
              echo ' (';
          }
          echo __('Page') . ' ' . get_query_var('paged');
          if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author()) {
              echo ')';
          }
      }
      echo '</div>';
  }
} // end the_breadcrumb()
