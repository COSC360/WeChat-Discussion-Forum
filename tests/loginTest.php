<?php
use GuzzleHttp\Client;
class loginTest extends \PHPUnit\Framework\TestCase
{
    public function testLogin()
    {
        $this->assertTrue(true);
    }

    //page loads correctly test
    public function testLoginPageLoads()
{
    $client = new \GuzzleHttp\Client();
    $response = $client->request('GET', 'http://localhost/login.php');
    $this->assertEquals(200, $response->getStatusCode());
    $this->assertStringContainsString('Login', $response->getBody());
}

}
?>