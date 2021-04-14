## About MSG4wrd-io


## Installtion

> composer require kpawork/msg4wrd-io

After updating composer, add the ServiceProvider to the providers array in `config/app.php`

> KPAWork\MSG4wrdIO\MSG4wrdIOServiceProvider::class,

Then, it would be best if you published the vendor to generate a config file `config/msg4wrdio.php`

> php artisan vendor:publish

Almost there, you need to add your token to `.env`, to get token [MSG4wrd.io](https://msg4wrd.io/)

> MSG4wrdIO_TOKEN=YOUR-TOKEN-HERE

To see if the MSG4wrd.io was installed success, open your browser, then access this

> http://[your-host-name]/msg4wrd-io
	
> http://localhost:8000/msg4wrd-io

To check if the MSG4wrd.io will send an SMS message, do this

> http://localhost:8000/msg4wrd-io/send-message?mobile=your-mobile-here 

Note: The mobile number should include the country code. I.e., +63 or +1
