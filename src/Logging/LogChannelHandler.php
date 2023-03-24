<?php

namespace RhysLees\LogChannelLaravel\Logging;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Monolog\Formatter\FormatterInterface;
use Monolog\Handler\AbstractProcessingHandler;
use Monolog\Logger;
use Monolog\LogRecord;

class LogChannelHandler extends AbstractProcessingHandler
{
    public function __construct($level = Logger::DEBUG)
    {
        parent::__construct($level);
    }

    /**
     * {@inheritDoc}
     */
    protected function write(LogRecord $record): void
    {
        Http::acceptJson()
            ->withoutVerifying()
            ->post(
                config('logging.channels.logchannel.endpoint').'/'.config('logging.channels.logchannel.app_id'),
                array_merge(
                    [
                        'key' => config('logging.channels.logchannel.key'),
                    ],
                    $record->toArray()
                )
            );
    }
}
