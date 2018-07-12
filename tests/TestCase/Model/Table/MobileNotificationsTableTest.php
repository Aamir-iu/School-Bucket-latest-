<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MobileNotificationsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MobileNotificationsTable Test Case
 */
class MobileNotificationsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\MobileNotificationsTable
     */
    public $MobileNotifications;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.mobile_notifications'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('MobileNotifications') ? [] : ['className' => 'App\Model\Table\MobileNotificationsTable'];
        $this->MobileNotifications = TableRegistry::get('MobileNotifications', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->MobileNotifications);

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
}
