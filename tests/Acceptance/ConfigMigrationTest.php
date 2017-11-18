<?php


namespace App\Tests\Acceptance;

use App\Application;
use App\Framework\Request;

class ConfigMigrationTest extends \PHPUnit_Framework_TestCase
{
    public function testUsersMustConfigureSecret()
    {
        $app = new Application(__DIR__ . '/../data/config/1.1-original-config.php');

        $request = new Request();
        $response = $app->handle($request);

        $this->assertRegexp('/Token encryption requires a random string/', $response->getContent());
    }
}

