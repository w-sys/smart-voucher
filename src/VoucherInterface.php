<?php

namespace SmartVoucher;


interface Voucher {
 
 public function getId();

 public function setId(int $id);

 public function getAmount();

 public function setAmount(float $amount);


 public function getWebshopAddr();

 public function setWebshopAddr(string $address);


 public function getNonce();

 public function setNonce(int $nonce);

 public function getSignature();

 public function setSignature(string $signature);
 
 public function getCreated();
 
 public function setCreated(string $created);
 
 public function getUpdated();
 
 public function setUpdated(string $updated);

 public function getInitialAmount();
 
 public function setInitialAmount(float $amount);
 
 public function getCurrentAmount();
 
 public function setCurrentAmount(float $amount);
 
}
