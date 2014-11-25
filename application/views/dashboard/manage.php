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
								# code...
								break;

							case 'unverify':
								# code...
								break;

							case 'verified':
								# code...
								break;

							case 'winner':
								# code...
								break;
							
							default:
								redirect(site_url('dashboard/manage'));//kembali ke dashboard sayas
								break;
						}
					?>
					<?php } else {?>
						<div class="col-md-2"><img style="width:100%" src="#"></div>
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