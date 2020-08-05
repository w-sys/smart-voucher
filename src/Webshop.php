<?php

namespace SmartVoucher;


class Webshop implements WebshopInterface {

 protected $id;

 protected $wallet;

 protected $website;

 protected $publishers;

 protected $subscribers;

 protected $vouchers;

 protected $nonce;
 
 protected $email;

  public function __construct() {
    $this->publishers = [];
    $this->subscribers = [];
    $this->vouchers = [];
  }
  
  public function getId() {
    return $this->id;
  }

  public function setId(int $id) {
    $this->id = $id;
    return $this;
  }

  public function getWallet() {
    return $this->wallet;
  }

  public function setWallet(string $wallet) {
    $this->wallet = $wallet;
    return $this;
  }

  public function getWebsite() {
    return $this->website;
  }

  public function setWebsite(string $website = '') {
    $this->website = $website;
    return $this;
  }
  
  public function getEmail() {
    return $this->email;
  }
  
  public function setEmail(string $email) {
    $this->email = $email;
    return $this;
  }

  public function getPublishers() {
    return $this->publishers;
  }

  public function setPublishers(array $publishers = []) {
    $this->publishers = $publishers;
    return $this;
  }

  public function getSubscribers() {
   return $this->subscribers;
  }

  public function setSubscribers(array $subscribers = []) {
    $this->subscribers = $subscribers;
    return $this;
  }

  public function getVouchers() {
    return $this->vouchers;
  }


  public function setVouchers(array $vouchers = []) {
    $this->vouchers = $vouchers;
    return $this;
  }


  public function addVoucher(VoucherInterface $voucher) {
    $this->vouchers[] = $voucher;
    return $this;
  }
  
  public function addSubscriber(WebshopInterface $subscriber) {
    $this->subscribers[] = $subscriber;
    return $this;
  }
  
  public function addPublisher(WebshopInterface $publisher) {
    $this->publishers[] = $publisher;
    return $this;
  }

  public function getVouchersCount() {
    return $this->vouchersCount;
  }

  public function setVouchersCount(int $count) {
    $this->vouchersCount = $count;
  }
  
  public function getNonce() {
    return $this->nonce;
  }
  
  public function setNonce(int $nonce) {
    $this->nonce = $nonce;
    return $this;
  }

  public static function createFromArray(array $item) {
    $webshop = new self();
    foreach ($item as $key => $value) 
    {
      switch ($key) 
      {
        case 'id':
         $webshop->setId($value);
        break;
        case 'wallet':
          $webshop->setWallet($value);
        break;
        case 'website':
          $webshop->setWebsite($value);
        break;
        case 'nonce':
          $webshop->setNonce($value);
        break;
        case 'vouchersCount':
          $webshop->setVouchers($value);
        break;
      }
    }
    
    if (!empty($item['publishers'])) 
    {
      foreach ($item['publishers'] as $publisher_item) 
      {
        $this->addPublisher(Webshop::createFromArray($publisher_item));
      }
    }
    
    if (!empty($item['subscribers'])) 
    {
      foreach ($item['subscribers'] as $subscriber_item) 
      {
        $this->addSubscriber(Webshop::createFromArray($subscriber_item));
      }
    }
    
    if (!empty($item['vouchers'])) {
      foreach ($item['vouchers'] as $voucher_item) 
      {
        $this->addVoucher(Voucher::createFromArray($voucher_item));
      }
    }
    
    return $webshop;
  }
  
}

