<?php

namespace RhysLees\LogChannelLaravel\Logging;

use Monolog\Logger;
use RhysLees\LogChannelLaravel\Logging\LogChannelHandler;

class LogChannel
{
    public function __invoke(): Logger
    {
        return (new Logger('logchannel'))->pushHandler(new LogChannelHandler())->pushProcessor(new LogChannelProcessor());
    }
}
