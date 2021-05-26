<?php

namespace Epmnzava\MpesaTanzania;

use Epmnzava\MpesaTanzania\Api\APIContext;
use Epmnzava\MpesaTanzania\Api\APIMethodType;
use Epmnzava\MpesaTanzania\Api\APIRequest;
use Exception;

class MpesaTanzania
{

    public $api_key;
    public $public_key;
    public $environment;
    public $context;

    public function __construct($env, $api_key, $public_key)
    {
        $this->environment = $env;
        $this->api_key = $api_key;
        $this->public_key = $public_key;
    }


    //Initialize payment
    public function makePayment($amount, $msisdn, $transactionid, $thirdpartyconversationID, $transactionDescription)
    {

        $this->initializeContext(
            $amount,
            $msisdn,
            $transactionid,
            $thirdpartyconversationID,
            $transactionDescription
        );

        sleep(30);

        $request = new APIRequest($this->context);
        // Do the API call and put result in a response packet
        $response = null;

        try {
            $response = $request->execute();
        } catch (Exception $e) {
            echo 'Call failed: ' . $e->getMessage() . '<br>';
        }

        if ($response->get_body() == null) {
            throw new Exception('API call failed to get result. Please check.');
        }


        return $response;
    }




    public function initializeContext(
        $amount,
        $msisdn,
        $transactionid,
        $thirdpartyconversationID,
        $transactionDescription
    ) {
        $this->context = new APIContext();
        $this->context->set_api_key($this->api_key);
        $this->context->set_public_key($this->public_key);
        $this->context->set_ssl(true);
        $this->context->set_method_type(APIMethodType::POST);
        $this->context->set_address(config("mpesa-tanzania.base_endpoint"));
        $this->context->set_port(443);

        if ($this->environment == "sandbox")
            $this->context->set_path('/sandbox/ipg/v2/vodacomTZN/c2bPayment/singleStage/');
        else
            $this->context->set_path('/openapi/ipg/v2/vodacomTZN/c2bPayment/singleStage/');

        $this->context->add_header('Origin', '*');
        $this->context->add_parameter('input_Amount',  $amount);
        $this->context->add_parameter('input_Country', config("mpesa-tanzania.country"));
        $this->context->add_parameter('input_Currency', config("mpesa-tanzania.currency"));
        $this->context->add_parameter('input_CustomerMSISDN', $msisdn);
        $this->context->add_parameter('input_ServiceProviderCode', '000000');
        $this->context->add_parameter('input_ThirdPartyConversationID', $thirdpartyconversationID);
        $this->context->add_parameter('input_TransactionReference', $transactionid);
        $this->context->add_parameter('input_PurchasedItemsDesc', $transactionDescription);
    }
}
