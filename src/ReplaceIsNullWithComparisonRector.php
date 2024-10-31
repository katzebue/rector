<?php

declare(strict_types=1);

namespace Katzebue\Rector;

use Override;
use PhpParser\Node;
use PhpParser\Node\Expr\BinaryOp\Identical;
use PhpParser\Node\Expr\BinaryOp\NotIdentical;
use PhpParser\Node\Expr\BooleanNot;
use PhpParser\Node\Expr\FuncCall;
use Rector\Rector\AbstractRector;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

final class ReplaceIsNullWithComparisonRector extends AbstractRector
{
    #[Override]
    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition('Replace is_null() with === null or !== null', [
            new CodeSample('is_null($value);', '$value === null;'),
            new CodeSample('!is_null($value);', '$value !== null;'),
        ]);
    }

    #[Override]
    public function getNodeTypes(): array
    {
        return [FuncCall::class, BooleanNot::class];
    }

    #[Override]
    public function refactor(Node $node): ?Node
    {
        // !is_null($value)
        if ($node instanceof BooleanNot && $node->expr instanceof FuncCall && $this->isName($node->expr, 'is_null')) {
            $arg = $node->expr->args[0]->value;
            return new NotIdentical($arg, $this->nodeFactory->createNull());
        }

        // is_null($value)
        if ($node instanceof FuncCall && $this->isName($node, 'is_null')) {
            $arg = $node->args[0]->value;
            return new Identical($arg, $this->nodeFactory->createNull());
        }

        return null;
    }
}
