# magento-installer
Programmatically Install Magento v1

## Install

```
composer require ryaan_anthony/magento-installer
```

## Usage

* Instantiate the installer with default values

```  
  $magentoInstaller = new RyaanAnthony\MagentoInstaller();
```

* or configure the installer yourself

```
  $magentoInstaller = new RyaanAnthony\MagentoInstaller(
    'https://example.com/magento.tar.gz'
    '/path/to/magento/',
    'magento.tar.gz'
  );   
```

* Download and extract Magento 

```
  $magentoInstaller->setUp();
```


## Caveats

* Only works with gzipped tar files

- - -
Tested using PHP7.2