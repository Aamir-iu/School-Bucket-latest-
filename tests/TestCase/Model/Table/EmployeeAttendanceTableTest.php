<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\EmployeeAttendanceTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\EmployeeAttendanceTable Test Case
 */
class EmployeeAttendanceTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\EmployeeAttendanceTable
     */
    public $EmployeeAttendance;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.employee_attendance',
        'app.employees',
        'app.users',
        'app.roles',
        'app.campuses',
        'app.departments',
        'app.users',
        'app.employee_department',
        'app.requisitions'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('EmployeeAttendance') ? [] : ['className' => 'App\Model\Table\EmployeeAttendanceTable'];
        $this->EmployeeAttendance = TableRegistry::get('EmployeeAttendance', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->EmployeeAttendance);

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
