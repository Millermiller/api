<?php

namespace DoctrineProxies\__CG__\Scandinaver\User\Domain;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class Order extends \Scandinaver\User\Domain\Order implements \Doctrine\ORM\Proxy\Proxy
{
    /**
     * @var \Closure the callback responsible for loading properties in the proxy object. This callback is called with
     *      three parameters, being respectively the proxy object to be initialized, the method that triggered the
     *      initialization process and an array of ordered parameters that were passed to that method.
     *
     * @see \Doctrine\Common\Proxy\Proxy::__setInitializer
     */
    public $__initializer__;

    /**
     * @var \Closure the callback responsible of loading properties that need to be copied in the cloned object
     *
     * @see \Doctrine\Common\Proxy\Proxy::__setCloner
     */
    public $__cloner__;

    /**
     * @var boolean flag indicating if this object was already initialized
     *
     * @see \Doctrine\Common\Persistence\Proxy::__isInitialized
     */
    public $__isInitialized__ = false;

    /**
     * @var array<string, null> properties to be lazy loaded, indexed by property name
     */
    public static $lazyPropertiesNames = array (
);

    /**
     * @var array<string, mixed> default values of properties to be lazy loaded, with keys being the property names
     *
     * @see \Doctrine\Common\Proxy\Proxy::__getLazyProperties
     */
    public static $lazyPropertiesDefaults = array (
);



    public function __construct(?\Closure $initializer = null, ?\Closure $cloner = null)
    {

        $this->__initializer__ = $initializer;
        $this->__cloner__      = $cloner;
    }







