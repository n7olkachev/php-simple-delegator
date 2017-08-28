# Simple Delegator

<p align="center">
<a href="https://websecret.by"><img src="https://websecret.by/images/logo-github.png" /></a>
</p>

[![Code quality](https://img.shields.io/scrutinizer/g/n7olkachev/php-simple-delegator.svg?style=flat-square)](https://scrutinizer-ci.com/g/n7olkachev/php-simple-delegator/)
[![Licence](https://img.shields.io/packagist/l/n7olkachev/php-simple-delegator.svg?style=flat-square)](https://packagist.org/packages/n7olkachev/php-simple-delegator)
[![Build Status](https://travis-ci.org/n7olkachev/php-simple-delegator.svg?branch=master)](https://travis-ci.org/n7olkachev/php-simple-delegator)

## Why?

You can watch Jeffrey Way's video from Laracon US 2017 with usage example: https://streamacon.com/video/laracon-us-2017/day-2-jeffrey-way (35:00)

## Examples

Suppose, we want to create Presenter for our User model:

```php
class User extends Model
{
    protected $filterable = [
        'name',
    ];
}

class UserPresenter
{
    use SimpleDelegator;
    
    protected $user;
    
    public function __construct($user)
    {
        $this->user = $user;
    }
    
    protected function delegatee()
    {
        return $this->user;
    }
    
    public function formattedName()
    {
        return 'Decorated ' . $this->user->name;
    }
}

$decoratedUser = new UserDecorator($user);

$decoratedUser->formattedName() // call to decorator method
$decoratedUser->name // gets original name from User model
```

Or, we want to add some additional behavior to our class (as in Jeffrey's example):

```php
class NotifyingThread
{
    protected $thread;
    
    public function __construct($thread)
    {
        $this->thread = $thread;
    }
    
    public function addReply()
    {
        $reply = $this->thread->addReply();
        
        Notification::send(
            $reply->mentionedUsers(),
            new YouWereMentioned($reply)
        );
    }
}

$thread = new NotifyingThread($thread);

$thread->addReply($data); // default logic + sending notification
```

## Installation

You can install the package via composer:

``` bash
composer require n7olkachev/php-simple-delegator
```

Next, add SimpleDelegator trait to your Decorator class:

```php
use SimpleDelegator;
```

## Testing

``` bash
$ composer test
```

## Credits

- [Nikita Tolkachev](https://github.com/n7olkachev)

## Sponsored by

https://websecret.by/

Web agency based in Minsk, Belarus

## License

The MIT License (MIT)
