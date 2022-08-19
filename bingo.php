<? 
session_start();
include_once 'sistemas/conexao2.inc';

ini_set('default_charset', 'UTF-8');
?>

<!DOCTYPE html>
<html lang="pt-br">
	
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Show de Premios</title>
	
<script language="javascript">
	// Buscar o aluno


			function SubmeterBingo() {
				document.formentra.bingo.value = 1;
				document.formentra.submit();
			}
			
		    function SubmeterVoltar() {
				document.formentra.voltar.value = 1;
				document.formentra.submit();
			}
		
			function SubmeterSalva_rodada() {
				document.formentra.salva_rodada.value = 1;
				document.formentra.submit();
			}
	
			function SubmeterEnvia_num() {
				document.formentra.salva_num.value = 1;
				document.formentra.submit();
			}

			function SubmeterBusca_bola() {
				document.formentra.bolaponta.value = 1;
				document.formentra.submit();
			}

			function SubmeterApaga_v() {
				document.formentra.apaga_v.value = 1;
				document.formentra.submit();
			}
			   function onlynumber(evt) {
				   //return number.evt().length;
				   var theEvent = evt || window.event;
				   var key = theEvent.keyCode || theEvent.which;
				   key = String.fromCharCode( key );
				   //var regex = /^[0-9.,]+$/;
				   var regex = /^[0-9.]+$/;
				   if( !regex.test(key) ) {
					  theEvent.returnValue = false;
					  if(theEvent.preventDefault) theEvent.preventDefault();
				}
			}
	
</script>
	
<style type="text/css">
.animate-charcter
{
   text-transform: uppercase;
  background-image: linear-gradient(
    -225deg,
    #231557 0%,
    #44107a 29%,
    #ff1361 67%,
    #fff800 100%
  );
  background-size: auto auto;
  background-clip: border-box;
  background-size: 200% auto;
  color: #fff;
  background-clip: text;
  text-fill-color: transparent;
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  animation: textclip 2s linear infinite;
  display: inline-block;
      font-size: 50px;
}

@keyframes textclip {
  to {
    background-position: 200% center;
  }
}

table {
   margin: 0  auto;
   width: 100%;
}

td {
  border: 1px solid gray;
  border-radius: 10px;
  text-align: center;
  }
  
h1 {
  border: 1px solid black;
  border-radius: 10px;
  text-align: center;
  }
  
td[colspan1] {
   text-align: center;
}

caption {
   font-size: 16px;
   font-weight: bold;
}

body {
	background-color: #DCDCDC;
  }
  
 body{
   overflow: hidden;
   padding: 0;
   margin: 0;
       }

.max-width {
	background-image: url("image/VcGanhou.png");
	background-size: cover;
	background-repeat: no-repeat;
	
	width: 1000px;
	height: 100vh;
	margin: 0 auto;
        }
</style>
</head>
<body>

 <?    
		date_default_timezone_set('America/Sao_Paulo');
	
		$datahora = date('Y-m-d H:i:s');
	    $data_hoje = $_POST['data_hoje'];
        $data2 = date('d/m/Y');
	    $data_hoje = date('Y-m-d');
		
	    $salva_rodada = $_POST['salva_rodada'];
	    $voltar = $_POST['voltar'];
	
		$bola_num = $_POST['bola_num'];
		$salva_num = $_POST['salva_num'];
		$busca_bola = $_POST['busca_bola'];

	    $envia_num = $_POST['envia_num'];
		$envia_rodada = $_POST['envia_rodada'];
	    $bingo = $_POST['bingo'];
		$refer = $_POST['refer'];

		$bolaponta = $_POST['bolaponta'];
		$apaga_v = $_POST['apaga_v'];
?>

<? if($bingo=="1"){?><div class="max-width"></div><? }?>
	
 <form name="formentra" method="post" action="<? echo $PHP_SELF;?>" >

