<?php

namespace App\Tests\Acceptance;

use AcceptanceTester;

/**
 * Class ChangeSshKeyCest
 */
class ChangeSshKeyCest
{
    /**
     * @param AcceptanceTester $I
     */
    public function accessingFromMenuWorks(AcceptanceTester $I)
    {
        $I->amOnPage('/');
        $I->expectTo('see SSH Key in the menu');
        $I->see('SSH Key');
        $I->click('SSH Key');
        $I->see('Change your SSH Key');
        $I->expectTo('see SSH Key in the menu active');
        $I->see('SSH Key', '.active');
    }

    /**
     * @param AcceptanceTester $I
     */
    public function changeSshKeyWorks(AcceptanceTester $I)
    {
        $I->amOnPage('/change-ssh-key');
        $I->amGoingTo('fill the form with valid data');
        $I->fillField('login', 'user1');
        $I->fillField('password', 'password1');
        $I->fillField('sshkey', 'dftyguijok');
        $I->click('Send');
        $I->expect('the new ssh key is accepted');
        $I->see('Your SSH Key was changed');
    }
}
