<?php

namespace Infrastructure\Auth;

trait Authorize
{
    use CheckProxy;

    public function authorize(Check ...$assertions): void
    {
        foreach ($assertions as $assertion) {
            $this->check($assertion)->authorize();
        }
    }
}
