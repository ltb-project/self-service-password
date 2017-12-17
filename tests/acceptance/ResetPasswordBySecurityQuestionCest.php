<?php

namespace App\Tests\Acceptance;

use AcceptanceTester;

/**
 * Class ResetPasswordBySecurityQuestionCest
 */
class ResetPasswordBySecurityQuestionCest
{
    /**
     * @param AcceptanceTester $I
     */
    public function accessingFromMenuWorks(AcceptanceTester $I)
    {
        $I->amOnPage('/');
        $I->expectTo('see Question in the menu');
        $I->see('Question');
        $I->click('Question');
        $I->see('Reset your password');
        $I->expectTo('see Question in the menu active');
        $I->see('Question', '.active');
    }

    /**
     * @param AcceptanceTester $I
     */
    public function changePasswordWorks(AcceptanceTester $I)
    {
        $I->amOnPage('/reset-password-by-question');
        $I->amGoingTo('fill the form with valid data');
        $I->fillField('login', 'user1');
        $I->selectOption('Question','When is your birthday?');
        $I->fillField('answer', 'goodbirthday1');
        $I->fillField('newpassword', 'mynewpass');
        $I->fillField('confirmpassword', 'mynewpass');
        $I->click('Send');
        $I->see('Your password was changed');
    }

    /**
     * @param AcceptanceTester $I
     */
    public function changePasswordShouldNotWorkWhenAnswerIsWrong(AcceptanceTester $I)
    {
        $I->amOnPage('/reset-password-by-question');
        $I->amGoingTo('fill the form with valid data');
        $I->fillField('login', 'user1');
        $I->selectOption('Question','When is your birthday?');
        $I->fillField('answer', 'bad answer');
        $I->fillField('newpassword', 'mynewpass');
        $I->fillField('confirmpassword', 'mynewpass');
        $I->click('Send');
        $I->see('Your answer is incorrect');
        $I->dontSee('Your password was changed');
    }

    /**
     * @param AcceptanceTester $I
     */
    public function changePasswordShouldNotWorkWhenConfirmationIsWrong(AcceptanceTester $I)
    {
        $I->amOnPage('/reset-password-by-question');
        $I->amGoingTo('fill the form with valid data except confirmation');
        $I->fillField('login', 'user1');
        $I->selectOption('Question','When is your birthday?');
        $I->fillField('answer', 'bad answer');
        $I->fillField('newpassword', 'mynewpass');
        $I->fillField('confirmpassword', 'mynewpasd');
        $I->click('Send');
        $I->see('Passwords mismatch');
        $I->dontSee('Your password was changed');
    }
}
