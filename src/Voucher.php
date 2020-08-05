<?php

namespace SmartVoucher;

class Voucher implements VoucherInterface {
  
  protected $id;
  
  protected $amount;
  
  protected $webshopAddr;
  
  protected $nonce;
  
  protected $signature;
  
  protected $initalAmount;
  
  protected $currentAmount;
  
  protected $created_at;
  
  protected $updated_at;
  
  public function getId() {
    return $this->id;
  }
  
  public function setId(int $id) {
    $this->id = $id;
    return $this;
  }
  
  
  public function getAmount() {
    return $this->amount;
  }
  
  public function setAmount(float $amount) {
    $this->amount = $amount;
    return $this;
  }
  
  public function getWebshopAddr() {
    return $this->webshopAddr;
  }
  
  public function setWebshopAddr(string $webshopAddr) {
    $this->webshopAddr = $webshopAddr;
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
  
  public function getInitialAmount() {
    return $this->initalAmount;
  }
  
  public function setInitialAmount(float $amount) {
    $this->initalAmount = $amount;
    return $this;
  }
  
  public function getCurrentAmount() {
    return $this->currentAmount;
  }
  
  public function setCurrentAmount(float $amount) {
    $this->currentAmount = $amount;
    return $this;
  }
  
  public function getCreated() {
    return $this->created_at;
  }
  
  public function setCreated(string $created) {
    $this->created_at = $created;
    return $this;
  }
  
  public function getUpdated() {
    return $this->updated_at;
  }
  
  public function setUpdated(string $updated) {
    $this->updated_at = $updated;
    return $this;
  }
  
  public static function createFromArray(array $item) {
    $voucher = new self();
    foreach ($item as $key => $value) 
    {
      switch ($key)
      {
        case 'id':
          $voucher->setId($value);
        break;
        case 'amount':
          $voucher->setAmount($value);
        break;
        case 'webshopAddr':
          $voucher->setWebshopAddr($value);
        break;
        case 'nonce':
          $voucher->setNonce($value);
        break;
        case 'signature':
          $voucher->setSignature($value);
        break;
        case 'initalAmount':
          $voucher->setInitialAmount($value);
        case 'currentAmount':
          $voucher->setCurrentAmount($value);
        break;
        case 'created_at':
          $voucher->setCreated($value);
        break;
        case 'updated_at':
          $voucher->setUpdated($value);
        break;
      }
    }
    
    return $voucher;
  }
  
}