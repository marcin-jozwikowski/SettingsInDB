<?php

namespace MarcinJozwikowski\SettingsInDBBundle\Services;


use Doctrine\ORM\EntityManager;
use MarcinJozwikowski\SettingsInDBBundle\DependencyInjection\Configuration;
use MarcinJozwikowski\SettingsInDBBundle\Entity\Setting;
use Symfony\Component\DependencyInjection\ContainerInterface;

class SettingsInDbService
{
    /** @var EntityManager */
    protected $entityManager;
    /** @var  Boolean */
    private $__returnNullOnNotFound;
    /** @var  Boolean */
    private $__selectAllAtFirst;
    /** @var  Boolean */
    private $__allowInserts;

    private $allValues = null;

    public function __construct(ContainerInterface $container, EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->__allowInserts = $container->getParameter(Configuration::CONFIG_ROOT . '.' . Configuration::ALLOW_INSERTS);
        $this->__selectAllAtFirst = $container->getParameter(Configuration::CONFIG_ROOT . '.' . Configuration::READ_ALL);
        $this->__returnNullOnNotFound = $container->getParameter(Configuration::CONFIG_ROOT . '.' . Configuration::RETURN_NULL);
    }

    /**
     * @param $key
     * @param null $default
     * @param null $allowInserts
     * @return null|string
     * @throws \Exception
     */
    public function read($key, $default = null, $allowInserts = null)
    {
        $value = $this->getValue($key);
        if (is_null($value)) {
            // key wasn't retrieved
            if (func_num_args() > 1) {
                //second argument present - default value
                if ($allowInserts !== false && $this->__allowInserts !== false) {
                    $this->insertNewValue($key, $default);
                }
                return $default;
            } else {
                if ($this->__returnNullOnNotFound) {
                    return null;
                } else {
                    throw new \Exception(sprintf("No setting entry found for key '%s'", $key));
                }
            }
        } else {
            return $value;
        }
    }

    /**
     * @param $key
     * @return null|string
     */
    private function getValue($key)
    {
        if ($this->__selectAllAtFirst) {
            $this->prepareAllValues();
            return isset($this->allValues[$key]) ? $this->allValues[$key] : null;
        } else {
            $val = $this->getRepo()->getOne($key);
            return is_null($val) ? $val : $val->getValue();
        }
    }

    /**
     * @return \MarcinJozwikowski\SettingsInDBBundle\Repository\SettingsRepository
     */
    private function getRepo()
    {
        return $this->entityManager->getRepository("SettingsInDBBundle:Setting");
    }

    private function prepareAllValues()
    {
        if (is_null($this->allValues)) {
            $all = $this->getRepo()->getAll();
            foreach ($all as $oneSetting) {
                $this->allValues[$oneSetting->getKey()] = $oneSetting->getValue();
            }
        }
    }

    private function insertNewValue($key, $value)
    {
        $newSetting = new Setting();
        $newSetting->setKey($key);
        $newSetting->setValue($value);

        $this->entityManager->persist($newSetting);
        $this->entityManager->flush();
    }
}