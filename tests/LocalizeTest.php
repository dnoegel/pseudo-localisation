<?php


use PseudoLocalisation\PseudoLocalisation;
use PseudoLocalisation\StringTranslationInterface;

class LocalizeTest extends \PHPUnit\Framework\TestCase
{
    public function testDefaultLocalize(): void
    {
        $localizer = new PseudoLocalisation();

        $return = $localizer->localize("Hello World");
        $this->assertEquals("[Ĥēēĺĺōō Ŵōōřĺď]", $return);
    }

    public function testLongLocalize(): void
    {
        $localizer = new PseudoLocalisation(1);

        $return = $localizer->localize("Hello World");
        $this->assertEquals("[Ĥēēēēĺĺōōōō Ŵōōōōřĺď]", $return);
    }

    public function testAlternativeDilimiter(): void
    {
        $localizer = new PseudoLocalisation(1, ["->", "<-"]);

        $return = $localizer->localize("Hello World");
        $this->assertEquals("->Ĥēēēēĺĺōōōō Ŵōōōōřĺď<-", $return);
    }


    public function testUmlaut(): void
    {
        $localizer = new PseudoLocalisation(1, ["->", "<-"]);

        $return = $localizer->localize("Pökelsalz");
        $this->assertEquals("->Pööööķēēēēĺŝááááĺž<-", $return);
    }

    public function testCustomStringTranslation()
    {
        $localizer = new PseudoLocalisation(0);
        $localizer->setStringTranslation(new class implements StringTranslationInterface {
            public function getMapping(): array
            {
                return ["a" => "_"];
            }

        });

        $string = $localizer->localize("Hallo");
        $this->assertEquals("[H_llo]", $string);
    }

    public function testMultiLine(): void
    {
        $localizer = new PseudoLocalisation();

        $return = $localizer->localize("Hello\nWorld");
        $this->assertEquals("[Ĥēēĺĺōō\nŴōōřĺď]", $return);

    }
}
