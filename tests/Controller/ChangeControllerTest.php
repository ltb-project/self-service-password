<?php

namespace App\Tests\Controller;

use App\Application;
use App\Framework\Request;

class ChangeControllerTest extends \PHPUnit_Framework_TestCase {
    public function testChangePassword() {
        $app = new Application(__DIR__ . '/../data/config/1.1-configured.php');

        // Insert fake ldap client in the application
        $container = $app->getContainer();

        $container['ldap_client'] = $this->createFakeLdapClient();

        // Send request to homepage
        $request = new Request();
        $response = $app->handle($request);

        // Assert that the form is present
        $this->assertRegexp('/input.*name="login"/', $response->getContent());
        $this->assertRegexp('/input.*name="oldpassword"/', $response->getContent());
        $this->assertRegexp('/input.*name="newpassword"/', $response->getContent());
        $this->assertRegexp('/input.*name="confirmpassword"/', $response->getContent());

        // Send new request with valid data
        $request = new Request(array(), array(
            'login' => 'plewin',
            'oldpassword' => 'myoldpass',
            'newpassword' => 'mynewpass',
            'confirmpassword' => 'mynewpass',
        ));

        $response = $app->handle($request);

        $this->assertRegexp('/Your password was changed/', $response->getContent());
    }

    private function createFakeLdapClient() {
        return new ChangeControllerTestFakeLdapClient();
    }
}


class ChangeControllerTestFakeLdapClient {
    public function connect() {
        return ''; // no problem
    }

    public function checkOldPassword($login, $oldpassword, &$context) {
        return ''; // no problem
    }

    public function changePassword($userdn, $newpassword, $oldpassword, $context) {
        return 'passwordchanged';
    }
}
