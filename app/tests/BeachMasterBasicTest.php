<?php

class BeachMasterBasicTest extends TestCase {

	public function testBeachController()
	{
		$crawler = $this->client->request('GET', '/');
		$this->assertTrue($this->client->getResponse()->isOk());
                $this->assertViewHas("beaches");
                
                $crawler = $this->client->request('GET', '/add');
		$this->assertTrue($this->client->getResponse()->isOk());
                
                $crawler = $this->client->request('GET', '/api/v1/beaches');
		$this->assertTrue($this->client->getResponse()->isOk());
                
                $crawler = $this->client->request('GET', '/about');
		$this->assertTrue($this->client->getResponse()->isOk());
                
                $crawler = $this->client->request('GET', '/details/A');
		$this->assertRedirectedTo('/');
                
                $crawler = $this->client->request('GET', '/details/1');
		$this->assertViewHas('beach');
                $this->assertViewHas('reviews');
	}
        
        public function testReviewController(){
                $crawler = $this->client->request('POST', '/review/add', 
                        array(
                            'title' =>'Review Title',
                            'text' =>'Review Description',
                            'beachId' =>1)
                        );
                $this->assertRedirectedTo('/details/1');
                $message = 'Review submitted!';
                $this->assertSessionHas('message',$message);
                
                $crawler = $this->client->request('POST', '/review/add', 
                        array(
                            //Missing parameters
                            'beachId' =>1)
                        );
                $this->assertRedirectedTo('/details/1');
                $this->assertSessionHas('errors');
                
                $crawler = $this->client->request('POST', '/review/add');
                $this->assertRedirectedTo('/');
                $this->assertSessionHas('errors');
        }
}
