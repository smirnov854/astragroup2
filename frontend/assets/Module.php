<?php


namespace frontend\assets;

class Module
{
    public static function module($space, $module)
    {
        $css_arr = [];
        $js_arr = [];


        if ($handle = opendir($_SERVER['DOCUMENT_ROOT'] . '/frontend/web/apps/' . $module . '/css/')) {
            while (false !== ($entry = readdir($handle))) {
                if ($entry !== '.' && $entry !== '..' && stripos($entry, '.map') === false)
                    $css_arr[] = $entry;
            }
            closedir($handle);
        }

        if ($handle = opendir($_SERVER['DOCUMENT_ROOT'] . '/frontend/web/apps/' . $module . '/js/')) {
            while (false !== ($entry = readdir($handle))) {
                if ($entry !== '.' && $entry !== '..' && stripos($entry, '.map') === false)
                    $js_arr[] = $entry;
            }
            closedir($handle);
        }

        $result = "";
        switch ($space) {
            case 'head':
                foreach ($css_arr as $css) {
                    $result .= "<link href=/apps/" . $module . "/css/" . $css . " rel=preload as=style>";
                }
                foreach ($js_arr as $js) {
                    $result .= "<link href=/apps/" . $module . "/js/" . $js . " rel=preload as=script>";
                }
                foreach (array_reverse($css_arr) as $css) {
                    $result .= "<link href=/apps/" . $module . "/css/" . $css . " rel=stylesheet>";
                }
                break;
            case 'body';
                foreach ($js_arr as $js) {
                    $result .= "<script src=/apps/" . $module . "/js/" . $js . "> </script>";
                }
                break;
        }

        return $result;
    }
}

