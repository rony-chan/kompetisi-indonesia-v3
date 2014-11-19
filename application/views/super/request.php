<?php 
if(isset($script2) && isset($script)) {
 echo $script2; //script untuk atur class active
 echo $script; //script untuk atur class active
}
?>

<br/>
<div class="row-fluid">
	<?php $this->load->view('super/menu/sidebar') //load the sidebar ?>
	<div class="col-md-10">

		<div class="panel panel-default">
			<div class="panel-heading">Request : Kompetisi</div>
			<div class="panel-body">

				<div class="tabbable" > <!-- Only required for left/right tabs -->
					<ul class="nav nav-tabs" id="myTab">
						<li id="tunggu"><a href="<?php echo site_url('super/super/request?act=menunggu')?>">Menununggu</a></li>
						<li id="terima"><a href="<?php echo site_url('super/super/request?act=diterima')?>">Diterima</a></li>
						<li id="tolak"><a href="<?php echo site_url('super/super/request?act=ditolak')?>">Ditolak</a></li>
					</ul>
					<br/>
					<div class="tab-content">

						<!--menunggu-->
						<div class="tab-pane active" id="menunggu">
							<h3>Total : <?php echo $tot ?></h3>
							<table class="table table-hover">
								<thead>
									<tr>
										<td><strong>No</strong></td>
										<td><strong>Username</strong></td>
										<td><strong>Judul</strong></td>
										<td><strong>Penyelenggara</strong></td>
										<td><strong>Tgl Buat</strong></td>
										<td><strong>Tgl Edit</strong></td>
										<td><strong>Main Kategori</strong></td>
										<td><strong>Sub Kategori</strong></td>
										<td><strong>Sumber</strong></td>
										<td><strong>Status</strong></td>
										<td style="width:100px"></td>
									</tr>
								</thead>
								<tbody>
									<?php 
									$n = 1;
									foreach($view as $v) {
									$judul = $v['judul_kompetisi']; 
									$enc = base64_encode(base64_encode($v['id_kompetisi']));
									$id = str_replace('=', '', $enc);
									?>
									<tr>
										<td><?php echo $n ?></td>
										<td><?php echo $v['username'] ?></td>
										<td><?php echo $v['judul_kompetisi'] ?></td>
										<td><?php echo $v['penyelenggara'] ?></td>
										<td><?php echo $v['tgl_buat'] ?></td>
										<td><?php echo $v['tgl_edit'] ?></td>
										<td><?php echo $v['main_kat'] ?></td>
										<td><?php echo $v['sub_kat'] ?></td>
										<td><?php echo $v['sumber'] ?></td>
										<td><?php echo $v['status_kompetisi'] ?></td>
										<td>
											<div class="btn-group">
											<a title="accept" class="btn btn-xs btn-default" href="<?php echo site_url('super/super/btn_accept_kompetisi?id='.$v['id_kompetisi'])?>"><span class="glyphicon glyphicon-ok-circle"></span></a>
											<a title="reject" class="btn btn-xs btn-default" href="<?php echo site_url('super/super/btn_reject_kompetisi?id='.$v['id_kompetisi'])?>"><span class="glyphicon glyphicon-remove-circle"></span></a>
											<a href="<?php echo site_url().'/kompetisi/detail/'.$id.'/'.$judul; ?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-chevron-right"></span></a>
											</div>
										</td>
									</tr>
									<?php  $n++; } ?>
								</tbody>
							</table>
							</br>
							<div style="padding:10px; border:2px solid #E6E6E6; font-size:15px"><center><?php echo $page ?> </center></div>
							</br>
						</div>
						<!--end of menunggu-->
					</div>
				</div>
			</div>
		</div>



	</div>