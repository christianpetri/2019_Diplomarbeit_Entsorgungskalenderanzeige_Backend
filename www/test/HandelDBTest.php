<?php
/**
 * Created by PhpStorm.
 * User: -
 * Date: 18.03.2019
 * Time: 17:04
 */

use PHPUnit\Framework\TestCase;


class HandelDBTest extends TestCase
{
    protected $db;

    protected function setUp() : void
    {   parent::setUp();
        try{
            $this->db = new HandelDB();
        } catch (Error $e){
            echo $e;
        }


    }


    public function testGetCheckIfCircleIdExists()
    {

        $this->assertInstanceOf(
            HandelDB::class,
           $this->db
        );
    }




}
