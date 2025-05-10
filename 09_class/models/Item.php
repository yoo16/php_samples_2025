<?php
require_once 'Calculatable.php';

class Item
{
    use Calculatable;

    // コンストラクタ
    function __construct(string $name, int $price)
    {
        $this->setName($name);
        $this->setPrice($price);

        self::$count++;
        self::$list[] = $this;
    }

    private string $name;
    private int $price;

    public static int $count = 0;
    public static array $list = [];

    public function getName()
    {
        return $this->name;
    }
    public function setName(string $name)
    {
        $this->name = $name;
    }
    public function getPrice()
    {
        return $this->price;
    }
    public function setPrice(int $price)
    {
        if ($price > 0) {
            $this->price = $price;
        }
    }

    public static function totalPrice()
    {
        $price_list = array_column(self::$list, 'price');
        $total_price = array_sum($price_list);
        return $total_price;
    }

}
