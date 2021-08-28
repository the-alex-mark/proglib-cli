<?php

namespace ProgLib\CLI\Helpers;

use ProgLib\CLI\CLI;
use Exception;

class CLILoop {

    public function __construct() {
        $this->before  = null;
        $this->after   = null;
        $this->loop    = false;
        $this->list    = [];
        $this->text    = 'Команда: ';
        $this->exit    = '';
    }

    #region Properties

    /**
     * @var callable
     */
    private $before;

    /**
     * @var callable
     */
    private $after;

    /**
     * @var string
     */
    private $loop;

    /**
     * @var string
     */
    private $text;

    /**
     * @var string
     */
    private $exit;

    #endregion

    public function before($callback) {
        $this->before = $callback;
        return $this;
    }

    public function after($callback) {
        $this->after = $callback;
        return $this;
    }

    public function loop($value) {
        $this->loop = strval($value);
        return $this;
    }

    /**
     * @throws Exception
     */
    public function list($value) {

        if (!is_array($value))
            throw new Exception('Недопустимый набор команд.');

        // Фильтрация списка команд
        $value = array_filter($value, function ($item) { return !is_null($item); });
        $value = array_map(function ($item) { return strval($item); }, $value);

        if (empty($value))
            throw new Exception('Недопустимый набор команд.');

        $this->list = $value;
        return $this;
    }

    public function text($value) {
        $this->text = strval($value);
        return $this;
    }

    public function exit($value) {
        $this->exit = strval($value);
        return $this;
    }

    /**
     * Выполняет циклический запрос команды из указанного списка.
     */
    public function echo() {
        if (empty($this->list)) {

            // Зацикливание вывода
            do { $data = CLI::read($this->text); }
            while (is_null($data));
        }
        else {
            do {

                //
                call_user_func($this->before);

                CLI::log();

                // Зацикливание вывода
                do { $data = CLI::read($this->text); }
                while ($data !== $this->exit && !in_array($data, $this->list, true));

                //
                if ($data !== $this->exit)
                    call_user_func($this->after, $data);
            }
            while ($this->loop && $data !== $this->exit);

            // Очистка терминала
            if ($this->loop)
                CLI::clear();
        }
    }
}
