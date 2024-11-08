<?php

class App {
    private $_getParams;
    private $_postParams = [];
    private $_method;
    private $_protocol;
    private $_uri;

    public function __construct($server) {
        $this->_method = $server['REQUEST_METHOD'];
        $this->_protocol = $server['SERVER_PROTOCOL'] ?? 'HTTP/1.0';
        $this->_uri = $server['PHP_SELF'];

        $this->_getParams = isset($server['QUERY_STRING']) ? App::parseGet($server['QUERY_STRING']) : [];
    }

    private function getHeader($type) {
        if ($type === 'json') {
            return 'Content-Type: application/json; charset=utf-8';
        } else if ($type === 'html') {
            return 'Content-Type: text/html; charset=utf-8';
        }

        return 'Content-Type: text/plain; charset=utf-8';
    }

    private function method($method, $path, $handler) {
        if($method === null || $this->_method === $method) {
            if($this->_uri === $path) {
                $response = $handler();

                header($this->_protocol . ' ' . $response->status);
                header($this->getHeader($response->type));
                echo $response->body;
                exit;
            }
        }
    }

    public function get($path, $handler) {
        return $this->method('GET', $path, $handler);
    }

    public function post($path, $handler) {
        return $this->method('POST', $path, $handler);
    }

    public function use($path, $handler) {
        return $this->method(null, $path, $handler);
    }

    static private function parseGet($string) {
        $values = explode('&', $string);
        $params = array_map(function($str){ [$key, $value] = explode('=', $str); return [$key => $value]; }, $values);

        return array_merge(...$params);
    }
}
