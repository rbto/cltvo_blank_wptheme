<?php

abstract class Cltvo_metabox_master implements Cltvo_metabox_interface{

	protected $meta_key;
	protected $meta_value;

	private $id_metabox;
	protected $description_metabox;
	protected $post_type = "post";
	protected $position = "normal";
	protected $prioridad = "default";
	protected $ags = null;


	function __construct(){

		$this->meta_key = $this->GetMetaKey();
		$this->id_metabox = $this->meta_key."_mb";

		if ($this->metaboxDisplayRule()) {
			$this->CltvoMetaBox();
		}

		$this->CltvoSaveMetaValue();
	}

	/**
	 * Agrega el hook que coloca el meta en el admin
	 */
	public function CltvoMetaBox(){
		add_action( 'add_meta_boxes', function(){
			add_meta_box(
				$this->id_metabox,		//id
				$this->description_metabox, //título
				function($object){
					$this->meta_value = $this->getMetaValue($object);
					$this->CltvoDisplayMetabox($object);
				},		//callback function
				$this->post_type,			//post type
				$this->position,						//posición
				$this->prioridad
			);
		} ); // agrega las metabox
	}

	/**
	 * guarda el valor del metabox
	 */
	public function CltvoSaveMetaValue(){

		add_action( 'save_post', function($id){

			if( !current_user_can('edit_post', $id) ) return $id;

			// Vs Autosave
			if( defined('DOING_AUTOSAVE') AND DOING_AUTOSAVE ) return $id;
			if( wp_is_post_revision($id) OR wp_is_post_autosave($id) ) return $id;

			// ---------------------- salva el meta box ----------------------

			if( isset( $_POST[ $this->meta_key ] ) ) {

			    update_post_meta( $id, $this->meta_key , $_POST[ $this->meta_key ] );
			}

		} ); // guarda el valor de las metabox
	}

	/**
	* define el metodo donde se mostrara el meta
	* @return boolean si es verdadero el meta sera desplegado en el admin en caso constrario no
	*/
	public static function metaboxDisplayRule(){
		return true;
	}

	/**
	 * define el metodo que inicializa el valor del meta
	 */
	public static function setMetaValue($meta_value){
		return $meta_value;
	}

	/**
	 * regresa el el valor del meta inicializado para un post
	 * @param object $object en principio es un objeto de WP_post
	 * @return string|array valor del meta inicalizado
	 */
	public static function getMetaValue($object){
		return static::setMetaValue(
			get_post_meta($object->ID, static::GetMetaKey(), true)
		);;
	}



	/**
	 * Es la funcion que muestra el contenido del metabox
	 * @param object $object en principio es un objeto de WP_post
	 */
	abstract public function CltvoDisplayMetabox( $object );

	/**
	 * define el meta key
	 */
	abstract static function GetMetaKey();

}
