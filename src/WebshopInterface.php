<?php

namespace SmartVoucher;

use Partners;

interface WebshopInterface {

 public function getId();

 public function getWallet();

 public function getWebsite();

 public function getPublishers();

 public function getSubscribers();

 public function getVouchers();
 
 public function getNonce();

 public function getVouchersCount();
 
 public function setId(int $id);
 
 public function setWebsite(string $website = "");
 
 public function getEmail();
 
 public function setEmail(string $email);

 public function setPublishers(array $publishers = []);

 public function setSubscribers(array $subscribers = []);

 public function setVouchers(array $vouchers = []);

 public function setNonce(int $nonce);

 public function setVouchersCount(int $count);

 public function addVoucher(VoucherInterface $voucher);

 public function addPublisher(WebshopInterface $publisher);

 public function addSubscriber(WebshopInterface $subscriber);
 
}
