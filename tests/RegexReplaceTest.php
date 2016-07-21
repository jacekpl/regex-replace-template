<?php

class RegexReplaceTest extends PHPUnit_Framework_TestCase
{
    public function testRegexReplace()
    {
        $rr = new RegexReplace();
        $str = "Hello {name,fallback=Customer}, this is a message sent to {email}, we'll be in touch in writing at {address,fallback=Your Postal Address}";

        $data1 = array(
            'name' => "John Smith",
            'email' => "john@google.com",
            'address' => NULL,
        );

        $data2 = array(
            'name' => NULL,
            'email' => "steve@google.com",
            'address' => "123 Berkshire Road, London",
        );

        $result1 = "Hello John Smith, this is a message sent to john@google.com, we'll be in touch in writing at Your Postal Address";
        $result2 = "Hello Customer, this is a message sent to steve@google.com, we'll be in touch in writing at 123 Berkshire Road, London";

        $this->assertEquals($result1, $rr->execute($str, $data1));
        $this->assertEquals($result2, $rr->execute($str, $data2));
    }

    public function testGetVariables()
    {
        $rr = new RegexReplace();
        $str = $str = "Hello {name,fallback=Customer}, this is a message sent to {email}, we'll be in touch in writing at {address,fallback=Your Postal Address}";

        $result = [
            ['variable' => 'name', 'fallback' => 'Customer'],
            ['variable' => 'email', 'fallback' => null],
            ['variable' => 'address', 'fallback' => 'Your Postal Address'],
        ];

        $this->assertEquals($result, $rr->variables($str));
    }
}
