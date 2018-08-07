<?php

namespace PseudoLocalisation;

class Extended
{

    // https://en.wikipedia.org/wiki/Latin_Extended-A
    protected $mapping = [
        "a" => "á",
        "b" => "b",
        "c" => "ć",
        "d" => "ď",
        "e" => "ē",
        "f" => "f",
        "g" => "ĝ",
        "h" => "ĥ",
        "i" => "ĩ",
        "j" => "ĵ",
        "k" => "ķ",
        "l" => "ĺ",
        "m" => "m",
        "n" => "ń",
        "o" => "ō",
        "p" => "p",
        "q" => "q",
        "r" => "ř",
        "s" => "ŝ",
        "t" => "ť",
        "u" => "ũ",
        "v" => "v",
        "w" => "w",
        "x" => "x",
        "y" => "ŷ",
        "z" => "ž",

        "A" => "Ā",
        "B" => "B",
        "C" => "Ć",
        "D" => "Ď",
        "E" => "Ĕ",
        "F" => "F",
        "G" => "Ĝ",
        "H" => "Ĥ",
        "I" => "Ĩ",
        "J" => "Ĵ",
        "K" => "Ķ",
        "L" => "Ľ",
        "M" => "M",
        "N" => "Ń",
        "O" => "Ō",
        "P" => "P",
        "Q" => "Q",
        "R" => "Ŕ",
        "S" => "Ś",
        "T" => "Ţ",
        "U" => "Ŭ",
        "V" => "V",
        "W" => "Ŵ",
        "X" => "X",
        "Y" => "Ÿ",
        "Z" => "Ž",
    ];

    public function getMapping(): array
    {
        return $this->mapping;
    }
}