<?php
declare(strict_types=1);
use PHPUnit\Framework\TestCase;
use PZ\Finders\ScalarValueFinder;

class ScalarValueFinderTest extends TestCase
{
    /**
     * @var ScalarValueFinder
     */
    private $scalarValueFinder;

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
                                            'test' => 3.14,
                                            'mykey' => 's',
                                        ],
                                        'mykey' => 'dsafasdf',
                                        [
                                            'test' => 'd',
                                            'mykey' => 'z',
                                        ],

                                        [
                                            'test' => 0,
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
        'key0' => 'z',
        'key1' => 't',
        'key2' => [
            'mykey' => 3.14,
        ],
        null => 0,
        'key3' => [
            'subkey1' => [
                true
            ],
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
                            'mykey' => true,
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
        0
    ];

    public function __construct()
    {
        parent::__construct();

        $this->scalarValueFinder = new ScalarValueFinder();
    }

    public function testFindIntegerValue()
    {
        $this->assertEmpty($this->scalarValueFinder->findIntegerValue([], 0));

        $result = $this->scalarValueFinder->findIntegerValue($this->deepArray, 0);
        $this->assertEquals(4, count($result));
        $result = array_map(function ($item) {
            return implode('.', $item);
        }, $result);

        $this->assertContains('mykey.test.mykey.test2.mykey.0.oooooo.mykey', $result);
        $this->assertContains('mykey.test.mykey.test2.mykey.0.0.asdfasdf.2.test', $result);
        $this->assertContains('', $result);
        $this->assertContains('2', $result);
    }

    public function testFindFloatValue()
    {
        $this->assertEmpty($this->scalarValueFinder->findFloatValue([], 0.1));

        $result = $this->scalarValueFinder->findFloatValue($this->deepArray, 3.14);
        $this->assertEquals(2, count($result));
        $result = array_map(function ($item) {
            return implode('.', $item);
        }, $result);

        $this->assertContains('key2.mykey', $result);
        $this->assertContains('mykey.test.mykey.test2.mykey.0.0.asdfasdf.0.test', $result);
    }

    public function testFindBooleanValue()
    {
        $this->assertEmpty($this->scalarValueFinder->findBooleanValue([], false));

        $result = $this->scalarValueFinder->findBooleanValue($this->deepArray, true);
        $this->assertEquals(2, count($result));
        $result = array_map(function ($item) {
            return implode('.', $item);
        }, $result);

        $this->assertContains('key3.subkey3.ssubkey3.test.test2.mykey', $result);
        $this->assertContains('key3.subkey1.0', $result);
    }

    public function testFindStringValue()
    {
        $this->assertEmpty($this->scalarValueFinder->findStringValue([], ''));

        $result = $this->scalarValueFinder->findStringValue($this->deepArray, 'z');
        $this->assertEquals(4, count($result));
        $result = array_map(function ($item) {
            return implode('.', $item);
        }, $result);

        $this->assertContains('mykey.mykey', $result);
        $this->assertContains('mykey.test.mykey.test2.mykey.0.0.asdfasdf.1.mykey', $result);
        $this->assertContains('key0', $result);
        $this->assertContains('key4.mykey', $result);
    }
}
