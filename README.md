# SettingsInDB
A Symfony2 bundle that allows an easy key-value storage in DB

## Installation

1. Add as composer dependency:
  
  ```bash
  composer require marcin_jozwikowski/settings_in_db_bundle
  ```
2. Add in application kernel:
  
  ```php
  class AppKernel extends Kernel
  {
      public function registerBundles()
      {
      //...
      $bundles[] = new \MarcinJozwikowski\SettingsInDBBundle\SettingsInDBBundle();
      return $bundles;
      }
  }
  ```

3. Update database schema:
  
  ```bash
  php app/console doctrine:schema:update --force
  ```

##Usage

1. Access DB stored values through service:
  
  ```php
    //in controller
    $val = $this->get('settings_in_db_service')->read('key', 'defaultValue');
  ```
