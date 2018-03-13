<?php

namespace Tests\Unit;

use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SendAnEmailAtEspecificDay extends TestCase
{
    /**
     * A basic test example.
     *
     * @test
     */
    public function sendAnEmailTheSameDay()
    {
        $day = Carbon::now();
        $deliveryDay = Carbon::createFromFormat('Y-m-d',ENV('DELIVERY_DAY'));

        $this->assertEquals($day->year,$deliveryDay->year);
        $this->assertEquals($day->month,$deliveryDay->month);
        $this->assertEquals($day->day,$deliveryDay->day);
    

    }
}
