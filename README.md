# Calc API Sig (calc-api-sig) #

Helper class to simplify generating a signature for APIs that use HMAC, such as
APIs using [ApiAxle](http://apiaxle.com/).

This uses a given shared secret to calculate a signature for a given API key 
prepended with the current unix timestamp. A different timestamp can optionally
be specified, as can a particular hashing algorithm if something other than the
default (SHA1) is desired. 


## Example Usages ##


**Basic**

The expected common usage:

    $signature = \CalcApiSig\HmacSigner::CalcApiSig('api key', 'shared secret');


**Advanced**

A more rare usage, in which the time used is 2 seconds in the future (perhaps 
to compensate for excessive latency) and the desired hashing algorithm is MD5:

    $signature = \CalcApiSig\HmacSigner::CalcApiSig(
        'api key',
        'shared secret',
        time() + 2,
        'md5'
    );

## License ##

Calc API Sig is licensed under the MIT license. See "LICENSE" for details.
