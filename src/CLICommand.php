<?php

namespace ProgLib\CLI;

/**
 *
 */
class CLICommand {

    /**
     *
     *
     * @param  string $name
     * @param  string $description
     */
    public function __construct($name, $description = '') {
        $this->name        = $name;
        $this->description = $description;
    }

    #region Properties

    /**
     * Имя.
     * @var string
     */
    public $name;

    /**
     * Описание.
     * @var array
     */
    public $description;

    /**
     * Параметры исполняемой функции.
     * @var array
     */
    public $args;

    /**
     * Исполняемая функция.
     * @var callable
     */
    protected $callback;

    #endregion

    /**
     * Задаёт описание.
     *
     * @param  string $description
     * @return CLICommand
     */
    public function description($description) {
        $this->description = $description;

        return $this;
    }

    /**
     * Задаёт дополнительный аргумент.
     *
     * @param  string $args
     * @param  string $description
     * @return CLICommand
     */
    public function option($args, $description = '') {
        $this->args[] = [
            'args'        => $args,
            'description' => $description
        ];

        return $this;
    }

    /**
     * Задаёт исполняемую функцию команды.
     *
     * @param  callable $callback
     * @return CLICommand
     */
    public function action($callback) {
        $this->callback = $callback;

        return $this;
    }

    public function run() {
        call_user_func($this->callback, $this->name, $this->args);
    }

    /**
     * @return object
     */
    public function toObject() {
        return (object)[
            'name'    => $this->name,
            'options' => $this->args,
            'action'  => $this->callback
        ];
    }
}
