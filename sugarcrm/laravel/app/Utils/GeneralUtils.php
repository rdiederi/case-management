<?php namespace App\Utils;

use Illuminate\Support\Facades\DB;

class GeneralUtils {

    public static function getLatestPolicyName($options = []) {
        $result = DB::select("SELECT * FROM lt_policy ORDER BY created_at DESC LIMIT 1");
        return $result[0]->name;
    }

    public static function countIncreaseCoverCases($options = []) {
        $result = DB::select("SELECT COUNT(*) AS number_of_cases FROM lt_case WHERE type = 'increase_cover'");
        return $result[0]->number_of_cases;
    }

    public static function countDecreaseCoverCases($options = []) {
        $result = DB::select("SELECT COUNT(*) AS number_of_cases FROM lt_case WHERE type = 'decrease_cover'");
        return $result[0]->number_of_cases;
    }

    public static function countCancelCoverCases($options = []) {
        $result = DB::select("SELECT COUNT(*) AS number_of_cases FROM lt_case WHERE type = 'cancel_cover'");
        return $result[0]->number_of_cases;
    }

}
