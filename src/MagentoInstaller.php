<?php

namespace RyaanAnthony;

class MagentoInstaller
{
  const MAGENTO_DIR = __DIR__.'/../magento/';
  const ARCHIVE_NAME = 'magento.tar.gz';
  const ARCHIVE_URL = 'https://github.com/OpenMage/magento-mirror/archive/1.9.4.1.tar.gz';

  function __construct(
    string $directory = self::MAGENTO_DIR,
    string $archive_name = self::ARCHIVE_NAME,
    string $archive_url = self::ARCHIVE_URL
  ) {
    $this->directory = $directory;
    $this->archive_url = $archive_url;
    $this->archive_name = $archive_name;
  }

  public function setUp() {
    try {
      $this->downloadFile();
      $this->extractFile();
      $this->cleanUpFile();

      print 'Setup complete!'.PHP_EOL;
    } catch (\Exception $e) {
      print 'Error occurred during setup!!'.PHP_EOL;
      print $e->getMessage().PHP_EOL;
    }
  }

  public function getDirectory()
  {
    return glob($this->directory . '*')[0];
  }

  protected function downloadFile()
  {
    copy($this->archive_url, $this->archive_name);
  }

  protected function extractFile()
  {
    $phar = new \PharData($this->archive_name);
    $phar->decompress();
    $phar->extractTo($this->directory);
  }

  protected function cleanUpFile()
  {
    unlink(str_replace('.gz', '', $this->archive_name));
    unlink($this->archive_name);
  }
}
