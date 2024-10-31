<?php

declare(strict_types=1);

namespace Katzebue\Rector\Tests\MoveScalarToRightSideRector;

use Katzebue\Rector\MoveScalarToRightSideRector;
use Katzebue\Rector\Tests\FixtureTestCase;
use PHPUnit\Framework\Attributes\CoversMethod;

#[CoversMethod(MoveScalarToRightSideRector::class, 'refactor')]
final class MoveScalarToRightSideRectorTest extends FixtureTestCase
{
}
