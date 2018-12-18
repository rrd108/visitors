<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ServicesVisitsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ServicesVisitsTable Test Case
 */
class ServicesVisitsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ServicesVisitsTable
     */
    public $ServicesVisits;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.services_visits',
        'app.services',
        'app.visits'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('ServicesVisits') ? [] : ['className' => ServicesVisitsTable::class];
        $this->ServicesVisits = TableRegistry::getTableLocator()->get('ServicesVisits', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ServicesVisits);

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

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
