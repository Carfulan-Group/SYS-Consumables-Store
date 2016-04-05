<?php
get_header ();

// // //
// check if user is logged in
// // //
if (is_user_logged_in ())
{
    ?>

    <?php

        // // //
        // get user id
        // // //
        $groups_user = new Groups_User( get_current_user_id() );

        // // //
        // if users has access to My Consumables group
        // // //
        if ( $groups_user->can( 'My Consumables' ) )
        {
            echo "<h1 class='page-title'>Hello " . $current_user->user_firstname
                 . ", here's a list of compatible products:</h1>";
            ?>
        <span class="user-groups"><?php
            get_available_machines_options($type = 'comma');
        ?></span>
        <section id="home-products" class="vertical-padding-large">
            <?php wc_print_notices (); ?>
            <div class="home-cat-selector">
                <ul>
                    <li class="active" onclick="catSelect(this)" data-tab="all-cats">All</li>
                    <li onclick="catSelect(this)" data-tab="model-cat">Model Materials</li>
                    <li onclick="catSelect(this)" data-tab="support-cat">Support</li>
                    <li onclick="catSelect(this)" data-tab="hardware-cat">Hardware</li>
                </ul>
            </div>
            <div class="home-search">
                <select class="home-search-select">
                    <option selected="selected" value="0">Filter By Machine</option>
                </select>
                <input type="text" placeholder="Search" onkeyup="itemSearch(this)">
            </div>
            <div class="home-cat-container">
                <div class="home-cat all-cats model-cat">
                    <h2>Model Materials</h2>
                    <?php echo do_shortcode ( '[product_category category="model material" per_page="-1"]' ); ?>
                </div>
                <div class="home-cat all-cats support-cat">
                    <h2>Support Materials</h2>
                    <?php echo do_shortcode ( '[product_category category="support material" per_page="-1"]' ); ?>
                </div>
                <div class="home-cat all-cats hardware-cat">
                    <h2>Printing Hardware</h2>
                    <?php echo do_shortcode ( '[product_category category="hardware" per_page="-1"]' ); ?>
                </div>
            </div>
            <?php
        }

        // // //
        // if user account has not been set up yet
        // // //
        else
        {
            echo "<h1 class='page-title'>Hello " . $current_user->user_firstname . "</h1>";
            wc_print_notices ();
            ?>
                <section id="home-products" class="vertical-padding-large">
                    <p>Our team is busy tailoring your account to your needs and equipment. You will be alerted when we are done, thank you for your patience.</p>

                    <p>While you're waiting, why not finish setting up your account <a href="<?php echo site_url(); ?>/my-account/edit-address/billing/">here.</a></p>
                    <?php
        }
        ?>
                </section>
                <?php
}

// // //
// if user isn't logged in
// // //
else
{
    ?>
                    <h1 class="page-title">SYS Systems Consumables Store</h1>
                    <section id="home-login" class="vertical-padding-large">
                        <?php
        echo do_shortcode ( '[woocommerce_my_account]' );
        ?>
                    </section>
                    <?php
}


get_footer ();
?>
