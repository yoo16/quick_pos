<?php
class Sales
{
    public $id;
    public $receipt_number;
    public $price;
    public $created_at;
    public $updated_at;

    public function __construct($data)
    {
        $this->id = $data['id'] ?? null;
        $this->receipt_number = $data['receipt_number'] ?? 'R' . date('YmdHis') . rand(100, 999);
        $this->price = (int)$data['price'];
        $this->created_at = $data['created_at'] ?? null;
        $this->updated_at = $data['updated_at'] ?? null;
    }

    public static function fromArray(array $row): self
    {
        return new self($row);
    }
    
}
