<?php

namespace PHPMaker2024\project3;

/**
 * Crosstab column class
 */
class CrosstabColumn
{

    public function __construct(
        public $Caption,
        public $Value,
        public $Visible = true,
    ) {
    }
}
