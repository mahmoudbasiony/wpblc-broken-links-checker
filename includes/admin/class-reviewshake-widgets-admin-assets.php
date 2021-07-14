<?php
/**
 * The Reviewshake_Widgets_Admin_Assets class.
 *
 * @package Reviewshake_Widgets/Admin
 * @author  Reviewshake
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Reviewshake_Widgets_Admin_Assets' ) ) :

	/**
	 * Admin assets.
	 *
	 * Handles back-end styles and scripts.
	 *
	 * @since 1.0.0
	 */
	class Reviewshake_Widgets_Admin_Assets {
		/**
		 * The constructor.
		 *
		 * @since 1.0.0
		 *
		 * @return void
		 */
		public function __construct() {
			add_action( 'admin_enqueue_scripts', array( $this, 'scripts' ), 20 );
			add_action( 'admin_enqueue_scripts', array( $this, 'styles' ), 20 );
		}

		/**
		 * Enqueues admin scripts.
		 *
		 * @since 1.0.0
		 *
		 * @return void
		 */
		public function scripts() {
			if ( empty( $_GET['page'] ) || 'reviewshake-widgets' !== $_GET['page'] ) {
				return;
			}

			// Postscripe.
			wp_enqueue_script(
				'postscripe',
				REVIEWSHAKE_WIDGETS_ROOT_URL . 'assets/dist/vendor/postscribe/postscribe.min.js',
				array( 'jquery' ),
				REVIEWSHAKE_WIDGETS_PLUGIN_VERSION,
				true
			);

			// WP color picker alpha.
			wp_enqueue_script(
				'wp-color-picker-alpha',
				REVIEWSHAKE_WIDGETS_ROOT_URL . 'assets/dist/vendor/wp-color-picker-alpha/wp-color-picker-alpha.min.js',
				array( 'jquery', 'wp-color-picker' ),
				REVIEWSHAKE_WIDGETS_PLUGIN_VERSION,
				true
			);

			// Global admin scripts.
			wp_enqueue_script(
				'reviewshake_widgets_admin_scripts',
				REVIEWSHAKE_WIDGETS_ROOT_URL . 'assets/dist/js/admin/reviewshake-widgets-admin-scripts.min.js',
				array( 'wp-color-picker-alpha', 'postscripe' ),
				REVIEWSHAKE_WIDGETS_PLUGIN_VERSION,
				true
			);

			// Localization variables.
			wp_localize_script(
				'reviewshake_widgets_admin_scripts',
				'reviewshake_widgets_params',
				array(
					'ajax_url'       => esc_url( admin_url( 'admin-ajax.php' ) ),
					'nonce'          => wp_create_nonce( 'reviewshake-nonce' ),
					'site_url'       => esc_url( get_site_url() ),
					'wp_rest_nonce'  => wp_create_nonce( 'wp_rest' ),
					'newAccountForm' => reviewshake_render_connect_account_form(),
					'closeButton'    => esc_url( REVIEWSHAKE_WIDGETS_ROOT_URL . 'assets/dist/images/close-button.svg' ),
					'successIcon'    => esc_url( REVIEWSHAKE_WIDGETS_ROOT_URL . 'assets/dist/images/success-icon.svg' ),
					'errorIcon'      => esc_url( REVIEWSHAKE_WIDGETS_ROOT_URL . 'assets/dist/images/error-icon.svg' ),
					'translations'   => array(
						'required'           => esc_html__( 'This field is required!', 'reviewshake-widgets' ),
						'add_source_success' => array(
							'title'   => esc_html__( 'Review Source', 'reviewshake-widgets' ),
							'message' => esc_html__( 'Your review source has been added. We are currently fetching the reviews.', 'reviewshake-widgets' ),
						),
						'confirm_delete'     => esc_html__( 'Are you sure to delete this item', 'reviewshake-widgets' ),
						'another_account'    => esc_html__( 'Are you sure? This will overwrite the existing review sources and widgets', 'reviewshake-widgets' ),
					),
				)
			);
		}

		/**
		 * Enqueues admin styles.
		 *
		 * @since 1.0.0
		 *
		 * @return void
		 */
		public function styles() {
			// Css rules for Color Picker.
			wp_enqueue_style( 'wp-color-picker' );

			// Global admin styles.
			wp_enqueue_style( 'reviewshake_widgets_admin_styles', REVIEWSHAKE_WIDGETS_ROOT_URL . 'assets/dist/css/admin/reviewshake-widgets-admin-styles.min.css', array( 'wp-color-picker' ), REVIEWSHAKE_WIDGETS_PLUGIN_VERSION, 'all' );
		}
	}

	return new Reviewshake_Widgets_Admin_Assets();

endif;