<?php

/*
 +--------------------------------------------------------------------------+
 | Zephir Language                                                          |
 +--------------------------------------------------------------------------+
 | Copyright (c) 2013-2015 Zephir Team and contributors                     |
 +--------------------------------------------------------------------------+
 | This source file is subject the MIT license, that is bundled with        |
 | this package in the file LICENSE, and is available through the           |
 | world-wide-web at the following url:                                     |
 | http://zephir-lang.com/license.html                                      |
 |                                                                          |
 | If you did not receive a copy of the MIT license and are unable          |
 | to obtain it through the world-wide-web, please send a note to           |
 | license@zephir-lang.com so we can mail you a copy immediately.           |
 +--------------------------------------------------------------------------+
*/

namespace Zephir\Operators\Other;

use Zephir\Operators\BaseOperator;
use Zephir\CompilationContext;
use Zephir\Expression;
use Zephir\CompilerException;
use Zephir\CompiledExpression;

/**
 * TypeHintOperator
 *
 * Compiles a type hint expression
 */
class TypeHintOperator extends BaseOperator
{
    private $strict = false;

    /**
     * Sets if the type hint is strict or not
     *
     * @param boolean $strict
     */
    public function setStrict($strict)
    {
        $this->strict = $strict;
    }

    /**
     * @param array $expression
     * @param CompilationContext $compilationContext
     * @return CompiledExpression
     * @throws CompilerException
     */
    public function compile(array $expression, CompilationContext $compilationContext)
    {
        $expr = new Expression($expression['right']);
        $expr->setReadOnly(true);
        $resolved = $expr->compile($compilationContext);

        if ($resolved->getType() != 'variable') {
            throw new CompilerException("Type-Hints only can be applied to dynamic variables", $expression);
        }

        $symbolVariable = $compilationContext->symbolTable->getVariableForRead($resolved->getCode(), $compilationContext, $expression);
        if (!$symbolVariable->isVariable()) {
            throw new CompilerException("Type-Hints only can be applied to dynamic variables", $expression);
        }

        $symbolVariable->setDynamicTypes('object');
        $symbolVariable->setClassTypes($compilationContext->getFullName($expression['left']['value']));        

        return $resolved;
    }
}
