<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Config;

class PayPalEscrowService
{
    private $client;
    private $baseUri;
    private $clientId;
    private $secret;

    public function __construct()
    {
        $this->client = new Client();
        $this->baseUri = Config::get('paypal.settings.mode') == 'sandbox' ? 'https://api.sandbox.paypal.com' : 'https://api.paypal.com';
        $this->clientId = Config::get('paypal.client_id');
        $this->secret = Config::get('paypal.secret');
    }

    private function getAccessToken()
    {
        $response = $this->client->request('POST', "{$this->baseUri}/v1/oauth2/token", [
            'headers' => [
                'Accept' => 'application/json',
                'Accept-Language' => 'en_US',
            ],
            'auth' => [$this->clientId, $this->secret],
            'form_params' => [
                'grant_type' => 'client_credentials',
            ],
        ]);

        $data = json_decode($response->getBody(), true);
        return $data['access_token'];
    }

    public function createOrder($amount)
    {
        $accessToken = $this->getAccessToken();
        $response = $this->client->request('POST', "{$this->baseUri}/v2/checkout/orders", [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => "Bearer $accessToken",
            ],
            'json' => [
                'intent' => 'AUTHORIZE',
                'purchase_units' => [
                    [
                        'amount' => [
                            'currency_code' => 'USD',
                            'value' => $amount,
                        ],
                    ],
                ],
                'application_context' => [
                    'return_url' => url('status'),
                    'cancel_url' => url('status'),
                ],
            ],
        ]);

        return json_decode($response->getBody(), true);
    }

    public function capturePayment($orderId)
    {
        $accessToken = $this->getAccessToken();
        $response = $this->client->request('POST', "{$this->baseUri}/v2/checkout/orders/{$orderId}/capture", [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => "Bearer $accessToken",
            ],
        ]);

        return json_decode($response->getBody(), true);
    }

    public function verifyEmail($email)
    {
        $accessToken = $this->getAccessToken();
        try {
            $response = $this->client->request('POST', "{$this->baseUri}/v2/invoicing/invoices", [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Authorization' => "Bearer $accessToken",
                ],
                'json' => [
                    'detail' => [
                        'invoice_number' => uniqid(),
                        'currency_code' => 'USD',
                    ],
                    'invoicer' => [
                        'email_address' => 'your_paypal_email@example.com',
                    ],
                    'primary_recipients' => [
                        [
                            'billing_info' => [
                                'email_address' => $email,
                            ],
                        ],
                    ],
                ],
            ]);
            return true; // Email exists and invoice creation was successful.
        } catch (\Exception $ex) {
            $responseBody = $ex->getResponse()->getBody()->getContents();
            $responseArray = json_decode($responseBody, true);
            if (isset($responseArray['name']) && $responseArray['name'] == 'INVALID_RESOURCE_ID') {
                return false; // Email does not correspond to a PayPal account.
            }
            throw $ex; // Handle other exceptions accordingly.
        }
    }
}
