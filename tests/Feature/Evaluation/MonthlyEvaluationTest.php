<?php

namespace Tests\Feature\Evaluation;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MonthlyEvaluationTest extends TestCase
{

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutExceptionHandling();
    }
    /**
     * Test supervisor can store evaluation
     *
     * @test 
     */
    public function supervisor_can_store_evaluation()
    {
        
        $response = $this->json('POST','/api/store/evaluation', [          
            'user_id' => 13,
            'employee_id' => 2,
            'key_result_area' => "key result area test task",
            'month_of_evaluation' => date('Y-d-m',strtotime('2021-04-12'))
        ]);
      
        $response->assertStatus(200);
    }
     /**
     * Test supervisor can update evaluation
     *
     * @test 
     */
    public function supervisor_can_update_evaluation()
    {
        
        $response = $this->json('POST','/api/update/evaluation', [ 
            'id' => 2,     
            'key_result_area' => "update key result area test",
            'month_of_evaluation' => date('Y-d-m',strtotime('2021-04-12'))
        ]);
      
        $response->assertStatus(200);
    }
     /**
     * Test supervisor can update evaluation
     *
     * @test 
     */
    public function supervisor_can_update_evaluation()
    {
        
        $response = $this->json('POST','/api/update/evaluation', [ 
            'id' => 2,     
            'key_result_area' => "update key result area test",
            'month_of_evaluation' => date('Y-d-m',strtotime('2021-04-12'))
        ]);
      
        $response->assertStatus(200);
    }
    
}
