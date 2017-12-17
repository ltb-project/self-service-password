<?php

namespace App\Tests\Acceptance;

use AcceptanceTester;

/**
 * Class HomepageCest
 */
class HomepageCest
{
    /**
     * @param AcceptanceTester $I
     */
    public function frontpageWorks(AcceptanceTester $I)
    {
        $I->wantTo('See the homepage');
        $I->amOnPage('/');
        $I->see('Self service password');
    }

    /**
     * @param AcceptanceTester $I
     */
    public function error404(AcceptanceTester $I)
    {
        $I->wantTo('See an invalid page');
        $I->amOnPage('/invalid');
        $I->seeResponseCodeIs('404');
    }
}
