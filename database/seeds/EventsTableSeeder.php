<?php

use Illuminate\Database\Seeder;

class EventsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        foreach (Range(1,10) as $number) {
            \App\Event::create([
                'name' => '活動'.$number,
                'start_date' => date("2018/12/1"),
                'end_date' => date('2019/1/1'),
                'description' => '歡慶2019即將到來',
                'photo_path' => ' '
            ]);
        }
    }
}
