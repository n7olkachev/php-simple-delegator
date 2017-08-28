<?php

namespace N7olkachev\SimpleDelegator\Test;

use N7olkachev\SimpleDelegator\SimpleDelegator;
use PHPUnit\Framework\TestCase;

class SimpleDelegatorTest extends TestCase
{
    /** @test */
    public function it_delegates_get()
    {
        $user = new User('Nick');
        $decoratedUser = new UserDecorator($user);
        $this->assertEquals('Nick', $decoratedUser->name);
    }

    /** @test */
    public function it_delegates_set()
    {
        $user = new User('Nick');
        $decoratedUser = new UserDecorator($user);
        $decoratedUser->name = 'Decorated Nick';
        $this->assertEquals('Decorated Nick', $user->name);
    }

    /** @test */
    public function it_delegates_call()
    {
        $user = new User('Nick');
        $decoratedUser = new UserDecorator($user);
        $decoratedUser->setName('Decorated Nick');
        $this->assertEquals('Decorated Nick', $decoratedUser->getName());
    }

}

class User
{
    public $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }
}

class UserDecorator
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
}
