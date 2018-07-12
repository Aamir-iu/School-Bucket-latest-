<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\StudentsMasterDetailsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\StudentsMasterDetailsTable Test Case
 */
class StudentsMasterDetailsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\StudentsMasterDetailsTable
     */
    public $StudentsMasterDetails;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.students_master_details',
        'app.registrations',
        'app.classes',
        'app.shifts',
        'app.sessions',
        'app.campuses',
        'app.users',
        'app.roles'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('StudentsMasterDetails') ? [] : ['className' => 'App\Model\Table\StudentsMasterDetailsTable'];
        $this->StudentsMasterDetails = TableRegistry::get('StudentsMasterDetails', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->StudentsMasterDetails);

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
