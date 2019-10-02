Path Hydrator
=============

This utility will hydrate an object from a path-value array:

```
$product = new ProductTransfer();
PathHydrator::create()->hydrate($product, [
    'foobar' => 'barfoo'
);
```

```
$product = new ProductTransfer();
$product->addLabel(new ProductLabel());

PathHydrator::create()->hydrate($product, [
    'getLabels[0].title' => 'barfoo'
);
```

You can also hydrate from an array of JSON values:

```
$product = new ProductTransfer();

PathHydrator::create()->hydrate($product, [
    'foobar' => [
      'an',
      'array',
    ]
]);
```