    /**
     * 
     * @return array
     */
    public function __sleep()
    {
        if ($this->__isInitialized__) {
            return ['__isInitialized__', '' . "\0" . 'Scandinaver\\User\\Domain\\Order' . "\0" . 'id', '' . "\0" . 'Scandinaver\\User\\Domain\\Order' . "\0" . 'sum', '' . "\0" . 'Scandinaver\\User\\Domain\\Order' . "\0" . 'status', '' . "\0" . 'Scandinaver\\User\\Domain\\Order' . "\0" . 'notificationType', '' . "\0" . 'Scandinaver\\User\\Domain\\Order' . "\0" . 'datetime', '' . "\0" . 'Scandinaver\\User\\Domain\\Order' . "\0" . 'codepro', '' . "\0" . 'Scandinaver\\User\\Domain\\Order' . "\0" . 'sender', '' . "\0" . 'Scandinaver\\User\\Domain\\Order' . "\0" . 'sha1Hash', '' . "\0" . 'Scandinaver\\User\\Domain\\Order' . "\0" . 'label', '' . "\0" . 'Scandinaver\\User\\Domain\\Order' . "\0" . 'createdAt', '' . "\0" . 'Scandinaver\\User\\Domain\\Order' . "\0" . 'updatedAt', '' . "\0" . 'Scandinaver\\User\\Domain\\Order' . "\0" . 'deletedAt', '' . "\0" . 'Scandinaver\\User\\Domain\\Order' . "\0" . 'plan', '' . "\0" . 'Scandinaver\\User\\Domain\\Order' . "\0" . 'user'];
        }

        return ['__isInitialized__', '' . "\0" . 'Scandinaver\\User\\Domain\\Order' . "\0" . 'id', '' . "\0" . 'Scandinaver\\User\\Domain\\Order' . "\0" . 'sum', '' . "\0" . 'Scandinaver\\User\\Domain\\Order' . "\0" . 'status', '' . "\0" . 'Scandinaver\\User\\Domain\\Order' . "\0" . 'notificationType', '' . "\0" . 'Scandinaver\\User\\Domain\\Order' . "\0" . 'datetime', '' . "\0" . 'Scandinaver\\User\\Domain\\Order' . "\0" . 'codepro', '' . "\0" . 'Scandinaver\\User\\Domain\\Order' . "\0" . 'sender', '' . "\0" . 'Scandinaver\\User\\Domain\\Order' . "\0" . 'sha1Hash', '' . "\0" . 'Scandinaver\\User\\Domain\\Order' . "\0" . 'label', '' . "\0" . 'Scandinaver\\User\\Domain\\Order' . "\0" . 'createdAt', '' . "\0" . 'Scandinaver\\User\\Domain\\Order' . "\0" . 'updatedAt', '' . "\0" . 'Scandinaver\\User\\Domain\\Order' . "\0" . 'deletedAt', '' . "\0" . 'Scandinaver\\User\\Domain\\Order' . "\0" . 'plan', '' . "\0" . 'Scandinaver\\User\\Domain\\Order' . "\0" . 'user'];
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (Order $proxy) {
                $proxy->__setInitializer(null);
                $proxy->__setCloner(null);

                $existingProperties = get_object_vars($proxy);

                foreach ($proxy::$lazyPropertiesDefaults as $property => $defaultValue) {
                    if ( ! array_key_exists($property, $existingProperties)) {
                        $proxy->$property = $defaultValue;
                    }
                }
            };

        }
    }

    /**
     * 
     */
    public function __clone()
    {
        $this->__cloner__ && $this->__cloner__->__invoke($this, '__clone', []);
    }

    /**
     * Forces initialization of the proxy
     */
    public function __load()
    {
        $this->__initializer__ && $this->__initializer__->__invoke($this, '__load', []);
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __isInitialized()
    {
        return $this->__isInitialized__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitialized($initialized)
    {
        $this->__isInitialized__ = $initialized;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitializer(\Closure $initializer = null)
    {
        $this->__initializer__ = $initializer;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __getInitializer()
    {
        return $this->__initializer__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setCloner(\Closure $cloner = null)
    {
        $this->__cloner__ = $cloner;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific cloning logic
     */
    public function __getCloner()
    {
        return $this->__cloner__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     * @deprecated no longer in use - generated code now relies on internal components rather than generated public API
     * @static
     */
    public function __getLazyProperties()
    {
        return self::$lazyPropertiesDefaults;
    }

    
    /**
     * {@inheritDoc}
     */
    public function setUpdatedAt(?\DateTime $updatedAt): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setUpdatedAt', [$updatedAt]);

        parent::setUpdatedAt($updatedAt);
    }

    /**
     * {@inheritDoc}
     */
    public function getId(): int
    {
        if ($this->__isInitialized__ === false) {
            return (int)  parent::getId();
        }


        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getId', []);

        return parent::getId();
    }

    /**
     * {@inheritDoc}
     */
    public function getSum(): int
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getSum', []);

        return parent::getSum();
    }

    /**
     * {@inheritDoc}
     */
    public function setSum(int $sum): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setSum', [$sum]);

        parent::setSum($sum);
    }

    /**
     * {@inheritDoc}
     */
    public function getStatus(): ?string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getStatus', []);

        return parent::getStatus();
    }

    /**
     * {@inheritDoc}
     */
    public function setStatus(?string $status): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setStatus', [$status]);

        parent::setStatus($status);
    }

    /**
     * {@inheritDoc}
     */
    public function getNotificationType(): ?string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getNotificationType', []);

        return parent::getNotificationType();
    }

    /**
     * {@inheritDoc}
     */
    public function setNotificationType(?string $notificationType): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setNotificationType', [$notificationType]);

        parent::setNotificationType($notificationType);
    }

    /**
     * {@inheritDoc}
     */
    public function getDatetime(): ?string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getDatetime', []);

        return parent::getDatetime();
    }

    /**
     * {@inheritDoc}
     */
    public function setDatetime(?string $datetime): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setDatetime', [$datetime]);

        parent::setDatetime($datetime);
    }

    /**
     * {@inheritDoc}
     */
    public function getCodepro(): ?string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCodepro', []);

        return parent::getCodepro();
    }

    /**
     * {@inheritDoc}
     */
    public function setCodepro(?string $codepro): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCodepro', [$codepro]);

        parent::setCodepro($codepro);
    }

    /**
     * {@inheritDoc}
     */
    public function getSender(): ?string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getSender', []);

        return parent::getSender();
    }

    /**
     * {@inheritDoc}
     */
    public function setSender(?string $sender): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setSender', [$sender]);

        parent::setSender($sender);
    }

    /**
     * {@inheritDoc}
     */
    public function getSha1Hash(): ?string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getSha1Hash', []);

        return parent::getSha1Hash();
    }

    /**
     * {@inheritDoc}
     */
    public function setSha1Hash(?string $sha1Hash): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setSha1Hash', [$sha1Hash]);

        parent::setSha1Hash($sha1Hash);
    }

    /**
     * {@inheritDoc}
     */
    public function getLabel(): ?string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getLabel', []);

        return parent::getLabel();
    }

    /**
     * {@inheritDoc}
     */
    public function setLabel(?string $label): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setLabel', [$label]);

        parent::setLabel($label);
    }

    /**
     * {@inheritDoc}
     */
    public function getCreatedAt(): ?\DateTime
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCreatedAt', []);

        return parent::getCreatedAt();
    }

    /**
     * {@inheritDoc}
     */
    public function getPlan(): \Scandinaver\User\Domain\Plan
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPlan', []);

        return parent::getPlan();
    }

    /**
     * {@inheritDoc}
     */
    public function setPlan(\Scandinaver\User\Domain\Plan $plan): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setPlan', [$plan]);

        parent::setPlan($plan);
    }

    /**
     * {@inheritDoc}
     */
    public function getUser(): \Scandinaver\User\Domain\User
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getUser', []);

        return parent::getUser();
    }

    /**
     * {@inheritDoc}
     */
    public function setUser(\Scandinaver\User\Domain\User $user): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setUser', [$user]);

        parent::setUser($user);
    }

}
