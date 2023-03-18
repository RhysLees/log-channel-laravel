<?php

namespace RhysLees\LogChannelLaravel;

class LogChannelProcessor
{
    public function __invoke(array $record): array
    {
        $record['extra'] = [
            'user_id' => auth()->user() ? auth()->user()->id : null,
            'origin' => request()->headers->get('origin'),
            'ip' => request()->server('REMOTE_ADDR'),
            'user_agent' => request()->server('HTTP_USER_AGENT'),
        ];

        return $record;
    }
}
