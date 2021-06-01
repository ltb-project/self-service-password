<?php

namespace PwnedPasswords;

use PwnedPasswords\Exceptions\InvalidPasswordException;
use PwnedPasswords\Exceptions\InvalidResponseException;

class PwnedPasswords
{
    protected $baseUrl = "https://api.pwnedpasswords.com";

    public function isPwned(string $password, bool $getHits = false)
    {
        if (empty($password)) {
            throw new InvalidPasswordException("There was no password to check.");
        }

        $client = $this->getGuzzleClient();

        $hashedPassword = strtoupper(sha1($password));
        $chars          = substr($hashedPassword, 0, 5);

        $response = $client->get(sprintf('/range/%s', $chars));

        if ($response->getStatusCode() !== 200) {
            throw new InvalidResponseException(sprintf("Invalid status code returned from API request (%s), expected 200.", $response->getStatusCode()));
        }

        foreach (explode("\r\n", $response->getBody()->getContents()) as $line) {
            $result = explode(':', $line);
            $hash   = $chars . $result[0];
            $hits   = intval($result[1]);

            if ($hash === $hashedPassword) {
                if ($getHits === true) {
                    return $hits;
                }

                return true;
            }
        }

        if ($getHits === true) {
            return 0;
        }

        return false;
    }

    protected function getGuzzleClient()
    {
        return new \GuzzleHttp\Client([
            'base_uri' => $this->baseUrl
        ]);
    }
}