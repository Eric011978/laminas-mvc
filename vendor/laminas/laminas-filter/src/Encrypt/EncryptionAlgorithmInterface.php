<?php

declare(strict_types=1);

namespace Laminas\Filter\Encrypt;

/**
 * Encryption interface
 */
interface EncryptionAlgorithmInterface
{
    /**
     * Encrypts $value with the defined settings
     *
     * @param  string $value Data to encrypt
     * @return string The encrypted data
     */
    public function encrypt($value);

    /**
     * Decrypts $value with the defined settings
     *
     * @param  string $value Data to decrypt
     * @return string The decrypted data
     */
    public function decrypt($value);

    /**
     * Return the adapter name
     *
     * @return string
     */
    public function toString();
}
