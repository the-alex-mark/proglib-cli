<?php

namespace ProgLib\CLI;

use Exception;

/**
 *
 */
class CLICommandList {

    /**
     *
     */
    public function __construct() {
        $this->commands = [];
    }

    #region Properties

    /**
     * Список команд.
     * @var CLICommand[]
     */
    private $commands;

    #endregion

    /**
     * @param  CLICommand $command
     * @return CLICommand
     */
    public function add(CLICommand $command) {
        $this->commands[$command->name] = $command;

        return $this->commands[$command->name];
    }

    /**
     *
     *
     * @param  mixed $command
     * @return CLICommand
     * @throws Exception
     */
    public function get($command) {
        if (!isset($this->commands[$command]))
            throw new Exception('Указанной команды не существует.');

        return $this->commands[$command];
    }
}
