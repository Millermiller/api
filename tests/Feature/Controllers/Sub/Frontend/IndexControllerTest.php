<?php


namespace Tests\Feature\Controllers\Sub\Frontend;

use Scandinaver\User\Domain\User;
use Tests\TestCase;

/**
 * Class IndexControllerTest
 * @package Tests\Feature\Controllers\Sub\Frontend
 */
class IndexControllerTest extends TestCase
{

    public function testIndex()
    {
        $response = $this->get('/');
        $this->assertEquals(200, $response->getStatusCode());
   }

    public function testGetUser()
    {
        $user = app('em')->getRepository(User::class)->find(1);
        $this->actingAs($user);

        $response = $this->get(route('sub_frontend::user-info', ['domain' => 'is']));

        $response->assertJsonStructure(['id', 'login', 'avatar', 'email', 'active', 'plan', 'active_to']);
    }

    public function testInfo()
    {
        $response = $this->get(route('sub_frontend::site-info', ['domain' => 'is']));

        $response->assertJsonStructure(['site']);
    }

    public function testGetWords()
    {
        $user = app('em')->getRepository(User::class)->find(1);
        $this->actingAs($user);

        $response = $this->get(route('sub_frontend::words', ['domain' => 'is']));

        $response->assertJsonStructure([['count', 'id', 'title', 'level', 'active', 'testlink', 'canopen', 'result', 'type', 'available']]);
    }

    public function testSentences()
    {
        $user = app('em')->getRepository(User::class)->find(1);
        $this->actingAs($user);

        $response = $this->get(route('sub_frontend::sentences', ['domain' => 'is']));

     //   $response->assertJsonStructure([['count', 'id', 'title', 'level', 'active', 'testlink', 'canopen', 'result', 'type', 'available']]);
    }

    public function testPersonal()
    {
        $user = app('em')->getRepository(User::class)->find(1);
        $this->actingAs($user);

        $response = $this->get(route('sub_frontend::personal', ['domain' => 'is']));

        $response->assertJsonStructure([['count', 'id', 'title', 'level', 'result', 'type']]);
    }

    public function testCheck()
    {
        $user = app('em')->getRepository(User::class)->find(1);
        $this->actingAs($user);

        $response = $this->get(route('sub_frontend::check', ['domain' => 'is']));
      //  dd($response);
        $response->assertJsonStructure(['auth', 'state' => ['user']]);

        $data = $response->decodeResponseJson();

        $this->assertEquals(1, $data['state']['user']['id']);
        $this->assertEquals(true, $data['auth']);
    }

    public function testCheckFail()
    {
        $response = $this->get(route('sub_frontend::check', ['domain' => 'is']));

        $response->assertJsonStructure(['auth', 'state' => []]);

        $data = $response->decodeResponseJson();
        $this->assertEquals(false, $data['auth']);
    }

    public function testFeedback()
    {
        $user = app('em')->getRepository(User::class)->find(1);
        $this->actingAs($user);

        $response = $this->post(route('sub_frontend::subdomain-feedback', ['domain' => 'is', 'message' => 'testmessage']));

        $this->assertEquals(201, $response->getStatusCode());

        $response->assertJsonStructure(['message', 'id']);

        $data = $response->decodeResponseJson();
        $this->assertEquals('testmessage', $data['message']);
        $this->assertEquals($user->getLogin(), $data['name']);
    }
}