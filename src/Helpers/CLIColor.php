<?php

namespace ProgLib\CLI\Helpers;

/**
 * Предоставляет методы для установки тексту цвета.
 */
class CLIColor {

    #region Variables

    /**
     * Доступные цвета.
     *
     * @var array
     */
    private static $color = [

        // Цвет фона текста
        "background" => [
            "black"       => "40",     //  0
            "red"         => "41",     //  1
            "green"       => "42",     //  2
            "yellow"      => "43",     //  3
            "blue"        => "44",     //  4
            "magenta"     => "45",     //  5
            "cyan"        => "46",     //  6
            "grayLight"   => "47"      //  7
        ],

        // Цвет текста
        "foreground" => [
            "black"       => "0;30",   //  0
            "grayDark"    => "1;30",   //  1
            "blue"        => "0;34",   //  2
            "blueLight"   => "1;34",   //  3
            "green"       => "0;32",   //  4
            "greenLight"  => "1;32",   //  5
            "cyan"        => "0;36",   //  6
            "cyanLight"   => "1;36",   //  7
            "red"         => "0;31",   //  8
            "redLight"    => "1;31",   //  9
            "purple"      => "0;35",   // 10
            "purpleLight" => "1;35",   // 11
            "brown"       => "0;33",   // 12
            "yellow"      => "1;33",   // 13
            "grayLight"   => "0;37",   // 14
            "white"       => "1;37"    // 15
        ]
    ];

    #endregion

    /**
     * Устанавливает цвета фона.
     *
     * @param  string $message Сообщение журнала.
     * @param  mixed  $color   Требуемый цвет. Принимает значение с наименованием или идентификатором.
     * @return string Раскрашенная строка.
     */
    public static function background($message, $color = "") {
        $str_color = "";

        if (!empty($color)) {
            if (is_numeric($color) && isset(array_values(self::$color["background"])[$color]))
                $str_color .= "\033[" . array_values(self::$color["background"])[$color] . "m";

            if (is_string($color) && isset(self::$color["background"][$color]))
                $str_color .= "\033[" . self::$color["background"][$color] . "m";

            return $str_color . $message . "\033[0m";
        }

        return $message;
    }

    /**
     * Устанавливает цвета текста.
     *
     * @param  string $message Сообщение журнала.
     * @param  mixed  $color   Требуемый цвет. Принимает значение с наименованием или идентификатором.
     * @return string Раскрашенная строка.
     */
    public static function foreground($message, $color = "") {
        $str_color = "";

        if (!empty($color)) {
            if (is_numeric($color) && isset(array_values(self::$color["foreground"])[$color]))
                $str_color .= "\033[" . array_values(self::$color["foreground"])[$color] . "m";

            if (is_string($color) && isset(self::$color["foreground"][$color]))
                $str_color .= "\033[" . self::$color["foreground"][$color] . "m";

            return $str_color . $message . "\033[0m";
        }

        return $message;
    }
}
