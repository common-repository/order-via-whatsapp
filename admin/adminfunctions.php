<style>
.WAbtn-dashboard{
	width: 100%;
    height: auto;
}
#WAbtn-dashboard-form{
	width: 85%;
    background-color: #fff;
	padding: 3%;
    height: auto;
    margin: 2%;
}
.form-item{
    margin-left: 15%;
    padding: 1%;
}
</style>
<div class="WAbtn-dashboard">
    <div id="WAbtn-dashboard-form">
            <span style="margin-left: 5%; font-size: 18px;">Silahkan masukan Nomor WhatsApp dan Text Pesan Anda</span><br><br>
            <form method="POST" action="">
    <?php
    if (isset($_REQUEST['Order_via_WhatsApp_nonce'])) {
    if (isset($_REQUEST['Order_via_WhatsApp_nonce']) && wp_verify_nonce($_REQUEST['Order_via_WhatsApp_nonce'], 'Order_via_WhatsApp_save')) {
        
        if (isset($_POST['update_options']))
        ?> 
        <div id="message" class="updated"><p><strong><?php _e('Pengaturan Tersimpan.');?></strong></p></div>
        <?php
        //=========== penyimpanan nomor whatsapp
        if (isset($_POST['whatsappnumber'])) {
                update_option('whatsappnumber', sanitize_text_field($_POST['whatsappnumber']));
        }
        if (!empty($whatsappnumber) || @$whatsappnumber == '') {
            @$whatsappnumber = '';
            add_option('whatsappnumber', @$whatsappnumber);
        }
        
        //=========== penyimpanan text pesan 
        if (isset($_POST['whatsappmessage'])) {
            update_option('whatsappmessage', sanitize_text_field($_POST['whatsappmessage']));
        }
        if (!empty($whatsappmessage) || @$whatsappmessage == '') {
            @$whatsappmessage = '';
            add_option('whatsappmessage', $whatsappmessage);
        }
        //===========
        
    
    } else {
        wp_die(__('Invalid nonce specified'));
    }
}
?>    
    <div>
<table style="margin-left: 5%;">
<tr><td>Nomor Whatsapp Anda :</td><td><input type="text" id="whatsappnumber" name="whatsappnumber" value="<?php
echo get_option('whatsappnumber');;
?>" placeholder="+6285123xxxxxx"/></td></tr>
<tr><td>Text Pesan :</td><td><input type="text" id="whatsappmessage" name="whatsappmessage" value="<?php
echo get_option('whatsappmessage');
?>" placeholder="Hai, Saya mau beli..." /></td></tr>
</table>
	<?php wp_nonce_field('Order_via_WhatsApp_save', 'Order_via_WhatsApp_nonce'); ?>
     <p style="margin-left: 25%;"><input type="submit" name="Simpan" value="Simpan" class="button-primary" /></p>
    </form>
    </div>
</div>
</div>