<?php

namespace RhysLees\LogChannelLaravel\Logging;

use Illuminate\Support\Facades\Log;
use Monolog\Formatter\NormalizerFormatter;
use Monolog\LogRecord;

class LogChannelFormatter extends NormalizerFormatter
{
    public function __construct()
    {
        parent::__construct();
    }

    public function format(LogRecord $record)
    {
        $record = parent::format($record);

        return $this->convertToDataBase($record);
    }

    protected function convertToDataBase(LogRecord $record): LogRecord
    {
        $record->with([
            'user_id' => auth()->user() ? auth()->user()->id : null,
            'origin' => request()->headers->get('origin'),
            'ip' => request()->server('REMOTE_ADDR'),
            'user_agent' => request()->server('HTTP_USER_AGENT'),
        ]);
        return $record;
    }
}
