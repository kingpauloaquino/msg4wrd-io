## About MSG4wrd-io


## Installtion

    composer require kpawork/msg4wrd-io

After updating composer, add the ServiceProvider to the providers array in `config/app.php`

    KPAWork\MSG4wrdIO\MSG4wrdIOServiceProvider::class,

Then, it would be best if you published the vendor to generate a config file `config/msg4wrdio.php`

    php artisan vendor:publish

Almost there, you need to add your token to `config/msg4wrdio.php`

    'token' => env('MSG4wrdIO_TOKEN', 'YOUR-TOKEN-HERE'),