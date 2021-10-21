<?php

/*
 * Task 1
 * В массиве, содержащем 3 или более чисел, определить подходит ли каждая группа из трех чисел условию a > b < c или a < b > c.
 * Оформить решение в виде функции которая принимает исходный массив и возвращает массив с результатом проверки каждой группы, где 1 удовлетворяет условию и 0 - нет.
*/

function groupCheck($arr): array
{
    $resArr = [];
    foreach ($arr as $key => $value) {
        $modifiedArr = array_slice($arr, $key, 3);
        if (count($modifiedArr) >= 3) {
            if ($modifiedArr[0] > $modifiedArr[1] && $modifiedArr[1] < $modifiedArr[2]) {
                $result = 1;
            } elseif ($modifiedArr[0] < $modifiedArr[1] && $modifiedArr[1] > $modifiedArr[2]) {
                $result = 1;
            } else {
                $result = 0;
            }
        } else {
            break;
        }
        array_push($resArr, $result);
    }
    return $resArr;
}

$arr = [1, 3, 5, 4, 5, 7];
print_r(groupCheck($arr));


/*
 * Task 2
 * Дана матрица из целых чисел от 1 до 9, размером 3 * N, где N может быть больше либо равна 3.
 * Необходимо определить содержит ли каждый участок матрицы 3 * 3 все числа от 1 до 9.
*/

function checkGroup($nums): array
{
    $check = [1, 2, 3, 4, 5, 6, 7, 8, 9];
    $matches = [];
    $length = count($nums[0]);

    for ($a = 0; $a < $length - 2; $a++) {
        $block_items = [];
        foreach ($nums as $rows) {
            for ($j = $a; $j < $a + 3; $j++) {
                $block_items[] = $rows[$j];
            }
        }
        $diff = array_diff($check, $block_items);

        $matches[] = !count(($diff)) ? 'true' : 'false';
    }
    return $matches;
}

$nums = [
    [1, 2, 3, 2, 7],
    [4, 5, 6, 8, 1],
    [7, 8, 9, 4, 5]
];
print_r(checkGroup($nums));

/*
 * Task 3
 * Есть набор строк (строка это массив из слов), условия форматирования каждой этой строки и лимит символов в строке.
 * Необходимо подготовить текст к публикации, так чтобы он удовлетворял условиям форматирования и не превышал количество символов в строке.
 * Текст должен быть заключен символ * со всех сторон.
*/

function stringCheck($text, $formatting, $limit): array
{
    $completedArr = [];
    array_push($completedArr, str_repeat('*', 18));

    foreach ($text as $key => $item) {
        $textToString = implode(' ', $item);
        $countString = strlen($textToString);

        if ($countString <= $limit) {
            $diff = $limit - $countString;
            if ($formatting[$key] === 'LEFT') {
                array_push($completedArr, '*' . $textToString . str_repeat(' ', $diff) . '*');
            } else {
                array_push($completedArr, '*' . str_repeat(' ', $diff) . $textToString . '*');
            }
        } else {
            $str = wordwrap($textToString, 16);
            $str = explode(PHP_EOL, $str);
            foreach ($str as $s) {
                $diff = $limit - strlen($s);
                if ($formatting[$key] === 'LEFT') {
                    array_push($completedArr, '*' . $s . str_repeat(' ', $diff) . '*');
                } else {
                    array_push($completedArr, '*' . str_repeat(' ', $diff) . $s . '*');
                }
            }
        }
    }
    array_push($completedArr, str_repeat('*', 18));
    return $completedArr;
}

$text = [
    ['Hello', 'world'],
    ['Brad', 'came', 'to', 'dinner', 'with', 'us'],
    ['He', 'loves', 'tacos']
];
$formatting = ['LEFT', 'RIGHT', 'LEFT'];
$limit = 16;
print_r(stringCheck($text, $formatting, $limit));