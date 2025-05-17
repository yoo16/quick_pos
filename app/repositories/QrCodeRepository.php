<?php
namespace App\Repositories;

class QrCodeRepository
{
    private string $dir;

    public function __construct()
    {
        $this->dir = QR_DIR . '/products';

        if (!is_dir($this->dir)) {
            mkdir($this->dir, 0755, true);
        }
    }

    public function getSavePath(string $code): string
    {
        return $this->dir . '/' . $code . '.png';
    }

    public function getPublicFileName(string $code): string
    {
        return $code . '.png';
    }
}
