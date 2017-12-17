<?php

namespace App\Tests\Acceptance;

use AcceptanceTester;

/**
 * Class ChangeSecurityQuestionCest
 */
class ChangeSecurityQuestionCest
{
    /**
     * @param AcceptanceTester $I
     */
    public function changeSecurityQuestionWorks(AcceptanceTester $I)
    {
        $I->amOnPage('/change-security-question');
        $I->see('Set your password reset questions');
        $I->amGoingTo('fill the form with valid data');
        $I->fillField('login', 'user1');
        $I->fillField('password', 'password1');
        $I->selectOption('Question','When is your birthday?');
        $I->fillField('answer', '42');
        $I->click('Send');
        $I->expect('the new answer is accepted');
        $I->see('Your answer has been registered');
    }

    /**
     * @param AcceptanceTester $I
     */
    public function changeSecurityQuestionFailWhenMissingLogin(AcceptanceTester $I)
    {
        $I->amOnPage('/change-security-question');
        $I->see('Set your password reset questions');
        $I->amGoingTo('fill the form with valid data');
        $I->fillField('password', 'password1');
        $I->selectOption('Question','When is your birthday?');
        $I->fillField('answer', '42');
        $I->click('Send');
        $I->expect('the new answer is not accepted');
        $I->see('Your login is required');
    }

    /**
     * @param AcceptanceTester $I
     */
    public function changeSecurityQuestionFailWhenMissingPassword(AcceptanceTester $I)
    {
        $I->amOnPage('/change-security-question');
        $I->see('Set your password reset questions');
        $I->amGoingTo('fill the form with valid data');
        $I->fillField('login', 'user1');
        $I->selectOption('Question','When is your birthday?');
        $I->fillField('answer', '42');
        $I->click('Send');
        $I->expect('the new answer is not accepted');
        $I->see('Your password is required');
    }

}
