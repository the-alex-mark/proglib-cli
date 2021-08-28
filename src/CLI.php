<?php

namespace ProgLib\CLI;

use ProgLib\CLI\Extensions\CLIHelperExtension;
use ProgLib\CLI\Extensions\CLILoggerExtension;
use ProgLib\CLI\Extensions\CLIPhpExtension;
use ProgLib\CLI\Helpers\CLIColor;
use Exception;

/**
 * Предоставляет свойства и методы для работы ввода/вывода данных и выполнения команд в терминале.
 */
class CLI {

    use CLIHelperExtension;
    use CLILoggerExtension;
    use CLIPhpExtension;

    /**
     * Создаёт новый экземпляр класса **CLI**.
     */
    public function __construct() {
        $this->version  = new CLIVersion(1, 0);
        $this->commands = new CLICommandList();
    }

    #region Properties

    /**
     * Номер версии исполняемого файла.
     * @var CLIVersion
     */
    public $version;

    /**
     * Список команд.
     * @var CLICommandList
     */
    private $commands;

    #endregion

    #region Helpers

    /**
     * Возвращает текущий рабочий каталог.
     *
     * @return string|bool
     */
    public static function getCWD() {
        return getcwd();
    }

    #endregion

    /**
     * Выполняет очистку терминала.
     */
    public static function clear() {
        system('clear');
    }

    /**
     * Возвращает данные, вводимые в терминале.
     *
     * @param  string $message Сообщение журнала.
     * @param  string $color  Цвет текста.
     * @return false|string
     */
    public static function read($message = '', $color = '') {
        return readline(CLIColor::foreground($message, $color));
    }

    /**
     * Выполняет ожидание ввода клавиши **Enter**.
     */
    public static function pause() {
        self::log();
        self::read('Для продолжения нажмите клавишу «Enter» ... ');
    }

    /**
     * Выполняет команду через оболочку и возвращает полный вывод в виде строки.
     *
     * @param  string $command Команда.
     * @param  bool   $output  Выводить ли в терминал результат выполнения команды.
     * @return false|string|null
     */
    public static function exec($command, $output = true) {
        $result = shell_exec($command);

        if ($output) self::log($result);
        return $result;
    }

    public function command($slug, $description = '') {
        return $this->commands->add(
            new CLICommand($slug, $description)
        );
    }

    /**
     *
     *
     * @param  mixed $command
     * @throws Exception
     */
    public function run($command) {
        $this->commands->get($command)->run();
    }

    /**
     * Завершает работу скрипта.
     */
    public static function exit() {
        exit();
    }
}
