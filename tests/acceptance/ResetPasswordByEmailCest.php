<?php

namespace App\Tests\Acceptance;

use AcceptanceTester;

/**
 * Class ResetPasswordByEmailCest
 */
class ResetPasswordByEmailCest
{
    /**
     * @param AcceptanceTester $I
     */
    public function accessingFromMenuWorks(AcceptanceTester $I)
    {
        $I->amOnPage('/');
        $I->expectTo('see Email in the menu');
        $I->see('Email');
        $I->click('Email');
        $I->see('Email a password reset link');
        $I->expectTo('see Email in the menu active');
        $I->see('Email', '.active');
    }

    /**
     * @param AcceptanceTester $I
     */
    public function resetPasswordByEmailWorks(AcceptanceTester $I)
    {
        $I->amOnPage('/reset-password-by-email');
        $I->fillField('login', 'user1');
        $I->fillField('mail', 'user1@example.com');
        $I->click('Send');
        $I->see('A confirmation email has been sent');
        $I->seeEmailIsSent();
        $myEmailMessage = $I->grabLastSentEmail();
        $I->seeUrlInMail($myEmailMessage);
        $url = $I->grabUrlInMail($myEmailMessage);
        $I->expectTo('see the reset form because the token is valid');
        $I->amOnPage($url);
        $I->see('Login');
        $I->see('Password');
        $I->see('Confirm');
        $I->see('Send', 'form');
        $I->expectTo('see my login already filled and disabled');
        $I->canSeeInField('Login', 'user1');
        $I->seeInField('form input[disabled]','user1');
        $I->fillField('New password', 'newpass');
        $I->fillField('Confirm', 'newpass');
        $I->click('Send');
        $I->see('Your password was changed');
    }
}
