<?php
/**
 * $Desc
 *
 * @version    1.0
 * @package    basetheme
 * @author     Gaviasthemes Team
 * @copyright  Copyright (C) 2019 Gaviasthemess. All Rights Reserved.
 * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 *
 */
require_once( __DIR__ . '/includes/emprendimientos-store.php');
require_once( __DIR__ . '/includes/ofertas-store.php');
require_once(__DIR__ . '/includes/cursos-store.php');

define('VIZEON_THEMER_DIR', get_template_directory());
define('VIZEON_THEME_URL', get_template_directory_uri());

/*
 * Include list of files from Gavias Framework.
 */
require_once VIZEON_THEMER_DIR . '/includes/theme-functions.php';
require_once VIZEON_THEMER_DIR . '/includes/template.php';
require_once VIZEON_THEMER_DIR . '/includes/theme-hook.php';
require_once VIZEON_THEMER_DIR . '/includes/theme-layout.php';
require_once VIZEON_THEMER_DIR . '/includes/metaboxes.php';
require_once VIZEON_THEMER_DIR . '/includes/custom-styles.php';
require_once VIZEON_THEMER_DIR . '/includes/menu/megamenu.php';
require_once VIZEON_THEMER_DIR . '/includes/sample/init.php';
require_once VIZEON_THEMER_DIR . '/includes/elementor/hooks.php';

//Load Woocommerce
if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {
    add_theme_support("woocommerce");
    require_once VIZEON_THEMER_DIR . '/includes/woocommerce/functions.php';
    require_once VIZEON_THEMER_DIR . '/includes/woocommerce/hooks.php';
}

// Load Redux - Theme options framework
if (class_exists('Redux')) {
    require VIZEON_THEMER_DIR . '/includes/options/init.php';
    require_once VIZEON_THEMER_DIR . '/includes/options/opts-general.php';
    require_once VIZEON_THEMER_DIR . '/includes/options/opts-header.php';
    require_once VIZEON_THEMER_DIR . '/includes/options/opts-breadcrumb.php';
    require_once VIZEON_THEMER_DIR . '/includes/options/opts-footer.php';
    require_once VIZEON_THEMER_DIR . '/includes/options/opts-styling.php';
    require_once VIZEON_THEMER_DIR . '/includes/options/opts-typography.php';
    require_once VIZEON_THEMER_DIR . '/includes/options/opts-blog.php';
    require_once VIZEON_THEMER_DIR . '/includes/options/opts-page.php';
    require_once VIZEON_THEMER_DIR . '/includes/options/opts-woo.php';
    require_once VIZEON_THEMER_DIR . '/includes/options/opts-portfolio.php';
    require_once VIZEON_THEMER_DIR . '/includes/options/opts-service.php';
    require_once VIZEON_THEMER_DIR . '/includes/options/opts-socials.php';
}
// TGM plugin activation
if (is_admin()) {
    require_once VIZEON_THEMER_DIR . '/includes/tgmpa/class-tgm-plugin-activation.php';
    require VIZEON_THEMER_DIR . '/includes/tgmpa/config.php';
}
load_theme_textdomain('vizeon', get_template_directory() . '/languages');

