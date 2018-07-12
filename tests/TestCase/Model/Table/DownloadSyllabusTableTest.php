<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DownloadSyllabusTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DownloadSyllabusTable Test Case
 */
class DownloadSyllabusTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\DownloadSyllabusTable
     */
    public $DownloadSyllabus;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.download_syllabus',
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
        $config = TableRegistry::exists('DownloadSyllabus') ? [] : ['className' => 'App\Model\Table\DownloadSyllabusTable'];
        $this->DownloadSyllabus = TableRegistry::get('DownloadSyllabus', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->DownloadSyllabus);

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
