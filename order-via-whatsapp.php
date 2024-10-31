<?php
/*
 * Plugin Name: Woocommerce Order via WhatsApp
 * Description: Plugins for woocommerce that make consumers more comfortable to buy or consult about products directly through whatsapp. Most customers have questions before buying a product and sometimes want to buy many products. and they need to be informed as soon as possible.
 * Version: 1.2
 * Author: Krisna Pramu Waskito
 * Author URI: https://pramuwaskito.org
 * License: GPLv3
 * Copyright: 2018
 */


/*
Tombol Order via Whatsapp
*/
function WAbtn_whatsapp_after_addtocart_button_func()
{
?>
<style>
.WAbtn_whatsapp {
    margin-top: 50px;
    clear: both;
}
.WAbtn_whatsapp a {
    width: 100%;
    height: 45px;
    display: block;
    text-decoration: none;
    text-align: center;
    font-size: 18px;
    font-weight: bold;
    border-radius:50px;
    padding: 10px;
    background: #2bb641;
    color: #fff;
}
.WAbtn_whatsapp a:before
{
    display: inline-block;
    font-family: FontAwesome;
    font-size: 25px;
    float: center;
    content: "\f232";
    margin-right: 10px;
} 
@media screen and (max-width: 275px) {
    .WAbtn_whatsapp a {
        font-size:13px;
    }
}
</style>
<?php
    $whatsappnumber              = get_option('whatsappnumber');
    $whatsappnumber              = $whatsappnumber ? $whatsappnumber : "";
    $whatsappnumberremovespecial = preg_replace('/[^A-Za-z0-9\-]/', '', $whatsappnumber);
    $whatsappmessage             = get_option('whatsappmessage');
    $whatsappmessage             = $whatsappmessage ? $whatsappmessage : "Hi, i would like to buy";
    if ($whatsappnumber) {
        echo '<div class="WAbtn_whatsapp"><a target="_blank" href="https://api.whatsapp.com/send?phone=' . $whatsappnumberremovespecial . '&text=' . $whatsappmessage . '%20' . get_the_title() . '%20' . get_the_permalink() . '">' . __("Beli via Whatsapp", 'order-via-whatsapp') . '</a></div>';
    }
}
/*
check aktivasi
*/
if (!in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {
    add_action('admin_notices', 'WAbtn_admin_notice');
}

if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {
    
    add_action('woocommerce_after_add_to_cart_button', 'WAbtn_whatsapp_after_addtocart_button_func');
}

/*
Pemberitahuan admin
*/   
function WAbtn_admin_notice()
{
    echo "<div class='error'><p><strong>Order via Whatsapp</strong> requires <strong> Wooommerce plugin</strong> </p></div>";
}

/*
Halaman admin
*/  
function WAbtn_setup()
{
//Tambahkan Submenu halaman
add_menu_page(__('Order via WhatsApp', 'WAbtn'), __('Order via WhatsApp', 'WAbtn'), 8, basename(__FILE__), 'WAbtn_settings', plugin_dir_url(__FILE__) . 'img/WhatsApp.png');
}

// Display settings page
function WAbtn_settings()
{
include_once "admin/adminfunctions.php";
}

// Tambahkan settings page Dashboard WordPress
add_action('admin_menu', 'WAbtn_setup');


?>
