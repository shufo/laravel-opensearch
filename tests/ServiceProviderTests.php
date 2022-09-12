<?php namespace Shufo\LaravelOpenSearch\Tests;

use Shufo\LaravelOpenSearch\Factory;
use Shufo\LaravelOpenSearch\Manager;
use OpenSearch;
use OpenSearch\Client;


class ServiceProviderTests extends TestCase
{

    public function testAbstractsAreLoaded(): void
    {
        $factory = app('opensearch.factory');
        $this->assertInstanceOf(Factory::class, $factory);

        $manager = app('opensearch');
        $this->assertInstanceOf(Manager::class, $manager);

        $client = app(Client::class);
        $this->assertInstanceOf(Client::class, $client);
    }

    /**
     * Test that the facade works.
     * @todo This seems a bit simplistic ... maybe a better way to do this?
     */
    public function testFacadeWorks(): void
    {
        $ping = OpenSearch::ping();

        $this->assertTrue($ping);
    }

    /**
     * Test we can get the ES info.
     */
    public function testInfoWorks(): void
    {
        $info = OpenSearch::info();

        $this->assertIsArray($info);
        $this->assertArrayHasKey('cluster_name', $info);
    }
}
