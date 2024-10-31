<?php

declare(strict_types=1);

namespace Katzebue\Rector;

use Override;
use PhpParser\Node;
use PhpParser\Node\Expr\BinaryOp\Identical;
use PhpParser\Node\Expr\FuncCall;
use Rector\Rector\AbstractRector;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

final class ReplaceIsNullWithComparisonRector extends AbstractRector
{
    #[Override]
    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition('Replace is_null() with === null', [
            new CodeSample('is_null($value);', '$value === null;'),
        ]);
    }

    #[Override]
    public function getNodeTypes(): array
    {
        return [FuncCall::class];
    }

    #[Override]
    public function refactor(Node $node): ?Node
    {
        if (!$this->isName($node, 'is_null')) {
            return null;
        }

        if (!isset($node->args[0])) {
            return null;
        }

        $arg = $node->args[0]->value;

        return new Identical($arg, $this->nodeFactory->createNull());
    }
}