<? 
		if($voltar==1){
		$sql = "SELECT  id_bingo  FROM bingo_cand.bingo_tabela WHERE bingo_rodada='$envia_rodada' and bola_num = '$envia_num'";
		$resultado=mysqli_query($con,$sql);	
		while($id_nome = mysqli_fetch_array($resultado)):
		$bola_ret = $id_nome['id_bingo'];
		endwhile;
		
			$sql1 = "UPDATE bingo_cand.bingo_tabela SET";
			$sql1 = "$sql1 bola_num = '00'";
			$sql1 = "$sql1 WHERE id_bingo = '$bola_ret'";
				
			$resultado = mysqli_query($con, $sql1);
					
			if(!$resultado):
			$isNao = 'true';
			$isAtua = 'false';
			else:
			$isSim = 'true';
			endif;
	     }
		 
		$conta_ver= "SELECT * FROM bingo_cand.bingo_tabela WHERE (bola_num='00' and bingo_rodada='$envia_rodada')";
		$result=mysqli_query($con,$conta_ver);
		$conta1 = mysqli_num_rows($result);

		if($salva_rodada==1){
		$refer = "0";	
		$refer = (75-$conta1);	
		}else{
		$refer = "0";
		$refer = (76-$conta1);	
		}
		//echo "refer = "; echo $refer; 
		
		$conta_ver2= "SELECT * FROM bingo_cand.bingo_tabela WHERE bola_num='$envia_num' and bingo_rodada='$envia_rodada'";
		$result2=mysqli_query($con,$conta_ver2);
		$conta2 = mysqli_num_rows($result2);

		$caracteres = strlen($envia_num);
		

	if($salva_num==1){
		
	if($envia_num<>"00" and $conta2=="" and strlen($envia_num)>="2"){
		$sql2 = "UPDATE bingo_cand.bingo_tabela SET";
		$sql2 = "$sql2 bola_num = '$envia_num'";
		$sql2 = "$sql2 WHERE bingo_cres = '$refer' and bingo_rodada='$envia_rodada'";
	}
		$resultado = mysqli_query($con, $sql2);
		
		if(!$resultado):
		$isNao = 'true';
		$isAtua = 'false';
		else:
		$isSim = 'true';
		endif;
	}

	if( $apaga_v==1 ){
		$sql4 = "UPDATE bingo_cand.bingo_tabela SET";
		$sql4 = "$sql4 bingo_seq = 'nao'";
		$sql4 = "$sql4 WHERE bingo_rodada='$envia_rodada'";
		$resultado4 = mysqli_query($con, $sql4);
		
		if($resultado4):
		$isZera = 'true';
		endif;
		}

	if( $bolaponta==1 ){
		$sqlb = "UPDATE bingo_cand.bingo_tabela SET";
		$sqlb = "$sqlb bingo_seq = 'sim'";
		$sqlb = "$sqlb WHERE bola_num = '$busca_bola' and bingo_rodada ='$envia_rodada'";
		$resultado5 = mysqli_query($con, $sqlb);

		$conta_visto = "SELECT * FROM bingo_cand.bingo_tabela WHERE bola_num = '$busca_bola' and bingo_rodada ='$envia_rodada'";
		$result_v=mysqli_query($con,$conta_visto);
		$conta_visto = mysqli_num_rows($result_v);

		//echo $conta_visto;
		if($conta_visto <>'1'):
		$isBusca = 'false';
		else:
		$isBusca = 'true';
		endif;
	}
		 
	 if($salva_rodada==1 && strlen($envia_rodada)>="2"){
         $png = "0";
	     $envia_num = "";
		 $conta_ver= "SELECT * FROM bingo_cand.bingo_tabela WHERE bingo_rodada='$envia_rodada'";
		 $result=mysqli_query($con,$conta_ver);
		 $conta_rodada = mysqli_num_rows($result);
		 
		 if($envia_rodada==TRUE and $conta_rodada==""):
		 else:
		 $isAtua = true;
		 endif;
		 
		if($envia_rodada==TRUE and $conta_rodada==""){
		$inv=1;
		for($carr = 1; $carr <= 75; $carr++){	
		$sql3 = "INSERT INTO bingo_cand.bingo_tabela (bingo_rodada, bola_num, bingo_cres)";
		$sql3 = "$sql3 VALUES('$envia_rodada', '00','$inv')";
		$inv++;		
		$result = mysqli_query($con, $sql3);

		if(!$result):
        $isNao = true;
	    $isAtua = false;
		else:
		$isSim = true;
		endif;
			 }
		 }
		 
	 }
		
		$linA="1";
		$linB="1";
		$linC="1";
		$linD="1";
		$linE="1";
		$linZ="1";
		
		$colA="1";
	    $colB="3";
	    $colC="5";
		$colD="7";
		$colE="9";

		$sql = "SELECT  bola_num  FROM bingo_cand.bingo_tabela WHERE bingo_rodada='$envia_rodada'";
		$resultado=mysqli_query($con,$sql);	
		while($id_nome = mysqli_fetch_array($resultado)):
				
				if($id_nome['bola_num']>=1 and $id_nome['bola_num']<=15){
				${"cod$linA$colA"} = $id_nome['bola_num'];
				if(!$id_nome['bola_num']){
				${"cod$linA$colA"} = "00";}

				if($colA >= 2){
				$linA++;	
				$colA="0";
				}
				$colA++;
				}
				
				if($id_nome['bola_num']>=16 and $id_nome['bola_num']<=30){
				${"cod$linB$colB"} = $id_nome['bola_num'];
				if(!$id_nome['bola_num']){
				${"cod$linB$colB"} = "00";}

				if($colB >= 4){
				$linB++;	
				$colB="2";
				}
				$colB++;
				}	
	
				if($id_nome['bola_num']>=31 and $id_nome['bola_num']<=45){
				${"cod$linC$colC"} = $id_nome['bola_num'];
				if(!$id_nome['bola_num']){
				${"cod$linC$colC"} = "00";}

				if($colC >= 6){
				$linC++;	
				$colC="4";
				}
				$colC++;
				}	

				if($id_nome['bola_num']>=46 and $id_nome['bola_num']<=60){
				${"cod$linD$colD"} = $id_nome['bola_num'];
				if(!$id_nome['bola_num']){
				${"cod$linD$colD"} = "00";}

				if($colD >= 8){
				$linD++;	
				$colD="6";
				}
				$colD++;
				}	

				if($id_nome['bola_num']>=61 and $id_nome['bola_num']<=75){
				${"cod$linE$colE"} = $id_nome['bola_num'];
				if(!$id_nome['bola_num']){
				${"cod$linE$colE"} = "00";}

				if($colE >= 10){
				$linE++;	
				$colE="8";
				}
				$colE++;
				}	
		endwhile;
		
		
	?>  
	  <table >
    <tr>
       <center> <td bgcolor="#ADD8E6" colspan="2"><img src="image/B_bingo.png"  width="80" height="80"></td></center>
       <center> <td bgcolor="#7FFFD4" colspan="2"><img src="image/I_bingo.png"  width="45" height="80"></td></center>
	   <center> <td bgcolor="#FFE4B5" colspan="2"><img src="image/N_bingo.png"  width="80" height="80"></td></center>
	   <center> <td bgcolor="#D8BFD8" colspan="2"><img src="image/G_bingo.png"  width="80" height="80"></td></center>
	   <center> <td bgcolor="#FFF8DC" colspan="2"><img src="image/O_bingo.png"  width="80" height="80"></td></center>

	  <center> <td rowspan="8" colspan="6">

		<div class="container">
		  <div class="row">
			<div class="col-md-12 text-center">
			  <h3 class="animate-charcter">EMEF Candido Portinari</h3>
			  <h3 class="animate-charcter">Rodada nº: <? echo $envia_rodada ?></h3>
			</div>
		  </div>
		</div>
	   <center>
	   <?if($envia_num<>""){?>
	   <img src="image/<? echo $envia_num?>.gif" width="85%" height="85%"></center></td>
	   <?}else{?>
	   <img src="image/roda_bingo.png" width="90%" height="90%"></center></td>
	   <? }?>
	   </center>
	   
	   </tr>
				
	<? $p = "1"; for($lint = 1; $lint <= 8; $lint++){ ?>
   <tr>
	<?if($lint<=7){
			for($colt = 1; $colt <= 10; $colt++){ ?>
                    <? //echo "/"; echo $p; $p++;?>
					<? if(${"cod$lint$colt"}<>""){?>
					<td 
					<?if(${"cod$lint$colt"}<="15"){ ?>bgcolor="#ADD8E6"<?}?>
					<?if(${"cod$lint$colt"}>="16" and ${"cod$lint$colt"}<="30"){ ?>bgcolor="#7FFFD4"<?}?>
					<?if(${"cod$lint$colt"}>="31" and ${"cod$lint$colt"}<="45"){ ?>bgcolor="#FFE4B5"<?}?>
					<?if(${"cod$lint$colt"}>="46" and ${"cod$lint$colt"}<="60"){ ?>bgcolor="#D8BFD8"<?}?>
					<?if(${"cod$lint$colt"}>="61" and ${"cod$lint$colt"}<="75"){ ?>bgcolor="#FFF8DC"<?}?>
					>
					<?
					
					$sql = "SELECT  bingo_cres  FROM bingo_cand.bingo_tabela WHERE bingo_rodada='$envia_rodada' and bola_num='${"cod$lint$colt"}'";
					$resultado=mysqli_query($con,$sql);	
					while($id_cres = mysqli_fetch_array($resultado)):
					$cres = $id_cres['bingo_cres'];
					endwhile;

					//echo $refer; echo "="; echo $cres;?>
					<?if($refer==$cres){?>
					<center><img  src="image/<? echo ${"cod$lint$colt"};?>.gif" width="88" height="88"></center> 
					<? }else{?>

					<?
					$sql = "SELECT  bingo_seq  FROM bingo_cand.bingo_tabela WHERE bingo_rodada='$envia_rodada' and bola_num='${"cod$lint$colt"}'";
					$resultado=mysqli_query($con,$sql);	
					if($id_cres = mysqli_fetch_array($resultado)):
					$bingo_seq = $id_cres['bingo_seq'];	
					endif;
					?>
					<? if($bingo_seq=='sim'){?>
					<center><img src="image/num_visto/<? echo ${"cod$lint$colt"};?>_v.png"  width="88" height="88"></center> 
					<? }else{?>
					<center><img src="image/<? echo ${"cod$lint$colt"};?>.png"  width="88" height="88"></center> 
					<? }}?>
					</td>
	                <? }else{?>  
	                <td 
					<?if($colt<="2"){ ?>bgcolor="#ADD8E6"<?}?>
					<?if($colt>="3" and $colt<="4"){ ?>bgcolor="#7FFFD4"<?}?>
					<?if($colt>="5" and $colt<="6"){ ?>bgcolor="#FFE4B5"<?}?>
					<?if($colt>="7" and $colt<="8"){ ?>bgcolor="#D8BFD8"<?}?>
					<?if($colt>="9" and $colt<="10"){ ?>bgcolor="#FFF8DC"<?}?>
					>
					<center><img src="image/cand.png" width="88" height="88"></center> 
					</td>
			<? }?>
			<? }?>
			<? }?>
			
	<?  if($lint>=8){?>
		  <?  for($colt = 1; $colt <= 10; $colt++){?>
			
					<? if(($colt==1 or $colt==3 or $colt==5 or $colt==7 or $colt==9)){?>
					<td colspan="2"
					<?if($colt=="1"){ ?>bgcolor="#ADD8E6"<?}?>
					<?if($colt=="3"){ ?>bgcolor="#7FFFD4"<?}?>
					<?if($colt=="5"){ ?>bgcolor="#FFE4B5"<?}?>
					<?if($colt=="7"){ ?>bgcolor="#D8BFD8"<?}?>
					<?if($colt=="9"){ ?>bgcolor="#FFF8DC"<?}?>
					>
					<?if(${"cod$lint$colt"}<>""){
					$sql = "SELECT  bingo_cres  FROM bingo_cand.bingo_tabela WHERE bingo_rodada='$envia_rodada' and bola_num='${"cod$lint$colt"}'";
					$resultado=mysqli_query($con,$sql);	
					while($id_cres = mysqli_fetch_array($resultado)):
					$cres = $id_cres['bingo_cres'];
					endwhile;
						
						
						?>
					<? //echo $refer; echo "="; echo $cres;?>
					<? if($refer==$cres){ ?>
					<center><img  src="image/<? echo ${"cod$lint$colt"};?>.gif" width="88" height="88"></center> 
					<? }else{?>

					<?
					$sql = "SELECT  bingo_seq  FROM bingo_cand.bingo_tabela WHERE bingo_rodada='$envia_rodada' and bola_num='${"cod$lint$colt"}'";
					$resultado=mysqli_query($con,$sql);	
					if($id_cres = mysqli_fetch_array($resultado)):
					$bingo_seq = $id_cres['bingo_seq'];	
					endif;
					?>
					<? if($bingo_seq=='sim'){?>
					<center><img src="image/num_visto/<? echo ${"cod$lint$colt"};?>_v.png"  width="88" height="88"></center> 
					<?}else{?>
					<center><img  src="image/<? echo ${"cod$lint$colt"};?>.png" width="88" height="88"></center> 
					<? }}?>
					
					<? }else{?>
					<center><img src="image/cand.png" width="88" height="88"></center> 
					<? }?>
					</td>
	                <?  }
				 }?>
		<tablet>
			 <td bgcolor="#FFA500">  
			  <div>
			  
		    <? if($isSim == 'true'){ ?>
				<div>A BOLA foi salva com sucesso.</div>
			<? }?>

			<? if($isNao == 'true'){ ?>
				<div> BOLA já foi lançada, tente novamente.</div>
			<? }?>

			<? if($isAtua == 'true'){ ?>
				<div>Erro, Rodada já salva.</div>
			<? }?>

			<? if($isBusca == 'true'){ ?>
				<div>Bola. OK :)</div>
			<? }?>

			<? if($isBusca == 'false'){ ?>
			<div>Bola NÂO ENCONTRADA.</div>
			<? }?>
						
			<? if($isZera == 'true'){ ?>
			<div>ZEROU verificação.</div>
			<? }?>
			</td>  
		
		<td bgcolor="#FFA500">	
		<input class="button" type= "button" onClick="SubmeterSalva_rodada();"  value="Rodada">
		<input name="envia_rodada" id="envia_rodada" maxlength="2" onkeypress="return onlynumber();" type="text" size="1" value="<? echo $envia_rodada;?>">
		</td>
		<td bgcolor="#FFA500">
		<input class="button" type= "button" onClick="SubmeterEnvia_num();" value="Envia">
		<input name="envia_num" maxlength="2" id="envia_num" type="text" size="1" onkeypress="return onlynumber();" value="<? echo $envia_num;?>" <? if($bingo<>1){?> <? }?>>
		<input class="button" type= "button" onClick="SubmeterVoltar();" value="Apagar">
	    </td>
		<td bgcolor="#FFA500">
		<input class="button" type= "button" onClick="SubmeterBusca_bola('<? echo $busca_bola;?>');"  value="Busca">
		<input name="busca_bola" id="busca_bola" maxlength="2" onkeypress="return onlynumber();" type="text" size="1" value="<? echo $busca_bola;?>">
		<input class="button" type= "button" onClick="SubmeterApaga_v();" value="Apaga"/>
	    </td>
		<td bgcolor="#FFA500">
	    <input class="button" type= "button" onClick="SubmeterBingo();" value="Bingooo"/>
        </td>

	</div> 
	</table>

		   
		   <?}?>
	</tr>
	<? }?>
        
 
</table>
    <input type="hidden" name="salva_rodada" >
    <input type="hidden" name="salva_num" >
    <input type="hidden" name="voltar" >
	<input type="hidden" name="bingo" >
	<input type="hidden" name="refer" >
	<input type="hidden" name="bolaponta" >
	<input type="hidden" name="apaga_v" >
		
	</form>

</body>
<? mysqli_close($con); ?>	
</html>
