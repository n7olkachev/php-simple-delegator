<?php

namespace N7olkachev\SimpleDelegator;

trait SimpleDelegator
{
    abstract protected function delegatee();

    public function __get($key)
    {
        return $this->delegatee()->$key;
    }

    public function __set($key, $value)
    {
        return $this->delegatee()->$key = $value;
    }

    public function __call($key, $args)
    {
        return $this->delegatee()->$key(...$args);
    }
}
