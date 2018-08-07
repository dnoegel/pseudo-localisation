# Pseudo Localisation
Translates a given string into a pseudo localisation. This will help you to test your UI regarding:

* long strings from other languages
* unicode characters
* truncated characters (missing delimiters indicate a truncated string)

The generated pseudo localisations will still be readable.  

# Example
```
$localizer = new \PseudoLocalisation\PseudoLocalisation();
echo  $localizer->localize("Hello World");
```

prints `[Ĥēēĺĺōō Ŵōōřĺď]`

# Additional configuration
## Expansion width
```
(new \PseudoLocalisation\PseudoLocalisation(1))->localize("Hello World");
```
will increase the text expansion from the default 40% to 100% and thus return `[Ĥēēēēĺĺōōōō Ŵōōōōřĺď]`.

## Delimiter 
```
(new \PseudoLocalisation\PseudoLocalisation(2, ["a", "b"]))->localize("Hello World");
```
will use the delimiters `a` and `b` instead of the default `[`, `]`. Returns `aĤēēēēĺĺōōōō Ŵōōōōřĺďb` in this case.

## Repeatable Characters
By default vowels and umlauts will be repeated. You can override this behaviour:
```
(new \PseudoLocalisation\PseudoLocalisation(0.4, ["[", "]"], [" "]))->localize("Hello World");
```

will only expand spaces and return 

```
[Ĥēĺĺō      Ŵōřĺď]
```
