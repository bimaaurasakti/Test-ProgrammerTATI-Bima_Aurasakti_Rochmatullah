<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\User;
use App\Models\DailyLog;
use Illuminate\Database\Seeder;
use App\Dictionaries\DailyLogStatusDictionary;

class DailyLogTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            // Log Staff 1
            [
                'user' => 'staff1',
                'activity' => 'Saya hari ini melakukan slicing UI di aplikasi Tati.',
                'notes' => 'Terdapat kendala pada slicing UI dikarenakan design belum selesai',
                'status' => DailyLogStatusDictionary::STATUS_ACCEPTED,
                'log_date' => Carbon::now()->subDays(3)->format('Y-m-d'),
            ],
            [
                'user' => 'staff1',
                'activity' => 'Saya hari ini melakukan slicing UI di aplikasi Tati.',
                'notes' => 'Terdapat kendala pada slicing UI dikarenakan design belum selesai',
                'status' => DailyLogStatusDictionary::STATUS_REJECTED,
                'log_date' => Carbon::now()->subDays(2)->format('Y-m-d'),
            ],
            [
                'user' => 'staff1',
                'activity' => 'Saya hari ini melakukan slicing UI di aplikasi Tati.',
                'notes' => 'Terdapat kendala pada slicing UI dikarenakan design belum selesai',
                'status' => DailyLogStatusDictionary::STATUS_PENDING,
                'log_date' => Carbon::now()->subDays(1)->format('Y-m-d'),
            ],

            // Log Staff 2
            [
                'user' => 'division_head1',
                'activity' => 'Saya hari ini melakukan pemantauan progress staff1 dalam pengerjaan aplikasi Tati.',
                'notes' => 'Terdapat kendala pada slicing UI dikarenakan design belum selesai',
                'status' => DailyLogStatusDictionary::STATUS_REJECTED,
                'log_date' => Carbon::now()->subDays(3)->format('Y-m-d'),
            ],
            [
                'user' => 'division_head1',
                'activity' => 'Saya hari ini melakukan pemantauan progress staff1 dalam pengerjaan aplikasi Tati.',
                'notes' => 'Terdapat kendala pada slicing UI dikarenakan design belum selesai',
                'status' => DailyLogStatusDictionary::STATUS_ACCEPTED,
                'log_date' => Carbon::now()->subDays(2)->format('Y-m-d'),
            ],
            [
                'user' => 'division_head1',
                'activity' => 'Saya hari ini melakukan pemantauan progress staff1 dalam pengerjaan aplikasi Tati.',
                'notes' => 'Terdapat kendala pada slicing UI dikarenakan design belum selesai',
                'status' => DailyLogStatusDictionary::STATUS_PENDING,
                'log_date' => Carbon::now()->subDays(1)->format('Y-m-d'),
            ],
        ];

        foreach ($data as $value) {
            $value['user_id'] = User::where('username', $value['user'])->first()->id;
            unset($value['user']);
            DailyLog::create($value);
        }
    }
}
