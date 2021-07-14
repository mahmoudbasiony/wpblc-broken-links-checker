<?php
/**
 * Settings - Admin - Views.
 *
 * @var array $review_sources The available review sources list
 *
 * @package Reviewshake_Widgets/Templates/Admin/Vendor
 * @author Reviewshake
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>

<div class="wrap reviewshake-review-sources-create-wrap">
	<form method="post" class="create-review-source-form" id="create_review_source_form" data-sources-count="<?php echo esc_attr( $review_source_count ); ?>" data-account-exists="<?php echo $is_account_exists ? '1' : ''; ?>" data-pricing-plan="<?php echo isset( $current_plan->pricing_plan ) ? esc_attr( $current_plan->pricing_plan ) : ''; ?>">
		<table class="form-table review-sources-table">
			<tbody>
				<tr valign="top" class="review-sources-row">
					<th class="review-sources-source-column">
						<select name="source_name" class="review-sources" id="review-sources">
							<?php if ( ! empty( $review_sources ) ) : ?>
								<option value="" disabled selected><?php esc_html_e( 'Review Source', 'reviewshake-widgets' ); ?></option>

								<?php foreach ( $review_sources as $source_key => $source ) : ?>
									<option value="<?php echo esc_attr( stripslashes( $source_key ) ); ?>" data-placeholder-url="<?php echo isset( $source['source_url'] ) ? esc_url( $source['source_url'] ) : ''; ?>"><?php echo isset( $source['source_name'] ) ? esc_html( stripslashes( $source['source_name'] ) ) : ''; ?></option>
									<?php
								endforeach;
								endif;
							?>
						</select>
					</th>

					<th class="review-sources-url-column">
						<input type="text" name="source_url" class="review-sources-url" id="review-sources-url" placeholder="" />
					</th>

					<th class="review-sources-add-column">
						<input type="submit" name="add_review_source" id="add-review-source" class="button button-primary add-review-source" value="<?php esc_html_e( 'Add', 'reviewshake-widgets' ); ?>" />
					</th>
				</tr>
			</tbody>
		</table>
	</form>
</div>
