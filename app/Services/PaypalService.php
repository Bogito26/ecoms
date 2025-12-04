<?php

namespace App\Services;

use GuzzleHttp\Client;
use App\Models\Order;

class PayPalService
{
    private $client;
    private $clientId;
    private $secret;
    private $endpoint;

    public function __construct()
    {
        $this->client = new Client();
        $this->clientId = config('services.paypal.client_id');
        $this->secret = config('services.paypal.secret');
        $this->endpoint = config('services.paypal.sandbox')
            ? 'https://api-m.sandbox.paypal.com'
            : 'https://api-m.paypal.com';
    }

    private function getAccessToken()
    {
        $response = $this->client->post($this->endpoint . '/v1/oauth2/token', [
            'auth' => [$this->clientId, $this->secret],
            'form_params' => [
                'grant_type' => 'client_credentials',
            ]
        ]);

        $data = json_decode($response->getBody(), true);

        return $data['access_token'];
    }

    public function createPayment(Order $order)
    {
        $token = $this->getAccessToken();

        $response = $this->client->post($this->endpoint . '/v2/checkout/orders', [
            'headers' => [
                'Authorization' => "Bearer {$token}",
                'Content-Type'  => 'application/json'
            ],
            'json' => [
                'intent' => 'CAPTURE',
                'purchase_units' => [
                    [
                        'reference_id' => $order->id,
                        'amount' => [
                            'currency_code' => 'USD',
                            'value' => number_format($order->total, 2, '.', '')
                        ]
                    ]
                ],
                'application_context' => [
                    'return_url' => route('checkout.paypal.callback'),
                    'cancel_url' => route('checkout.index')
                ]
            ]
        ]);

        $result = json_decode($response->getBody(), true);

        foreach ($result['links'] as $link) {
            if ($link['rel'] === 'approve') {
                return $link['href']; // The PayPal checkout URL
            }
        }

        return url('/');
    }

    public function executePayment($request)
    {
        $token = $this->getAccessToken();

        $orderId = $request->query('token');

        $response = $this->client->post($this->endpoint . "/v2/checkout/orders/{$orderId}/capture", [
            'headers' => [
                'Authorization' => "Bearer {$token}",
                'Content-Type'  => 'application/json'
            ]
        ]);

        $result = json_decode($response->getBody(), true);

        return [
            'success'   => isset($result['status']) && $result['status'] === 'COMPLETED',
            'order_id'  => $result['purchase_units'][0]['reference_id'] ?? null,
        ];
    }
}
