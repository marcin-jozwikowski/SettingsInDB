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

##Configuration

Default configuration:

  ```yml
     settings_in_db:
        allow_inserts: true
        return_null_on_not_found: false 
        read_all_entries_at_first_use: true
  ```
  
*  **allow_inserts** - if set to true, persists a new key-value pair if none is found
*  **return_null_on_not_found** - if nothing found and allow_inserts = false, returns null instead of throwing an exception
*  **read_all_entries_at_first_use** - if set to true loads all records at first use and searches in internal array insted of querying
