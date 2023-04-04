<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RoutingTest extends WebTestCase
{
    public function providerUrisWithStatusCode(): array
    {
        return
            [
                ['/home', 200],
                ['/contact', 404],
                ['/help', 404],
            ];
    }

    /**
     * @dataProvider providerUrisWithStatusCode
     */
    public function test(string $url, int $expectedStatusCode): void
    {
        $client = self::createClient();
        $client->request('GET', $url);

        self::assertResponseStatusCodeSame($expectedStatusCode);
    }
}
