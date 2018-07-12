<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AdminCardDatesheetTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AdminCardDatesheetTable Test Case
 */
class AdminCardDatesheetTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\AdminCardDatesheetTable
     */
    public $AdminCardDatesheet;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.admin_card_datesheet',
        'app.classes',
        'app.shifts',
        'app.subjects',
        'app.orders',
        'app.scheduler',
        'app.employees',
        'app.users',
        'app.roles',
        'app.campuses',
        'app.departments',
        'app.users',
        'app.employee_department',
        'app.requisitions',
        'app.subjects',
        'app.classes_sections'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('AdminCardDatesheet') ? [] : ['className' => 'App\Model\Table\AdminCardDatesheetTable'];
        $this->AdminCardDatesheet = TableRegistry::get('AdminCardDatesheet', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->AdminCardDatesheet);

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
