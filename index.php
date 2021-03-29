<html>
<head>
    <meta charset="utf-8"/>
    <link href="assets/css/style.css" rel="stylesheet">
    <title>HTML5</title>
</head>
<body class="body">
<form action="index.php" method="POST">
    <p>Введите дату рождения в формате: (dd.mm.yy): <label>
            <input class="text_input" type="text" name="date_of_birth"/>
        </label></p>
    <p>Введите количество дней: <label>
            <input class="text_input" type="text" name="count_of_days"/>
        </label></p>
    <p><input class="btn" type="submit"/></p>
    <?php

    if (isset($_POST['date_of_birth'])) {
        if (check_inp_date() && (is_numeric($_POST['count_of_days']))) {
            find_interval_date();
            find_east_year();
        } else {
            show_alert_message();
        }
    }

    function find_interval_date()
    {
        $year = date_create()->diff(date_create($_POST['date_of_birth']))->y;
        $month = date_create()->diff(date_create($_POST['date_of_birth']))->m;
        $day = date_create()->diff(date_create($_POST['date_of_birth']))->d;
        echo '<p>В данный момент Вам: ' . $year . ' лет, ' . $month . ' месяцев, ' . $day . ' дней.' . '</p>';
        echo '<p>Дата, когда Вам исполнится ' . $_POST['count_of_days'] . ' дней: ' . date('d.m.Y', strtotime($_POST['date_of_birth']) + intval($_POST['count_of_days']) * 24 * 3600);
    }

    function find_east_year()
    {
        $zodiac_arr = [0 => "Крыса",
            1 => "Бык",
            2 => "Тигр",
            3 => "Кролик",
            4 => "Дракон",
            5 => "Змея",
            6 => "Лошадь",
            7 => "Коза",
            8 => "Обезьяна",
            9 => "Петух",
            10 => "Собака",
            11 => "Свинья",];
        $east_year = explode('.', $_POST['date_of_birth']);
        echo '<p>Ваш знак зодиака: ' . $zodiac_arr[(intval($east_year[2]) + 8) % 12] . '.</p>';
    }

    function check_inp_date(): bool
    {
        $date_arr = explode('.', $_POST['date_of_birth']);
        if ((isset($date_arr[0]) && isset($date_arr[1]) && isset($date_arr[2])) && (checkdate($date_arr[1], $date_arr[0], $date_arr[2]))) {
            return true;
        } else return false;
    }

    function show_alert_message()
    {
        echo '<p class="alert">Некорректный ввод данных!</p>';
    }

    ?>
</form>
</body>
</html>