//-------- Register sidebar default in theme -----------
//------------------------------------------------------
function vizeon_widgets_init()
{

    register_sidebar(array(
        'name' => esc_html__('Default Sidebar', 'vizeon'),
        'id' => 'default_sidebar',
        'description' => esc_html__('Appears in the Default Sidebar section of the site.', 'vizeon'),
        'before_widget' => '<aside id="%1$s" class="widget clearfix %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title"><span>',
        'after_title' => '</span></h3>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Plugin| WooCommerce Sidebar', 'vizeon'),
        'id' => 'woocommerce_sidebar',
        'description' => esc_html__('Appears in the Plugin WooCommerce section of the site.', 'vizeon'),
        'before_widget' => '<aside id="%1$s" class="widget clearfix %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title"><span>',
        'after_title' => '</span></h3>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Plugin| WooCommerce Single', 'vizeon'),
        'id' => 'woocommerce_single_summary',
        'description' => esc_html__('Appears in the WooCommerce Single Page like social, description text ...', 'vizeon'),
        'before_widget' => '<aside id="%1$s" class="widget clearfix %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title"><span>',
        'after_title' => '</span></h3>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Portfolio Sidebar', 'vizeon'),
        'id' => 'portfolio_sidebar',
        'description' => esc_html__('Appears in the Portfolio Page section of the site.', 'vizeon'),
        'before_widget' => '<aside id="%1$s" class="widget clearfix %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title"><span>',
        'after_title' => '</span></h3>',
    ));
    register_sidebar(array(
        'name' => esc_html__('After Offcanvas Mobile', 'vizeon'),
        'id' => 'offcanvas_sidebar_mobile',
        'description' => esc_html__('Appears in the Offcanvas section of the site.', 'vizeon'),
        'before_widget' => '<aside id="%1$s" class="widget clearfix %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title"><span>',
        'after_title' => '</span></h3>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Service Sidebar', 'vizeon'),
        'id' => 'service_sidebar',
        'description' => esc_html__('Appears in the Sidebar section of the Service Page.', 'vizeon'),
        'before_widget' => '<aside id="%1$s" class="widget clearfix %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title"><span>',
        'after_title' => '</span></h3>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Blog Sidebar', 'vizeon'),
        'id' => 'blog_sidebar',
        'description' => esc_html__('Appears in the Blog sidebar section of the site.', 'vizeon'),
        'before_widget' => '<aside id="%1$s" class="widget clearfix %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title"><span>',
        'after_title' => '</span></h3>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Page Sidebar', 'vizeon'),
        'id' => 'other_sidebar',
        'description' => esc_html__('Appears in the Page Sidebar section of the site.', 'vizeon'),
        'before_widget' => '<aside id="%1$s" class="widget clearfix %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title"><span>',
        'after_title' => '</span></h3>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Footer first', 'vizeon'),
        'id' => 'footer-sidebar-1',
        'description' => esc_html__('Appears in the Footer first section of the site.', 'vizeon'),
        'before_widget' => '<aside id="%1$s" class="widget clearfix %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title"><span>',
        'after_title' => '</span></h3>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Footer second', 'vizeon'),
        'id' => 'footer-sidebar-2',
        'description' => esc_html__('Appears in the Footer second section of the site.', 'vizeon'),
        'before_widget' => '<aside id="%1$s" class="widget clearfix %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title"><span>',
        'after_title' => '</span></h3>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Footer third', 'vizeon'),
        'id' => 'footer-sidebar-3',
        'description' => esc_html__('Appears in the Footer third section of the site.', 'vizeon'),
        'before_widget' => '<aside id="%1$s" class="widget clearfix %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title"><span>',
        'after_title' => '</span></h3>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Footer four', 'vizeon'),
        'id' => 'footer-sidebar-4',
        'description' => esc_html__('Appears in the Footer four section of the site.', 'vizeon'),
        'before_widget' => '<aside id="%1$s" class="widget clearfix %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title"><span>',
        'after_title' => '</span></h3>',
    ));
}
add_action('widgets_init', 'vizeon_widgets_init');

