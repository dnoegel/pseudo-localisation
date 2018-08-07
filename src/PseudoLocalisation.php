<?php

namespace PseudoLocalisation;

class PseudoLocalisation
{
    /**
     * Percentage of expansion, e.g. 0.4 for a 40% expansion
     * @var float
     */
    private $expandBy;

    /**
     * @var array
     */
    private $delim;

    private $repeatableCharacters = ["a", "e", "i", "o", "u", "A", "E", "I", "O", "U", "ä", "ö", "ü", "Ä", "Ö", "ü"];

    /**
     * @param float $expandBy Percentage of expansion, e.g. 0.4 for 40%
     * @param array $delim Delimiter, by default [ and ]
     * @param array $repeatableCharacters Characters that are allowed to repeat. Default: Vowels + Umlauts
     */
    public function __construct($expandBy = 0.4, $delim = ["[", "]"], $repeatableCharacters = [])
    {
        $this->expandBy = $expandBy;
        $this->delim = $delim;

        if (!empty($repeatableCharacters)) {
            $this->repeatableCharacters = $repeatableCharacters;
        }
    }

    /**
     * Returns the pseudo localized variant of a string, e.g. "[Ĥēēĺĺōō Ŵōōřĺď]" for "Hello World"
     *
     * @param $string
     * @return string
     */
    public function localize($string): string
    {
        return $this->addDelimiters($this->translateString($this->expandString($string)));
    }

    /**
     * Adds the delimiter to the string, by default [ and ]
     *
     * @param $string
     * @return string
     */
    private function addDelimiters($string): string
    {
        return $this->delim[0] . $string . $this->delim[1];
    }

    /**
     * Translates a string by replacing the latin characters with unicode pendants
     *
     * @param $string
     * @return string
     */
    private function translateString($string): string
    {
        $mapping = (new Extended())->getMapping();
        $find = array_keys($mapping);
        $replace = array_values($mapping);
        return str_replace($find, $replace, $string);
    }

    /**
     * Expands the given string by the percentage defined in $expandBy
     *
     * @param $string
     * @return string
     */
    private function expandString($string): string
    {
        $chars = preg_split('//u', $string, null, PREG_SPLIT_NO_EMPTY);
        $repeatableCharacters = array_filter($chars, function ($letter) {
            return in_array($letter, $this->repeatableCharacters);
        });
        $numRepeatable = count($repeatableCharacters);
        $expectedLength = ceil(strlen($string) + strlen($string) * $this->expandBy);
        $perCharacterExpansion = floor(($expectedLength - strlen($string)) / $numRepeatable);

        if ($perCharacterExpansion <= 0) {
            return $string;
        }

        $chars = array_map(function ($letter) use ($perCharacterExpansion) {
            $isRepeatable = in_array($letter, $this->repeatableCharacters);

            if (!$isRepeatable) {
                return $letter;
            }

            return str_repeat($letter, $perCharacterExpansion + 1);
        }, $chars);

        return implode("", $chars);

    }
}