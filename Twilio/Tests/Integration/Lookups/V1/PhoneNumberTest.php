<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Tests\Integration\Lookups\V1;

use Twilio\Exceptions\DeserializeException;
use Twilio\Exceptions\TwilioException;
use Twilio\Http\Response;
use Twilio\Tests\HolodeckTestCase;
use Twilio\Tests\Request;

class PhoneNumberTest extends HolodeckTestCase {
    public function testFetchRequest() {
        $this->holodeck->mock(new Response(500, ''));
        
        try {
            $this->twilio->lookups->v1->phoneNumbers("+987654321")->fetch();
        } catch (DeserializeException $e) {}
          catch (TwilioException $e) {}
        
        $this->assertTrue($this->holodeck->hasRequest(new Request(
            'get',
            'https://lookups.twilio.com/v1/PhoneNumbers/+987654321'
        )));
    }

    public function testFetchResponse() {
        $this->holodeck->mock(new Response(
            200,
            '
            {
                "carrier": {
                    "error_code": null,
                    "mobile_country_code": "310",
                    "mobile_network_code": "456",
                    "name": "verizon",
                    "type": "mobile"
                },
                "country_code": "US",
                "national_format": "(510) 867-5309",
                "phone_number": "+15108675309",
                "url": "https://lookups.twilio.com/v1/PhoneNumbers/phone_number"
            }
            '
        ));
        
        $actual = $this->twilio->lookups->v1->phoneNumbers("+987654321")->fetch();
        
        $this->assertNotNull($actual);
    }
}