<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\StudentAttendanceTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\StudentAttendanceTable Test Case
 */
class StudentAttendanceTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\StudentAttendanceTable
     */
    public $StudentAttendance;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.student_attendance',
        'app.registrations',
        'app.classes',
        'app.shifts',
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
        $config = TableRegistry::exists('StudentAttendance') ? [] : ['className' => 'App\Model\Table\StudentAttendanceTable'];
        $this->StudentAttendance = TableRegistry::get('StudentAttendance', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->StudentAttendance);

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
