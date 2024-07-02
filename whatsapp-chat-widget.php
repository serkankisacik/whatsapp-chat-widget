<?php
/*
Plugin Name: WhatsApp Chat Widget
Plugin URI: #
Description: WhatsApp chat widget for WordPress.
Version: 2.0.0
Author: SRtech Serra 🖤
Author URI: https://serra.org.tr
*/

function serra_whatsapp_chat_widget_enqueue_scripts()
{
    wp_enqueue_style('whatsapp-chat-widget-style', plugins_url('style.css', __FILE__));
    wp_enqueue_script('whatsapp-chat-widget-script', plugins_url('script.js', __FILE__), array('jquery'), '1.0', true);
}

function serra_whatsapp_chat_widget_menu()
{
    add_options_page(
        'WhatsApp Chat Ayarları',  // Sayfa başlığı
        'WhatsApp Chat',           // Menü başlığı
        'manage_options',          // Yetki
        'serra-whatsapp-chat',     // Menü slug
        'serra_whatsapp_chat_widget_settings_page' // Sayfa içeriği için işlev
    );
}

function serra_whatsapp_chat_widget_settings_page()
{
    ?>
    <div class="wrap">
        <h1>WhatsApp Chat Ayarları</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('serra-whatsapp-chat-settings-group');
            do_settings_sections('serra-whatsapp-chat-settings-group');
            ?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">WhatsApp Telefon Numarası</th>
                    <td><input type="text" name="serra_whatsapp_phone_number"
                               value="<?php echo esc_attr(get_option('serra_whatsapp_phone_number')); ?>"/></td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

function serra_whatsapp_chat_widget_settings()
{
    register_setting('serra-whatsapp-chat-settings-group', 'serra_whatsapp_phone_number');
}

add_action('admin_menu', 'serra_whatsapp_chat_widget_menu');
add_action('admin_init', 'serra_whatsapp_chat_widget_settings');

function serra_whatsapp_chat_widget_output()
{
    $phone_number = esc_attr(get_option('serra_whatsapp_phone_number'));
    ob_start();
    ?>
    <div id='serra-whatsapp-chat' class='serra-hide'>
        <div class='serra-header-chat'>
            <div class='serra-head-home'>
                <?php
                $site_title = get_bloginfo('name');
                $site_icon_url = get_site_icon_url();
                ?>

                <div class='serra-info-avatar'><img src='<?php echo $site_icon_url; ?>'/></div>
                <p><span class="serra-whatsapp-name"><?php echo $site_title; ?></span><br><small>Genellikle bir saat
                        içinde yanıt verir</small></p>
            </div>
            <div class='serra-get-new serra-hide'>
                <div id='serra-get-label'></div>
                <div id='serra-get-nama'></div>
            </div>
        </div>
        <div class='serra-home-chat'>
        </div>
        <div class='serra-start-chat'>
            <div pattern="https://elfsight.com/assets/chats/patterns/whatsapp.png"
                 class="WhatsappChat__Component-sc-1wqac52-0 serra-whatsapp-chat-body">
                <div class="WhatsappChat__MessageContainer-sc-1wqac52-1 serra-dAbFpq">
                    <div style="opacity: 0;" class="WhatsappDots__Component-pks5bf-0 serra-eJJEeC">
                        <div class="WhatsappDots__ComponentInner-pks5bf-1 serra-hFENyl">
                            <div class="WhatsappDots__Dot-pks5bf-2 WhatsappDots__DotOne-pks5bf-3 serra-ixsrax"></div>
                            <div class="WhatsappDots__Dot-pks5bf-2 WhatsappDots__DotTwo-pks5bf-4 serra-dRvxoz"></div>
                            <div class="WhatsappDots__Dot-pks5bf-2 WhatsappDots__DotThree-pks5bf-5 serra-kXBtNt"></div>
                        </div>
                    </div>
                    <div style="opacity: 1;" class="WhatsappChat__Message-sc-1wqac52-4 serra-kAZgZq">
                        <div class="WhatsappChat__Author-sc-1wqac52-3 serra-bMIBDo"><?php echo $site_title; ?>Destek
                        </div>
                        <div class="WhatsappChat__Text-sc-1wqac52-2 serra-iSpIQi">Merhaba 👋<br><br>Size nasıl yardım
                            edebilirim?
                        </div>
                    </div>
                </div>
            </div>
            <div class='serra-blanter-msg'>
                <textarea id='serra-chat-input' placeholder='Bir mesaj yazın!' maxlength='120' row='1'></textarea>
                <a href='javascript:void;' id='serra-send-it'>
                    <svg viewBox="0 0 448 448">
                        <path d="M.213 32L0 181.333 320 224 0 266.667.213 416 448 224z"/>
                    </svg>
                </a>
            </div>
        </div>
        <div id='serra-get-number'></div>
        <a class='serra-close-chat' href='javascript:void'>×</a>
    </div>
    <a class='serra-blantershow-chat' href='javascript:void' title='Show Chat'>
        <svg width="20" viewBox="0 0 24 24">
            <defs/>
            <path fill="#eceff1"
                  d="M20.5 3.4A12.1 12.1 0 0012 0 12 12 0 001.7 17.8L0 24l6.3-1.7c2.8 1.5 5 1.4 5.8 1.5a12 12 0 008.4-20.3z"/>
            <path fill="#4caf50"
                  d="M12 21.8c-3.1 0-5.2-1.6-5.4-1.6l-3.7 1 1-3.7-.3-.4A9.9 9.9 0 012.1 12a10 10 0 0117-7 9.9 9.9 0 01-7 16.9z"/>
            <path fill="#fafafa"
                  d="M17.5 14.3c-.3 0-1.8-.8-2-.9-.7-.2-.5 0-1.7 1.3-.1.2-.3.2-.6.1s-1.3-.5-2.4-1.5a9 9 0 01-1.7-2c-.3-.6.4-.6 1-1.7l-.1-.5-1-2.2c-.2-.6-.4-.5-.6-.5-.6 0-1 0-1.4.3-1.6 1.8-1.2 3.6.2 5.6 2.7 3.5 4.2 4.2 6.8 5 .7.3 1.4.3 1.9.2.6 0 1.7-.7 2-1.4.3-.7.3-1.3.2-1.4-.1-.2-.3-.3-.6-.4z"/>
        </svg>
        WhatsApp</a>
    <?php
    $output = ob_get_clean();
    return $output;
}

add_action('wp_enqueue_scripts', 'serra_whatsapp_chat_widget_enqueue_scripts');
add_shortcode('whatsapp_chat_widget', 'serra_whatsapp_chat_widget_output');