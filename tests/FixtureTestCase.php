<?php

declare(strict_types=1);

namespace Katzebue\Rector\Tests;

use Iterator;
use Override;
use PHPUnit\Framework\Attributes\DataProvider;
use Rector\Testing\PHPUnit\AbstractRectorTestCase;
use ReflectionClass;

abstract class FixtureTestCase extends AbstractRectorTestCase
{
    public static function provideData(): Iterator
    {
        return self::yieldFilesFromDirectory(static::getDir() . '/fixture');
    }

    private static function getDir(): string
    {
        $reflector = new ReflectionClass(static::class);
        $filename = $reflector->getFileName();
        return dirname($filename);
    }

    #[DataProvider('provideData')]
    final public function test(string $filePath): void
    {
        $this->doTestFile($filePath);
    }

    #[Override]
    final public function provideConfigFilePath(): string
    {
        return static::getDir() . '/config/configured_rule.php';
    }
}
