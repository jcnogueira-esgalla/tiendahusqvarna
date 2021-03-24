<?php

/**

 * Checkout coupon form

 *

 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-coupon.php.

 *

 * HOWEVER, on occasion WooCommerce will need to update template files and you

 * (the theme developer) will need to copy the new files to your theme to

 * maintain compatibility. We try to do this as little as possible, but it does

 * happen. When this occurs the version of the template file will be bumped and

 * the readme will list any important changes.

 *

 * @see https://docs.woocommerce.com/document/template-structure/

 * @package WooCommerce/Templates

 * @version 3.4.4

 */



defined( 'ABSPATH' ) || exit;



if ( ! wc_coupons_enabled() ) { // @codingStandardsIgnoreLine.

	return;

}



?>



<div class="row ">

    <div class="col-12 col-xl-6 mt-4">

        <div class="p-3 p-md-4 bg-light mb-3 mb-md-4">

            <div class="woocommerce-form-coupon-toggle fs-1-2">

                <?php

                    echo esc_html__( 'Have a coupon?', 'woocommerce' );

                     echo '<a href="#" class="c-1 td-u font-weight-bold showcoupon d-ib ml-5">' . esc_html__( 'Click here to enter your code', 'woocommerce' ) . '</a>';

                ?>

            </div>

            <form class="checkout_coupon woocommerce-form-coupon d-n" method="post">

                <div class="d-flex justify-content-between align-items-center fs-1 w-100 mt-3">

    				<!--<div class="mb-10"><?php //esc_html_e( 'If you have a coupon code, please apply it below.', 'woocommerce' ); ?></div>-->

    				<div class="form-row form-row-first w-50 pr-3">

    					<input type="text" name="coupon_code" class="input-text w-100" placeholder="<?php esc_attr_e( 'Coupon code', 'woocommerce' ); ?>" id="coupon_code" value="" />

    				</div>

    				<div class="form-row form-row-last w-50 pl-3">

    					<button type="submit" class="button btn btn-primary w-100" name="apply_coupon" value="<?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?>"><?php esc_html_e( 'Apply coupon', 'woocommerce' ); ?></button>

    				</div>

                </div>

			</form>

        </div>

    </div>

</div>

