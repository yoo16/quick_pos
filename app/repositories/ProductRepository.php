<?php

class ProductRepository
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Database::getInstance();
    }

    public function findByCode(string $code)
    {
        $sql = "SELECT * FROM products WHERE code = :code";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['code' => $code]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row ? Product::fromArray($row) : null;
    }

    public function find(int $id)
    {
        $sql = "SELECT * FROM products WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row ? Product::fromArray($row) : null;
    }

    public function get()
    {
        $sql = "SELECT * FROM products ORDER BY code";
        $stmt = $this->pdo->query($sql);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return array_map(fn($row) => Product::fromArray($row), $rows);
    }

    public function create(Product $product)
    {
        $sql = "INSERT INTO products (code, name, price) VALUES (:code, :name, :price)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':code' => $product->code,
            ':name' => $product->name,
            ':price' => $product->price,
        ]);
    }

    public function update(int $id, Product $product)
    {
        $sql = "UPDATE products SET code = :code, name = :name, price = :price WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':id' => $id,
            ':code' => $product->code,
            ':name' => $product->name,
            ':price' => $product->price,
        ]);
    }


    public function delete(int $id)
    {
        $sql = "DELETE FROM products WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }
}
