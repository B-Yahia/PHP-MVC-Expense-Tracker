<?php

declare(strict_types=1);

namespace Framework;

use ReflectionClass, ReflectionNamedType;
use Framework\Exceptions\ContainerException;

class Container
{
    private array $definitions = [];
    private array $resolved = [];

    public function addDefinitions(array $newDefinitions)
    {
        $this->definitions = [...$this->definitions, ...$newDefinitions];
    }

    public function resolve(string $className)
    {
        $reflactionClass = new ReflectionClass($className);
        if (!$reflactionClass->isInstantiable()) {
            throw new ContainerException("Class {$className} is not instantiable");
        }

        $constractor = $reflactionClass->getConstructor();
        if (!$constractor) {
            return new $className;
        }

        $params = $constractor->getParameters();
        if (count($params) === 0) {
            return new $className;
        }

        $dependencies = [];

        foreach ($params as $param) {
            $name = $param->getName();
            $type = $param->getType();

            if (!$type) {
                throw new ContainerException("Failed to resolve class {$className} because param {$name} is missing type hint.");
            }

            if (!$type instanceof ReflectionNamedType || $type->isBuiltin()) {
                throw new ContainerException("Failed to resolve class {$className} because invalid param name .");
            }

            $dependencies[] = $this->get($type->getName());
        }

        return $reflactionClass->newInstanceArgs($dependencies);
    }

    public function get(string $id)
    {
        if (!array_key_exists($id, $this->definitions)) {
            throw new ContainerException("Class {$id} does not exist in the container definitions.");
        }
        if (array_key_exists($id, $this->resolved)) {
            return $this->resolved[$id];
        }
        $factory = $this->definitions[$id];
        $dependency = $factory($this);
        $this->resolved[$id] = $dependency;
        return $dependency;
    }
}
