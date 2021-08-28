<?php

namespace ProgLib\CLI\Helpers;

/**
 *
 */
class CLITitle {

    /**
     *
     */
    public function __construct($title = '') {

        // Текст заголовка по умолчанию
        $this->title = $title;
        $this->sub   = [];

        // Стиль заголовка по умолчанию
        $this->setVersionBorder('v2');
        $this->setCustomColor('blueLight', 'yellow');
    }

    #region Properties

    /**
     *
     * @var string
     */
    private $title;

    /**
     *
     * @var string[]
     */
    private $sub;

    /**
     * Задаёт максимальную длину текста заголовка.
     * @var int
     */
    private $length = 68;

    /**
     * Задаёт цвета основного и второстепенного текста.
     * @var object
     */
    private $color;

    /**
     * Задаёт символы границ заголовка.
     * @var object
     */
    private $border;

    #endregion

    #region Helpers

    /**
     * Задаёт заранее определённые стили границ заголовка.
     *
     * @param  string $version
     * @return $this
     */
    public function setVersionBorder($version = 'v2') {
        switch ($version) {

            case 'v1':
                return $this->setCustomBorder('*', '*', '*', '*', '*', '*');

            case 'v2':
            default:
                return $this->setCustomBorder('-', '-', '-', '-', '-', '-');

            case 'v3':
                return $this->setCustomBorder('┌', '┐', '┘', '└', '─', '│');

            case 'v4':
                return $this->setCustomBorder('╭', '╮', '╯', '╰', '─', '│');
        }
    }

    /**
     * Задаёт пользовательские стили границ заголовка.
     *
     * @param  string $topLeft
     * @param  string $topRight
     * @param  string $bottomRight
     * @param  string $bottomLeft
     * @param  string $horizontal
     * @param  string $vertical
     * @return $this
     */
    public function setCustomBorder($topLeft, $topRight, $bottomRight, $bottomLeft, $horizontal, $vertical) {
        $this->border = (object)[
            'topLeft'     => $topLeft,
            'topRight'    => $topRight,
            'bottomRight' => $bottomRight,
            'bottomLeft'  => $bottomLeft,
            'horizontal'  => $horizontal,
            'vertical'    => $vertical
        ];

        return $this;
    }

    /**
     * Задаёт пользовательские цвета текста заголовка.
     *
     * @param  string $primary
     * @param  string $secondary
     * @return $this
     */
    public function setCustomColor($primary, $secondary) {
        $this->color = (object)[
            'primary'     => $primary,
            'secondary'   => $secondary
        ];

        return $this;
    }

    #endregion

    #region Methods

    /**
     * Разделяет строку символами переноса, если её длина больше требуемой.
     *
     * @param  string $string Строка для переноса.
     * @param  int    $length Максимальная длина.
     * @return array
     */
    private function wordwrap($string, $length) {
        $lines  = explode(PHP_EOL, $string);
        $result = [];

        foreach ($lines as $line) {
            $line = wordwrap($line, ($length * 2) - 4, PHP_EOL, true);
            $line = explode(PHP_EOL, $line);

            foreach ($line as $subline) {
                $mbTargetLength = strlen($subline) - mb_strlen($subline) + $length;
                $result[] = sprintf("%'. -{$mbTargetLength}s", $subline);
            }
        }

        return $result;
    }

    #endregion

    /**
     *
     *
     * @param  string $title
     * @return $this
     */
    public function title($title) {
        $this->title = $title;

        return $this;
    }

    /**
     *
     *
     * @param  string $value
     * @return $this
     */
    public function sub($value) {
        if (!empty($value))
            $this->sub[] = $value;

        return $this;
    }

    /**
     * Выводит содержимое заголовка на экран.
     *
     * @return $this
     */
    public function echo() {
        echo $this->toString() . PHP_EOL . PHP_EOL;

        return $this;
    }

    /**
     * Преобразует значение текущего объекта **CLITitle** в эквивалентное ему представление **String**.
     *
     * @return string
     */
    public function toString() {
        $result = CLIColor::foreground($this->border->topLeft . str_repeat($this->border->horizontal, $this->length + 2) . $this->border->topRight, $this->color->primary) . PHP_EOL;

        $lines = $this->wordwrap($this->title . (!empty($this->sub) ? PHP_EOL : ''), $this->length);
        foreach ($lines as $line)
            $result .= CLIColor::foreground($this->border->vertical . ' ' . $line . ' ' . $this->border->vertical, $this->color->primary) . PHP_EOL;

        if (!empty($this->sub)) {
            $lines = $this->wordwrap(implode(PHP_EOL, $this->sub), $this->length);
            foreach ($lines as $line) {
                $result .= CLIColor::foreground($this->border->vertical . ' ', $this->color->primary);
                $result .= CLIColor::foreground($line, $this->color->secondary);
                $result .= CLIColor::foreground(' ' . $this->border->vertical, $this->color->primary);
                $result .= PHP_EOL;
            }
        }

        $result .= CLIColor::foreground($this->border->bottomLeft . str_repeat($this->border->horizontal, $this->length + 2) . $this->border->bottomRight, $this->color->primary);

        return $result;
    }
}
