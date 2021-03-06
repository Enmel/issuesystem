<?php

use PHPUnit\Framework\TestCase;

class GenerateTest extends TestCase
{
    public function testCanGenerateInitialsWithoutNameParameter()
    {
        $avatar = new \LasseRafn\Initials\Initials();

        $avatar->generate('Lasse Rafn');

        $this->assertEquals('LR', $avatar->getInitials());

        // With emoji
        $avatar = new \LasseRafn\Initials\Initials();

        $avatar->generate('๐');

        $this->assertEquals('๐', $avatar->getInitials());

        // With Japanese letters
        $avatar = new \LasseRafn\Initials\Initials();

        $avatar->generate('ใใใซใกใฏ');

        $this->assertEquals('ใใ', $avatar->getInitials());
    }
}
