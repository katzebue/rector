<?php

declare(strict_types=1);

namespace Katzebue\Rector;

use Override;
use PhpParser\Node\Expr\BinaryOp\Identical;
use PhpParser\Node\Expr\BinaryOp\NotIdentical;
use PhpParser\Node\Expr\BinaryOp\Equal;
use PhpParser\Node\Expr\BinaryOp\NotEqual;
use PhpParser\Node\Scalar;
use PhpParser\Node\Expr\ConstFetch;
use PhpParser\Node;
use PhpParser\Node\Expr;
use PhpParser\Node\Expr\BinaryOp;
use Rector\Rector\AbstractRector;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

final class MoveScalarToRightSideRector extends AbstractRector
{
    #[Override]
    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition('Move scalar type to the right side in comparisons', [
            new CodeSample(
                '$value === 5;',
                '5 === $value;',
            ),
        ]);
    }

    #[Override]
    public function getNodeTypes(): array
    {
        return [BinaryOp::class];
    }

    #[Override]
    public function refactor(Node $node): ?Node
    {
        if (!$node instanceof BinaryOp || !$this->isComparisonOp($node)) {
            return null;
        }

        // Check if left side is scalar and right side is not
        if ($this->isScalarType($node->left) && !$this->isScalarType($node->right)) {
            [$node->left, $node->right] = [$node->right, $node->left];
            return $node;
        }

        return null;
    }

    private function isComparisonOp(BinaryOp $node): bool
    {
        return $node instanceof Identical
            || $node instanceof NotIdentical
            || $node instanceof Equal
            || $node instanceof NotEqual;
    }

    private function isScalarType(Expr $expr): bool
    {
        // Use native PHP methods to check if the expression is scalar
        return $expr instanceof Scalar || $expr instanceof ConstFetch;
    }
}