if (!function_exists('vizeon_fonts_url')):
/**
 *
 * @return string Google fonts URL for the theme.
 */
    function vizeon_fonts_url()
{
        $fonts_url = '';
        $fonts = array();
        $subsets = '';
        $protocol = is_ssl() ? 'https' : 'http';
        /*
         * Translators: If there are characters in your language that are not supported
         * by Noto Sans, translate this to 'off'. Do not translate into your own language.
         */
        if ('off' !== _x('on', 'Covered By Your Grace font: on or off', 'vizeon')) {
            $fonts[] = 'Covered+By+Your+Grace';
        }

        if ('off' !== _x('on', 'Poppins font: on or off', 'vizeon')) {
            $fonts[] = 'Poppins:400,500,600,700';
        }

        /*
         * Translators: To add an additional character subset specific to your language,
         * translate this to 'greek', 'cyrillic', 'devanagari' or 'vietnamese'. Do not translate into your own language.
         */
        $subset = _x('no-subset', 'Add new subset (greek, cyrillic, devanagari, vietnamese)', 'vizeon');

        if ('cyrillic' == $subset) {
            $subsets .= ',cyrillic,cyrillic-ext';
        } elseif ('greek' == $subset) {
        $subsets .= ',greek,greek-ext';
    } elseif ('devanagari' == $subset) {
        $subsets .= ',devanagari';
    } elseif ('vietnamese' == $subset) {
        $subsets .= ',vietnamese';
    }

    if ($fonts) {
        $fonts_url = add_query_arg(array(
            'family' => (implode('%7C', $fonts)),
            'subset' => ($subsets),
        ), $protocol . '://fonts.googleapis.com/css');
    }

    return $fonts_url;
}
endif;

function vizeon_custom_styles()
{
    $custom_css = get_option('vizeon_theme_custom_styles');
    if ($custom_css) {
        wp_enqueue_style(
            'vizeon-custom-style',
            get_template_directory_uri() . '/css/custom_script.css'
        );
        wp_add_inline_style('vizeon-custom-style', $custom_css);
    }
}
add_action('wp_enqueue_scripts', 'vizeon_custom_styles', 9999);

function vizeon_init_scripts()
{
    global $post;
    $protocol = is_ssl() ? 'https' : 'http';
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }

    wp_enqueue_style('vizeon-fonts', vizeon_fonts_url(), array(), null);
    wp_enqueue_script('bootstrap', get_template_directory_uri() . '/js/bootstrap.js', array('jquery'));
    wp_enqueue_script('scrollbar', get_template_directory_uri() . '/js/perfect-scrollbar.jquery.min.js');
    wp_enqueue_script('magnific', get_template_directory_uri() . '/js/magnific/jquery.magnific-popup.min.js');
    wp_enqueue_script('cookie', get_template_directory_uri() . '/js/jquery.cookie.js', array('jquery'));
    wp_enqueue_script('lightgallery', get_template_directory_uri() . '/js/lightgallery/js/lightgallery.min.js');
    wp_enqueue_script('sticky', get_template_directory_uri() . '/js/sticky.js', array('elementor-waypoints'));
    wp_enqueue_script('owl-carousel', get_template_directory_uri() . '/js/owl-carousel/owl.carousel.min.js');
    wp_enqueue_script('vizeon-main', get_template_directory_uri() . '/js/main.js', array('imagesloaded', 'jquery-masonry'));
    wp_enqueue_script('vizeon-woocommerce', get_template_directory_uri() . '/js/woocommerce.js');

    if (vizeon_woocommerce_activated()) {
        wp_dequeue_script('wc-add-to-cart');
        wp_register_script('wc-add-to-cart', VIZEON_THEME_URL . '/js/add-to-cart.js', array('jquery'));
        wp_enqueue_script('wc-add-to-cart');
    }

    wp_enqueue_style('lightgallery', get_template_directory_uri() . '/js/lightgallery/css/lightgallery.min.css');
    wp_enqueue_style('lightgallery', get_template_directory_uri() . '/js/lightgallery/css/lg-transitions.min.css');
    wp_enqueue_style('owl-carousel', get_template_directory_uri() . '/js/owl-carousel/assets/owl.carousel.css');
    wp_enqueue_style('magnific', get_template_directory_uri() . '/js/magnific/magnific-popup.css');
    wp_enqueue_style('fontawesome', get_template_directory_uri() . '/css/fontawesome/css/font-awesome.css');
    wp_enqueue_style('vizeon-icons', get_template_directory_uri() . '/css/icon-custom.css');
    wp_enqueue_style('vizeon-style', get_template_directory_uri() . '/style.css');

    $skin = vizeon_get_option('skin_color', '');
    if (isset($_GET['gskin']) && $_GET['gskin']) {
        $skin = $_GET['gskin'];
    }
    if (!empty($skin)) {
        $skin = 'skins/' . $skin . '/';
    }
    wp_enqueue_style('bootstrap', get_template_directory_uri() . '/css/' . $skin . 'bootstrap.css', array(), '1.0.5', 'all');
    wp_enqueue_style('vizeon-woocoomerce', get_template_directory_uri() . '/css/' . $skin . 'woocommerce.css', array(), '1.0.5', 'all');
    wp_enqueue_style('vizeon-template', get_template_directory_uri() . '/css/' . $skin . 'template.css', array(), '1.0.5', 'all');
}
add_action('wp_enqueue_scripts', 'vizeon_init_scripts', 99);

