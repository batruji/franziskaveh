<?php

/**
 * Class Toolset_Shortcode_Attr_Item_M2M
 *
 * Adds support for m2m relationships, e.g. "@departure.airport"
 *
 * @since m2m
 */
class Toolset_Shortcode_Attr_Item_M2M extends Toolset_Shortcode_Attr_Item_Id {
	/**
	 * @var Toolset_Shortcode_Attr_Interface
	 */
	private $chain_link;

	/**
	 * @var Toolset_Relationship_Service
	 */
	private $service_relationship;

	/**
	 * Toolset_Shortcode_Attr_Item_M2M constructor.
	 *
	 * @param Toolset_Shortcode_Attr_Interface $chain_link
	 * @param Toolset_Relationship_Service $service
	 */
	public function __construct( Toolset_Shortcode_Attr_Interface $chain_link, Toolset_Relationship_Service $service ) {
		$this->chain_link           = $chain_link;
		$this->service_relationship = $service;
	}

	/**
	 * @param array $data
	 *
	 * @return $this|int ->chain_link->get();
	 */
	public function get( array $data ) {
		if( ! apply_filters( 'toolset_is_m2m_enabled', false ) ) {
			// m2m disabled
			return $this->chain_link->get( $data );
		}

		if ( ! $item = $this->handle_attr_synonyms( $data ) ) {
			return $this->chain_link->get( $data );
		}

		global $post;

		if ( ! is_object( $post )
		     || ! property_exists( $post, 'ID' )
		     || ! property_exists( $post, 'post_type' )
		) {
			// no post = no association
			return $this->chain_link->get( $data );
		}

		// example of user request string: @appointment.doctor
		if ( substr( $item, 0, 1 ) !== '@' || strpos( $item, '.' ) === false ) {
			// no m2m assocation
			return $this->chain_link->get( $data );
		}

		$parts = explode( '.', substr( $item, 1 ) );

		// Following three variables are needed to get the requested data
		$request_role_name    = $parts[1];
		$request_relationship = $this->service_relationship->find_by_string( $parts[0] );

		if ( ! $request_relationship ) {
			return false;
		};

		// check if parent is requested
		if ( $id = $this->get_parent_id( $request_relationship, $request_role_name, $post ) ) {
			return $this->return_single_id( $id );
		}

		// no parent, check if child is requested
		if ( $id = $this->get_child_id( $request_relationship, $request_role_name, $post ) ) {
			return $this->return_single_id( $id );
		}


		// no child, check if intermediary is requested
		if ( $id = $this->get_intermediary_id( $request_relationship, $request_role_name, $post ) ) {
			return $this->return_single_id( $id );
		}

		return false;
	}

	/**
	 * @param $request_relationship
	 * @param $request_role_name
	 * @param $post
	 *
	 * @return array|bool|mixed
	 */
	private function get_parent_id( $request_relationship, $request_role_name, $post ) {
		$parent_types = $request_relationship->get_parent_type()->get_types();

		if ( $request_role_name == 'parent' && count( $parent_types ) == 1 ) {
			// 'parent' is used as item slug, only works if there is just one parent type
			$request_role_name = current( $parent_types );
		}

		if ( array_key_exists( $request_role_name, $parent_types )
		     || in_array( $request_role_name, $parent_types )
		) {
			$parent_id = $this->service_relationship->find_parent_id_by_relationship_and_child_id(
				$request_relationship,
				$post->ID,
				$request_role_name
			);

			return $this->return_single_id( $parent_id );
		}

		return false;
	}

	/**
	 * @param $request_relationship
	 * @param $request_role_name
	 * @param $post
	 *
	 * @return array|bool|mixed
	 */
	private function get_child_id( IToolset_Relationship_Definition $request_relationship, $request_role_name, $post ) {
		$child_types = $request_relationship->get_child_type()->get_types();

		if ( $request_role_name == 'child' && count( $child_types ) == 1 ) {
			// 'child' is used as item slug, only works if there is just one child type
			$request_role_name = current( $child_types );
		}

		if ( array_key_exists( $request_role_name, $child_types )
		     || in_array( $request_role_name, $child_types )
		) {
			$child_id = $this->service_relationship->find_child_id_by_relationship_and_parent_id(
				$request_relationship,
				$post->ID,
				$request_role_name
			);

			return $this->return_single_id( $child_id );
		}
	}

	/**
	 * @param $request_relationship
	 * @param $request_role_name
	 * @param $post
	 *
	 * @return bool|int
	 */
	private function get_intermediary_id( IToolset_Relationship_Definition $request_relationship, $request_role_name, $post ) {
		if ( $request_role_name != 'association'
		     && $request_role_name != $request_relationship->get_driver()->get_intermediary_post_type()
		) {
			return false;
		}

		$parent_types = $request_relationship->get_parent_type()->get_types();
		$child_types  = $request_relationship->get_child_type()->get_types();

		// by child post
		if ( array_key_exists( $post->post_type, $child_types )
		     || in_array( $post->post_type, $child_types )
		) {
			$one_or_more_intermediary_posts = $this->service_relationship->find_intermediary_by_relationship_and_child_id(
				$request_relationship,
				$post->ID
			);

			if( $intermediary = $this->get_single_intermediary_id( $one_or_more_intermediary_posts ) ) {
				return $intermediary;
			};
		}

		// by parent post
		if (
			array_key_exists( $post->post_type, $parent_types )
			|| in_array( $post->post_type, $parent_types )
		) {
			$one_or_more_intermediary_posts = $this->service_relationship->find_intermediary_by_relationship_and_parent_id(
				$request_relationship,
				$post->ID
			);

			if( $intermediary = $this->get_single_intermediary_id( $one_or_more_intermediary_posts ) ) {
				return $intermediary;
			};
		}

		// no unique intermediary post found
		return false;
	}

	/**
	 * @param $intermediary
	 *
	 * @return bool|int
	 */
	private function get_single_intermediary_id( $intermediary ) {
		if ( is_array( $intermediary ) && count( $intermediary ) == 1 ) {
			$intermediary = array_shift( $intermediary );
		}

		if ( ! $intermediary instanceof Toolset_Association ) {
			return false;
		}

		return $intermediary->get_intermediary_id();
	}
}