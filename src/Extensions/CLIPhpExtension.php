<?php

namespace ProgLib\CLI\Extensions;

use Symfony\Component\Process\PhpExecutableFinder;

/**
 * Функционал получения информации о **PHP**.
 */
trait CLIPhpExtension {

    /**
     * Возвращает текущую версию PHP
     *
     * @return false|string
     */
    public static function getPhpVersion() {
        return phpversion();
    }

    /**
     * Возвращает значение настройки конфигурации.
     *
     * @param  string $option Имя настройки конфигурации.
     * @return false|string
     */
    public static function getPhpOption($option) {
        return ini_get($option);
    }

    /**
     * Возвращает расположение исполняемого интерпретатора **PHP**.
     *
     * @return false|string
     */
    public static function getPhpExecutable() {
        return (new PhpExecutableFinder)->find();
    }
}
