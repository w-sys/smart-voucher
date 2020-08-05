<?php

namespace SmartVoucher;

use GuzzleHttp\Client as GuzzleСlient;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ConnectException;

class Client {
  
  private $client;
  const BASE_URL = 'https://pumacy-vm2.westeurope.cloudapp.azure.com';
  
  public function __construct(array $params=[]) 
  {
    
    $params['client'] = isset($params['client']) ? $params['client'] : [];
    
    $client_params['base_uri'] = self::BASE_URL + $params['client'];
    $this->client = new GuzzleСlient($client_params);
  }
  
  public function getWebshops() 
  {
    try {
     $response = $this->client->request('GET', '/webshops');
     $webshops = [];
     foreach(json_decode($response->getBody()->getContents()) as $item) {
      $webshops[] = Webshop::createFromArray($item);
     }
     
     return $webshops;

    } catch (ConnectException $e | RequestException $e) {
      return throw new $e;
    }
    
    return  [];
  }
  
  public function getWebshop($id) {
    try {
      $response = $this->client->request('GET', '/webshops/' . $id);
      return Webshop::createFromArray(json_decode($response->getBody()->getContents(), true));
    } catch (ConnectException $e | RequestException $e) {
      return throw new $e;
    }
  }
  
  public function registerWebshop(WebshopInterface $webshop) {
    try {
      $response = $this->client->request('POST', '/webshops', [
        'wallet' => $webshop->getWallet(),
        'website' => $webshop->getWebsite(),
        'email' => $webshop->getEmail(),
      ]);
    } catch (ConnectException $e | RequestException $e) {
      return throw new $e;
    }
  }
  
  public function addPartner(WebshopInterface $requester, WebshopInterface $requestee) {
    try {
      $response = $this->client->request('POST', '/webshops/addPartner', [
        'webshopAddr' => $requester->getWallet(),
        'partnerAddr' => $requestee->getWallet(),
        'nonce' => $requester->getNonce(),
        'signature' => $requester->getSignature(),
      ]);
    } catch (ConnectException $e | RequestException $e) {
      return throw new $e;
    }
  }
  
  public function removePartner(WebshopInterface $requester, WebshopInterface $requestee) {
    try {
      $response = $this->client->request('POST', '/webshops/removePartner', [
        'webshopAddr' => $requester->getWallet(),
        'partnerAddr' => $requestee->getWallet(),
        'nonce' => $requester->getNonce(),
        'signature' => $requester->getSignature(),
      ]);
    } catch (ConnectException $e | RequestException $e) {
      return throw new $e;
    }
  }
  
  
  public function redeemVoucher(RedeemVoucherInterface $voucher) {
    try {
      $response = $this->client->request('POST', '/vouchers/redeem', [
        'webshopAddr' => $requester->getWebshopAddr(),
        'amount' => $voucher->getAmount(),
        'voucherId' => $voucher->getId(),
        'nonce' => $voucher->getNonce(),
        'signature' => $voucher->getSignature(),
      ]);
    } catch (ConnectException $e | RequestException $e) {
      return throw new $e;
    }
  }
  
  public function createVoucher(VoucherInterface $voucher) {
    try {
      $response = $this->client->request('POST', '/vouchers', [
        'webshopAddr' => $requester->getWebshopAddr(),
        'amount' => $voucher->getAmount(),
        'nonce' => $voucher->getNonce(),
        'signature' => $voucher->getSignature(),
      ]);
      
    } catch (ConnectException $e | RequestException $e) {
      return throw new $e;
    }
  }
  
  public function validateVoucherCode(string $code) {
    try {
      $response = $this->client->request('GET', '/vouchers', [
        'code' => $code,
      ]);
      
    } catch (ConnectException $e | RequestException $e) {
      return throw new $e;
    }
  }
}