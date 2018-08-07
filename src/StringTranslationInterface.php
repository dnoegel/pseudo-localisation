<?php

namespace PseudoLocalisation;

interface StringTranslationInterface
{
    /**
     * @return array of mapping, e.g. ["a" => "á", …]
     */
    public function getMapping(): array;
}