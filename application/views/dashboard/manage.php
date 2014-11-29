<script type="text/javascript">
	function cekUser(){
		$('#alertnote').hide();
		$('#successnote').hide();
		username = $('#inputUsername').val();
		if(username == ''){ //jika username kosong
			
		} else {
			//cek di database
			$.ajax({
				url:'<?php echo site_url("ajax/cekUsername");?>',
				data:{username:username},
				success:function(){ //username tersedia di database
					$('#successnote').html('username tersedia');
					$('#successnote').show();
					$('#alertnote').hide();
				},
				error:function(){ //username tidak tersedia didatabase
					$('#alertnote').html('username tidak tersedia');
					$('#alertnote').show();
					$('#successnote').hide();
				}
			});
		}
	}
</script>
<br/>
</h3>
<div class="container">
	<div class="row">
		<center><h3 style="text-transform:uppercase" class="kompetisi-detail"><?php echo $this->session->userdata('username')?> dasbor</h3></center>
		<div class="col-md-2">
			<?php $this->load->view('dashboard/menu');?>
		</div>

		<div style="background-color:#fff" class="col-md-10">
			<h3>Manage : <?php echo $kompetisi['judul_kompetisi'];?> <a class="btn btn-default btn-xs" title="edit kompetisi" href="<?php echo site_url('dashboard/edit?id='.$_GET['id'])?>"><span class="glyphicon glyphicon-pencil"></span></a></h3>
			<p><strong>Deadline : </strong> 230 hari lagi</p>
			<p><strong>Pengumuman : </strong> 237 hari lagi</p>
			<hr/>
			<?php $this->load->view('dashboard/topmenu_manage')?>

			<div style="padding:10px" class="tab-content">
				<div class="tab-pane active" id="home">
					<?php if(isset($_GET['act'])){
						switch ($_GET['act']) {
							case 'komentar':
							echo '<h4>Komentar Sebagai CH</h4>';
							echo '<form action="'.site_url('kompetisi/add_komentar').'" method="POST" class="form">
									<textarea name="input_komentar" style="width:100%" class="form-control" placeholder="ada pertanyaan masukan disini"></textarea>
									<input type="hidden" name="id_kompetisi" value="'.$_GET['id'].'">
									<button style="margin-top:5px;float-right"  class="btn btn-default" type="submit" >Komentar</button>
								</form>';
							echo '<div class="col-md-12"><table class="table">';
							echo '<tr><th>Tanggal</th><th>Username</th><th>Komentar</th><th>Status</th><th></th></tr>';
							foreach($komentar as $komen):
								echo '<tr>';
								echo '<td>'.$komen['waktu'].'</td>';
								echo '<td><a target="_blank" href="'.site_url('publik/profile/'.$komen['username']).'">'.$komen['username'].'</a></td>';
								echo '<td>'.$komen['komentar'].'</td>';
								echo '<td>'.$komen['status'].'</td>';
								echo '<td><a class="btn btn-default btn-xs" href="#">banned</a></td>';
								echo '</tr>';
							endforeach;
							echo '</table></div>';
							break;

							case 'unverify':
							echo ' <div class="col-md-5">
							<form class="form" method="GET" action="'.site_url('dashboard/do_verifikasi').'">
								<div class="input-group">								      
									<input name="username" id="inputUsername" onkeyup="cekUser()" type="text" class="form-control" placeholder="verfikasi username">
									<input type="hidden" name="id" value="'.$_GET['id'].'">
									<span class="input-group-btn">
										<button class="btn btn-default" type="submit">verifikasi</button>
									</span>								      
								</div>
							</form>
							<div style="display:none" id="alertnote" class="alert alert-danger">  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div>
							<div style="display:none" id="successnote" class="alert alert-success">  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div>
						</div><br/><br/><br/>';
						echo '<table class="col-md-12 table table-striped">';
						echo '<tr><th>username</th><th>Nama</th><th>Email</th><th><Kelamin/th><th></th></tr>';
						foreach($unverified as $u):
							echo '<tr><td>'.$u['username'].'</td><td>'.$u['name'].'</td><td>'.$u['email'].'</td><td><Kelamin/td><td><a href="'.site_url('dashboard/do_verifikasi?id='.$_GET['id']).'&username='.$u['username'].'" title="verifikasi peserta" class="btn btn-xs btn-default">Verifikasi</a></td></tr>';
						endforeach;
						echo '</table>';
						break;

						case 'verified':
						echo ' <div class="col-md-5">
						<form class="form" method="GET" action="'.site_url('dashboard/undo_verifikasi').'">
							<div class="input-group">								      
								<input name="username" id="inputUsername" onkeyup="cekUser()" type="text" class="form-control" placeholder="verfikasi username">
								<input type="hidden" name="id" value="'.$_GET['id'].'">
								<span class="input-group-btn">
									<button class="btn btn-default" type="submit">unverifikasi</button>
								</span>								      
							</div>
						</form>
						<div style="display:none" id="alertnote" class="alert alert-danger">  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div>
						<div style="display:none" id="successnote" class="alert alert-success">  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div>
					</div><br/><br/><br/>';
					echo '<table class="table table-striped">';
					echo '<tr><th>username</th><th>Nama</th><th>Email</th><th><Kelamin/th><th></th></tr>';
					foreach($verified as $u):
						echo '<tr><td>'.$u['username'].'</td><td>'.$u['name'].'</td><td>'.$u['email'].'</td><td><Kelamin/td><td><a href="'.site_url('dashboard/undo_verifikasi?id='.$_GET['id']).'&username='.$u['username'].'" title="batal verifikasi peserta" class="btn btn-xs btn-default">Batal Verifikasi</a></td></tr>';
					endforeach;
					echo '</table>';
					break;

					case 'winner':
					if(!empty($_GET['note'])){
						echo '<div class="alert alert-danger">  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$_GET['note'].'</div>';
					}
					if(!empty($_GET['act'] && $_GET['act'] == 'edit')) { //edit kompetisi
						echo 'fitur belum tersedia';
					} else {
						echo ' <div>
						<form class="form form-inline" method="POST" action="'.site_url('dashboard/proc_winner?act=add').'">
							<div class="form-group">
								<label class="sr-only" for="exampleInputEmail2">username</label>
								<input name="username" id="inputUsername" onkeyup="cekUser()" type="text" class="form-control" placeholder="verfikasi username">

							</div>
							<div class="form-group">
								<label class="sr-only" for="exampleInputEmail2">username</label>
								<input name="detail" type="text" class="form-control" placeholder="deskripsi juara ...">

							</div>
							<div class="form-group">
								<label class="sr-only" for="exampleInputEmail2">username</label>
								<input name="hadiah" type="number" class="form-control" placeholder="hadiah (Rp) tanpa koma">

							</div>
							<div class="form-group">
								<button class="btn btn-default" type="submit">+ Pemenang</button>
							</div>
							<div class="input-group">								      
								<input type="hidden" name="id" value="'.$_GET['id'].'">

							</div>
						</form>
						<div style="display:none" id="alertnote" class="alert alert-danger">  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div>
						<div style="display:none" id="successnote" class="alert alert-success">  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div>
					</div>
					<br/>';
				} //end of else edit
				echo '
				<table class="table table-striped">
					<tr>
						<th>Username</th>
						<th>Juara</th>
						<th>Hadiah</th>
						<th></th>
					</tr>';
					foreach($winner as $w):
						echo '
					<tr>
						<td>'.$w['username'].'</td>
						<td>'.$w['detail'].'</td>
						<td>Rp'.number_format($w['hadiah']).',-</td>
						<td><div class="btn-group"><!--<a title="edit data pemenang" href="'.site_url('dashboard/proc_winner?act=edit&username='.$w['username'].'&id='.$_GET['id']).'" class="btn btn-xs btn-default">edit</a>--><a onclick="return confirm(\'Anda yakin !\')" title="hapus data pemenang" href="'.site_url('dashboard/proc_winner?act=delete&username='.$w['username'].'&id='.$_GET['id']).'" class="btn btn-xs btn-default">hapus</a></div></td>
					</tr>
					';
					endforeach;
					echo'</table>';
					break;

					
				}
				?>
				<?php } else {?>
				<div class="col-md-2"><img style="width:100%" src="<?php echo base_url('images/poster/'.$kompetisi['poster'])?>"/></div>
				<div class="col-md-5">
					<h4>Spesifikasi</h4>
					<hr/>
					<p><strong>Deadline : </strong> <?php echo date('d-m-Y',strtotime($kompetisi['deadline']));?></p>
					<p><strong>Pengumuman : </strong> <?php echo date('d-m-Y',strtotime($kompetisi['pengumuman']));?></p>
					<p><strong>Hadiah :</strong> <?php echo $kompetisi['hadiah'];?></p>
					<hr/>
				</div>
				<div class="col-md-5">
					<h4>Syarat dan Ketentuan</h4>
					<hr/>
					<?php echo $kompetisi['konten'];?>
					<hr/>
				</div>
				<?php }?>
				<br/>
			</div>

		</div>
		<br/>
	</div>


</div>
</div>
<br/>