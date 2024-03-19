<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TurnoverControllerTest extends WebTestCase
{

    public function testTurnoverReceive(): void
    {
        $client = static::createClient();
        $client->request('GET', '/turnover/1/show');

        $responseData = json_decode($client->getResponse()->getContent(), true);

        $this->assertEquals(1, $responseData['id']);
        $this->assertArrayHasKey('vat_country', $responseData);
        $this->assertArrayHasKey('departure_country', $responseData);
        $this->assertArrayHasKey('arrival_country', $responseData);
        $this->assertArrayHasKey('document_number', $responseData);
        $this->assertArrayHasKey('document_date', $responseData);
        $this->assertArrayHasKey('zip_code', $responseData);
        $this->assertArrayHasKey('city', $responseData);
        $this->assertArrayHasKey('turnover_item_list', $responseData);
        $this->assertEquals('Poland', $responseData['arrival_country']['name']);
    }
}
