<?php

declare(strict_types=1);

namespace Katzebue\Rector\Tests\ReplaceIsNullWithComparisonRector;

use Katzebue\Rector\ReplaceIsNullWithComparisonRector;
use Katzebue\Rector\Tests\FixtureTestCase;
use PHPUnit\Framework\Attributes\CoversMethod;

#[CoversMethod(ReplaceIsNullWithComparisonRector::class, 'refactor')]
final class ReplaceIsNullWithComparisonRectorTest extends FixtureTestCase
{
}
