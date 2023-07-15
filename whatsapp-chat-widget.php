<?php
/*
Plugin Name: WhatsApp Chat Widget
Plugin URI: #
Description: WhatsApp chat widget for WordPress.
Version: 1.0
Author: Serkan Kısacık
Author URI: https://doseryazilim.com/tr
*/

function whatsapp_chat_widget_enqueue_scripts()
{
    wp_enqueue_style('whatsapp-chat-widget-style', plugins_url('style.css', __FILE__));
    wp_enqueue_script('whatsapp-chat-widget-script', plugins_url('script.js', __FILE__), array('jquery'), '1.0', true);
}

function whatsapp_chat_widget_output()
{
    ob_start();
    ?>
    <div id='whatsapp-chat' class='hide'>
        <div class='header-chat'>
            <div class='head-home'>
                <div class='info-avatar'><img
                            src='https://meskenakademi.com/wp-content/uploads/2022/09/cropped-PNG-MESKEN-1-180x180.webp'/>
                </div>
                <p><span class="whatsapp-name">Site Başlığı</span><br><small>Genellikle bir saat içinde yanıt verir</small>
                </p>

            </div>
            <div class='get-new hide'>
                <div id='get-label'></div>
                <div id='get-nama'></div>
            </div>
        </div>
        <div class='home-chat'>

        </div>
        <div class='start-chat'>
            <div pattern="https://elfsight.com/assets/chats/patterns/whatsapp.png"
                 class="WhatsappChat__Component-sc-1wqac52-0 whatsapp-chat-body">
                <div class="WhatsappChat__MessageContainer-sc-1wqac52-1 dAbFpq">
                    <div style="opacity: 0;" class="WhatsappDots__Component-pks5bf-0 eJJEeC">
                        <div class="WhatsappDots__ComponentInner-pks5bf-1 hFENyl">
                            <div class="WhatsappDots__Dot-pks5bf-2 WhatsappDots__DotOne-pks5bf-3 ixsrax"></div>
                            <div class="WhatsappDots__Dot-pks5bf-2 WhatsappDots__DotTwo-pks5bf-4 dRvxoz"></div>
                            <div class="WhatsappDots__Dot-pks5bf-2 WhatsappDots__DotThree-pks5bf-5 kXBtNt"></div>
                        </div>
                    </div>
                    <div style="opacity: 1;" class="WhatsappChat__Message-sc-1wqac52-4 kAZgZq">
                        <div class="WhatsappChat__Author-sc-1wqac52-3 bMIBDo">Site Başlığı Destek</div>
                        <div class="WhatsappChat__Text-sc-1wqac52-2 iSpIQi">Merhaba 👋<br><br>Size nasıl yardım
                            edebilirim?
                        </div>
                    </div>
                </div>
            </div>

            <div class='blanter-msg'>
                <textarea id='chat-input' placeholder='Bir mesaj yazın!' maxlength='120' row='1'></textarea>
                <a href='javascript:void;' id='send-it'>
                    <svg viewBox="0 0 448 448">
                        <path d="M.213 32L0 181.333 320 224 0 266.667.213 416 448 224z"/>
                    </svg>
                </a>

            </div>
        </div>
        <div id='get-number'></div>
        <a class='close-chat' href='javascript:void'>×</a>
    </div>
    <a class='blantershow-chat' href='javascript:void' title='Show Chat'>
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

add_action('wp_enqueue_scripts', 'whatsapp_chat_widget_enqueue_scripts');
add_shortcode('whatsapp_chat_widget', 'whatsapp_chat_widget_output');
