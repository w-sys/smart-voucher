<?php

use PHPUnit\Framework\TestCase;

use SmartVoucher\Client;
use SmartVoucher\VouchInterface;

final class GetallwebshopsTest extends TestCase {
  
  public function testCanGetAllWebshops()
  {
    $client = new Client();
    $webshops = $client->getWebshops();
    $this->assertIsArray($webshops);
    return [$webshops];
  }
  
  /** 
   * @dataProvider testCanGetAllWebshops
   */
  public function testCanGetAllWebShopsInsanceOfWebshop($item): void
  {
    $this->assertIntanceOf(VouchInterface, $item);
  }
  
}
