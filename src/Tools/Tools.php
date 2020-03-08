<?php

class Tools
{
    /**
     * @param string $token
     * @return string
     */
    public static function generateClassName(string $token) : string
    {
        $class = '';
        $items = explode('_', $token);
        if (count($items) > 1) {
            foreach ($items as $item) {
                $class .= ucfirst($item);
            }
        } else {
            $class = ucfirst($token);
        }
        if (!class_exists($class)) {
            throw new RuntimeException("Class : $class does not exist.");
        }
        return $class;
    }

    /**
     * @param string $str
     * @param array $replace
     * @param string $delimiter
     * @return false|string|string[]|null
     */
    public static function cleanString(string $str, array $replace = array(), string $delimiter = '-') {
        if ( !empty($replace) ) {
            $str = str_replace((array)$replace, ' ', $str);
        }
        $clean = iconv('UTF-8', 'ASCII//TRANSLIT', $str);
        $clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $clean);
        $clean = strtolower(trim($clean, '-'));
        $clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);
        return $clean;
    }
}