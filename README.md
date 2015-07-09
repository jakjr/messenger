# Messeger
A litle package to display messages in a View.

* composer require jakjr/messenger

* Register the ServiceProvider (config/app.php)
```
'providers' => array(
    ...
    'Jakjr\Messenger\MessengerServiceProvider',
),
```

* Register an Alias (config/app.php)
```
'aliases' => array(
    ...
    'Messenger'         => 'Jakjr\Messenger\MessengerFacade',
),
```


* Controller use:
```
    Messenger::success('Hello Word');
```

* View use:
```
    @if(Messenger::has())
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    @foreach(Messenger::get() as $message)
                        {{$message->display()}}
                    @endforeach
                </div>
            </div>
        </div>
    @endif
```

* Its possible overwrite some configutation:
```
php artisan config:publish jakjr/messenger
```

* Or on runtime
```
        Config::set('messenger::wrapper', "
            <div class='alert alert-:status-class: alert-dismissible' role='alert'>
                <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>
                :message:
            </div>
        ");
```