<?php
require __DIR__ . '/vendor/autoload.php';

use App\Bitrix24\Bitrix24API;
use App\Bitrix24\Bitrix24APIException;

try {

    $webhookURL = 'https://b24-sm028d.bitrix24.ru/rest/1/9597i6ss3livr6je/';
    $bx24 = new Bitrix24API($webhookURL);

    // Получаем задачу по ID
    // $task = $bx24->getTask(4325);
    // print_r($task);

    // Получаем все задачи 
    $generator = $bx24->getTaskList();

    foreach ($generator as $result) {
        foreach ($result['tasks'] as $key => $value) {
            $user = $value['responsible']['name'];
            $table .= "<tr align=\"center\">
                            <td>{$value['title']}</td>
                            <td>{$value['description']}</td>
                            <td>{$user}</td>
                            <td>{$value['deadline']}</td>
                        </tr>";
        }
    }

} catch (Bitrix24APIException $e) {
    printf('Ошибка (%d): %s' . PHP_EOL, $e->getCode(), $e->getMessage());
} catch (Exception $e) {
    printf('Ошибка (%d): %s' . PHP_EOL, $e->getCode(), $e->getMessage());
}
?>

<html><head>
	<meta charset="utf-8">
	<title>Bitrix24API</title>

</head>
<body>
	<table border="1">
		<tbody><tr>
			<th>Название задачи</th>
			<th>Описание задачи</th>
			<th>Пользователь</th>
			<th>Крайний срок</th>
		</tr>
		<?=$table?>
	</tbody></table>

</body></html>