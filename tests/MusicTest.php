<?php
namespace Acme\Bundle\ApiBundle\Tests\Controller\Rest;



use App\Entity\Music;
use App\Repository\MusicRepository;
use function PHPSTORM_META\type;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

/**
 * CommentControllerTest
 */

class MusicTest extends WebTestCase
{
    public function testShouldGetAll()
    {
        $client = static::createClient();

        $client->request('GET', '/musics');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $json = json_decode($client->getResponse()->getContent());
        $this->assertEquals(sizeof($json), 2);
    }

    public function testShouldGetOne(){
        self::bootKernel();

        // returns the real and unchanged service container
        $container = self::$kernel->getContainer();
        // gets the special container that allows fetching private services
        $container = self::$container;
        $music = self::$container->get('doctrine')->getRepository(Music::class)->find(1);

        $client = static::createClient();
        $client->request('GET', '/musics/1');
        $json = json_decode($client->getResponse()->getContent());

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertEquals($json->_title, $music->getTitle());
        $this->assertEquals($json->_file, $music->getFile());
    }

    public function testShouldCreateOne(){
        $client = static::createClient();
        self::bootKernel();

        // returns the real and unchanged service container
        $container = self::$kernel->getContainer();
        // gets the special container that allows fetching private services
        $container = self::$container;

        $client->request('POST', '/musics', [
            'title' => 'test',
            'file' => 'test'
        ]);
        $music = self::$container->get('doctrine')->getRepository(Music::class)->find(4);
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertEquals($music->getTitle(), 'test');
        $this->assertEquals($music->getFile(), 'test');
    }
}