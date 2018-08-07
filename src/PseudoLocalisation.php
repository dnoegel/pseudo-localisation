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

    /**
     * @param float $expandBy Percentage of expansion, e.g. 0.4 for 40%
     * @param array $delim Delimiter, by default [ and ]
     */
    public function __construct($expandBy=0.4, $delim=["[", "]"])
    {
        $this->expandBy = $expandBy;
        $this->delim = $delim;
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
        $chars = preg_split('//', $string, null, PREG_SPLIT_NO_EMPTY);
        $vowels = array_filter($chars, function($letter) {
            return in_array($letter, ["a", "e", "i", "o", "u", "A", "E", "I", "O", "U"]);
        });
        $numVowels = count($vowels);
        $expectedLength = ceil(strlen($string) + strlen($string) * $this->expandBy);
        $perVowelExpansion = floor(($expectedLength- strlen($string)) / $numVowels) ;

        if ($perVowelExpansion <= 0) {
            return $string;
        }

        $chars = array_map(function($letter) use ($perVowelExpansion) {
            $isVowel = in_array($letter, ["a", "e", "i", "o", "u", "A", "E", "I", "O", "U"]);

            if (!$isVowel) {
                return $letter;
            }

            return str_repeat($letter, $perVowelExpansion + 1);
        }, $chars);

        return implode("", $chars);

    }
}