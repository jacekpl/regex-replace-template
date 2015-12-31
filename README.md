# regex-replace-template

Usage:
```
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

echo $rr->execute($str, $data1);
//Hello John Smith, this is a message sent to john@google.com, we'll be in touch in writing at Your Postal Address

echo $rr->execute($str, $data2)
//Hello Customer, this is a message sent to steve@google.com, we'll be in touch in writing at 123 Berkshire Road, London
```
