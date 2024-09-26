<?php
/*
Plugin Name: Serra WhatsApp Chat Button
Plugin URI:  https://serra.org.tr/iletisim
Description: Basit WhatsApp chat butonu.
Version: 1.0
Author: SRtech Serra 🖤
Author URI: https://serra.org.tr
*/

function serra_whatsapp_chat_enqueue_styles() {
    wp_enqueue_style('whatsapp-chat-style', plugins_url('style.css', __FILE__));
}

// WhatsApp butonunun HTML çıktısı
function serra_whatsapp_chat_button() {
    $phone_number = esc_attr(get_option('serra_whatsapp_phone_number', '905360360884')); // Varsayılan numara
    ?>
    <div class="whatsapp-button">
        <a href="https://api.whatsapp.com/send?phone=<?php echo $phone_number; ?>&amp;text=Merhaba,%20Websitesinden%20geliyorum.%20Bilgi%20almak%20istiyorum" target="_blank">
            <img src="https://upload.wikimedia.org/wikipedia/commons/a/a7/2062095_application_chat_communication_logo_whatsapp_icon.svg" alt="WhatsApp Icon">
        </a>
    </div>
    <?php
}

// Yönetim paneline menü ekleme
function serra_whatsapp_chat_options_menu() {
    add_options_page(
        'WhatsApp Chat Ayarları',
        'Serra WhatsApp Chat',
        'manage_options',
        'serra-whatsapp-chat',
        'serra_whatsapp_chat_settings_page'
    );
}

// Ayar ve kullanım talimatları sayfası
function serra_whatsapp_chat_settings_page() {
    ?>
    <div class="wrap">
        <h1>WhatsApp Chat Ayarları ve Kullanım</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('serra-whatsapp-chat-settings-group');
            do_settings_sections('serra-whatsapp-chat-settings-group');
            ?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">WhatsApp Telefon Numarası</th>
                    <td><input type="text" name="serra_whatsapp_phone_number" value="<?php echo esc_attr(get_option('serra_whatsapp_phone_number')); ?>" /></td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
        <h2>Kullanım Rehberi</h2>
        <p>Bu eklenti ile web sitenize basit bir WhatsApp sohbet butonu ekleyebilirsiniz. Aşağıda adım adım nasıl kullanabileceğinizi bulabilirsiniz:</p>
        <h3>Kullanım Adımları:</h3>
        <ol>
            <li>WhatsApp telefon numaranızı yukarıdaki alana uluslararası formatta girin (örneğin: <code>+905xxxxxxxxx</code>).</li>
            <li>Kaydet butonuna basın.</li>
            <li>WhatsApp ikonunu web sitenize eklemek için aşağıdaki kısa kodu kullanın:</li>
            <pre><code>[whatsapp_chat_widget]</code></pre>
            <li>Bu kısa kodu sayfa, yazı ya da bileşenlerde kullanarak ikonu dilediğiniz yere ekleyebilirsiniz.</li>
        </ol>
        <h3>İkon Özellikleri:</h3>
        <ul>
            <li>Sağ alt köşeye yerleştirilen sabit bir WhatsApp sohbet butonu.</li>
            <li>Butona tıklandığında direkt olarak WhatsApp'a yönlendirme yapılır.</li>
        </ul>
    </div>
    <?php
}

// Ayarları kaydetme
function serra_whatsapp_chat_register_settings() {
    register_setting('serra-whatsapp-chat-settings-group', 'serra_whatsapp_phone_number');
}

add_action('admin_menu', 'serra_whatsapp_chat_options_menu');
add_action('admin_init', 'serra_whatsapp_chat_register_settings');
add_action('wp_enqueue_scripts', 'serra_whatsapp_chat_enqueue_styles');
add_action('wp_footer', 'serra_whatsapp_chat_button'); // Butonu footer kısmında çağırıyoruz
