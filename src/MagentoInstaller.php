<?php

namespace RyaanAnthony;

class MagentoInstaller
{
  const MAGENTO_DIR = 'magento/';
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

  public function setUp(): void
  {
    $this->downloadFile();
    $this->extractFile();
    $this->cleanUpFile();
    $this->renameDirectory();
  }

  private function renameDirectory(): void
  {
    rename(
      glob($this->directory . '*')[0],
      'temp-magento'
    );
    rename(
      'temp-magento',
      $this->directory
    );
  }

  private function downloadFile(): void
  {
    copy($this->archive_url, $this->archive_name);
  }

  private function extractFile(): void
  {
    $phar = new \PharData($this->archive_name);
    $phar->decompress();
    $phar->extractTo($this->directory);
  }

  private function cleanUpFile(): void
  {
    unlink($this->archive_name);
    unlink(str_replace('.gz', '', $this->archive_name));
  }
}
