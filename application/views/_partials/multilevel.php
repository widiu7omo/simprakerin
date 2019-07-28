<?php $levels = $this->session->flashdata('multilevel');
<<<<<<< HEAD
var_dump($levels);
=======
//var_dump($levels);
>>>>>>> 5afebab207b07bf6bf315a9f7d03a7245fb91af8
?>
<form action="<?php echo site_url('login?in=multi') ?>" method="POST">
	<div class="modal fade" id="levelModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
		aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="levelModalLabel">Tampaknya anda memiliki level lebih dari satu</h5>
				</div>
				<div class="modal-body">
					<select class="form-control" name="level">
						<?php foreach($levels as $level): ?>
<<<<<<< HEAD
						<option value='[<?php echo '"'.$level->id.'","'.$level->userpass.'","'.$level->level.'"' ?>]'>
=======
						<option value='[<?php echo '"'.$level->id.'","'.$level->password.'","'.$level->level.'"' ?>]'>
>>>>>>> 5afebab207b07bf6bf315a9f7d03a7245fb91af8
							<?php echo ucfirst($level->level) ?></option>
						<?php endforeach; ?>
					</select>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Login</button>
				</div>
			</div>
		</div>
	</div>
</form>
