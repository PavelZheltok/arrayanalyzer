<?php

include_once 'vendor/autoload.php';

use PZ\ArrayAnalyzer;

$myArray = [
    'mykey' => [
        'mykey' => 'z',
        'test' => [
            'aaa' => '0',
            'mykey' => [
                'test2' => [
                    'mykey' => [
                        [
                            'oooooo' => [
                                'mykey' => 0,
                            ],
                            [
                                'asdfasdf' => [
                                    [
                                        'test' => 'd',
                                        'mykey' => 's'
                                    ],
                                    'mykey' => 'dsafasdf',
                                    [
                                        'test' => 'd',
                                        'mykey' => 's'
                                    ],

                                    [
                                        'test' => 'd',
                                        'mykey' => 's'
                                    ]
                                ]
                            ]
                        ],
                        'mykey' => 'ddddd',
                    ],
                ],
            ],
        ],

    ],
    'key1' => 't',
    'key2' => [
        'mykey' => 'rrrrr',
    ],
    null => 0,
    'key3' => [
        'subkey1' => [],
        'subkey2' => null,
        'subkey3' => [
            'ssubkey1' => 1,
            'ssubkey2' => [
                'mykey' => [
                    'test' => '1',
                    'mykey' => 'value',
                ],
            ],
            'ssubkey3' => [
                'test' => [
                    'test2' => [
                        'mykey' => 'value',
                    ],
                ],
            ],
        ],
    ],
    'key4' => [
        'mykey' => 'z',
    ],
    2,
    6
];

$ar = [
    'mykey1' => 'value',
    'mykey2' => [
        'mykey' => 'value',
        'mykey1' => 'value3'
    ],
];

$result = ArrayAnalyzer::findKeysPaths($ar, 'mykey1');
var_dump($result);
