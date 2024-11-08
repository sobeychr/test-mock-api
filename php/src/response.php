<?php

class Response {
    public $body;
    public $status;
    public $type;

    public function __construct($args) {
        $this->body = isset($args['body']) ? $args['body'] : '';
        $this->status = isset($args['status']) ? $args['status'] : 200;
        $this->type = isset($args['type']) ? $args['type'] : 'text';
    }
}
