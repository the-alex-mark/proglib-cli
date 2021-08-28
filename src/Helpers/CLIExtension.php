<?php

namespace ProgLib\CLI\Helpers;

class CLIExtension {

    /**
     *
     *
     * @return CLITitle
     */
    public static function title($title = '') {
        return new CLITitle($title);
    }

    /**
     *
     *
     * @return CLIError
     */
    public static function error($title = '') {
        return new CLIError($title);
    }

    /**
     *
     *
     * @return CLILoop
     */
    public static function loop() {
        return new CLILoop();
    }
}
