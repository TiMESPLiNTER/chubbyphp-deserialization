<?php

declare(strict_types=1);

namespace Chubbyphp\Deserialization\Mapping;

interface ObjectMappingInterface
{
    /**
     * @return string
     */
    public function getClass(): string;

    /**
     * @return callable
     */
    public function getFactory(): callable;

    /**
     * @return PropertyMappingInterface[]
     */
    public function getPropertyMappings(): array;
}
