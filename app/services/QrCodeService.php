<?php

namespace App\Services;

use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\Label\LabelAlignment;
use Endroid\QrCode\Label\Font\OpenSans;
use Endroid\QrCode\RoundBlockSizeMode;
use Endroid\QrCode\Writer\PngWriter;
use App\Repositories\QrCodeRepository;

class QrCodeService
{
    private QrCodeRepository $repository;

    public function __construct()
    {
        $this->repository = new QrCodeRepository();
    }

    public function generate(string $code): string
    {
        $builder = new Builder(
            writer: new PngWriter(),
            writerOptions: [],
            validateResult: false,
            data: $code,
            encoding: new Encoding('UTF-8'),
            errorCorrectionLevel: ErrorCorrectionLevel::High,
            size: 300,
            margin: 10,
            roundBlockSizeMode: RoundBlockSizeMode::Margin,
            logoResizeToWidth: 50,
            logoPunchoutBackground: true,
            labelFont: new OpenSans(20),
            labelAlignment: LabelAlignment::Center
        );
        $result = $builder->build();

        $savePath = $this->repository->getSavePath($code);
        $result->saveToFile($savePath);
        return $savePath;
    }

    public function getFileName(string $code): string
    {
        return $this->repository->getPublicFileName($code);
    }
}
