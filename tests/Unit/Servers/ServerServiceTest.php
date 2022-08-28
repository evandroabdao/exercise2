<?php

namespace Tests\Unit\Servers;

use App\Filters\Servers\ServerFilter;
use Tests\TestCase;

class ServerServiceTest extends TestCase
{
    private $serverFilter = ServerFilter::class;

    /**
     * Testing calculation of total stogare by the string of harddisk.
     *
     * @return void
     */
    public function test_it_calculates_total_storage()
    {
        $filter = app($this->serverFilter);
        $expectedValue = 240;
        $notExpectedValue = 500;
        
        $reflection = new \ReflectionClass($this->serverFilter);
        $method = $reflection->getMethod('calculateStorage');
        $method->setAccessible(true);

        $calculatedTotalStorage = $method->invokeArgs($filter, ['2x120GBSSD']);
        $this->assertEquals($calculatedTotalStorage, $expectedValue);
        $this->assertNotEquals($notExpectedValue, $expectedValue);
    }
}
