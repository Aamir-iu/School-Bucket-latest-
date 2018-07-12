<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\StudentsNotificationsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\StudentsNotificationsTable Test Case
 */
class StudentsNotificationsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\StudentsNotificationsTable
     */
    public $StudentsNotifications;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.students_notifications',
        'app.notifications',
        'app.registrations'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('StudentsNotifications') ? [] : ['className' => 'App\Model\Table\StudentsNotificationsTable'];
        $this->StudentsNotifications = TableRegistry::get('StudentsNotifications', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->StudentsNotifications);

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
