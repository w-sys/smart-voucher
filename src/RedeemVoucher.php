<?php

namespace SmartVoucher;

class RedeemVoucher implements RedeemVoucherInterface {
  
  protected $id;
  
  protected $webshopAddr;
  
  protected $amount;
  
  protected $nonce;
  
  protected $signature;
  
  public function getId() {
    return $this->id;
  }
  
  public function setId(int $id) {
    $this->id = $id;
    return $this;
  }
  
  public function getWebshopAddr() {
    return $this->webshopAddr;
  }
 
  
  public function setWebshopAddr(string $addr) {
    $this->webshopAddr = $addr;
    return $this;
  }
  
  public function getAmount() {
    return $this->amount;
  }
  public function setAmount(float $amount) {
    $this->amount = $amount;
    return $this;
  }
  
  public function getNonce() {
    return $this->nonce;
  }
  
  public function setNonce(int $nonce) {
    $this->nonce = $nonce;
    return $this;
  }
  
  
  public function getSignature() {
    return $this->signature;
  }
  
  public function setSignature(string $signature) {
    $this->signature = $signature;
    return $this;
  }
}
