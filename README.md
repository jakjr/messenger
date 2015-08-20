# Messeger
A small package to display messages in a View.

* composer require jakjr/messenger

* Register the ServiceProvider (config/app.php)
```
'providers' => [
    ...
    Jakjr\Messenger\MessengerServiceProvider::class,
],
```

* Register an Alias (config/app.php)
```
'aliases' => [
    ...
    'Messenger' => Jakjr\Messenger\MessengerFacade::class,
),
```


* Controller use:
```
    Messenger::success('Hello Word');
```

* View use:
```
@include('messenger::message'
```

* You can publish the view and the config file:
$ php artisan vendor:publish

* To custom the view, make changes on file:
resources/views/vendor/messenger/message.blade.php

* To custom the configuratio, make changes on file:
config/messenger.php

* Or on runtime
```
        Config::set('messenger.wrapper', "
            <div class='alert alert-:status-class: alert-dismissible' role='alert'>
                <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>
                :message:
            </div>
        ");
```
