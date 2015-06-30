<?php
/** ==============================================================================================================
 *                                       Constantes y variables Globales
 *  ==============================================================================================================
 */
define( 'JSPATH', get_template_directory_uri() . '/js/' );
define( 'BLOGURL', get_home_url('/') );
define( 'THEMEURL', get_bloginfo('template_url').'/' );


/**
 * Hook que crea las paginas especificas o especiales de manera automatica
 *
 * Key: slug de la pagina
 * Value: nombre de la pagina especial
 *
 */

add_action('init', function(){

/**
 * Array de paginas especificas o especiales
 * Key: slug de la pagina especial
 * Value: nombre de la pagina especial
 *
 */

$GLOBALS['special_pages'] = array(
		'nosotros' => 'Nosotros',
		'ajax-mail' => 'Ajax para enviar mails'
	);

	foreach ($GLOBALS['special_pages'] as $slug => $name) {

		$args = array(
		 'name'        => $slug,
		 'post_type'   => 'page',
		 'post_status' => 'publish',
		 'numberposts' => 1
		);

		if( !get_posts($args) ){ // busca la paginas por slug y si no las encuetra las crea

			$page = array(
			'post_author'  => 1,
			'post_status'  => 'publish',
			'post_name' => $slug,
			'post_title'   => $name,
			'post_type'    => 'page'
			);

			wp_insert_post( $page, true );
		}
	}

});

/** ==============================================================================================================
 *                                       Inluye los archivos generarles
 *  ==============================================================================================================
 */
// ---------------- scripts
// Contiene la llamada de los archivos functions.js y admin-functions.js asi como inclucion de valiables java

include_once('functions/general-scripts_js.php');

// ---------------- funciones cltvo
// Contiene las funciones generales del cultivo que son independeites de cada proyecto

include_once('functions/general-functions_cltvo.php');

// ---------------- flitros cltvo
// Contiene los filtros generales del cultivo que son independeites de cada proyecto

include_once('functions/general-filters_cltvo.php');




/** ==============================================================================================================
 *                                       Inluye los archivos de admin
 *  ==============================================================================================================
 */

// ---------------- personaizacion del menu
// Contiene las funciones para personalizar el menu del admin

include_once('functions/admin-menu.php');

// ---------------- imagenes de tamaños y opcciones personalizadas
// Contiene la funciones para personalizar los tamaños de la imagenes

include_once('functions/admin-images.php');

// ---------------- post type y taxonimias
// Contiene el registro de tipos de post persializados y configuracion del editor de los mismos

include_once('functions/admin-post_type.php');

// Contiene el registro de taxonomias personalizadas

include_once('functions/admin-taxonomies.php');

// ---------------- meta boxes y save post
// Contiene la inclucion de las metaboxes asi como las funciones del save post

include_once('functions/admin-metabox_savepost.php');


/** ==============================================================================================================
 *                                         Inluye los archivos del tema
 *  ==============================================================================================================
 */

// ---------------- funciones del menu
// Contiene el menú del sitio y sus funciones

include_once('functions/theme-menu.php');

// ---------------- filtros del tema
// Contiene los filtros específicos del tema

include_once('functions/theme-filters.php');

// ---------------- funciones del tema
// Contiene los funciones específicas del tema

include_once('functions/theme-functions.php');



?>
