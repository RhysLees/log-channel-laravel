<?php

namespace RhysLees\LogChannelLaravel;

use Monolog\Logger;

class LogChannel
{
    public function __invoke(): Logger
    {
        return new Logger('logchannel', [new LogChannelHandler()], [new LogChannelProcessor()]);
    }
}
