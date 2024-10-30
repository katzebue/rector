<?php

declare(strict_types=1);

namespace Katzebue\Rector\Tests\MoveScalarToRightSideRector;

use Iterator;
use Katzebue\Rector\MoveScalarToRightSideRector;
use Override;
use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\Attributes\DataProvider;
use Rector\Testing\PHPUnit\AbstractRectorTestCase;

#[CoversMethod(MoveScalarToRightSideRector::class, 'refactor')]
final class MoveScalarToRightSideRectorTest extends AbstractRectorTestCase
{
    public static function provideData(): Iterator
    {
        return self::yieldFilesFromDirectory(__DIR__ . '/fixture');
    }

    #[DataProvider('provideData')]
    public function test(string $filePath): void
    {
        $this->doTestFile($filePath);
    }

    #[Override]
    public function provideConfigFilePath(): string
    {
        return __DIR__ . '/config/configured_rule.php';
    }
}
