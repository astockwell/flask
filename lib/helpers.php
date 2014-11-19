<?php
/**
 * Add Pagename Variable for Body Class paramter
 */
if (!function_exists('flask_page_name')) {
	function flask_page_name() {
		$page_classes = array();
		$page_slug = basename( get_permalink() );
		if( is_page( $page_slug ) ) {
			$page_classes[] = "pagename-" . $page_slug;
		}
		return $page_classes;
	}
}

/**
 * Truncate a string to desired length without breaking words.
 */
if (!function_exists('truncate')) {
	function truncate($string, $length, $tailing_char = '...') {
		if (strlen($string) > $length):
			$string = preg_replace('/\s+?(\S+)?$/', '', substr($string . ' ', 0, $length)) . $tailing_char;
		endif;
		return $string;
	}
}

/**
 * Retrieve WP-formatted content from a post via post ID
 */
if (!function_exists('get_the_content_by_id')) {
	function get_the_content_by_id($id) {
		$content = get_post_field('post_content', $id);
		$content = apply_filters('the_content', $content);
		$content = str_replace(']]>', ']]&gt;', $content);
		return $content;
	}
}

/**
 * Retrieve post ID via page/post slug
 */
if (!function_exists('get_post_id_from_slug')) {
	function get_post_id_from_slug($slug, $post_type = "") {
		global $wpdb;
		if ( !empty($post_type) ) {
			$post_type = $wpdb->prepare("AND post_type = '%s'", $post_type);
		} else {
			$post_type = "AND post_type not in ('nav_menu_item', 'revision')";
		}
		$id = $wpdb->get_var(
			$wpdb->prepare(
				"
					SELECT ID
					FROM $wpdb->posts
					WHERE post_name = '%s'
					$post_type
					AND post_status = 'publish'
					LIMIT 1
				",
				$slug
			)
		);
		return $id;
	}
}

/**
 * Slug-ify a string (wrapper function for WP core function)
 */
if (!function_exists('slugify')) {
	function slugify($string) {
		return sanitize_title_with_dashes($string);
	}
}

/**
 * Get everything you could want about a featured image
 */
if (!function_exists('get_featured_image')) {
	function get_featured_image($id = null) {
		if (!$id) {
			global $post;
			$id = $post->ID;

			if (!$id) return false;
		}
		return wp_prepare_attachment_for_js( get_post_thumbnail_id( $id ) );
	}
}