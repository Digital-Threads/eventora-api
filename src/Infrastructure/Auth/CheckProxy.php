<?php

namespace Infrastructure\Auth;

trait CheckProxy
{
    final protected function check(Check $check): CheckResponse
    {
        return $check->execute();
    }
}
