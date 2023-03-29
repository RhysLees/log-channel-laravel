<?php

namespace RhysLees\LogChannelLaravel\Logging;

use Monolog\LogRecord;

class LogChannelProcessor
{
    public function __invoke(LogRecord $record): LogRecord
    {
        $record->extra['request'] = [
            'user_id' => auth()->user() ? auth()->user()->id : null,
            'origin' => request()->headers->get('origin'),
            'ip' => request()->server('REMOTE_ADDR'),
            'user_agent' => request()->server('HTTP_USER_AGENT'),
        ];
        $record->extra['timezone'] = config('app.timezone');

        return $record;
    }
}
