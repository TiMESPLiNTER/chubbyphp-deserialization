<?php

declare(strict_types=1);

namespace Chubbyphp\Deserialization;

interface DeserializerInterface
{
    /**
     * @param array  $serializedData
     * @param string $class
     * @param string $path
     *
     * @return object
     */
    public function deserializeByClass(array $serializedData, string $class, string $path = '');

    /**
     * @param array  $serializedData
     * @param object $object
     * @param string $path
     *
     * @return object
     */
    public function deserializeByObject(array $serializedData, $object, string $path = '');
}
