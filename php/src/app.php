<?php

define('HEADERS', [
    'json' => 'application/json',
    'html' => 'text/html',
]);
define('HEADER_DEFAULT', 'text/plain');

class App {
    private $_method;
    private $_protocol;
    private $_start;
    private $_uri;

    public function __construct($server) {
        $this->_method = $server['REQUEST_METHOD'];
        $this->_protocol = $server['SERVER_PROTOCOL'] ?? 'HTTP/1.0';
        $this->_uri = $server['PHP_SELF'];

        $this->_start = microtime(true);
    }

    private function _closure() {
        $end = microtime(true);
        $delay = $end - $this->_start;
        $duration = round($delay * 1000, 3);

        $data = $this->_method
            . ' ' . $this->_uri
            . ' ' . $duration
            . 'ms';
        $logger = new Logger($data);
        $logger->write();
    }

    private function _getHeader($type) {
        $header = HEADERS[$type] ?? HEADER_DEFAULT;
        return 'Content-Type: ' . $header . '; charset=utf-8';
    }

    private function _method($method, $path, $handler) {
        if($method === null || $this->_method === $method) {
            if($path === null || $this->_uri === $path) {
                $response = $handler();

                header($this->_protocol . ' ' . $response->status);
                header($this->_getHeader($response->type));
                echo $response->body;

                $this->_closure();
                exit;
            }
        }
    }

    public function error($handler) {
        return $this->_method(null, null, $handler);
    }

    public function get($path, $handler) {
        return $this->_method('GET', $path, $handler);
    }

    public function post($path, $handler) {
        return $this->_method('POST', $path, $handler);
    }

    public function use($path, $handler) {
        return $this->_method(null, $path, $handler);
    }
}
