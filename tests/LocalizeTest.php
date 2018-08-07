<?php


class LocalizeTest extends \PHPUnit\Framework\TestCase
{
    public function testDefaultLocalize(): void
    {
        $localizer = new \PseudoLocalisation\PseudoLocalisation();

        $return = $localizer->localize("Hello World");
        $this->assertEquals("[Ĥēēĺĺōō Ŵōōřĺď]", $return);
    }

    public function testLongLocalize(): void
    {
        $localizer = new \PseudoLocalisation\PseudoLocalisation(1);

        $return = $localizer->localize("Hello World");
        $this->assertEquals("[Ĥēēēēĺĺōōōō Ŵōōōōřĺď]", $return);
    }

    public function testAlternativeDilimiter(): void
    {
        $localizer = new \PseudoLocalisation\PseudoLocalisation(1, ["->", "<-"]);

        $return = $localizer->localize("Hello World");
        $this->assertEquals("->Ĥēēēēĺĺōōōō Ŵōōōōřĺď<-", $return);
    }


    public function testUmlaut(): void
    {
        $localizer = new \PseudoLocalisation\PseudoLocalisation(1, ["->", "<-"]);

        $return = $localizer->localize("Pökelsalz");
        $this->assertEquals("->Pööööķēēēēĺŝááááĺž<-", $return);
    }
}
