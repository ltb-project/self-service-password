<?php

namespace App\Tests\Service;

use App\Service\PosthookExecutor;

class PosthookExecutorTest extends \PHPUnit_Framework_TestCase {
    public function testEchoPosthook()
    {
        $posthookExecutor = new PosthookExecutor('echo');

        // without old password
        $result = $posthookExecutor->execute('login', 'newpassword');

        $this->assertSame(0, $result['return_var']);
        $this->assertSame('"login" "newpassword"', $result['output'][0]);

        // with old password
        $result = $posthookExecutor->execute('login', 'newpassword', 'oldpassword');

        $this->assertSame(0, $result['return_var']);
        $this->assertSame('"login" "newpassword" "oldpassword"', $result['output'][0]);
    }

}
