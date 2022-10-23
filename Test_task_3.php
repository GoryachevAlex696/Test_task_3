<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test_task_3</title>
</head>

<body>

    <h2>Входные данные</h2>
    <form name="enterForm" method="GET" action="<?= $_SERVER['PHP_SELF'] ?>">
        <table>
            <tbody>
                <tr>
                    <td>
                        <b>Введите n:</b>
                    </td>

                    <td>
                        <b><input type="text" name="n"></b>
                    </td>
                </tr>

                <tr>
                    <td>
                        <b>Введите k:</b>
                    </td>

                    <td>
                        <input type="text" name="k">
                    </td>
                </tr>
                <tr>
                    <td>
                        <b><input type="submit"></b>
                    </td>
                </tr>
            </tbody>
        </table>
    </form>

    <h2>Выходное число: </h2>

    <?php

    $the_set_of_natural_numbers = isset($_GET['n']) ? $_GET['n'] : 0;
    $the_desired_number = isset($_GET['k']) ? $_GET['k'] : 0;
    $the_set_of_natural_numbers_2 = (int) $the_set_of_natural_numbers;
    $the_desired_number_2 = (int) $the_desired_number;


    function add_prev($the_set_of_natural_numbers_2, $the_desired_number_2)
    {
        function count_added_strings($str_len, $the_set_of_natural_numbers_2, $the_desired_number_2)
        {
            $num_beg = 10 ** ($str_len - 1);
            $num_end = $the_desired_number_2 * 10 ** ($str_len - strlen($the_desired_number_2)) - 1;
            if ($str_len == strlen($the_set_of_natural_numbers_2)) {
                $num_end = min($num_end, $the_set_of_natural_numbers_2);
                return $num_end - $num_beg + 1;
            }
        }
        $res = 0;
        foreach (range(strlen($the_desired_number_2) + 1, strlen($the_set_of_natural_numbers_2) + 1) as $str_len) {
            $res += count_added_strings($str_len, $the_set_of_natural_numbers_2, $the_desired_number_2);
        }
        return $res;
    }

    function remove_prev($the_desired_number_2)
    {
        function count_deleted_strings_with_k_dig($the_desired_number_2)
        {
            $res = 0;
            foreach (range(2, strlen($the_desired_number_2)) as $str_len) {
                $res += ($the_desired_number_2[0] + 1) * 10 ** ($str_len - 1) - 1 - $the_desired_number_2[$str_len];
            }
            return $res;
        }
        function count_deleted_strings_with_digits_greater($the_desired_number_2)
        {
            if (strlen($the_desired_number_2) == 1) {
                return 0;
            }
            $p_str = (string) $the_desired_number_2;
            return (9 - $p_str[0]) * '1' * (strlen($p_str) - 1);
        }
        $res = 0;
        $res += count_deleted_strings_with_digits_greater($the_desired_number_2);
        return $res;
    }
    if (($t_str > $p_str) || (empty($t_str)) || (empty($p_str)) || (!is_numeric($t_str)) || (!is_numeric($p_str)) || ($t_str < 0) || ($p_str < 0))
        echo "Введите корректные входные данные...";
    else {
        $result = $the_desired_number_2 + add_prev($the_set_of_natural_numbers_2, $the_desired_number_2) - remove_prev($the_desired_number_2);
        if (is_nan($result))
            echo "Слишком большие числа...";
        else echo "Результат: ", $result;
    }
    ?>

</body>

</html>
