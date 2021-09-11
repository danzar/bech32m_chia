<?php


    use Danzar\Bech32m\Bech32m;
    use PHPUnit\Framework\TestCase;

    final class Bech32mTest extends TestCase
    {

        public function test_encodeSegwit_is_successful()
        {
            //Arrange
            $address = 'xch1v7hdwth79shnzp0aeux3049f29yqxmf3uahqfazzfupe3kxvldhqzrtqc8';

            $hrp = 'xch';
            $version = 1;
            $hexPuzzle = '67aed72efe2c2f3105fdcf0d17d4a95148036d31e76e04f4424f0398d8ccfb6e';
            $hex = hex2bin($hexPuzzle);

            //Act
            $result = Bech32m::encodeSegwit($hrp, $version, $hex);

            //Assert
            $this->assertNotNull($result);
            $this->assertSame($address, $result);

        }

        public function test_encodeSegwit_is_successful_with_string()
        {
            //Arrange
            $hrp = 'xch';
            $version = 1;
            $hexPuzzle = bin2hex("some value");
            $hex = hex2bin($hexPuzzle);

            //Act
            $result = Bech32m::encodeSegwit($hrp, $version, $hex);

            //Assert
            $this->assertNotNull($result);
            $this->assertSame('xch1wdhk6efqweskcat9lfkkm3', $result);
        }


        public function test_encodeSegwit_is_invalid_length()
        {
            //Arrange
            $hrp = 'xch';
            $version = 1;
            $hex = '6';

            //Act
            $this->expectException(\Danzar\Bech32m\Bech32Exception::class);
            $result = Bech32m::encodeSegwit($hrp, $version, $hex);

            //Assert
        }


        public function test_decodeSegwit_is_successful()
        {
            //Arrange
            $address = 'xch1v7hdwth79shnzp0aeux3049f29yqxmf3uahqfazzfupe3kxvldhqzrtqc8';

            $hrp = 'xch';
            $version = 1;
            $hexPuzzle = '67aed72efe2c2f3105fdcf0d17d4a95148036d31e76e04f4424f0398d8ccfb6e';

            //Act
            [$hex_value, $hexPuzzleResult] = Bech32m::decodeSegwit($hrp, $address);

            //Assert
            $this->assertNotNull($hexPuzzleResult);
            $this->assertSame(bin2hex($hexPuzzleResult), $hexPuzzle);
            $this->assertNotNull($hex_value);
        }
    }
