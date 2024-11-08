<?php

$app->get('/', function() {
    return new Response([
        'body' => 'Mock-API',
    ]);
});

$app->get('/healthcheck', function() {
    return new Response([
        'status' => 200,
        'body' => 'ok',
    ]);
});

$app->get('/test-json', function() {
    $data = getFile('test-1.json');
    return new Response([
        'body' => $data,
        'type' => 'json',
    ]);
});

$app->get('/test-html', function() {
    $data = getFile('test-0.html');
    return new Response([
        'body' => $data,
        'type' => 'html',
    ]);
});

$app->use('/test-error', function() {
    return new Response([
        'status' => 500,
        'body' => 'test-error',
    ]);
});

$app->use('/test-timeout', function() {
    sleep(5);
    return new Response([
        'status' => 200,
        'body' => 'after timeout',
    ]);
});
