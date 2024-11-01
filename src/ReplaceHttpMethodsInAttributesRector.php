<?php

declare(strict_types=1);

namespace Katzebue\Rector;

use PhpParser\Node;
use PhpParser\Node\Expr\ArrayItem;
use PhpParser\Node\Expr\ClassConstFetch;
use PhpParser\Node\Scalar\String_;
use Rector\Rector\AbstractRector;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

final class ReplaceHttpMethodsInAttributesRector extends AbstractRector
{
    private const METHOD_MAP = [
        'GET' => 'METHOD_GET',
        'POST' => 'METHOD_POST',
        'PUT' => 'METHOD_PUT',
        'DELETE' => 'METHOD_DELETE',
        'PATCH' => 'METHOD_PATCH',
        // Добавьте другие методы при необходимости
    ];

    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition(
            'Replace HTTP methods in Route attributes with Symfony Request constants',
            [
                new CodeSample(
                    "#[Route('/search', methods: ['GET'])]",
                    "#[Route('/search', methods: ['\Symfony\Component\HttpFoundation\Request::METHOD_GET'])]",
                ),
            ],
        );
    }

    public function getNodeTypes(): array
    {
        return [Node\Stmt\ClassMethod::class];
    }

    public function refactor(Node $node): ?Node
    {
        if (!$node instanceof Node\Stmt\ClassMethod) {
            return null;
        }

        foreach ($node->attrGroups as $attrGroup) {
            foreach ($attrGroup->attrs as $attribute) {
                if ($attribute->name->toString() !== 'Symfony\Component\Routing\Attribute\Route') {
                    continue;
                }

                foreach ($attribute->args as $arg) {
                    if ($this->isName($arg, 'methods') && $arg->value instanceof Node\Expr\Array_) {
                        foreach ($arg->value->items as $item) {
                            if ($item instanceof ArrayItem && $item->value instanceof String_) {
                                $method = $item->value->value;
                                if (isset(self::METHOD_MAP[$method])) {
                                    $item->value = new ClassConstFetch(
                                        new Node\Name('Request'),
                                        self::METHOD_MAP[$method],
                                    );
                                }
                            }
                        }
                    }
                }
            }
        }

        return $node;
    }
}
