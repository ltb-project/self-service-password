<?php

namespace App\Tests\Functional\Security;

use App\Tests\Functional\FunctionalTestCase;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class ControllersTest
 */
class ControllersTest extends FunctionalTestCase
{
    public function testChangePasswordController()
    {
        $client = $this->createClient();
        $changePasswordController = $client->getContainer()->get('change_password.controller');

        $container = $this->getMock('Symfony\\Component\\DependencyInjection\Container');

        $container
            ->method('getParameter')
            ->with('enable_password_change')
            ->willReturn(false);

        $this->setExpectedException('Symfony\Component\Security\Core\Exception\AccessDeniedException');

        $changePasswordController->setContainer($container);
        $request = new Request();
        $changePasswordController->indexAction($request);
    }

    public function testChangeSecurityQuestionController()
    {
        $client = $this->createClient();
        $changePasswordController = $client->getContainer()->get('change_security_questions.controller');

        $container = $this->getMock('Symfony\\Component\\DependencyInjection\Container');

        $container
            ->method('getParameter')
            ->with('enable_questions')
            ->willReturn(false);

        $this->setExpectedException('Symfony\Component\Security\Core\Exception\AccessDeniedException');

        $changePasswordController->setContainer($container);
        $request = new Request();
        $changePasswordController->indexAction($request);
    }

    public function testChangeSshKeyController()
    {
        $client = $this->createClient();
        $changePasswordController = $client->getContainer()->get('change_ssh_key.controller');

        $container = $this->getMock('Symfony\\Component\\DependencyInjection\Container');

        $container
            ->method('getParameter')
            ->with('enable_sshkey_change')
            ->willReturn(false);

        $this->setExpectedException('Symfony\Component\Security\Core\Exception\AccessDeniedException');

        $changePasswordController->setContainer($container);
        $request = new Request();
        $changePasswordController->indexAction($request);
    }

    public function testGetTokenByEmailVerificationController()
    {
        $client = $this->createClient();
        $changePasswordController = $client->getContainer()->get('get_token_by_email_verification.controller');

        $container = $this->getMock('Symfony\\Component\\DependencyInjection\Container');

        $container
            ->method('getParameter')
            ->with('enable_reset_by_email')
            ->willReturn(false);

        $this->setExpectedException('Symfony\Component\Security\Core\Exception\AccessDeniedException');

        $changePasswordController->setContainer($container);
        $request = new Request();
        $changePasswordController->indexAction($request);
    }

    public function testGetTokenBySmsVerificationController()
    {
        $client = $this->createClient();
        $changePasswordController = $client->getContainer()->get('get_token_by_sms_verification.controller');

        $container = $this->getMock('Symfony\\Component\\DependencyInjection\Container');

        $container
            ->method('getParameter')
            ->with('enable_reset_by_sms')
            ->willReturn(false);

        $this->setExpectedException('Symfony\Component\Security\Core\Exception\AccessDeniedException');

        $changePasswordController->setContainer($container);
        $request = new Request();
        $changePasswordController->indexAction($request);
    }

    public function testResetPasswordByQuestionController()
    {
        $client = $this->createClient();
        $changePasswordController = $client->getContainer()->get('reset_password_by_question.controller');

        $container = $this->getMock('Symfony\\Component\\DependencyInjection\Container');

        $container
            ->method('getParameter')
            ->with('enable_questions')
            ->willReturn(false);

        $this->setExpectedException('Symfony\Component\Security\Core\Exception\AccessDeniedException');

        $changePasswordController->setContainer($container);
        $request = new Request();
        $changePasswordController->indexAction($request);
    }

    public function testResetPasswordByTokenController()
    {
        $client = $this->createClient();
        $changePasswordController = $client->getContainer()->get('reset_password_by_token.controller');

        $container = $this->getMock('Symfony\\Component\\DependencyInjection\Container');

        $values = [
            ['enable_reset_by_email', false],
            ['enable_reset_by_sms', false],
        ];

        $container
            ->method('getParameter')
            ->will($this->returnValueMap($values))
        ;

        $this->setExpectedException('Symfony\Component\Security\Core\Exception\AccessDeniedException');

        $changePasswordController->setContainer($container);
        $request = new Request();
        $changePasswordController->indexAction($request);
    }
}

