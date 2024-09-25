<?php
/*
Plugin Name: Simple WhatsApp Chat Widget
Plugin URI: #
Description: Simple WhatsApp chat widget for WordPress. Bu eklenti ile web sitenize basit bir WhatsApp sohbet butonu ekleyebilirsiniz.
Version: 1.0.0
Author: SRtech Serra 🖤
Author URI: https://serra.org.tr
*/

function serra_simple_whatsapp_chat_enqueue_scripts() {
    wp_enqueue_style('simple-whatsapp-chat-style', plugins_url('simple-whatsapp-chat.css', __FILE__));
}

// WhatsApp ikonu ve linki için shortcode
function serra_simple_whatsapp_chat_output() {
    $phone_number = esc_attr(get_option('serra_whatsapp_phone_number'));
    ob_start();
    ?>
    <div class="serra-whatsapp-chat">
        <a href="https://wa.me/<?php echo $phone_number; ?>" target="_blank">
            <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg" alt="WhatsApp" style="width:50px; height:50px;">
        </a>
    </div>
    <?php
    return ob_get_clean();
}

// Yönetim paneline ayar eklemek için
function serra_simple_whatsapp_chat_menu() {
    add_options_page(
        'WhatsApp Chat Ayarları',
        'WhatsApp Chat',
        'manage_options',
        'serra-simple-whatsapp-chat',
        'serra_simple_whatsapp_chat_settings_page'
    );
}

// Admin panelindeki WhatsApp ayarları sayfası
function serra_simple_whatsapp_chat_settings_page() {
    ?>
    <div class="wrap">
        <h1>WhatsApp Chat Ayarları</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('serra-simple-whatsapp-chat-settings-group');
            do_settings_sections('serra-simple-whatsapp-chat-settings-group');
            ?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">WhatsApp Telefon Numarası</th>
                    <td><input type="text" name="serra_whatsapp_phone_number" value="<?php echo esc_attr(get_option('serra_whatsapp_phone_number')); ?>" /></td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

// Admin panelinde ayarları kayıt etmek için
function serra_simple_whatsapp_chat_settings() {
    register_setting('serra-simple-whatsapp-chat-settings-group', 'serra_whatsapp_phone_number');
}

// Eklentiyi etkinleştiren aksiyonlar
add_action('wp_enqueue_scripts', 'serra_simple_whatsapp_chat_enqueue_scripts');
add_action('admin_menu', 'serra_simple_whatsapp_chat_menu');
add_action('admin_init', 'serra_simple_whatsapp_chat_settings');
add_shortcode('whatsapp_chat_widget', 'serra_simple_whatsapp_chat_output');

// Kullanım Rehberi Sayfası
function serra_simple_whatsapp_chat_usage() {
    ?>
    <div class="wrap">
        <h1>WhatsApp Chat Widget Kullanım Rehberi</h1>
        <p>Bu eklenti ile web sitenize basit bir WhatsApp sohbet butonu ekleyebilirsiniz. Aşağıda adım adım nasıl kullanabileceğinizi bulabilirsiniz:</p>
        <h2>Kullanım Adımları:</h2>
        <ol>
            <li>WordPress admin paneline gidin.</li>
            <li><strong>Ayarlar > WhatsApp Chat</strong> menüsüne tıklayın.</li>
            <li>WhatsApp telefon numaranızı uluslararası formatta girin (örneğin: <code>+905xxxxxxxxx</code>).</li>
            <li>Kaydet butonuna basın.</li>
            <li>WhatsApp ikonunu web sitenize eklemek için aşağıdaki kısa kodu kullanın:</li>
            <pre><code>[whatsapp_chat_widget]</code></pre>
            <li>Bu kısa kodu sayfa, yazı ya da bileşenlerde kullanarak ikonu dilediğiniz yere ekleyebilirsiniz.</li>
        </ol>
        <h2>İkon Özellikleri:</h2>
        <ul>
            <li>Sağ alt köşeye yerleştirilen sabit bir WhatsApp sohbet butonu.</li>
            <li>Butona tıklandığında direkt olarak WhatsApp'a yönlendirme yapılır.</li>
        </ul>
    </div>
    <?php
}

// Kullanım rehberini admin menüye eklemek için
add_action('admin_menu', function() {
    add_submenu_page(
        'options-general.php',
        'WhatsApp Kullanım Rehberi',
        'Kullanım Rehberi',
        'manage_options',
        'serra-simple-whatsapp-chat-usage',
        'serra_simple_whatsapp_chat_usage'
    );
});
