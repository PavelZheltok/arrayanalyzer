<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
//use PZ\Analyzer\Analyzer;
use PZ\ArrayAnalyzer;

class AnalyzerTest extends TestCase
{
    private $simpleArray1 = [1, 2, 3];
    private $simpleArray2 = [1, 2, 3];

    private $multiArray1 = [1, 2, 3, [1, 'test', 3]];
    private $multiArray2 = ['somekey', 1, ['test' => ['test' => null]]];

    private $simpleAssociativeArray1 = [1, 2, 'somekey' => 'value'];
    private $simpleAssociativeArray2 = ['somekey' => 1, 2];

    private $deepArray = [
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
                                            'mykey' => 's',
                                        ],
                                        'mykey' => 'dsafasdf',
                                        [
                                            'test' => 'd',
                                            'mykey' => 's',
                                        ],

                                        [
                                            'test' => 'd',
                                            'mykey' => 's',
                                        ],
                                    ],
                                ],
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
        6,
    ];

    public function testFindKeysResultIsArray(): void
    {
        $array = [];
        $result = ArrayAnalyzer::findKeysPaths($array, 'somekey');
        $this->assertIsArray($result);
        $this->assertEmpty($result);
    }

    public function testOneDimentionalArrayWithoutKey(): void
    {
        $result = ArrayAnalyzer::findKeysPaths($this->simpleArray1, 'somekey');
        $this->assertEmpty($result);
        $this->assertEquals(1, ArrayAnalyzer::findMaxDepth($this->simpleArray1));

        $result = ArrayAnalyzer::findKeysPaths($this->simpleArray2, 'somekey');
        $this->assertEmpty($result);

        $this->assertEquals(1, ArrayAnalyzer::findMaxDepth($this->simpleArray2));
    }

    public function testMultyDimentionalArrayWithoutKey(): void
    {
        $result = ArrayAnalyzer::findKeysPaths($this->multiArray1, 'somekey');
        $this->assertEquals(2, ArrayAnalyzer::findMaxDepth($this->multiArray1));
        $this->assertEmpty($result);

        $this->assertEquals(3, ArrayAnalyzer::findMaxDepth($this->multiArray2));
        $result = ArrayAnalyzer::findKeysPaths($this->multiArray2, 'somekey');
        $this->assertEmpty($result);
    }

    public function testOneDimentionalArrayWitKey(): void
    {
        $this->assertEquals(1, ArrayAnalyzer::findMaxDepth($this->simpleAssociativeArray1));
        $result = ArrayAnalyzer::findKeysPaths($this->simpleAssociativeArray1, 'somekey');
        $this->assertEquals(['somekey'], $result);

        $this->assertEquals(1, ArrayAnalyzer::findMaxDepth($this->simpleAssociativeArray2));
        $result = ArrayAnalyzer::findKeysPaths($this->simpleAssociativeArray2, 'somekey');
        $this->assertEquals(['somekey'], $result);
    }

    public function testMultyDimentionalArrayWitKey(): void
    {
        $result = ArrayAnalyzer::findKeysPaths($this->simpleAssociativeArray1, 'somekey');
        $this->assertEquals(['somekey'], $result);

        $result = ArrayAnalyzer::findKeysPaths($this->simpleAssociativeArray2, 'somekey');
        $this->assertEquals(['somekey'], $result);
    }

    public function testMyltyDimansionalArrayWithManyKeys(): void
    {
        $result = ArrayAnalyzer::findKeysPaths($this->deepArray, 'mykey');
        $this->assertContains('mykey', $result);
        $this->assertContains('mykey.mykey', $result);
        $this->assertContains('mykey.test.mykey', $result);
        $this->assertContains('mykey.test.mykey.test2.mykey', $result);
        $this->assertContains('mykey.test.mykey.test2.mykey.0.oooooo.mykey', $result);
        $this->assertContains('mykey.test.mykey.test2.mykey.0.0.asdfasdf.0.mykey', $result);
        $this->assertContains('mykey.test.mykey.test2.mykey.0.0.asdfasdf.mykey', $result);
        $this->assertContains('mykey.test.mykey.test2.mykey.0.0.asdfasdf.1.mykey', $result);
        $this->assertContains('mykey.test.mykey.test2.mykey.0.0.asdfasdf.2.mykey', $result);
        $this->assertContains('mykey.test.mykey.test2.mykey.mykey', $result);
        $this->assertContains('key2.mykey', $result);
        $this->assertContains('key3.subkey3.ssubkey2.mykey', $result);
        $this->assertContains('key3.subkey3.ssubkey2.mykey.mykey', $result);
        $this->assertContains('key3.subkey3.ssubkey3.test.test2.mykey', $result);
        $this->assertContains('key4.mykey', $result);
        $this->assertEquals(10, ArrayAnalyzer::findMaxDepth($this->deepArray));
    }

}
