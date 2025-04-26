<?php

class Sanitize
{
    protected static $instance = null;

    public static function instance(): ?Sanitize
    {
        if (null === self::$instance) {
            self::$instance = new self();
            self::$instance->init();
        }

        return self::$instance;
    }

    protected function init()
    {
        add_action('init', array($this, 'sanitize_get_params'));
    }

    public function sanitize_text_field($value)
    {
        return strip_tags($value);
    }

    public function sanitize_get_params()
    {
        foreach ($_GET as $key => $value) {
            $_GET[$key] = $this->sanitize_text_field($value);
        }
    }
}

Sanitize::instance();
