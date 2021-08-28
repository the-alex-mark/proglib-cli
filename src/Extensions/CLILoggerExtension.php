<?php

namespace ProgLib\CLI\Extensions;

use ProgLib\CLI\Helpers\CLIColor;

/**
 * Функционал вывода информации в терминал.
 */
trait CLILoggerExtension {

    /**
     * Выводит в терминал сообщение типа **ALERT**.
     *
     * @param  string $message Сообщение журнала.
     * @return void
     */
    public static function alert($message = '') {

    }

    /**
     * Выводит в терминал сообщение типа **CRITICAL**.
     *
     * @param  string $message Сообщение журнала.
     * @return void
     */
    public static function critical($message = '') {

    }

    /**
     * Выводит в терминал сообщение типа **DEBUG**.
     *
     * @param  string $message Сообщение журнала.
     * @return void
     */
    public static function debug($message = '') {
        self::log($message . PHP_EOL);
    }

    /**
     * Выводит в терминал сообщение типа **EMERGENCY**.
     *
     * @param  string $message Сообщение журнала.
     * @return void
     */
    public static function emergency($message = '') {

    }

    /**
     * Выводит в терминал сообщение типа **ERROR**.
     *
     * @param  string $message Сообщение журнала.
     * @return void
     */
    public static function error($message = '') {
        self::log($message . PHP_EOL, 'red');
    }

    /**
     * Выводит в терминал сообщение типа **INFO**.
     *
     * @param  string $message Сообщение журнала.
     * @return void
     */
    public static function info($message = '') {
        self::log($message . PHP_EOL, 'green');
    }

    /**
     * Выводит в терминал сообщение с указанным цветом текста либо перенос строки.
     *
     * @param  string $message Сообщение журнала.
     * @param  string $color   Цвет текста.
     * @return void
     */
    public static function log($message = '', $color = '') {
        echo (!empty($message)) ? CLIColor::foreground($message, $color) : PHP_EOL;
    }

    /**
     * Выводит в терминал сообщение типа **NOTICE**.
     *
     * @param  string $message Сообщение журнала.
     * @return void
     */
    public static function notice($message = '') {
        self::log($message . PHP_EOL, 'blueLight');
    }

    /**
     * Выводит в терминал сообщение типа **WARNING**.
     *
     * @param  string $message Сообщение журнала.
     * @return void
     */
    public static function warning($message = '') {
        self::log($message . PHP_EOL, 'yellow');
    }
}