/**
 * Handles contact form 7 data storage
 * @param object $contact_form
 * @param bool &$abort
 * @param object $submission
 */
function handle_form_data_storage($contact_form, &$abort, $submission)
{

    global $wpdb;

    //vars definition
    $result = false;
    $status = "error";
    $message = "Error al enviar formulario";

//id's definition
    $emprendimientos_form_id = 84;
    $ofertas_form_id = 100;
    $cursos_form_id = 106;

//getting posted data
    $posted_data = $submission->get_posted_data();

    if ($contact_form->id() == $emprendimientos_form_id) {

        $uploaded_files = $submission->uploaded_files();

        $result = EmprendimientosStore::store($wpdb, $posted_data, $uploaded_files);

    } else if ($contact_form->id() == $ofertas_form_id) {
        $result = OfertasStore::store($wpdb, $posted_data);
    } else if ($contact_form->id() == $cursos_form_id) {
        $result = CursosStore::store($wpdb, $posted_data);
    }

    if ($result) {
        $status = "ok";
        $message = "Formulario enviado satisfactoriamente";
    }
    $abort = true;
    $submission->set_status($status);
    $submission->set_response($contact_form->filter_message($message));
}
add_action('wpcf7_before_send_mail', 'handle_form_data_storage', 10, 3);

/**
 *
 * Handles emprendimientos data requests
 * @return string
 */
function emprendimientos_datatable_shortcode($atts)
{

    global $wpdb;
    $is_member = false;

    // get membership plans
    $plans = wc_memberships_get_membership_plans();

    // check if the member has an active membership for any plan
    foreach ($plans as $plan) {
        $is_member = wc_memberships_is_user_active_member(get_current_user_id(), $plan);
        if ($is_member) {
            break;
        }
    }
    return EmprendimientosStore::getData($wpdb, $is_member);
}
add_shortcode('emprendimientos_datatable_shortcode', 'emprendimientos_datatable_shortcode');

/**
 *
 * Handles ofertas data requests
 * @return string
 */
function ofertas_datatable_shortcode($atts)
{

    global $wpdb;
    $is_member = false;

    // get membership plans
    $plans = wc_memberships_get_membership_plans();

    // check if the member has an active membership for any plan
    foreach ($plans as $plan) {
        $is_member = wc_memberships_is_user_active_member(get_current_user_id(), $plan);
        if ($is_member) {
            break;
        }
    }

    return OfertasStore::getData($wpdb, $is_member);
}
add_shortcode('ofertas_datatable_shortcode', 'ofertas_datatable_shortcode');

/**
 *
 * Handles non members cursos data requests
 * @return string
 */
function cursos_datatable_shortcode($atts)
{

    global $wpdb;
    $is_member = false;

    // get membership plans
    $plans = wc_memberships_get_membership_plans();

    // check if the member has an active membership for any plan
    foreach ($plans as $plan) {
        $is_member = wc_memberships_is_user_active_member(get_current_user_id(), $plan);
        if ($is_member) {
            break;
        }
    }

    return CursosStore::getDataToNonMembers($wpdb, $is_member);

}
add_shortcode('cursos_datatable_shortcode', 'cursos_datatable_shortcode');


