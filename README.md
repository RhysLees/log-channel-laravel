# This is my package logchannellaravel

## Installation

You can install the package via composer:

```bash
composer require rhyslees/log-channel-laravel
```

Add the following to your `config\logging.php` file:

```php
'channels' => [
    ...
    
    'logchannel' => [
        'driver' => 'custom',
        'via' => \RhysLees\LogChannelLaravel\LogChannelLaravel::class,
        'key' => env('LOG_CHANNEL_KEY', ''),
        'app_id' => env('LOG_CHANNEL_APP_ID', ''),
        'endpoint' => env('LOG_CHANNEL_ENDPOINT', 'https://logchannel.co.uk/api/app'),
    ],
    
    ...
],
```

Then add the channel to the stack:

```php
'stack' => [
    'driver' => 'stack',
    'channels' => ['single', 'logchannel'],
    'ignore_exceptions' => false,
],
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="log-channel-laravel-config"
```

This is the contents of the published config file:

```php
return [
    'key' => env('LOG_CHANNEL_KEY', ''),
    'app_id' => env('LOG_CHANNEL_APP_ID', ''),
    'endpoint' => env('LOG_CHANNEL_ENDPOINT', 'https://logchannel.test/api/app'),
];
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="log-channel-laravel-views"
```

## Usage

### As Log Channel



### As Facade

```php
$logChannelLaravel = new RhysLees\LogChannelLaravel();
echo $logChannelLaravel->echoPhrase('Hello, RhysLees!');
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Rhys Lees](https://github.com/RhysLees)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
