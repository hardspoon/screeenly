<?php

class RouteTest extends TestCase {

	/**
	 * A basic functional test example.
	 *
	 * @return void
	 */
	public function testHomepage()
	{
		$crawler = $this->call('GET', '/');
		$this->assertResponseOk();
	}

	public function testTryPage()
	{
		$crawler = $this->call('GET', '/try');
		$this->assertResponseOk();
	}

	public function testTryWithWrongProof()
	{
		$response = $this->call('POST', '/try', [
				'url' => 'http://google.com',
				'key' => 'something',
				'proof' => 'something'
		]);

		$this->assertResponseStatus(302);
		$this->assertRedirectedToRoute('home.landingpage');

	}

	public function testTryWithCorrectProof()
	{
		$token = csrf_token();

		$response = $this->call('POST', '/try', [
				'url'    => 'http://google.com',
				'key'    => 'something',
				'proof'  => 'laravel'
		]);

		$this->assertResponseStatus(302);
		// $this->assertRedirectedTo('try');
		$this->assertRedirectedToRoute('try');
		$this->assertSessionHas('asset');

	}

}
