<?php

namespace App\Infrastructures\Repositories;

use App\Dictionaries\DailyLogStatusDictionary;
use App\Models\DailyLog;
use App\Infrastructures\Core\Repository;

class DailyLogRepository extends Repository
{
    protected function model(): string
    {
        return DailyLog::class;
    }

    public function reject($dailyLogID)
    {
        return DailyLog::find($dailyLogID)->update([
            'status' => DailyLogStatusDictionary::STATUS_REJECTED,
        ]);
    }


    public function accept($dailyLogID)
    {
        return DailyLog::find($dailyLogID)->update([
            'status' => DailyLogStatusDictionary::STATUS_ACCEPTED,
        ]);
    }
}
