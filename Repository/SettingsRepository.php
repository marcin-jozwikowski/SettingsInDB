<?php

namespace MarcinJozwikowski\SettingsInDBBundle\Repository;

use Doctrine\ORM\EntityRepository;
use MarcinJozwikowski\SettingsInDBBundle\Entity\Setting;

class SettingsRepository extends EntityRepository
{
    /**
     * @return Setting[]|array
     */
    public function getAll(){
        return $this->findAll();
    }

    /**
     * @param $key
     * @return null|Setting
     */
    public function getOne($key){
        return $this->findOneBy(['key'=>$key]);
    }
}
