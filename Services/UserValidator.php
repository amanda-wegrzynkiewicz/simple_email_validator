<?php

class UserValidator
{
    public function validateEmail(string $email): bool
    {
        $pattern = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
        return preg_match($pattern, $email) === 1;
    }

    public function validatePassword(string $password): bool
    {
        $pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/';
        return preg_match($pattern, $password) === 1;
    }
}