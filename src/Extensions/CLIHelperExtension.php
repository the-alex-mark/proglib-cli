<?php

namespace ProgLib\CLI\Extensions;

use ProgLib\CLI\Helpers\CLIExtension;

/**
 *
 */
trait CLIHelperExtension {

    /**
     *
     *
     * @return CLIExtension
     */
    public static function extension() {
        return new CLIExtension();
    }
}
