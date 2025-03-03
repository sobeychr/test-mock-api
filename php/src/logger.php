<?php

define('FILE', ROOT . 'logs/logs.log');
define('FLAGS', FILE_USE_INCLUDE_PATH | FILE_APPEND);

class Logger {
    private $_data;

    public function __construct($data) {
        $this->_data = $data;
    }

    private function _pad($number) {
        return str_pad($number, 2, '0', STR_PAD_LEFT);
    }

    public function write() {
        $date = getdate();
        $time = $this->_pad($date['hours'])
            . ':' . $this->_pad($date['minutes'])
            . ':' . $this->_pad($date['seconds']);

        $data = $time . ' ' . $this->_data . "\n";

        file_put_contents(FILE, $data, FLAGS);
    }
}
