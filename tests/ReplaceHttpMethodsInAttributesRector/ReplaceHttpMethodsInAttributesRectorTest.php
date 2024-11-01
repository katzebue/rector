<?php

declare(strict_types=1);

namespace Katzebue\Rector\Tests\ReplaceHttpMethodsInAttributesRector;

use Katzebue\Rector\ReplaceHttpMethodsInAttributesRector;
use Katzebue\Rector\Tests\FixtureTestCase;
use PHPUnit\Framework\Attributes\CoversMethod;

#[CoversMethod(ReplaceHttpMethodsInAttributesRector::class, 'refactor')]
final class ReplaceHttpMethodsInAttributesRectorTest extends FixtureTestCase
{

}
