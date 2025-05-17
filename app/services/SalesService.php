<?php
class SalesService
{
    private $salesRepository;

    public function __construct()
    {
        $this->salesRepository = new SalesRepository();
    }

    public function get()
    {
        return $this->salesRepository->get();
    }

    public function getSalesByMonth($year, $month)
    {
        return $this->salesRepository->getSalesByMonth($year, $month);
    }

    public function create($sale)
    {
        return $this->salesRepository->create($sale);
    }

    public function delete($id)
    {
        return $this->salesRepository->delete($id);
    }

    public function getTotalSales($sales)
    {
        return array_sum(array_column($sales, 'price'));
    }

    public function getMonthlySalesByYear($year)
    {
        return $this->salesRepository->getMonthlySalesByYear($year);
    }
}
