# Laravel Facebook Posts

This is a simple package I created for my own use to post to facebook. This is not yet ready for general use. I plan to add a lot of other features.

## Install

Via Composer

```
$ composer require developernaren/facebook
```

## Usage
I have made the facebook class into a singleton class because I need only a single instance at a time.

Because I have made this into a singleton, this is how it can currently be used ( I might change this in the future, But this is how I need it for now)


`$fb = app()->make('FB');`

`$fb->addStatus( "First line of the status )`  
            `->addStatus( "Second Line Here" )`    
            `->addlink( "http://linktomywebsite.com" )`  
            `->asPage( "<pageID>" )`  
          `  ->post();`  

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CONDUCT](CONDUCT.md) for details.

## Security

If you discover any security related issues, please email :author_email instead of using the issue tracker.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

