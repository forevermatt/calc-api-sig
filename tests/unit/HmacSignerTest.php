<?php

class HmacSignerTest extends PHPUnit_Framework_TestCase
{
    public function testCalcApiSig_defaultHashAlgo()
    {
        // Arrange
        $apiKey = 'a made up api key';
        $sharedSecret = 'a made up shared secret';
        $time = 1399311914;

        // Act
        $apiSig = \CalcApiSig\HmacSigner::CalcApiSig(
            $apiKey,
            $sharedSecret,
            $time
        );

        // Assert
        $this->assertEquals(
            '3e75a94a5bb87f5d3f1c89cb45e0224bfe4d0283',
            $apiSig
        );
    }
    
    public function testCalcApiSig_defaultHashAlgo_invalid()
    {
        // Arrange
        $apiKey = 'a made up api key';
        $sharedSecret = 'a DIFFERENT made up shared secret';
        $time = 1399311914;

        // Act
        $apiSig = \CalcApiSig\HmacSigner::CalcApiSig(
            $apiKey,
            $sharedSecret,
            $time
        );

        // Assert
        $this->assertNotEquals(
            '3e75a94a5bb87f5d3f1c89cb45e0224bfe4d0283',
            $apiSig
        );
    }

    public function testCalcApiSig_md5HashAlgo()
    {
        // Arrange
        $apiKey = 'a made up api key';
        $sharedSecret = 'a made up shared secret';
        $time = 1399311914;
        $algorithm = 'md5';

        // Act
        $apiSig = \CalcApiSig\HmacSigner::CalcApiSig(
            $apiKey,
            $sharedSecret,
            $time,
            $algorithm
        );

        // Assert
        $this->assertEquals('40a675daed03b8559393a8b1e136349d', $apiSig);
    }

    public function testCalcApiSig_unknownHashAlgo()
    {
        // Arrange
        $apiKey = 'a made up api key';
        $sharedSecret = 'a made up shared secret';
        $time = 1399311914;
        $algorithm = 'anUnknownHashingAlgorithmName';

        // Act
        $apiSig = @\CalcApiSig\HmacSigner::CalcApiSig(
            $apiKey,
            $sharedSecret,
            $time,
            $algorithm
        );

        // Assert
        $this->assertNull($apiSig);
    }
}
