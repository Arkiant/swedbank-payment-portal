<?php

namespace SwedbankPaymentPortal;

use SwedbankPaymentPortal\SharedEntity\Authentication;

/**
 * Removes sensitive data from requests.
 */
class SensitiveDataCleanup
{
    /**
     * @const Placeholder for sensitive data.
     */
    const PLACEHOLDER = '*******';

    /**
     * @var Authentication
     */
    private $cleanAuthentication;

    /**
     * SensitiveDataCleanup constructor.
     */
    public function __construct()
    {
        $this->cleanAuthentication = new Authentication(self::PLACEHOLDER, self::PLACEHOLDER);
    }

    /**
     * Cleans up object authorization data.
     *
     * @param object $requestObject
     *
     * @return object
     */
    public function cleanUpRequest($requestObject)
    {
        $requestObject->setAuthentication($this->cleanAuthentication);

        return $requestObject;
    }

    /**
     * Cleans up xml string authorization data.
     *
     * @param string $xml
     *
     * @return string
     */
    public function cleanUpRequestXml($xml)
    {
        $xml = $this->replaceSensitiveEntry($xml, 'client', self::PLACEHOLDER);

        return $this->replaceSensitiveEntry($xml, 'password', self::PLACEHOLDER);
    }

    /**
     * Replaces string xml value in xml data.
     *
     * @param string $subject
     * @param string $fieldName
     * @param string $newValue
     *
     * @return string
     */
    private function replaceSensitiveEntry($subject, $fieldName, $newValue)
    {
        return preg_replace("/(<{$fieldName}>)(.*)(<\/{$fieldName}>)/", "$1{$newValue}$3", $subject);
    }
}
