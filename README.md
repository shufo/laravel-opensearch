# Laravel-OpenSearch

:warning: This package is still in alpha. Don't use in production.

An easy way to use the [official OpenSearch client](https://github.com/opensearch-project/opensearch-php) in your Laravel applications.

This is the fork of [laravel-elasticsearch](https://github.com/cviebrock/laravel-elasticsearch).

## Installation and Configuration

Add repository to your composer.json

```json
  "repositories": [
    {
      "type": "vcs",
      "url": "https://github.com/shufo/opensearch-php"
    }
  ],
```

then

```sh
composer require shufo/laravel-opensearch
```

### Laravel

The package's service provider will automatically register its service provider.

Publish the configuration file:

```sh
php artisan vendor:publish --provider="Shufo\LaravelOpenSearch\ServiceProvider"
```

To change host of opensearch, set `OPENSEARCH_HOST` environment variable to your opensearch hostname.

To edit config you can edit `config/opensearch.php`.

```bash
$ vim config/opensearch.php
```

## Usage

With Facade:

```php
// search
>>> OpenSearch::search([
    'index' => 'example',
    'body'  => [
        'query' => [
            'match' => [
                'id' => '123'
            ]
        ]
    ]
])
=> [
     "took" => 1,
     "timed_out" => false,
     "_shards" => [
       "total" => 1,
       "successful" => 1,
       "skipped" => 0,
       "failed" => 0,
     ],
     "hits" => [
       "total" => [
         "value" => 1,
         "relation" => "eq",
       ],
       "max_score" => 0.6931471,
       "hits" => [
         [
           "_index" => "example",
           "_type" => "_doc",
           "_id" => "1",
           "_score" => 0.6931471,
           "_source" => [
             "id" => "123",
             "body" => "test",
           ],
         ],
       ],
     ],
   ]

// create index
OpenSearch::indices()->create([
    'index' => 'example',
    'body' => [
        'mappings' => [
            'properties' => [
                'id' => [
                    'type' => 'long',
                ],
                'text' => [
                    'type' => 'text',
                ]
            ]
        ]
    ],
])

// add document to index
OpenSearch::index([
    "id" => "123",
    "body" => [
        "id" => "123",
        "text" => "foo",
    ],
    "index" => "example",
]);

// delete index
OpenSearch::indices()->delete(['index' => 'example']);

// SQL (currently it's available only select operation)
>>> OpenSearch::sql()->query(["query" => "select * from example", "fetch_size" => 1])
=> [
     "schema" => [
       [
         "name" => "body",
         "type" => "text",
       ],
       [
         "name" => "id",
         "type" => "keyword",
       ],
     ],
     "cursor" => "d:eyJhIjp7fSwicyI6IkZHbHVZMngxWkdWZlkyOXVkR1Y0ZEY5MWRXbGtEWEYxWlhKNVFXNWtSbVYwWTJnQkZrTmZVamR0VEc1ZlUwSmxOM2h4U2w5bFRWQjRaMUVBQUFBQUFBQUFxaFpqUjFGckxVRm9YMUl6Vnpkc2NXaHlabkk1VFZGbiIsImMiOlt7Im5hbWUiOiJib2R5IiwidHlwZSI6InRleHQifSx7Im5hbWUiOiJpZCIsInR5cGUiOiJrZXl3b3JkIn1dLCJmIjoxLCJpIjoiZXhhbXBsZSIsImwiOjF9",
     "total" => 2,
     "datarows" => [
       [
         "test",
         "123",
       ],
     ],
     "size" => 1,
     "status" => 200,
   ]

```

With Opensearch Client Builder:

```php
use OpenSearch\ClientBuilder;

$data = [
    'body' => [
        'testField' => 'abc'
    ],
    'index' => 'my_index',
    'type' => 'my_type',
    'id' => 'my_id',
];

$client = ClientBuilder::create()->build();
$return = $client->index($data);
```

## Contributing

1.  Fork it
2.  Create your feature branch (`git checkout -b my-new-feature`)
3.  Commit your changes (`git commit -am 'Add some feature'`)
4.  Push to the branch (`git push origin my-new-feature`)
5.  Create new Pull Request

## LICENSE

MIT
