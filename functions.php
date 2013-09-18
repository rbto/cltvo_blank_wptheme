<?php

define( 'JSPATH', get_template_directory_uri() . '/js/' );
define( 'BLOGURL', get_home_url('/') );
define( 'THEMEURL', get_bloginfo('template_url').'/' );

add_theme_support( 'post-thumbnails' );
add_action( 'init', 'cltvo_posttypes' );
add_action( 'init', 'cltvo_custom_tax' );
add_action( 'add_meta_boxes', 'cltvo_metaboxes' );
add_action( 'save_post', 'cltvo_save_post' );
add_action( 'wp_enqueue_scripts', 'cltvo_js' );



/*	SCRIPTS
	-------
*/

function cltvo_js(){
	wp_register_script('cltvo_functions_js', JSPATH.'functions.js', array('jquery'), false, true );

	$php2js_vars = array(
		'site_url'     => home_url('/'),
		'template_url' => get_bloginfo('template_url')
	);
	wp_localize_script( 'cltvo_functions_js', 'php2js_vars', $php2js_vars );
	
	
	if( !is_admin() ){
		wp_enqueue_script('jquery');
		wp_enqueue_script('cltvo_functions_js');
	}	
}



/*	TIPOS DE POSTS
	--------------
*/

function cltvo_posttypes(){
	//Nombre del posttype!
	// $args = array(
	// 	'label' => 'Artistas',
	// 	'public' => true,
	// 	'rewrite' => array( 'slug' => 'artistas' ),
	// 	'has_archive' => true,
	// 	'supports' => array( 'title', 'editor', 'thumbnail' )
	// );
	// register_post_type( 'inter_artistas_pt', $args );
}



/*	TAXONOMÍAS
	----------
*/
	
function cltvo_custom_tax(){
	//Nombre de la taxonomía
	// $argumentos = array(
	// 	'labels' => array(
	// 		'name'			=> 'Secciones',
	// 		'add_new_item'	=> 'Nueva Sección',
	// 		'parent_item'	=> 'Sección madre'
	// 	),
	// 	'hierarchical' => true
	// );
	
	// register_taxonomy(
	// 	'inter_seccion_tax',
	// 	'inter_activi_pt',
	// 	$argumentos
	// );	
}



/*	META CAJAS
	----------
*/
	
function cltvo_metaboxes(){
	// add_meta_box(
	// 	'inter_descripcion_mb',
	// 	'Descripción',
	// 	'inter_descripcion_mb',
	// 	'inter_activi_pt',
	// 	'side'
	// );
	// add_meta_box(
	// 	'inter_colaborador_mb',
	// 	'Colaborador',
	// 	'inter_colaborador_mb',
	// 	'inter_colabora_pt',
	// 	'side'
	// );
}

// function inter_descripcion_mb($object){
// 	echo '<p><input type="checkbox" name="inter_descripcion_in" ';
// 	if( get_post_meta($object->ID, 'inter_descripcion_meta') )echo "checked";
// 	echo '> Descripción de sección</p>';
// }
// function inter_colaborador_mb($object){
// 	echo '<p><label>Nombre del colaborador:</label></p>';
// 	echo '<input name="inter_colaborador_in" type="text" value="';
// 	echo get_post_meta($object->ID, 'inter_colaborador_meta', true);
// 	echo '" />';
// }



/*	AL GUARDAR EL POST
	------------------
*/
	
function cltvo_save_post($id){
	// Permisos
	if( !current_user_can('edit_post', $id) ) return $id;

	// Vs Autosave
	if( defined('DOING_AUTOSAVE') AND DOING_AUTOSAVE ) return $id;
	if( wp_is_post_revision($id) OR wp_is_post_autosave($id) ) return $id;

	// Cultiva Código...
}


/*	FUNCIONES DEL TEMA
	------------------
*/

?>