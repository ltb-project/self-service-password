<?php

namespace App\Tests\Acceptance;

use AcceptanceTester;

/**
 * Class ResetPasswordBySmsCest
 */
class ResetPasswordBySmsCest
{
    /**
     * @param AcceptanceTester $I
     */
    public function accessingFromMenuWorks(AcceptanceTester $I)
    {
        $I->amOnPage('/');
        $I->expectTo('see SMS in the menu');
        $I->see('SMS');
        $I->click('SMS');
        $I->see('Get a reset code');
        $I->expectTo('see SMS in the menu active');
        $I->see('SMS', '.active');
    }

    /**
     * @param AcceptanceTester $I
     */
    public function resetPasswordBySmsWorks(AcceptanceTester $I)
    {
        $I->amOnPage('/reset-password-by-sms');
        $I->fillField('login', 'user1');
        $I->click('Get user');
        $I->see('Check that user information are correct and press Send to get SMS token');
        $I->see('User full name');
        $I->see('User1 DisplayName');
        $I->see('Login');
        $I->see('user1');
        $I->see('SMS number');
        $I->see('0612****78');
        $I->click('Send');
        $I->seeSmsIsSent();
        $I->see('A confirmation code has been send by SMS');
        $I->see('SMS token');
        $code = $I->grabCodeInSms();
        $I->fillField('smstoken', $code);
        $I->click('Send');
        $I->see('Your new password is required');
        $I->see('The token sent by sms allows you to reset your password.');
    }
}
