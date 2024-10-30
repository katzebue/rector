<?php

$value = 5;

// Пример 1: Сравнение с идентичностью
if ($value === 10) {
    echo "Value is 10";
}

// Пример 2: Не идентично
if (5 !== $value) {
    echo "Value is not 5";
}

// Пример 3: Обычное равенство
if ($value == 10) {
    echo "Value is 10";
}

// Пример 4: Не равно
if (5 != $value) {
    echo "Value is not 5";
}

// Пример 5: Сравнение со скалярным значением
if (10 === $value) {
    echo "Value is 10";
}

// Пример 6: Сравнение с константой
const MY_CONSTANT = 5;
if (MY_CONSTANT === $value) {
    echo "Value is MY_CONSTANT";
}
?>
-----
<?php

$value = 5;

// Пример 1: Сравнение с идентичностью
if ($value === 10) {
    echo "Value is 10";
}

// Пример 2: Не идентично
if ($value !== 5) {
    echo "Value is not 5";
}

// Пример 3: Обычное равенство
if ($value == 10) {
    echo "Value is 10";
}

// Пример 4: Не равно
if ($value != 5) {
    echo "Value is not 5";
}

// Пример 5: Сравнение со скалярным значением
if ($value === 10) {
    echo "Value is 10";
}

// Пример 6: Сравнение с константой
const MY_CONSTANT = 5;
if ($value === MY_CONSTANT) {
    echo "Value is MY_CONSTANT";
}
?>