function post_entrepreneurship_shortcode()
{
    function redirect_to($url){
        echo "
        <script>
            window.location.href='".$url."'
        </script>
    ";
    }

    if(isset($_POST['entrepreneurship_name'])){

        //Global variables

        $author_id = get_current_user_id();
        $title = $_POST['entrepreneurship_name'];
        $country = $_POST['entrepreneurship_country'];
        $tel =  $_POST['entrepreneurship_tel'];
        $email = $_POST['entrepreneurship_email'];
        $aditional_info = $_POST['entrepreneurship_info'];
        $website = $_POST['entrepreneurship_website'];
        $archivo = $_FILES['entrepreneurship_logo']['name'];
        $upload_dir = wp_upload_dir();
        $temp = "";
        $imagePath = "";
        $memberInfo = get_userdata($author_id);
        
        if (isset($archivo) && $archivo != "") {
            //Obtenemos algunos datos necesarios sobre el archivo
            $tipo = $_FILES['entrepreneurship_logo']['type'];
            $tamano = $_FILES['entrepreneurship_logo']['size'];
            $temp = $_FILES['entrepreneurship_logo']['tmp_name'];
            $imagePath = $upload_dir['path'].'/'.$archivo;
            //Se comprueba si el archivo a cargar es correcto observando su extensión y tamaño
            if (!((strpos($tipo, "gif") || strpos($tipo, "jpeg") || strpos($tipo, "jpg") || strpos($tipo, "png")) && ($tamano < 2000000))) {
                echo "<script> alert('Image not uploaded') </script>";
            }
            else {
                //Si la imagen es correcta en tamaño y tipo
                //Se intenta subir al servidor
                if (move_uploaded_file($temp, $imagePath)) {
                    //Cambiamos los permisos del archivo a 777 para poder modificarlo posteriormente
                    echo "<script> alert('Image uploaded') </script>";
                    chmod($imagePath, 0777);
                }
                else {
                //Si no se ha podido subir la imagen, mostramos un mensaje de error
                   echo "<script> alert('Image not uploaded ".$temp."') </script>";

                }
            }
        }
        ob_start();
        ?>
                    <div class="EntrepreneurshipPost">
                        <aside class="EntrepreneurshipPost-aside">
                        <header>
                            <h4><?php echo $memberInfo->first_name; ?></h4>
                        </header>
                        <article>
                            <h5>País</h5>
                            <p><?php echo $country; ?></p>
                            <h5>Teléfono</h5>
                            <p><?php echo $tel; ?></p>
                            <h5>Email</h5>
                            <p><?php echo $email; ?></p>
                        </article>
                        </aside>
                        <article class="EntrepreneurshipPost-content">
                            <header class="EntrepreneurshipPost-content-header">
                                <h2><?php echo $title; ?></h2>
                            </header>
                            <article>
                                <h5>
                                Descripción
                                </h5>
                                <p>
                                <?php echo $aditional_info; ?>
                                </p>
                                <h5>
                                Página web
                                </h5>
                                <p>
                                <?php echo $website; ?>
                                </p>
                            </article>
                        </article>

                    </div>
                    <style>
                        .EntrepreneurshipPost{display: grid;grid-template-columns: 0.3fr 1fr;padding: 20px;column-gap: 50px;text-align: center;}.EntrepreneurshipPost-aside, .EntrepreneurshipPost-content { box-shadow: 0px 0px 3px rgba(0, 0, 0, 0.1); padding: 20px 40px; background-color: #F1F1F1; border-radius: 2px;} .EntrepreneurshipPost-content-header{ padding: 40px 0px;} .EntrepreneurshipPost-content-header h2{ font-size: 28px;} .EntrepreneurshipPost-content p{ padding-bottom: 20px;} .EntrepreneurshipPost-content{ padding: 20px 150px;} .EntrepreneurshipPost-aside h4{ font-size: 20px; padding: 20px 0px;}
                    </style>
                    <script>
                        document.getElementsByClassName("heading-title")[0].innerText = "Emprendimiento"
                    </script>
        <?php

        $content = ob_get_clean();
        ob_end_clean();

        $attachment = array(
            'guid'           => $upload_dir['url'] . '/' . basename( $imagePath ), 
            'post_type' => 'attachment',
            'post_title'     => preg_replace( '/\.[^.]+$/', '', basename( $imagePath ) ),
            'post_content'   => '',
            'post_status'    => 'inherit',
            'post_mime_type' => 'image/jpeg'
        );

        $post_id = wp_insert_post(
            array(
                'comment_status'	=>	'closed',
                'ping_status'		=>	'closed',
                'post_author'		=>	$author_id,
                'post_title'		=>	$title,
                'post_content'      =>  $content,
                'post_status'		=>	'private',
                'post_type'		    =>	'post',
                'post_excerpt' => '',
                'post_category' => array(82),
                'meta_input'   => array(
                    'ent_title' => $title,
                    'ent_country' => $country,
                    'ent_tel' => $tel,
                    'ent_email' => $email,
                    'ent_additional_info' => $aditional_info,
                    'ent_website' => $website,
                    'post_type' => "Emprendimiento"
                )
            )
        );
        $attach_id = wp_insert_attachment( $attachment, $imagePath);

        set_post_thumbnail( $post_id, $attach_id );

        redirect_to("/emnuy/publicar");

    }else{
        redirect_to("/emnuy/publicar");
    }

    
}
add_shortcode('post_entrepreneurship_shortcode', 'post_entrepreneurship_shortcode');

function post_offer_shortcode()
{
    function redirect_to($url){
        echo "
        <script>
            window.location.href='".$url."'
        </script>
    ";
    }

    if(isset($_POST['offer_name'])){

        //Global variables

        $author_id = get_current_user_id();
        $title = $_POST['offer_name'];
        $country = $_POST['offer_country'];
        $tel =  $_POST['offer_tel'];
        $email = $_POST['offer_email'];
        $info = $_POST['offer_info'];
        $job = $_POST['offer_job'];
        $offer_additional_requiriments = $_POST['offer_additional_requiriments'];
        $website = $_POST['offer_website'];
        $archivo = $_FILES['offer_logo']['name'];
        $upload_dir = wp_upload_dir();
        $temp = "";
        $imagePath = "";
        $memberInfo = get_userdata($author_id);
        
        if (isset($archivo) && $archivo != "") {
            //Obtenemos algunos datos necesarios sobre el archivo
            $tipo = $_FILES['offer_logo']['type'];
            $tamano = $_FILES['offer_logo']['size'];
            $temp = $_FILES['offer_logo']['tmp_name'];
            $imagePath = $upload_dir['path'].'/'.$archivo;
            //Se comprueba si el archivo a cargar es correcto observando su extensión y tamaño
            if (!((strpos($tipo, "gif") || strpos($tipo, "jpeg") || strpos($tipo, "jpg") || strpos($tipo, "png")) && ($tamano < 2000000))) {
                echo "<script> alert('Image not uploaded') </script>";
            }
            else {
                //Si la imagen es correcta en tamaño y tipo
                //Se intenta subir al servidor
                if (move_uploaded_file($temp, $imagePath)) {
                    //Cambiamos los permisos del archivo a 777 para poder modificarlo posteriormente
                    chmod($imagePath, 0777);
                }
                else {
                //Si no se ha podido subir la imagen, mostramos un mensaje de error
                   echo "<script> alert('Image not uploaded ".$temp."') </script>";
                   return false;

                }
            }
        }
        ob_start();
        ?>
                    <div class="EntrepreneurshipPost">

                        <aside class="EntrepreneurshipPost-aside">

                            <header>
                                <h4><?php echo $memberInfo->first_name; ?></h4>
                            </header>

                            <article>
                                <h5>País</h5>
                                <p><?php echo $country; ?></p>
                                <h5>Teléfono</h5>
                                <p><?php echo $tel; ?></p>
                                <h5>Email</h5>
                                <p><?php echo $email; ?></p>
                            </article>

                        </aside>

                        <article class="EntrepreneurshipPost-content">

                            <header class="EntrepreneurshipPost-content-header">

                                <h2><?php echo $title; ?></h2>

                            </header>

                            <article>
                                <h5>    
                                    Cargo
                                </h5>
                                <p>
                                <?php echo $job; ?>
                                </p>
                                <h5>
                                    Descripción
                                </h5>
                                <p>
                                <?php echo $info; ?>
                                </p>
                                <h5>
                                    Requerimientos adicionales
                                </h5>
                                <p>
                                <?php echo $offer_additional_requiriments; ?>
                                </p>

                            </article>

                        </article>

                    </div>
                    <style>
                        .EntrepreneurshipPost{display: grid;grid-template-columns: 0.3fr 1fr;padding: 20px;column-gap: 50px;text-align: center;}.EntrepreneurshipPost-aside, .EntrepreneurshipPost-content { box-shadow: 0px 0px 3px rgba(0, 0, 0, 0.1); padding: 20px 40px; background-color: #F1F1F1; border-radius: 2px;} .EntrepreneurshipPost-content-header{ padding: 40px 0px;} .EntrepreneurshipPost-content-header h2{ font-size: 28px;} .EntrepreneurshipPost-content p{ padding-bottom: 20px;} .EntrepreneurshipPost-content{ padding: 20px 150px;} .EntrepreneurshipPost-aside h4{ font-size: 20px; padding: 20px 0px;}
                    </style>
                    <script>
                        document.getElementsByClassName("heading-title")[0].innerText = "Emprendimiento"
                    </script>
        <?php

        $content = ob_get_clean();
        ob_end_clean();

        $attachment = array(
            'guid'           => $upload_dir['url'] . '/' . basename( $imagePath ), 
            'post_type' => 'attachment',
            'post_title'     => preg_replace( '/\.[^.]+$/', '', basename( $imagePath ) ),
            'post_content'   => '',
            'post_status'    => 'inherit',
            'post_mime_type' => 'image/jpeg'
        );

        $post_id = wp_insert_post(
            array(
                'comment_status'	=>	'closed',
                'ping_status'		=>	'closed',
                'post_author'		=>	$author_id,
                'post_title'		=>	$title,
                'post_content'      =>  $content,
                'post_status'		=>	'private',
                'post_type'		    =>	'post',
                'post_excerpt' => '',
                'post_category' => array(79),
                'meta_input'   => array(
                    'offer_title' => $title,
                    'offer_country' => $country,
                    'offer_tel' => $tel,
                    'offer_email' => $email,
                    'offer_aditional_requiriments' => $offer_additional_requiriments,
                    'offer_website' => $website,
                    'post_type' => "Oferta laboral"
                )
            )
        );
        $attach_id = wp_insert_attachment( $attachment, $imagePath);

        set_post_thumbnail( $post_id, $attach_id );

        redirect_to("/emnuy/publicar-oferta");

    }else{
        redirect_to("/emnuy/publicar-oferta");
    }

    
}

add_shortcode('post_offer_shortcode', 'post_offer_shortcode');


function show_user_emtrepreneurship_shortcode () {
                   
    $user_id = get_current_user_id();
    $args = array(
        'author'        =>  $user_id,
        'orderby'       =>  'post_date',
        'order'         =>  'ASC',
        'posts_per_page' => -1,
        'post_type' => 'post'
        );

    // get his posts 'ASC'
    $current_user_posts = get_posts( $args );


    foreach ($current_user_posts as $key => $value) {
        
        $metadata = get_post_meta($value->ID);
        $banner = get_post( $metadata['_thumbnail_id'][0])->guid;
        ?>

        <section className="PostContainer">
    
            <article class="Post">
                <a href="<?php echo $value->guid; ?>" >

                    <header class="Post-header">
                        <img src=<?php echo $banner; ?> alt="Imagen no dispoible" />
                    </header>
                    <section class="Post-body">
                        <a href="<?php echo $value->guid; ?>" >
                            <div class="Post-body-item Post-body-item--title">                
                                <h3> <?php echo $metadata['ent_title'][0]?></h3>
                                <?php if($user_id == $value->post_author) : ?> <span class="Post-body-item-status Post-btn">En revisión</span> <?php endif; ?>
                            </div>
                        </a>
                        <?php if($user_id == $value->post_author) : ?>
                        <div class="Post-body-item Post-body-item--controls">
                            <p class="Post-btn Post-btn-edit">Editar</p>
                            <p class="Post-btn Post-btn-delete">Borrar</p>
                        </div>
                        <?php endif; ?>
                        <a href="<?php echo $value->guid; ?>" >
                            <div class="Post-body-item">
                                <small>Tipo</small>
                                <p>
                                    <b><?php echo $metadata['post_type'][0]?></b>
                                </p>
                            </div>
                            <div class="Post-body-item">
                                <small>País</small>
                                <p><?php echo $metadata['ent_country'][0]?></p>
                            </div>
                            <div class="Post-body-item Post-body-item--description">
                                <small>Descripción</small>
                                <p><?php echo $metadata['ent_additional_info'][0]?></p>
                            </div>
                        </a>
                    </section>
                    <a href="<?php echo $value->guid; ?>" >
                        <footer class="Post-footer">
                            <div>
                                <img src="http://1.gravatar.com/avatar/ddd7406cec173533b7eea8a6bec4c4d9?s=96&d=mm&r=g" alt="Imagen no dispoible" />
                            </div>
                            <div class="Post-footer-info">
                                <p class="Post-footer-info-user">Jorge</p>
                                <p class="Post-footer-info-date"><?php echo $value->post_date?></p>
                            </div>
                        </footer>
                    </a>
            </article>
        </section>
        <style>
            .Post{ height: auto; width: 260px; box-shadow: 0px 0px 2px rgba(0, 0, 0, 0.1); margin: 0}.Post-header{ width: 237px; height: 157px; cursor: pointer}.Post-header img{ min-width: 260px !important; height: 157px}.Post-body{ padding: 20px}.Post-body-item--description p{ height: 50px; overflow: hidden; text-overflow: ellipsis}.Post-footer{ height: 120px; padding: 20px; display: grid; grid-template-columns: 0.3fr 1fr; margin-top: 20px}.Post-footer img{ width: 30px; border-radius: 100%}.Post-footer-info-user{ font-weight: 500; margin-top: 0px}.Post-footer-info-date{ font-weight: 500; color: #747b86}.PostContainer{ display: flex; justify-content: flex-start; align-items: flex-start; gap: 20px}.Post-body-item--title{ display: flex; justify-content: space-between; align-items: center; gap: 15px; padding: 1em 0px; cursor: pointer;}.Post-body-item--title h3{ margin: 0px; transition:all 0.3s}.Post-body-item--title h3:hover{ color: #E74D57}.Post-body-item-status{ font-size: 10px; background-color: #D69729;}.Post-body-item--controls{ display: flex; gap: 5px; font-size: 12px; margin-bottom: 20px}.Post-btn{ padding: 2px; border-radius: 2px; display: block; margin: 0px; color: white; transition: all 0.5s}.Post-btn-edit{ background-color: #33567A; padding: 5px 10px; cursor: pointer}.Post-btn-delete{ background-color: #8f0d0d; padding: 5px 10px; cursor: pointer}.Post-btn-edit:hover{ background-color: #3e6b9b}.Post-btn-delete:hover{ background-color: #b11111}
        </style>
        
        <?php

    }

}

add_shortcode('show_user_emtrepreneurship_shortcode', 'show_user_emtrepreneurship_shortcode');

/***
 * Handles redirection of already logged users if they go to login or register pages
 *
 */
