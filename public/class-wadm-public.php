<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://werkaandemuur.nl/
 * @since      1.0.0
 *
 * @package    Wadm
 * @subpackage Wadm/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Wadm
 * @subpackage Wadm/public
 * @author     Sander van Leeuwen <sander@werkaandemuur.nl>
 */
class Wadm_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wadm_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wadm_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wadm-public.css', [], $this->version, 'all' );

	}

	/**
	 * Parse [wadm_artlist] shorttags and insert artlists
	 */
	public function artlist_shortcode($attributesRaw)
	{
		// Parse attributes to set defaults and remove any unsupported attributes
		$attributes = shortcode_atts([
			'limit' => 12,
			'columns' => 3,
			'order' => null,
        ], $attributesRaw);

		// Fetch feed and get HTML
		$feed = new Wadm_Feed_Artlist(get_option('wadm_artist_id'));
		$feed->setPerPage($attributes['limit']);
		$feed->setColumns($attributes['columns']);

		if (isset($attributes['order']))
			$feed->setOrder($attributes['order']);

		$feedContent = null;

		try {
			$feedContent = $feed->getHtml();
		}
		catch (Exception $e)
		{
			return $this->_getError($e);
		}

		if (!$feedContent)
			return false;

		return $feedContent . $feed->getPagination();
	}


	/**
	 * Parse [wadm_album] shorttags and insert artlists
	 */
	public function album_shortcode($attributesRaw)
	{
		// Parse attributes to set defaults and remove any unsupported attributes
		$attributes = shortcode_atts([
			'albumid' => null, // Shortcode attributes are always lowercase
			'limit' => 12,
			'columns' => 3,
			'order' => null,
        ], $attributesRaw);

		if (!$attributes['albumid'])
			return false;

		// Fetch feed and get HTML
		$feed = new Wadm_Feed_Album((int)$attributes['albumid']);
		$feed->setPerPage($attributes['limit']);
		$feed->setColumns($attributes['columns']);

		if (isset($attributes['order']))
			$feed->setOrder($attributes['order']);

		$feedContent = null;

		try {
			$feedContent = $feed->getHtml();
		}
		catch (Exception $e)
		{
			return $this->_getError($e);
		}

		if (!$feedContent)
			return false;

		return $feedContent . $feed->getPagination();
	}

	/**
	 * Parse [wadm_artwork] shorttags and insert artlists
	 */
	public function artwork_shortcode($attributesRaw)
	{
		// Parse attributes to set defaults and remove any unsupported attributes
		$attributes = shortcode_atts([
			'artid' => null, // Shortcode attributes are always lowercase
        ], $attributesRaw);

		if (!$attributes['artid'])
			return false;

		// Fetch feed and get HTML
		$feed = new Wadm_Feed_Artwork((int)$attributes['artid']);
		$feedContent = null;

		try {
			$feedContent = $feed->getHtml();
		}
		catch (Exception $e)
		{
			return $this->_getError($e);
		}

		if (!$feedContent)
			return false;

		return $feedContent;
	}

	/**
	 * Get errors through this method to easily enable / disable debugging
	 */
	protected function _getError(Exception $e)
	{
		if (!Wadm::DEBUG)
			return false;

		return $e->getMessage();
	}
}
