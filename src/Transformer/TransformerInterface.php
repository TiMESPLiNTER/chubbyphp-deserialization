<?php

declare(strict_types=1);

namespace Chubbyphp\Deserialization\Transformer;

interface TransformerInterface
{
    /**
     * @return string
     */
    public function getContentType(): string;

    /**
     * @param string $string
     *
     * @return array
     *
     * @throws TransformerException
     */
    public function transform(string $string): array;
}
