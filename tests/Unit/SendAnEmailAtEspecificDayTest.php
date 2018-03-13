<?php

namespace Tests\Unit;

use App\Mail\HelloUser;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SendAnEmailAtEspecificDayTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic test example.
     *
     * @test
     */
    public function sendAnEmailTheSameDay()
    {
        $user = factory(User::class)->create(['email' => 'quimgonzalez@iesebre.com']);
        dump($user);


        $day = Carbon::now();
        $deliveryDay = Carbon::createFromFormat('Y-m-d',ENV('DELIVERY_DAY'));

        $this->assertEquals($day->year,$deliveryDay->year);
        $this->assertEquals($day->month,$deliveryDay->month);
        $this->assertEquals($day->day,$deliveryDay->day);

        if($day->year == $deliveryDay->year && $day->month == $deliveryDay->month && $day->day == $deliveryDay->day){
            Mail::to(User::find(1))->send(new HelloUser());
        }


    }
}
