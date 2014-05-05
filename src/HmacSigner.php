<?php

namespace CalcApiSig;

/**
 * Helper class to simplify generating a signature for APIs that use HMAC, such
 * as APIs using ApiAxle.
 *
 * @author forevermatt
 */
class HmacSigner
{
    /**
     * Take a given API Key and and Shared Secret and calculate the API
     * Signature to use for the current (or optionally some other) unix
     * timestamp.
     * 
     * NOTE: If an unknown hashing algorithm is specified, hash_hmac seems to
     * trigger a PHP Warning. If this does not stop your code execution, then
     * this function will return null in response to the unknown algorithm.
     * 
     * @param string $apiKey The API Key.
     * @param string $sharedSecret The Shared Secret used for calculating a
     *     signature for calls to the API. 
     * @param int|null $time (Optional:) The unix timestamp to use. Defaults to
     *     null, in which case the current unix timestamp will be used.
     * @param string $algorithm (Optional:) The hashing algorithm to use. See
     *     the PHP hash_hmac function. Defaults to 'sha1'.
     * @return string|null The resulting signature, or null if we were unable to
     *     calculate the signature due to an unknown hashing algorithm having
     *     been specified.
     */
    public static function CalcApiSig(
        $apiKey,
        $sharedSecret,
        $time = null,
        $algorithm = 'sha1'
    ) {
        // If no unix timestamp was given, get the current one.
        if ($time === null) {
            $time = time();
        }
        
        // Calculate the signature.
        $apiSig = hash_hmac($algorithm, ($time . $apiKey), $sharedSecret);
        
        // If the specified hashing algorithm was unknown (but code execution
        // is proceeding)...
        if ($apiSig === false) {
            
            // Return null (meaning no data) to indicate that we were unable to
            // calculate the signature.
            return null;
        }
        
        // Otherwise, return the resulting signature.
        return $apiSig;
    }
}
