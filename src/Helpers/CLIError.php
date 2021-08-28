<?php

namespace ProgLib\CLI\Helpers;

use ProgLib\CLI\CLI;

/**
 *
 */
class CLIError {

    /**
     *
     */
    public function __construct($title = '') {
        $this->title = $title;
        $this->list  = [];
    }

    #region Properties

    /**
     * Заголовок.
     * @var string
     */
    private $title;

    /**
     * Список ошибок.
     * @var array
     */
    private $list;

    #endregion

    /**
     * Задаёт заголовок.
     *
     * @param  string $value
     * @return $this
     */
    public function title($value) {
        $this->title = $value;

        return $this;
    }

    /**
     * Задаёт ошибку.
     *
     * @param  string $value
     * @return $this
     */
    public function sub($value) {
        $this->list[] = $value;

        return $this;
    }

    /**
     * Задаёт набор ошибок.
     *
     * @param $value
     * @return $this
     */
    public function list($value) {
        $this->list = array_merge($this->list, $value);

        return $this;
    }

    /**
     * Очищает список ошибок.
     *
     * @return $this
     */
    public function clear() {
        $this->list = [];

        return $this;
    }

    /**
     * Выводит список ошибок на экран.
     *
     * @return $this
     */
    public function echo() {
        if (!empty($this->list)) {
            CLI::error($this->title);

            foreach ($this->list as $message)
                CLI::error(' · ' . $message);

            CLI::pause();
        }

        return $this;
    }

    /**
     * Завершает работу скрипта.
     */
    public function exit() {
        CLI::clear();
        CLI::exit();
    }
}
