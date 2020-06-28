<?php

class Shop
{
    private static $customer_names = ["Александр","Алексей","Анатолий","Андрей","Антон","Аркадий","Артем","Борислав","Вадим","Валентин","Валерий","Василий","Виктор","Виталий","Владимир","Вячеслав","Геннадий","Георгий","Григорий","Даниил","Денис","Дмитpий","Евгений","Егор","Иван","Игорь","Илья","Кирилл","Лев","Максим","Михаил","Никита","Николай","Олег","Семен","Сергей","Станислав","Степан","Федор","Юрий","Александра","Алина","Алла","Анастасия","Анжела","Анна","Антонина","Валентина","Валерия","Вероника","Виктория","Галина","Дарья","Евгения","Екатерина","Елена","Елизавета","Карина","Кира","Клавдия","Кристина","Ксения","Лидия","Любовь","Людмила","Маргарита","Марина","Мария","Надежда","Наталья","Нина","Оксана","Олеся","Ольга","Полина","Светлана","Таисия","Тамара","Татьяна","Эвелина","Эльвира","Юлиана","Юлия","Яна"];
    public $size;
    public $queue;
    public $customer;

    public function __construct()
    {
        $this->size = rand(5, 10);
        $this->queue = [];
    }

    public function addCustomer($count = 1){
        $time = date('H:i:s');
        if($count > 1){
            $new_customers = [];
            echo "\n$time - Зашли {$count} клиента: ";
            for ($i = 0; $i < $count; $i++){
                $new_customers[] = self::$customer_names[array_rand(self::$customer_names)];
            }
            echo implode(', ', $new_customers).".";
            array_push($this->queue, ...$new_customers);
        }else {
            $new_customer = self::$customer_names[array_rand(self::$customer_names)];
            echo "\n$time - Зашел клиент {$new_customer}.";
            array_push($this->queue, $new_customer);
        }
    }

    public function serveCustomer(){
        $time = date('H:i:s');
        if(!empty($this->queue)) {
            $this->customer = array_shift($this->queue);
            echo "\n$time - Клиент {$this->customer} обслужен.";
        }else {
            $this->customer = null;
        }
    }

    public function start(){
        $time = date('H:i:s');
        echo "\n$time -- Магазин открыт для {$this->size} клиентов! --\n";

        while(count($this->queue) < $this->size){
            sleep(rand(1, 10));
            $this->addCustomer(rand(1, 3));
        }

        echo "\n\nОчередь: ". implode(', ', $this->queue) .".\n";

        while(!empty($this->queue)){
            sleep(rand(1, 10));
            $this->serveCustomer();
        }

        $this->serveCustomer();
        $time = date('H:i:s');
        echo "\n\n$time -- Магазин закрыт! --\n";
    }

}


$shop = new Shop();
$shop->start();
