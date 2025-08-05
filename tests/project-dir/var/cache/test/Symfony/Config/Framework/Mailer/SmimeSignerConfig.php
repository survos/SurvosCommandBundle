<?php

namespace Symfony\Config\Framework\Mailer;

use Symfony\Component\Config\Loader\ParamConfigurator;
use Symfony\Component\Config\Definition\Exception\InvalidConfigurationException;

/**
 * This class is automatically generated to help in creating a config.
 */
class SmimeSignerConfig 
{
    private $enabled;
    private $key;
    private $certificate;
    private $passphrase;
    private $extraCertificates;
    private $signOptions;
    private $_usedProperties = [];

    /**
     * @default false
     * @param ParamConfigurator|bool $value
     * @return $this
     */
    public function enabled($value): static
    {
        $this->_usedProperties['enabled'] = true;
        $this->enabled = $value;

        return $this;
    }

    /**
     * Path to key (in PEM format)
     * @param ParamConfigurator|mixed $value
     * @return $this
     */
    public function key($value): static
    {
        $this->_usedProperties['key'] = true;
        $this->key = $value;

        return $this;
    }

    /**
     * Path to certificate (in PEM format without the `file://` prefix)
     * @param ParamConfigurator|mixed $value
     * @return $this
     */
    public function certificate($value): static
    {
        $this->_usedProperties['certificate'] = true;
        $this->certificate = $value;

        return $this;
    }

    /**
     * The private key passphrase
     * @default null
     * @param ParamConfigurator|mixed $value
     * @return $this
     */
    public function passphrase($value): static
    {
        $this->_usedProperties['passphrase'] = true;
        $this->passphrase = $value;

        return $this;
    }

    /**
     * @default null
     * @param ParamConfigurator|mixed $value
     * @return $this
     */
    public function extraCertificates($value): static
    {
        $this->_usedProperties['extraCertificates'] = true;
        $this->extraCertificates = $value;

        return $this;
    }

    /**
     * @default null
     * @param ParamConfigurator|int $value
     * @return $this
     */
    public function signOptions($value): static
    {
        $this->_usedProperties['signOptions'] = true;
        $this->signOptions = $value;

        return $this;
    }

    public function __construct(array $value = [])
    {
        if (array_key_exists('enabled', $value)) {
            $this->_usedProperties['enabled'] = true;
            $this->enabled = $value['enabled'];
            unset($value['enabled']);
        }

        if (array_key_exists('key', $value)) {
            $this->_usedProperties['key'] = true;
            $this->key = $value['key'];
            unset($value['key']);
        }

        if (array_key_exists('certificate', $value)) {
            $this->_usedProperties['certificate'] = true;
            $this->certificate = $value['certificate'];
            unset($value['certificate']);
        }

        if (array_key_exists('passphrase', $value)) {
            $this->_usedProperties['passphrase'] = true;
            $this->passphrase = $value['passphrase'];
            unset($value['passphrase']);
        }

        if (array_key_exists('extra_certificates', $value)) {
            $this->_usedProperties['extraCertificates'] = true;
            $this->extraCertificates = $value['extra_certificates'];
            unset($value['extra_certificates']);
        }

        if (array_key_exists('sign_options', $value)) {
            $this->_usedProperties['signOptions'] = true;
            $this->signOptions = $value['sign_options'];
            unset($value['sign_options']);
        }

        if ([] !== $value) {
            throw new InvalidConfigurationException(sprintf('The following keys are not supported by "%s": ', __CLASS__).implode(', ', array_keys($value)));
        }
    }

    public function toArray(): array
    {
        $output = [];
        if (isset($this->_usedProperties['enabled'])) {
            $output['enabled'] = $this->enabled;
        }
        if (isset($this->_usedProperties['key'])) {
            $output['key'] = $this->key;
        }
        if (isset($this->_usedProperties['certificate'])) {
            $output['certificate'] = $this->certificate;
        }
        if (isset($this->_usedProperties['passphrase'])) {
            $output['passphrase'] = $this->passphrase;
        }
        if (isset($this->_usedProperties['extraCertificates'])) {
            $output['extra_certificates'] = $this->extraCertificates;
        }
        if (isset($this->_usedProperties['signOptions'])) {
            $output['sign_options'] = $this->signOptions;
        }

        return $output;
    }

}
