<?php
use PHPUnit\Framework\TestCase;
  
class TestCases extends TestCase
{
    public function simple()
    {
        $response = $this->get('/');
 
        $response->assertStatus(200);

    }
}
  
?>