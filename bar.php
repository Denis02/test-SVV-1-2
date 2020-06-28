<?php

class Visitor {
    private static $names = ["Александр","Алексей","Анатолий","Андрей","Антон","Аркадий","Артем","Борислав","Вадим","Валентин","Валерий","Василий","Виктор","Виталий","Владимир","Вячеслав","Геннадий","Георгий","Григорий","Даниил","Денис","Дмитpий","Евгений","Егор","Иван","Игорь","Илья","Кирилл","Лев","Максим","Михаил","Никита","Николай","Олег","Семен","Сергей","Станислав","Степан","Федор","Юрий","Александра","Алина","Алла","Анастасия","Анжела","Анна","Антонина","Валентина","Валерия","Вероника","Виктория","Галина","Дарья","Евгения","Екатерина","Елена","Елизавета","Карина","Кира","Клавдия","Кристина","Ксения","Лидия","Любовь","Людмила","Маргарита","Марина","Мария","Надежда","Наталья","Нина","Оксана","Олеся","Ольга","Полина","Светлана","Таисия","Тамара","Татьяна","Эвелина","Эльвира","Юлиана","Юлия","Яна"];

    public $name;
    public $musicGenres;
    public $action;

    public function __construct()
    {
        $this->name = self::$names[array_rand(self::$names)];
        $musicGenres = [];
        for($i = 0; $i < rand(1, 3); $i++){
            $musicGenres[] = Music::$genres[array_rand(Music::$genres)];
        }
        $this->musicGenres = array_unique($musicGenres);
    }

    public function __toString()
    {
        return $this->name . " (" . implode(', ', $this->musicGenres) . ")";
    }
}

class Music {
    public static $genres = ['rock', 'R&B', 'pop', 'jazz', 'electronic'];

    public $title;
    public $genre;
    public $time;

    public function __construct()
    {
        $this->title = rand(555, 9999);
        $this->time = rand(5, 10);
        $this->genre = self::$genres[array_rand(self::$genres)];
    }

    public function __toString()
    {
        return "$this->title (genre: $this->genre, time: $this->time)";
    }
}

class Bar {
    public static $drinks = ['пиво', 'водку', 'чай', 'текилу', 'виски'];

    public $visitors;
    public $playList;
    public $currentMusic;

    public function __construct()
    {
        $this->visitors = [];
        $this->playList = [];
        for($i = 0; $i < rand(5, 10); $i++){
            $this->visitors[] = new Visitor();
        }
        for($i = 0; $i < rand(7, 10); $i++){
            $this->playList[] = new Music();
        }
    }

    public function start(){
        $time = date('H:i:s');
        echo "\n$time -- Бар открыт! --\n";

        echo "\nПосетители:\n";
        foreach ($this->visitors as $visitor) echo "$visitor\n";
        echo "\nPLAYLIST:\n";
        foreach ($this->playList as $music) echo "$music\n";
        sleep(5);

        while(!empty($this->playList)){
            $this->currentMusic = array_shift($this->playList);
            $time = date('H:i:s');
            $str = "\n\n$time - Играет трек №{$this->currentMusic->title} ";
            foreach ($this->visitors as $visitor){
                $str .= "\n{$visitor->name}";
                if(in_array($this->currentMusic->genre, $visitor->musicGenres)){
                    $str .= "\033[1m танцует \033[0m";
                }else{
                    $str .= "пьет " . self::$drinks[array_rand(self::$drinks)];
                }
            }
            echo $str;
            sleep($this->currentMusic->time);
        }

        echo "\n\n$time -- Бар закрыт! --\n";
    }

}


$bar = new Bar();
$bar->start();
