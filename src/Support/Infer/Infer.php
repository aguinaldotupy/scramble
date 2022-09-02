<?php

namespace Dedoc\Scramble\Support\Infer;

use Dedoc\Scramble\Support\ClassAstHelper;
use Dedoc\Scramble\Support\Type\ObjectType;

class Infer
{
    /** @var array<string, ObjectType> */
    private $classesCache = [];

    public function analyzeClass(string $class): ObjectType
    {
        if (array_key_exists($class, $this->classesCache)) {
            return $this->classesCache[$class];
        }

        return $this->classesCache[$class] = $this->traverseClassAstAndInferType($class);
    }

    private function traverseClassAstAndInferType(string $class): ObjectType
    {
        $astHelper = new ClassAstHelper($class);

        return $astHelper->scope->getType($astHelper->classAst);
    }
}
