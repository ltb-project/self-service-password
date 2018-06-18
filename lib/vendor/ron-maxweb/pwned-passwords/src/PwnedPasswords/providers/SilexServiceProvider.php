<?php


namespace PwnedPasswords\Providers;

use PwnedPasswords\PwnedPasswords;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

class SilexServiceProvider implements ServiceProviderInterface
{
    public function register(Container $app)
    {
        
        $app['pwned_passwords.method'] = PwnedPasswords::CURL;
        
        $app['pwned_passwords.curl_options'] = [];
        
        $app['pwned_passwords'] = function($app) {
            $pp = new PwnedPasswords();
            $pp->setMethod($app['pwned_passwords.method'];
            $pp->setCurlOptions($app['pwned_passwords.curl_options']);
            return $pp;
        }
        
    }
}
