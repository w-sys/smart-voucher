<?php

namespace SmartVoucher;

interface RedeemVoucherInterface {
  public function getWebshopAddr();
  
  public function setWebshopAddr(string $addr);
  
  public function getAmount();
  public function setAmount(float $amount);
  
  public function getId();
  public function setId(int $id);
  
  public function getNonce();
  public function setNonce(int $nonce);
  
  
  public function getSignature();
  
  public function setSignature(string $signature);
  
}