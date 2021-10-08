<?php

namespace Tests\Unit\Sample;

use PHPUnit\Framework\TestCase;
use App\PHPUnitSamples\Sample;

class test extends TestCase
{
    // ./vendor/bin/phpunit tests/Unit/Sample/test.php とコマンドを打ってテストを実行する。
    public function test_add(): void
    {
        $sample = new Sample;
        $sum = $sample->add(5, 3);
        $this->assertEquals(8, $sum);
    }

    /**
     * @test
     */
    public function sub(): void
    {
        $sample = new Sample;
        $sub = $sample->sub(5, 3);
        $this->assertEquals(2, $sub);
    }

    public function ignore(): void
    {
        $this->assertTrue(true, 'TEST ignore.');
    }
}
