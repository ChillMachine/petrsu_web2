<?php 
    class NotePad {
        
        private $phone;
        public $name;
        public $surname;

        const TEXT_SIZE = 20; // максимальная длина строки для свойств класса

        public function note_show() {
            echo $this->phone, ' ', $this->name, ' ', $this->surname, ' ', self::TEXT_SIZE, '<br>';
        }

        public function __construct($phone = null, $name = null, $surname = null) {
            $this->phone = $phone;
            $this->name = $name;
            $this->surname = $surname;
        }

        public function __clone() {
            $this->phone = null;
            $this->name = null;
            $this->surname = null;
        }

        protected function setPhone($phone) { $this->phone = $phone; }
        protected function getPhone() { return $this->phone; }
    }

    class NoteChild extends NotePad {
        public function note_show() {
            echo __CLASS__;
            echo '<br>Вызов родительского метода note_show<br>';
            NotePad::note_show();
        }

        public function cut_note() {
            //$this->phone = mb_strimwidth($this->phone, 0, self::TEXT_SIZE, '...');
            $this->name = mb_strimwidth($this->name, 0, self::TEXT_SIZE, '...');
            $this->surname = mb_strimwidth($this->surname, 0, self::TEXT_SIZE, '...');
            parent::setPhone(mb_strimwidth(parent::getPhone(), 0, self::TEXT_SIZE, '...'));
        }
    }


    $note1 = new NotePad();
    
    echo $note1->note_show();
    echo $note1::TEXT_SIZE;

    echo '<br><br>';

    $note2 = new NotePad('331525', 'Walter', 'White');
    echo $note2->note_show();

    echo '<br>';

    $note2_copy = clone $note2;
    echo $note2_copy->note_show();
    
    echo '<br>';

    $child1 = new NoteChild('123', 'Ivan', 'Ivanov');
    echo $child1->note_show();

    echo '<br>';

    $child1_copy = clone $child1;
    //echo $note2_copy->phone; // приватное + пустое
    echo $note2_copy->name; // пустое т.к. __clone
    echo $note2_copy->surname; // пустое т.к. __clone*/
    echo $child1->note_show();
    
    echo '<br>';

    $child2 = new NoteChild('123456789012345678901234567890', 'Длина имени больше двадцати символов', 'Фамилия короче 20');
    echo $child2->note_show();
    echo $child2->cut_note();
    echo $child2->note_show();
?>