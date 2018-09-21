<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ClubsUsersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ClubsUsersTable Test Case
 */
class ClubsUsersTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ClubsUsersTable
     */
    public $ClubsUsers;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.clubs_users',
        'app.users',
        'app.clubs'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('ClubsUsers') ? [] : ['className' => ClubsUsersTable::class];
        $this->ClubsUsers = TableRegistry::getTableLocator()->get('ClubsUsers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ClubsUsers);

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
