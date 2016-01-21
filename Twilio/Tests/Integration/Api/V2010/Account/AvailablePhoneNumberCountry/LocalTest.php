<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Tests\Integration\Api\V2010\Account\AvailablePhoneNumberCountry;

use Twilio\Exceptions\DeserializeException;
use Twilio\Exceptions\TwilioException;
use Twilio\Http\Response;
use Twilio\Tests\HolodeckTestCase;
use Twilio\Tests\Request;

class LocalTest extends HolodeckTestCase {
    public function testReadRequest() {
        $this->holodeck->mock(new Response(500, ''));
        
        try {
            $this->twilio->api->v2010->accounts("ACaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa")
                                     ->availablePhoneNumbers("US")
                                     ->local->read();
        } catch (DeserializeException $e) {}
          catch (TwilioException $e) {}
        
        $this->assertTrue($this->holodeck->hasRequest(new Request(
            'get',
            'https://api.twilio.com/2010-04-01/Accounts/ACaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/AvailablePhoneNumbers/US/Local.json'
        )));
    }

    public function testReadFullResponse() {
        $this->holodeck->mock(new Response(
            200,
            '
            {
                "available_phone_numbers": [
                    {
                        "address_requirements": "none",
                        "beta": false,
                        "capabilities": {
                            "MMS": true,
                            "SMS": false,
                            "voice": true
                        },
                        "friendly_name": "(808) 925-1571",
                        "iso_country": "US",
                        "lata": "834",
                        "latitude": "19.720000",
                        "longitude": "-155.090000",
                        "phone_number": "+18089251571",
                        "postal_code": "96720",
                        "rate_center": "HILO",
                        "region": "HI"
                    }
                ],
                "uri": "/2010-04-01/Accounts/ACaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/AvailablePhoneNumbers/US/Local.json?PageSize=1"
            }
            '
        ));
        
        $actual = $this->twilio->api->v2010->accounts("ACaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa")
                                           ->availablePhoneNumbers("US")
                                           ->local->read();
        
        $this->assertNotNull($actual);
    }

    public function testReadEmptyResponse() {
        $this->holodeck->mock(new Response(
            200,
            '
            {
                "available_phone_numbers": [],
                "uri": "/2010-04-01/Accounts/ACaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/AvailablePhoneNumbers/US/Local.json?PageSize=1"
            }
            '
        ));
        
        $actual = $this->twilio->api->v2010->accounts("ACaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa")
                                           ->availablePhoneNumbers("US")
                                           ->local->read();
        
        $this->assertNotNull($actual);
    }
}