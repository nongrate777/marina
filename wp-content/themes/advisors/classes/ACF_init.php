<?php

class ACF_init
{
    protected static $instance = null;

    public static function instance(): ?ACF_init
    {
        if (null === self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    function __construct()
    {
        add_action('acf/init', array($this, 'options_page'));

        add_filter('block_categories_all', array($this, 'register_category'));
        add_action('acf/init', array($this, 'register_blocks'));
    }

    public static function options_page(): void
    {
        acf_add_options_page(array(
            'page_title' => 'General fields',
            'menu_title' => 'General fields',
            'menu_slug'  => 'general-fields',
            'capability' => 'edit_posts',
            'position'   => 10
        ));
    }

    public static function register_category($categories)
    {
        $custom_categories = array(
            'slug'  => 'custom-layout',
            'title' => 'Blocks'
        );

        array_unshift($categories, $custom_categories);

        return $categories;
    }

    public static function register_blocks(): void
    {
        $blocks = array(
            'banner'      => 'Banner Block',
            'accordion'   => 'Accordion Block',
            'whatis'      => 'What is Block',
            'services'    => 'Services Block',
            'about'       => 'About Block',
            'table'       => 'Table Block',
            'tablewave'   => 'Table Wave Block',
            'tableblue'   => 'Table Blue Block',
            'rightphoto'  => 'Right Photo Block',
            'blue'        => 'Blue Block',
            'counters'    => 'Counters Block',
            'terms'       => 'Terms Block',
            'contacts'    => 'Contacts Block',
            'needhelp'    => 'I need help Block',
            'arrow'       => 'Arrow Up Block',
            'imgleft'     => 'Left image Block',
            'fourcolumns' => 'Four columns Block',
            'fourblue'    => 'Four blue columns Block',
            'twocolumns'  => 'Two columns Block',
            'bluefour'    => 'Blue Four columns Block',
            'location'    => 'Locations Block',
            'happy'       => 'Happy Block',
            'get'         => 'Get Block',
            'steps'       => 'Steps Block',
            'plan'        => 'Plan Block',
            'slider'      => 'Slider Block',
            'speakers'    => 'Speakers Block',
            '404'         => '404 page'
        );


        foreach ($blocks as $id => $name) {
            acf_register_block_type(
                array(
                    'name'            => $id.'_block',
                    'title'           => $name,
                    'render_template' => get_template_directory() . '/blocks/'.$id.'/'.$id.'.php',
                    'category'        => 'custom-layout'
                )
            );
        }
    }
}

ACF_init::instance();
