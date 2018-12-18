<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ServicesDaysTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ServicesDaysTable Test Case
 */
class ServicesDaysTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ServicesDaysTable
     */
    public $ServicesDays;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.services_days'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('ServicesDays') ? [] : ['className' => ServicesDaysTable::class];
        $this->ServicesDays = TableRegistry::getTableLocator()->get('ServicesDays', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ServicesDays);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
