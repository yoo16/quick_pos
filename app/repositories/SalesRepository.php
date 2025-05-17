<?php
class SalesRepository
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Database::getInstance();
    }

    public function get()
    {
        $sql = "SELECT * FROM sales ORDER BY created_at DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return array_map(fn($row) => Sales::fromArray($row), $rows);
    }

    function periodDate($year, $month)
    {
        $from_at = sprintf('%04d-%02d-01 00:00:00', $year, $month);
        $to_at = date('Y-m-d 00:00:00', strtotime("$from_at +1 month"));

        return [
            'from_at' => $from_at,
            'to_at' => $to_at,
        ];
    }

    public function getSalesByMonth($year, $month)
    {
        if ($year == 0 || $month == 0) {
            return [];
        }

        $period = $this->periodDate($year, $month);

        $sql = "SELECT * FROM sales 
                WHERE created_at >= :from_at 
                    AND created_at < :to_at
                ORDER BY created_at DESC";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':from_at' => $period['from_at'],
            ':to_at' => $period['to_at'],
        ]);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return array_map(fn($row) => Sales::fromArray($row), $rows);
    }

    public function create(Sales $sale)
    {
        $sql = "INSERT INTO sales (receipt_number, price) VALUES (:receipt_number, :price)";
        $stmt = $this->pdo->prepare($sql);
        $result = $stmt->execute([
            ':receipt_number' => $sale->receipt_number,
            ':price' => $sale->price,
        ]);
        return $result;
    }

    public function delete(int $id)
    {
        $sql = "DELETE FROM sales WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
    }

    public function getMonthlySalesByYear(int $year)
    {
        $sql = "SELECT MONTH(created_at) AS month, SUM(price) AS total
            FROM sales
            WHERE YEAR(created_at) = :year
            GROUP BY MONTH(created_at)
            ORDER BY month";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':year' => $year]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
