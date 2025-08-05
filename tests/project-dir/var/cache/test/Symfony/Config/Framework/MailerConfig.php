<?php

namespace Symfony\Config\Framework;

require_once __DIR__.\DIRECTORY_SEPARATOR.'Mailer'.\DIRECTORY_SEPARATOR.'EnvelopeConfig.php';
require_once __DIR__.\DIRECTORY_SEPARATOR.'Mailer'.\DIRECTORY_SEPARATOR.'HeaderConfig.php';
require_once __DIR__.\DIRECTORY_SEPARATOR.'Mailer'.\DIRECTORY_SEPARATOR.'DkimSignerConfig.php';
require_once __DIR__.\DIRECTORY_SEPARATOR.'Mailer'.\DIRECTORY_SEPARATOR.'SmimeSignerConfig.php';
require_once __DIR__.\DIRECTORY_SEPARATOR.'Mailer'.\DIRECTORY_SEPARATOR.'SmimeEncrypterConfig.php';

use Symfony\Component\Config\Loader\ParamConfigurator;
use Symfony\Component\Config\Definition\Exception\InvalidConfigurationException;

/**
 * This class is automatically generated to help in creating a config.
 */
class MailerConfig 
{
    private $enabled;
    private $messageBus;
    private $dsn;
    private $transports;
    private $envelope;
    private $headers;
    private $dkimSigner;
    private $smimeSigner;
    private $smimeEncrypter;
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
     * The message bus to use. Defaults to the default bus if the Messenger component is installed.
     * @default null
     * @param ParamConfigurator|mixed $value
     * @return $this
     */
    public function messageBus($value): static
    {
        $this->_usedProperties['messageBus'] = true;
        $this->messageBus = $value;

        return $this;
    }

    /**
     * @default null
     * @param ParamConfigurator|mixed $value
     * @return $this
     */
    public function dsn($value): static
    {
        $this->_usedProperties['dsn'] = true;
        $this->dsn = $value;

        return $this;
    }

    /**
     * @return $this
     */
    public function transport(string $name, mixed $value): static
    {
        $this->_usedProperties['transports'] = true;
        $this->transports[$name] = $value;

        return $this;
    }

    /**
     * Mailer Envelope configuration
    */
    public function envelope(array $value = []): \Symfony\Config\Framework\Mailer\EnvelopeConfig
    {
        if (null === $this->envelope) {
            $this->_usedProperties['envelope'] = true;
            $this->envelope = new \Symfony\Config\Framework\Mailer\EnvelopeConfig($value);
        } elseif (0 < \func_num_args()) {
            throw new InvalidConfigurationException('The node created by "envelope()" has already been initialized. You cannot pass values the second time you call envelope().');
        }

        return $this->envelope;
    }

    /**
     * @template TValue of mixed
     * @param TValue $value
     * @return \Symfony\Config\Framework\Mailer\HeaderConfig|$this
     * @psalm-return (TValue is array ? \Symfony\Config\Framework\Mailer\HeaderConfig : static)
     */
    public function header(string $name, mixed $value = []): \Symfony\Config\Framework\Mailer\HeaderConfig|static
    {
        if (!\is_array($value)) {
            $this->_usedProperties['headers'] = true;
            $this->headers[$name] = $value;

            return $this;
        }

        if (!isset($this->headers[$name]) || !$this->headers[$name] instanceof \Symfony\Config\Framework\Mailer\HeaderConfig) {
            $this->_usedProperties['headers'] = true;
            $this->headers[$name] = new \Symfony\Config\Framework\Mailer\HeaderConfig($value);
        } elseif (1 < \func_num_args()) {
            throw new InvalidConfigurationException('The node created by "header()" has already been initialized. You cannot pass values the second time you call header().');
        }

        return $this->headers[$name];
    }

    /**
     * DKIM signer configuration
     * @default {"enabled":false,"key":"","domain":"","select":"","passphrase":"","options":[]}
    */
    public function dkimSigner(array $value = []): \Symfony\Config\Framework\Mailer\DkimSignerConfig
    {
        if (null === $this->dkimSigner) {
            $this->_usedProperties['dkimSigner'] = true;
            $this->dkimSigner = new \Symfony\Config\Framework\Mailer\DkimSignerConfig($value);
        } elseif (0 < \func_num_args()) {
            throw new InvalidConfigurationException('The node created by "dkimSigner()" has already been initialized. You cannot pass values the second time you call dkimSigner().');
        }

        return $this->dkimSigner;
    }

    /**
     * S/MIME signer configuration
     * @default {"enabled":false,"key":"","certificate":"","passphrase":null,"extra_certificates":null,"sign_options":null}
    */
    public function smimeSigner(array $value = []): \Symfony\Config\Framework\Mailer\SmimeSignerConfig
    {
        if (null === $this->smimeSigner) {
            $this->_usedProperties['smimeSigner'] = true;
            $this->smimeSigner = new \Symfony\Config\Framework\Mailer\SmimeSignerConfig($value);
        } elseif (0 < \func_num_args()) {
            throw new InvalidConfigurationException('The node created by "smimeSigner()" has already been initialized. You cannot pass values the second time you call smimeSigner().');
        }

        return $this->smimeSigner;
    }

