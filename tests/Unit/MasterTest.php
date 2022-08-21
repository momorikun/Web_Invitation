<?php

namespace Tests\Unit;

use App\Models\Ceremony;
use PHPUnit\Framework\TestCase;
use Illuminate\Support\Facades\DB;

class MasterTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $this->assertTrue(true);
    }

    /**
     * 
     */
    public function test_get_all_ceremonies_with_limit_15 ()
    {
        $ceremonies = Ceremony::factory()->create();
        
        $this->assertTrue(true);
    }
}
