<?php
/**
 * Created by PhpStorm.
 * User: Marcin
 * Date: 2015-10-31
 * Time: 20:25
 */

namespace MarcinJozwikowski\SettingsInDBBundle\Services;


use Doctrine\ORM\EntityManager;
use MarcinJozwikowski\SettingsInDBBundle\DependencyInjection\Configuration;
use Symfony\Component\DependencyInjection\ContainerInterface;

class SettingsInDbService {
    /** @var EntityManager  */
    protected $entityManager;
    /** @var  Boolean */
    protected $returnNullOnNotFound;
    /** @var  Boolean */
    protected $allowInserts;

    public function __construct(ContainerInterface $container, EntityManager $entityManager){
        $this->entityManager = $entityManager;
        $this->allowInserts = $container->getParameter(Configuration::CONFIG_ROOT.'.'.Configuration::ALLOW_INSERTS);
        $this->returnNullOnNotFound = $container->getParameter(Configuration::CONFIG_ROOT.'.'.Configuration::RETURN_NULL);
    }

    public function read($key, $default = null, $allowInserts = null){
        die('key');
    }
}