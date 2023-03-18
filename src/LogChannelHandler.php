<?php

namespace RhysLees\LogChannelLaravel;

use Illuminate\Support\Facades\Http;
use Monolog\Formatter\FormatterInterface;
use Monolog\Handler\AbstractProcessingHandler;
use Monolog\Logger;

class LogChannelHandler extends AbstractProcessingHandler
{
    public function __construct($level = Logger::DEBUG)
    {
        parent::__construct($level);
    }

    /**
     * {@inheritDoc}
     */
    protected function write(array|\Monolog\LogRecord $record): void
    {
        $res = Http::withToken(config('logchannellaravel.key'))
            ->withoutVerifying()
            ->post(
                config('logchannellaravel.endpoint').'/'.config('logchannellaravel.app_id'),
                $record['formatted']
            );

        ray($res->status());
    }

    protected function getDefaultFormatter(): FormatterInterface
    {
        return new LogChannelFormatter();
    }
}
