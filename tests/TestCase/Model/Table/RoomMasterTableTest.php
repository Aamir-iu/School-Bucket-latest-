<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\RoomMasterTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\RoomMasterTable Test Case
 */
class RoomMasterTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\RoomMasterTable
     */
    public $RoomMaster;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.room_master'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('RoomMaster') ? [] : ['className' => 'App\Model\Table\RoomMasterTable'];
        $this->RoomMaster = TableRegistry::get('RoomMaster', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->RoomMaster);

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
