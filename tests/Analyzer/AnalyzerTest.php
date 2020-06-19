<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use PZ\ArrayAnalyzer;

class AnalyzerTest extends TestCase
{
    public function testFindKeys(): void
    {
        $result = ArrayAnalyzer::findKeysPaths([], '');
        $this->assertEmpty($result);
    }

    public function testMaxDepth(): void
    {
        $result = ArrayAnalyzer::findMaxDepth([]);
        $this->assertEquals(0, $result);
    }
}
