﻿<?php
	require_once('../../config.php');
	require_once('../../functions.php');
	$con = new DBConnection();
	verificaLogin(); getData();
?>
<script>
$(document).ready(function(){
	$(".up").keyup(function() {
		$(this).val($(this).val().toUpperCase());
	});
});
</script>
<?php
if(@$ac == 'update') {
	try {
		$query = $con->query("UPDATE `notas_cat_e` SET `descricao`='$descricao', `oculto`='$status' WHERE id = '$id'");
	}
	catch( PDOException $e ){
		echo '<p class="text-danger">Algo aconteceu de errado!</p>'; 
	}
	echo '<p class="text-success">Informações atualizadas com sucesso!</p>';
	exit;
}

?>

<div class="retorno"></div>
<form action="javascript:void(0)" onsubmit='post(this,"gestor/editar-categoria-eqp.php?ac=update&id=<?php echo $id ?>",".retorno")'>
	<?php
		$stm2 = $con->query("select * from notas_cat_e where id = '$id'");
		while($c = $stm2->fetch()){ extract($c); ?>
		<label style="width:100%">Descrição:
			<input type="text" name="descricao" value="<?php echo $descricao; ?>" class="form-control input-sm up" size="100" required/>
		</label>
		<label style="width:100%">Status:
			<select name="status" class="form-control" style="width:100%">
				<?php 
				if($oculto == '0'){ 
					echo '<option value="0" selected>ATIVO</option>';
					echo '<option value="1">INATIVO</option>';
				}else if($oculto == '1'){
					echo '<option value="0">ATIVO</option>';
					echo '<option value="1" selected>INATIVO</option>';
				}
				?>
			</select>
		</label>
		<label style="width:100%; text-align:center"><br/>
			<input type="submit" value="Salvar"  style="width:50%" class="btn btn-success btn-sm"/>
		</label>
		<?php } ?>
</form>
