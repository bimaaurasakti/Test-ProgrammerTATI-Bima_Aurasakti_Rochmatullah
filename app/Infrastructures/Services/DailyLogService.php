<?php

namespace App\Infrastructures\Services;

use Exception;
use App\Models\DailyLog;
use Illuminate\Support\Collection;
use App\Dictionaries\Users\UserTypeDictionary;
use App\Infrastructures\Repositories\DailyLogRepository;

class DailyLogService
{
    protected $dailyLogRepository;

    public function __construct()
    {
        $this->dailyLogRepository = new DailyLogRepository();
    }

    public function getAll()
    {
        return $this->dailyLogRepository->all();
    }

    public function findById($dailyLog, $with = [])
    {
        return $this->dailyLogRepository->findById($dailyLog, $with);
    }

    public function craete($request)
    {
        // Create collection
        $collection = new Collection($request);

        // Create daily log
        $dailyLogDataArray = ['user_id', 'activity', 'status', 'notes', 'log_date'];
        $dailyLogData = $collection->only($dailyLogDataArray)->toArray();
        $newUser = $this->dailyLogRepository->create($dailyLogData);

        return $newUser;
    }

    public function update(DailyLog $dailyLog, $request)
    {
        // Remove null data
        $request = arrayFilterNullData($request);

        // Create collection
        $collection = new Collection($request);

        // Update user
        $dailyLogDataArray = ['user_id', 'activity', 'status', 'notes', 'log_date'];
        $dailyLogData = $collection->only($dailyLogDataArray)->toArray();
        $updatedDailyLog = $this->dailyLogRepository->updateById($dailyLog->id, $dailyLogData);

        return $updatedDailyLog;
    }

    public function reject($dailyLogID)
    {
        $dailyLog = $this->dailyLogRepository->findById($dailyLogID, ['user.manager']);
        if ((auth()->user()->can('daily-log-reject-' . $dailyLog->user->type) && $dailyLog->user->manager->id == auth()->user()->id) || auth()->user()->user_type == UserTypeDictionary::USER_TYPE_SUPER_ADMIN) {
            $this->dailyLogRepository->reject($dailyLog->id);
        } else {
            throw new Exception('You are not allowed to reject daily log');
        }
    }

    public function accept($dailyLogID)
    {
        $dailyLog = $this->dailyLogRepository->findById($dailyLogID, ['user.manager']);
        if ((auth()->user()->can('daily-log-reject-' . $dailyLog->user->type) && $dailyLog->user->manager->id == auth()->user()->id) || auth()->user()->user_type == UserTypeDictionary::USER_TYPE_SUPER_ADMIN) {
            $this->dailyLogRepository->accept($dailyLog->id);
        } else {
            throw new Exception('You are not allowed to accept daily log');
        }
    }
}