    /**
     * S/MIME encrypter configuration
     * @default {"enabled":false,"repository":"","cipher":null}
    */
    public function smimeEncrypter(array $value = []): \Symfony\Config\Framework\Mailer\SmimeEncrypterConfig
    {
        if (null === $this->smimeEncrypter) {
            $this->_usedProperties['smimeEncrypter'] = true;
            $this->smimeEncrypter = new \Symfony\Config\Framework\Mailer\SmimeEncrypterConfig($value);
        } elseif (0 < \func_num_args()) {
            throw new InvalidConfigurationException('The node created by "smimeEncrypter()" has already been initialized. You cannot pass values the second time you call smimeEncrypter().');
        }

        return $this->smimeEncrypter;
    }

    public function __construct(array $value = [])
    {
        if (array_key_exists('enabled', $value)) {
            $this->_usedProperties['enabled'] = true;
            $this->enabled = $value['enabled'];
            unset($value['enabled']);
        }

        if (array_key_exists('message_bus', $value)) {
            $this->_usedProperties['messageBus'] = true;
            $this->messageBus = $value['message_bus'];
            unset($value['message_bus']);
        }

        if (array_key_exists('dsn', $value)) {
            $this->_usedProperties['dsn'] = true;
            $this->dsn = $value['dsn'];
            unset($value['dsn']);
        }

        if (array_key_exists('transports', $value)) {
            $this->_usedProperties['transports'] = true;
            $this->transports = $value['transports'];
            unset($value['transports']);
        }

        if (array_key_exists('envelope', $value)) {
            $this->_usedProperties['envelope'] = true;
            $this->envelope = new \Symfony\Config\Framework\Mailer\EnvelopeConfig($value['envelope']);
            unset($value['envelope']);
        }

        if (array_key_exists('headers', $value)) {
            $this->_usedProperties['headers'] = true;
            $this->headers = array_map(fn ($v) => \is_array($v) ? new \Symfony\Config\Framework\Mailer\HeaderConfig($v) : $v, $value['headers']);
            unset($value['headers']);
        }

        if (array_key_exists('dkim_signer', $value)) {
            $this->_usedProperties['dkimSigner'] = true;
            $this->dkimSigner = \is_array($value['dkim_signer']) ? new \Symfony\Config\Framework\Mailer\DkimSignerConfig($value['dkim_signer']) : $value['dkim_signer'];
            unset($value['dkim_signer']);
        }

        if (array_key_exists('smime_signer', $value)) {
            $this->_usedProperties['smimeSigner'] = true;
            $this->smimeSigner = \is_array($value['smime_signer']) ? new \Symfony\Config\Framework\Mailer\SmimeSignerConfig($value['smime_signer']) : $value['smime_signer'];
            unset($value['smime_signer']);
        }

        if (array_key_exists('smime_encrypter', $value)) {
            $this->_usedProperties['smimeEncrypter'] = true;
            $this->smimeEncrypter = \is_array($value['smime_encrypter']) ? new \Symfony\Config\Framework\Mailer\SmimeEncrypterConfig($value['smime_encrypter']) : $value['smime_encrypter'];
            unset($value['smime_encrypter']);
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
        if (isset($this->_usedProperties['messageBus'])) {
            $output['message_bus'] = $this->messageBus;
        }
        if (isset($this->_usedProperties['dsn'])) {
            $output['dsn'] = $this->dsn;
        }
        if (isset($this->_usedProperties['transports'])) {
            $output['transports'] = $this->transports;
        }
        if (isset($this->_usedProperties['envelope'])) {
            $output['envelope'] = $this->envelope->toArray();
        }
        if (isset($this->_usedProperties['headers'])) {
            $output['headers'] = array_map(fn ($v) => $v instanceof \Symfony\Config\Framework\Mailer\HeaderConfig ? $v->toArray() : $v, $this->headers);
        }
        if (isset($this->_usedProperties['dkimSigner'])) {
            $output['dkim_signer'] = $this->dkimSigner instanceof \Symfony\Config\Framework\Mailer\DkimSignerConfig ? $this->dkimSigner->toArray() : $this->dkimSigner;
        }
        if (isset($this->_usedProperties['smimeSigner'])) {
            $output['smime_signer'] = $this->smimeSigner instanceof \Symfony\Config\Framework\Mailer\SmimeSignerConfig ? $this->smimeSigner->toArray() : $this->smimeSigner;
        }
        if (isset($this->_usedProperties['smimeEncrypter'])) {
            $output['smime_encrypter'] = $this->smimeEncrypter instanceof \Symfony\Config\Framework\Mailer\SmimeEncrypterConfig ? $this->smimeEncrypter->toArray() : $this->smimeEncrypter;
        }

        return $output;
    }

}
