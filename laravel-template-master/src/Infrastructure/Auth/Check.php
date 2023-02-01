<?php

namespace Infrastructure\Auth;

abstract class Check
{
    use CheckProxy;

    abstract public function execute(): CheckResponse;
}
