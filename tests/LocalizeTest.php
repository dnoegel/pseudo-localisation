<?php


class LocalizeTest extends \PHPUnit\Framework\TestCase
{
    public function testLocalize(): void
    {
        $localizer = new \PseudoLocalisation\PseudoLocalisation();

        $return = $localizer->localize("Hello World");
        $this->assertEquals("[Ĥēēĺĺōō Ŵōōřĺď]", $return);
    }
}
