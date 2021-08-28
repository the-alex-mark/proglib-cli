<?php

namespace ProgLib\CLI;

/**
 * Представляет объект номера версии.
 */
class CLIVersion {

    /**
     * Инициализирует новый экземпляр класса **CliVersion**.
     *
     * @param  numeric $major
     * @param  numeric $minor
     * @param  numeric $build
     * @param  numeric $revision
     */
    public function __construct($major, $minor, $build = null, $revision = null) {
        $this->major    = $major;
        $this->minor    = $minor;
        $this->build    = $build;
        $this->revision = $revision;
    }

    #region Properties

    /**
     * Получает значение компонента текущего объекта **CliVersion**, представляющего в номере версии основной номер.
     * @var numeric
     */
    public $major;

    /**
     * Возвращает значение компонента текущего объекта **CliVersion**, представляющего в номере версии дополнительный номер.
     * @var numeric
     */
    public $minor;

    /**
     * Возвращает значение компонента текущего объекта **CliVersion**, представляющего в номере версии номер построения.
     * @var numeric
     */
    public $build;

    /**
     * Возвращает значение компонента текущего объекта **CliVersion**, представляющего в номере версии номер редакции.
     * @var numeric
     */
    public $revision;

    #endregion

    /**
     * Преобразует значение текущего объекта **CliVersion** в эквивалентное ему представление **String**.
     *
     * @return string
     */
    public function toString() {
        $version = [ $this->major, $this->minor, $this->build, $this->revision ];
        $version = array_filter($version, function($element) { return !is_null($element); });

        return implode($version, '.');
    }
}
