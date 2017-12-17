<?php

namespace App\Tests\Functional\Translation;

use App\Tests\Functional\FunctionalTestCase;

/**
 * Class TranslationTest
 */
class TranslationTest extends FunctionalTestCase
{
    public function testPageIsTranslated()
    {
        $client = $this->createClient();

        $crawler = $client->request(
            'GET',
            '/change-password',
            [],
            []
        );

        $response = $client->getResponse()->getContent();
        $this->assertNotContains('Gestion du mot de passe', $response);

        // request from French (Switzerland) browser
        $crawler = $client->request(
            'GET',
            '/change-password',
            [],
            [],
            ['HTTP_ACCEPT_LANGUAGE' => 'fr-CH, fr;q=0.9, en;q=0.8, de;q=0.7, *;q=0.5']
        );

        $response = $client->getResponse()->getContent();
        $this->assertContains('Gestion du mot de passe', $response);
    }
}

