<?php

return [
    "availableTypes" => [
        "steps" => [
            "title" => "Шаги",
            "admin" => "esb-steps",
            "render" => "esb::types.steps",
        ],
    ],

    "maxTitleLength" => 70,
    "maxDigit" => 999,

    // Admin
    "customStepBlockRecordModel" => null,
    "customStepBlockObserverModel" => null,

    // Components
    "customStepsComponent" => null,
];
