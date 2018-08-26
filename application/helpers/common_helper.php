<?php
if (!function_exists('ci')) {
    function ci()
    {
        $ci = &get_instance();
        return $ci;
    }
}

function config($key, $load = '')
{
    if (empty($key)) {
        return '';
    }

    if (!empty($load)) {
        ci()->config->load($load);
    }

    return ci()->config->item($key);
}

function isDev()
{
    return ENVIRONMENT !== 'production';
}

function twig()
{
    $loader = new Twig_Loader_Filesystem(VIEWPATH);

    $twig = new Twig_Environment($loader, array(
        'debug' => isDev(),
        'cache' => APPPATH . 'cache/',
        'charset' => 'utf-8',
        'auto_reload' => true,
    ));

    $twig->addExtension(new Twig_Extension_Debug());

    $twig->getExtension('Twig_Extension_Core')->setTimezone('Asia/Taipei');

    return $twig;
}

function cache()
{
    return ci()->cache->file;
}
