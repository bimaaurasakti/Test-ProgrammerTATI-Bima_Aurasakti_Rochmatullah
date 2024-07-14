<?php

namespace App\Dictionaries;

class EmployeePerformanceDictionary
{
    const BELOW = 'Dibawah ekspektasi';
    const MEETS = 'Sesuai ekspektasi';
    const EXCEEDS = 'Diatas ekspektasi';

    const WORK_BELOW = self::BELOW;
    const WORK_MEETS = self::MEETS;
    const WORK_EXCEEDS = self::EXCEEDS;

    const BEHAVIOR_BELOW = self::BELOW;
    const BEHAVIOR_MEETS = self::MEETS;
    const BEHAVIOR_EXCEEDS = self::EXCEEDS;

    const VERY_POOR = 'Sangat kurang';
    const POOR = 'Kurang';
    const NEEDS_IMPROVEMENT = 'Butuh perbaikan';
    const GOOD = 'Baik';
    const EXCELLENT = 'Sangat baik';

    public static function workList()
    {
        return [
            self::WORK_BELOW,
            self::WORK_MEETS,
            self::WORK_EXCEEDS,
        ];
    }

    public static function behaviorList()
    {
        return [
            self::BEHAVIOR_BELOW,
            self::BEHAVIOR_MEETS,
            self::BEHAVIOR_EXCEEDS,
        ];
    }

    public static function calculateScore($workResult, $behavior)
    {
        if ($workResult == self::WORK_EXCEEDS && $behavior == self::BEHAVIOR_EXCEEDS) {
            return self::EXCELLENT;
        }
        else if (($workResult == self::WORK_MEETS || $workResult == self::WORK_EXCEEDS) && ($behavior == self::BEHAVIOR_MEETS || $behavior == self::BEHAVIOR_EXCEEDS)) {
            return self::GOOD;
        }
        else if ($workResult == self::WORK_BELOW && ($behavior == self::BEHAVIOR_MEETS || $behavior == self::BEHAVIOR_EXCEEDS)) {
            return self::NEEDS_IMPROVEMENT;
        }
        else if (($workResult == self::WORK_MEETS || $workResult == self::WORK_EXCEEDS) && $behavior == self::BEHAVIOR_BELOW) {
            return self::POOR;
        }  
        else {
            return self::VERY_POOR;
        }
    }
}
