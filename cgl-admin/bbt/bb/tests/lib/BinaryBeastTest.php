<?php

/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.0 on 2013-02-19 at 23:22:50.
 * @group binarybeast
 * @group library
 * @group all
 */
class BinaryBeastTest extends BBTest {

    /**
     * @var BinaryBeast
     */
    protected $object;

    protected function setUp() {
        $this->object = &$this->bb;
    }

    /**
     * @covers BinaryBeast::login
     */
    public function testLogin() {
        $this->assertTrue($this->object->login('APITester@binarybeast.com', 'password', true), 'Email/Password login failed');
        //Only testing, keep using the api key as it is the standard
        $this->object->login(null, null, false);
    }

    /**
     * @covers BinaryBeast::test_login
     */
    public function testTest_login() {
        $this->assertTrue($this->object->test_login(), 'API Key Login failed');
    }

    /**
     * @covers BinaryBeast::disable_ssl_verification
     */
    public function testDisable_ssl_verification() {
        $this->object->disable_ssl_verification();
        $this->assertFalse($this->object->ssl_verification());
    }

    /**
     * @covers BinaryBeast::ssl_verification
     */
    public function testSsl_verification() {
        $this->object->disable_ssl_verification();
        $this->assertFalse($this->object->ssl_verification());
    }

    /**
     * @covers BinaryBeast::enable_ssl_verification
     */
    public function testEnable_ssl_verification() {
        $this->object->enable_ssl_verification();
        $this->assertTrue($this->object->ssl_verification());
        //Keep it disabled
        $this->object->disable_ssl_verification();
    }

    /**
     * @covers BinaryBeast::call
     */
    public function testCall() {
        $this->assertServiceListSuccessful($this->object->call('Tourney.TourneyList.Creator', array('page_size' => 1)));
    }

    /**
     * @covers BinaryBeast::tournament
     */
    public function testTournament() {
        $this->assertInstanceOf('BBTournament', $this->object->tournament, '$this->object->tournament did not return a new BBTournament');
        $this->assertInstanceOf('BBTournament', $this->object->tournament(), '$this->object->tournament() did not return a new BBTournament');
    }

    /**
     * @covers BinaryBeast::team
     */
    public function test_team() {
        $this->assertInstanceOf('BBTeam', $this->object->team, '$this->object->team did not return a new BBTeam');
        $this->assertInstanceOf('BBTeam', $this->object->team(), '$this->object->team() did not return a new BBTeam');
    }

    /**
     * @covers BinaryBeast::match
     */
    public function testMatch() {
        $this->assertInstanceOf('BBMatch', $this->object->match, '$this->object->match did not return a new BBMatch');
        $this->assertInstanceOf('BBMatch', $this->object->match(), '$this->object->match() did not return a new BBMatch');
    }

    /**
     * @covers BinaryBeast::match
     */
    public function test_match_game() {
        $this->assertInstanceOf('BBMatchGame', $this->object->match_game, '$this->object->match_game did not return a new BBMatchGame');
        $this->assertInstanceOf('BBMatchGame', $this->object->match_game(), '$this->object->match_game() did not return a new BBMatchGame');
    }

    /**
     * @covers BinaryBeast::map
     */
    public function testMap() {
        $this->assertInstanceOf('BBMap', $this->object->map, '$this->object->map did not return a new BBMap');
        $this->assertInstanceOf('BBMap', $this->object->map(), '$this->object->map() did not return a new BBMap');
    }

    /**
     * @covers BinaryBeast::country
     */
    public function testCountry() {
        $this->assertInstanceOf('BBCountry', $this->object->country, '$this->object->country did not return a new BBCountry');
        $this->assertInstanceOf('BBCountry', $this->object->country(), '$this->object->country() did not return a new BBCountry');
    }

    /**
     * @covers BinaryBeast::game
     */
    public function testGame() {
        $this->assertInstanceOf('BBGame', $this->object->game, '$this->object->game did not return a new BBGame');
        $this->assertInstanceOf('BBGame', $this->object->game(), '$this->object->game() did not return a new BBGame');
    }

    /**
     * @covers BinaryBeast::race
     */
    public function testRace() {
        $this->assertInstanceOf('BBRace', $this->object->race, '$this->object->game did not return a new BBRace');
        $this->assertInstanceOf('BBRace', $this->object->race(), '$this->object->game() did not return a new BBRace');
    }

    /**
     * Test to make sure that BBModels do not allow
     *  loading data from a specific ID, if it already had an ID and you are
     *  specifying a new one
     */
    public function test_load_different_id() {
        $tournament = $this->object->tournament();
        $tournament->title = 'load() test';
        $this->assertSave($tournament->save());

        $tournament2 = $this->object->tournament();
        $tournament2->title = 'load() test';
        $this->assertSave($tournament2->save());
        
        $this->assertFalse($tournament->load($tournament2->id));
        $this->assertFalse($tournament2->load($tournament->id));
        
        $tournament->delete();
        $tournament2->delete();
    }

    /**
     * Test format of set_error
     */
    public function test_last_error() {
        $this->object->set_error('Custom Error');
        $this->assertTrue(is_object($this->object->last_error));
        $this->assertEquals('Custom Error', $this->object->last_error->error_message);
    }
    /**
     */
    public function test_error_history() {
        $this->object->set_error('Custom Error');
        $key = sizeof($this->object->error_history) - 1;
        $this->assertTrue(is_object($this->object->error_history[$key]));
        $this->assertEquals('Custom Error', $this->object->error_history[$key]->error_message);
    }
}

?>