# Test-Mock-API > PHP

### Setup

1. `docker compose build` to build the container
2. `cp .env.development .env` to create your local environment file
3. `docker compose up` to run the container

### Configs

- `SERVER_HOST` mocked domain name to run the application
- `SERVER_PORT` mocked port to run the application
- `TIMEOUT` maximum timeout in seconds for responses, ex `5 = 5 seconds`

### Custom routes

1. Create `src/routes.dev.php` file, _src/dynamicRoutes.php_ should automatically include the file into the application
2. Write your own endpoints returning a Response from the _src/response.php_ file

```
// src/routes.dev.php - example
<?php

$app->use('/test', function(){
    return new Response([
        'status' => 200, // HTTP response code
        'body' => 'mocked response', // string to print
        'type' => 'text', // 'text' | 'html' | 'json' output types
    ]);
});

```

#### Multiple routes

If you need to host a lot of custom endpoints, it is recommended to split them among files. Keep your files under `src/routes/*.php` and they should be automatically included (as per custom routes above).

### Local data

You can store test files locally. It avoid having to hardcoded large among of data directly into your routes. These files can then be used via the `src/getFile.php` helper.

```
// assume 'src/data/some-big-data.json' exists
// assume 'src/data/dir/subdirectory/lorem-ipsum.html' exists

// src/routes/load.php
$app->use('/test-load-file', function(){
    $jsonData = getFile('some-big-data.json');
    $htmlData = getFile('dir/subdirectory/lorem-ipsum.html');
});
```
