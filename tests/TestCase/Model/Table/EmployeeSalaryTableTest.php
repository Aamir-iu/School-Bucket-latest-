<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\EmployeeSalaryTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\EmployeeSalaryTable Test Case
 */
class EmployeeSalaryTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\EmployeeSalaryTable
     */
    public $EmployeeSalary;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.employee_salary',
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
        $config = TableRegistry::exists('EmployeeSalary') ? [] : ['className' => 'App\Model\Table\EmployeeSalaryTable'];
        $this->EmployeeSalary = TableRegistry::get('EmployeeSalary', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->EmployeeSalary);

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
