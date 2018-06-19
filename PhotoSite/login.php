<?php
require_once 'database.php';

$day = $_POST['date'];
switch ($day) {
	case '1':
		$dayName = "monday";
		break;
	case '2':
		$dayName = "tuesday";
		break;
	case '3':
		$dayName = "wednesday";
		break;
	case '4':
		$dayName = "thursday";
		break;
	case '5':
		$dayName = "friday";
		break;

}
$dayResult = ORM::for_table('days')
							->where('name', $dayName)
							->find_one();

$auth = ORM::for_table('users')
				->where('username', $_POST['username'])
				->where('password', $_POST['password'])
				->find_one();

	if (!empty($auth)) {
			$_SESSION['username'] = $_POST['username'];
			$_SESSION['password'] = 'correct';
			$dayResult->set('count', $dayResult->count + 5);
			$dayResult->save();
			echo "success";
	} else {
		unset($_SESSION['password']);
    unset($_SESSION['username']);
		echo "fail";
	}

?>
