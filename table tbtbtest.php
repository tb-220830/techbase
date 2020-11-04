<?PHP

// DB接続設定
$dsn = 'データベース名';
$user = 'ユーザー名';
$password = 'パスワード';
$pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

$sql = "CREATE TABLE IF NOT EXISTS tbtbtest"
	." ("
	. "id INT AUTO_INCREMENT PRIMARY KEY,"
	. "name varchar(32),"
	. "comment TEXT"
	.");";
	$stmt = $pdo->query($sql);

?>