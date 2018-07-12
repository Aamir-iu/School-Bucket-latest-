<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ClassScheduleTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ClassScheduleTable Test Case
 */
class ClassScheduleTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ClassScheduleTable
     */
    public $ClassSchedule;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.class_schedule',
        'app.days',
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
        'app.classes_sections',
        'app.classes',
        'app.shifts'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('ClassSchedule') ? [] : ['className' => 'App\Model\Table\ClassScheduleTable'];
        $this->ClassSchedule = TableRegistry::get('ClassSchedule', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ClassSchedule);

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
