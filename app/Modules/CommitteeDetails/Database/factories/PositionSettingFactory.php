<?php

use Carbon\Carbon;
use App\Modules\CommitteeDetails\Entities\PositionSetting;
use Faker\Generator as Faker;

$factory->define(PositionSetting::class, function (Faker $faker) {
    return [
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now()
    ];
});