<?php

namespace App\Tests\ApplicationTests;

use App\DataFixtures\PetitionFixture;
use App\Repository\PetitionRepository;
use Doctrine\ORM\Tools\SchemaTool;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PetitionsControllerTest extends WebTestCase
{
    private $client;
    private $entityManager;

    public function setUp(): void
    {
        parent::setUp();
        $this->client = static::createClient();
        $this->entityManager = $this->client->getContainer()->get('doctrine.orm.entity_manager');
        $cmf = $this->entityManager->getMetadataFactory();
        $classes = $cmf->getAllMetadata();
        $schemaTool = new SchemaTool($this->entityManager);
        $schemaTool->createSchema($classes);
    }

    public function testGettingAllPetitions() {
        (new PetitionFixture())->load($this->entityManager);
        $this->client->request('GET', '/api/petitions', [], [], [
            'HTTP_AUTHORIZATION' => 'Bearer random_token'
        ]);
        $this->assertResponseIsSuccessful();
        $content = json_decode($this->client->getResponse()->getContent(), true);
        $this->assertCount(2, $content);
        $this->assertEquals('Japan', $content[0]['country']);
        $this->assertEquals('Germany', $content[1]['country']);
    }

    public function testCreatingANewPetition() {
        $this->client->request('POST', '/api/petitions', [], [], [
            'HTTP_AUTHORIZATION' => 'Bearer random_token'
        ], json_encode([
            'name' => 'Test petition',
            'description' => 'This is a test petition',
            'country' => 'France'
        ]));
        $this->assertResponseIsSuccessful();
        $content = json_decode($this->client->getResponse()->getContent(), true);
        $this->assertEquals(1, $content['petition']['id']);
        $records = static::getContainer()->get(PetitionRepository::class)->findAll();
        $this->assertCount(1, $records);
        $this->assertEquals('France', $records[0]->getCountry());
    }
}