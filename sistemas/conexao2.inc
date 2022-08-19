<?PHP

$servername = 'localhost';
$username = 'root';
$password = 'Pobre17#';
$bco = 'bingo_cand';
$cha = 'utf8';

$con = mysqli_connect($servername, $username, $password, $bco);
mysqli_set_charset($con, $cha) or die (mysqli_error($con));

If(mysqli_connect_error()):
echo "Erro na conexao: " .mysqli_connect_error();
endif;
?>
