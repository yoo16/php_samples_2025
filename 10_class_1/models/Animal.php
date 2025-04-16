<?php 

class Animal
{
    // コンストラクタ
    public function __construct(string $name)
    {
       $this->name = $name; 
    }

    // プロパティ
    // 名前
    private string $name;
    // 種別
    public string $type;
    // 鳴き声
    public string $crying;

    // クラスメソッド
    public function run()
    {
        echo "{$this->name}が走った！";
    }

    protected function eat(string $something)
    {
        echo "{$this->name}が{$something}を食べた！";
    }

    public function cry()
    {
        echo $this->crying;
    }

}
