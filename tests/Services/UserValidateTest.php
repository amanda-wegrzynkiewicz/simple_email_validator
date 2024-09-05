<?php

namespace App\Tests\Services;

use PHPUnit\Framework\TestCase;
use App\Services\UserValidator;

class UserValidateTest extends TestCase
{
    protected UserValidator $userValidator;

    protected function setUp(): void
    {
        $this->userValidator = new UserValidator();
    }

    public function testValidPassword(): void
    {
        $password = 'StrongPass1!';
        $this->assertTrue($this->userValidator->validatePassword($password), 'Password should be valid');
    }

    public function testTooShortPassword(): void
    {
        $password = 'Test1!';
        $this->assertFalse($this->userValidator->validatePassword($password), 'Password should be too short');
    }
    
    public function testMissingLowercaseLetterInPassword(): void
    {
        $password = 'MISSINGLOWERCASELETTER123!';
        $this->assertFalse($this->userValidator->validatePassword($password), 'Password should be missing a lowercase letter');
    }

    public function testMissingUppercaseLetterInPassword(): void
    {
        $password = 'missinguppercaseletter123!';
        $this->assertFalse($this->userValidator->validatePassword($password), 'Password should be missing an uppercase letter');
    }

    public function testMissingNumberInPassword(): void
    {
        $password = 'MissingNumber!';
        $this->assertFalse($this->userValidator->validatePassword($password), 'Password should be missing a number');
    }

    public function testMissingSpecialCharacterInPassword(): void
    {
        $password = 'NoSpecialCharacter123';
        $this->assertFalse($this->userValidator->validatePassword($password), 'Password should be missing a special character');
    }

    public function testValidEmail(): void
    {
        $email = 'test@example.com';
        $this->assertTrue($this->userValidator->validateEmail($email), 'Email should be valid');
    }

    public function testMissingAtSymbolInEmail(): void
    {
        $email = 'testexample.com';
        $this->assertFalse($this->userValidator->validateEmail($email), 'Email should be invalid because of missing @');
    }

    public function testMissingDomainInEmail(): void
    {
        $email = 'test@';
        $this->assertFalse($this->userValidator->validateEmail($email), 'Email should be invalid because of missing domain');
    }

    public function testInvalidDomainInEmail(): void
    {
        $email = 'test@example.c';
        $this->assertFalse($this->userValidator->validateEmail($email), 'Email should be invalid because of incomplete domain');
    }

    public function testSpecialCharactersInEmail(): void
    {
        $email = 'test!@example.eu';
        $this->assertFalse($this->userValidator->validateEmail($email), 'Email should be invalid because of special characters');
    }
}
