<?php

namespace PseudoLocalisation;

class PseudoLocalisation
{
    /**
     * @var float
     */
    private $expandBy;

    /**
     * @var array
     */
    private $delim;

    public function __construct($expandBy=0.4, $delim=["[", "]"])
    {
        $this->expandBy = $expandBy;
        $this->delim = $delim;
    }

    public function localize($string): string
    {
        return $this->addDelimeters($this->translateString($this->expandString($string)));
    }

    private function addDelimeters($string): string
    {
        return $this->delim[0] . $string . $this->delim[1];
    }

    private function translateString($string): string
    {
        $mapping = (new Extended())->getMapping();
        $find = array_keys($mapping);
        $replace = array_values($mapping);
        return str_replace($find, $replace, $string);
    }

    private function expandString($string): string
    {
        //expand
        $chars = preg_split('//', $string, null, PREG_SPLIT_NO_EMPTY);
        $vowels = array_filter($chars, function($letter) {
            return in_array($letter, ["a", "e", "i", "o", "u", "A", "E", "I", "O", "U"]);
        });
        $numVowels = count($vowels);
        $expectedLength = ceil(strlen($string) + strlen($string) * $this->expandBy);
        $perVowelExpansion = floor(($expectedLength- strlen($string)) / $numVowels) ;


        $chars = array_map(function($letter) use ($perVowelExpansion) {
            $isVowel = in_array($letter, ["a", "e", "i", "o", "u", "A", "E", "I", "O", "U"]);

            if (!$isVowel || $perVowelExpansion < 1) {
                return $letter;
            }

            return str_repeat($letter, $perVowelExpansion + 1);
        }, $chars);

        return implode("", $chars);

    }
}