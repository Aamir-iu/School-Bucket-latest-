<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\RemarksForStudentsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\RemarksForStudentsTable Test Case
 */
class RemarksForStudentsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\RemarksForStudentsTable
     */
    public $RemarksForStudents;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.remarks_for_students',
        'app.registrations',
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
        $config = TableRegistry::exists('RemarksForStudents') ? [] : ['className' => 'App\Model\Table\RemarksForStudentsTable'];
        $this->RemarksForStudents = TableRegistry::get('RemarksForStudents', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->RemarksForStudents);

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
