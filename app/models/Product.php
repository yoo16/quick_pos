<?php
class Product
{
    public ?int $id;
    public string $code;
    public string $name;
    public int $price;
    public ?string $created_at;
    public ?string $updated_at;

    public function __construct($data) {
        $this->id = $data['id'] ?? null;
        $this->code = $data['code'];
        $this->name = $data['name'];
        $this->price = (int)$data['price'];
        $this->created_at = $data['created_at'] ?? null;
        $this->updated_at = $data['updated_at'] ?? null;
    }

    public static function fromArray(array $row)
    {
        return new self($row);
    }

    // QRコード画像のパスを返す
    public function getQrCodePath(): string
    {
        return "qr/products/{$this->code}.png";
    }

}