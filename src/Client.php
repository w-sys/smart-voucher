<?php

namespace SmartVoucher;

use GuzzleHttp\Client as GuzzleСlient;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ConnectException;

/**
 * class Client communication interface with real api
 */
class Client {
  
  /**
   * @see GuzzleHttp\Client
   */
  private $client;
  
  /**
   * api base url
   */
  const BASE_URL = 'https://pumacy-vm2.westeurope.cloudapp.azure.com';
  
  /**
   * you can pass additional params to guzzle client via 'client' key
   *
   */
  public function __construct(array $params=[]) 
  {
    
    $params['client'] = isset($params['client']) ? $params['client'] : [];
    $client_params = array_merge(['base_uri' => self::BASE_URL], $params['client']);
    $this->client = new GuzzleСlient($client_params);
  }
  
  /**
   * Retrieve all webshops
   * @returns array - array of WebshopInterface type
   */
  public function getWebshops() 
  {
    try {
     $response = $this->client->request('GET', '/webshops');
     $webshops = [];
     foreach(json_decode($response->getBody()->getContents(), true) as $item) {
      $webshops[] = Webshop::createFromArray($item);
     }
     return $webshops;
    } catch (ConnectException | RequestException $e) {
      throw new \Exception ($e->getMessage());
    }
    
    return  [];
  }
  
  /**
   * Retrieve webshop details
   * @param int $id
   * @return WebshopInterface
   */
  
  public function getWebshop($id) {
    try {
      $response = $this->client->request('GET', '/webshops/' . $id);
      return Webshop::createFromArray(json_decode($response->getBody()->getContents(), true));
    } catch (ConnectException | RequestException $e) {
      throw new \Exception ($e->getMessage());
    }
  }
  
  /**
   * Register webshop
   * @param WebshopInterface $webshop
   */
  public function registerWebshop(WebshopInterface $webshop) {
    try {
      $response = $this->client->request('POST', '/webshops', [
        'wallet' => $webshop->getWallet(),
        'website' => $webshop->getWebsite(),
        'email' => $webshop->getEmail(),
      ]);
    } catch (ConnectException | RequestException $e) {
      throw new \Exception($e->getMessage());
    }
  }
  
  /**
   * Add Partner
   * @param WebshopInterface $requester - webshop that want to add partner
   * @param WebshopInterface $requestee - webshop to add as partner
   * @return bool
   */
  public function addPartner(WebshopInterface $requester, WebshopInterface $requestee) {
    try {
      $response = $this->client->request('POST', '/webshops/addPartner', [
        'webshopAddr' => $requester->getWallet(),
        'partnerAddr' => $requestee->getWallet(),
        'nonce' => $requester->getNonce(),
        'signature' => $requester->getSignature(),
      ]);
    } catch (ConnectException | RequestException $e) {
      throw new \Exception($e->getMessage());
    }
    
    return false;
  }
  
  /**
   * Remove Partner
   * @param WebshopInterface $requester - webshop that want to remove partner
   * @param WebshopInterface $requestee - Partner webshop that will be removed
   * @return bool
   */
  public function removePartner(WebshopInterface $requester, WebshopInterface $requestee) {
    try {
      $response = $this->client->request('POST', '/webshops/removePartner', [
        'webshopAddr' => $requester->getWallet(),
        'partnerAddr' => $requestee->getWallet(),
        'nonce' => $requester->getNonce(),
        'signature' => $requester->getSignature(),
      ]);
    } catch (ConnectException | RequestException $e) {
      throw new \Exception($e->getMessage());
    }
    
    return true;
  }
  
  /**
   * Redeem Voucher
   * @param RedeemVoucherInterface $voucher
   */
  public function redeemVoucher(RedeemVoucherInterface $voucher) {
    try {
      $response = $this->client->request('POST', '/vouchers/redeem', [
        'webshopAddr' => $requester->getWebshopAddr(),
        'amount' => $voucher->getAmount(),
        'voucherId' => $voucher->getId(),
        'nonce' => $voucher->getNonce(),
        'signature' => $voucher->getSignature(),
      ]);
    } catch (ConnectException | RequestException $e) {
      throw new \Exception($e->getMessage());
    }
  }
  
  /**
   * Create voucher
   * @param VoucherInterface $voucher
   * @return 
   */
  public function createVoucher(VoucherInterface $voucher) {
    try {
      $response = $this->client->request('POST', '/vouchers', [
        'webshopAddr' => $requester->getWebshopAddr(),
        'amount' => $voucher->getAmount(),
        'nonce' => $voucher->getNonce(),
        'signature' => $voucher->getSignature(),
      ]);
      
    } catch (ConnectException | RequestException $e) {
      throw new \Exception($e->getMessage());
    }
  }
  
  /**
   * Validate Voucher code
   * @param string $code
   * @return bool
   */
  public function validateVoucherCode(string $code) {
    try {
      $response = $this->client->request('GET', '/vouchers', [
        'code' => $code,
      ]);
      
    } catch (ConnectException | RequestException $e) {
      throw new \Exception($e->getMessage());
    }
    
    return false;
  }
}