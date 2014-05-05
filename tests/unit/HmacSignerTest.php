<?php

class HmacSignerTest extends PHPUnit_Framework_TestCase
{
    public function testCalcApiSig()
    {
        // Arrange
        $apiKey = '1f327a26d1b7f541d912ab0b297b049b';
        $sharedSecret = 'cb9ecf1eb29889c1ddf243a93fbe8073bb357e60';
        $time = 1399311914;

        // Act
        $apiSig = \CalcApiSig\HmacSigner::CalcApiSig(
            $apiKey,
            $sharedSecret,
            $time
        );

        // Assert
        $this->assertEquals(
            'cdd38b0a500e345be7a64a2300e0afc5f2d99680',
            $apiSig
        );
    }
}
