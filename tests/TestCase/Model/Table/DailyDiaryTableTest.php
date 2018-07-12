<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DailyDiaryTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DailyDiaryTable Test Case
 */
class DailyDiaryTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\DailyDiaryTable
     */
    public $DailyDiary;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.daily_diary',
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
        $config = TableRegistry::exists('DailyDiary') ? [] : ['className' => 'App\Model\Table\DailyDiaryTable'];
        $this->DailyDiary = TableRegistry::get('DailyDiary', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->DailyDiary);

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
