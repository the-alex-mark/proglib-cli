<?php

// Подключение файла автозагрузки
require_once 'vendor/autoload.php';

use ProgLib\CLI\CLI;
use ProgLib\CLI\Helpers\CLITitle;

(new CLITitle())
    ->title('Тестирование проекта «ProgLib CLI»')
    ->sub('Версия: 1.0.0')
    ->sub('Задача: Логирование')
    ->echo();

CLI::debug('Привет мир!');
CLI::info('Привет мир!');
CLI::notice('Привет мир!');
CLI::warning('Привет мир!');
CLI::error('Привет мир!');
