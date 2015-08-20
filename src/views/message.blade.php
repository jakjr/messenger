@if(Messenger::has())
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                @foreach(Messenger::get() as $message)
                    {!!$message->display()!!}
                @endforeach
            </div>
        </div>
    </div>
@endif