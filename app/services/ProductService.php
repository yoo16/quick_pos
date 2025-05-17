<?php
class ProductService
{
    private $productRepository;

    public function __construct()
    {
        $this->productRepository = new ProductRepository();
    }

    public function get()
    {
        return $this->productRepository->get();
    }

    public function find($id)
    {
        return $this->productRepository->find($id);
    }

    public function findByCode($code)
    {
        return $this->productRepository->findByCode($code);
    }

    public function create(Product $product)
    {
        return $this->productRepository->create($product);
    }

    public function update($id, Product $product)
    {
        return $this->productRepository->update($id, $product);
    }

    public function delete($id)
    {
        return $this->productRepository->delete($id);
    }

}
