# JsonTransformer

```php
<?php

use Chubbyphp\Deserialization\Transformer\JsonTransformer;

$transformer = new JsonTransformer();
$transformer->getContentType(); // 'application/json'
$transformer->transform($json); // transforms json to an array
```
