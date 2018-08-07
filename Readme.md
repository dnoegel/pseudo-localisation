# Pseudo Localisation
Translates a given string into a pseudo localisation. This will help you to test your UI regarding:

* long strings from other languages
* unicode characters
* truncated characters

# Example
```
$localizer = new \PseudoLocalisation\PseudoLocalisation();
echo  $localizer->localize("Hello World");
```

prints `[Ĥēēĺĺōō Ŵōōřĺď]`

# Additional configuration
```
(new \PseudoLocalisation\PseudoLocalisation(2))->localize("Hello World");
```
will increase the text expansion from the default 40% to 100% and thus return `[Ĥēēēēĺĺōōōō Ŵōōōōřĺď]`.

```
(new \PseudoLocalisation\PseudoLocalisation(2, ["a", "b"]))->localize("Hello World");
```
will use the delimiters "a" and "b" instead of the default "[, ]". Returns `aĤēēēēĺĺōōōō Ŵōōōōřĺďb` in this case.