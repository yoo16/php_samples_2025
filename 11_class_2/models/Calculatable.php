<?php 

trait Calculatable
{
    private int $non_taxed_price;
    private int $tax;
    
    public function getNoneTaxedPrice()
    {
        return $this->non_taxed_price;
    }
    public function getTax()
    {
        return $this->tax;
    }

    public function calculateTax(float $tax_rate = 0.1)
    {
        // 税抜き価格
        $this->non_taxed_price = $this->price / (1 + $tax_rate);
        // 税金
        $this->tax = $this->price - $this->non_taxed_price;
    }
}

?>