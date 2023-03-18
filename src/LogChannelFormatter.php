<?php

namespace RhysLees\LogChannelLaravel;

use Monolog\Formatter\NormalizerFormatter;

class LogChannelFormatter extends NormalizerFormatter
{
    public function __construct()
    {
        parent::__construct();
    }

    public function format(array|\Monolog\LogRecord $record)
    {
        $record = parent::format($record);

        return $this->convertToDataBase($record);
    }

    protected function convertToDataBase(array $record)
    {
        $el = $record['extra'];
        $el['level'] = strtolower($record['level_name']);
        $el['message'] = $record['message'];
        $el['datetime'] = $record['datetime'];

        return $el;
    }
}
