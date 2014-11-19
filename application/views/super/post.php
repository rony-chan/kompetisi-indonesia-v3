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
			<div class="panel-heading">Post</div>
			<div class="panel-body">
				<h3>Total : <?php echo $tot?></h3>				
				<div style="padding:10px"><a class="btn btn-default" href="#addpost" data-toggle="modal"> + Tambah Post</a></div>
				<div class="tabbable" > <!-- Only required for left/right tabs -->
					<ul class="nav nav-tabs" id="myTab">
						<li id="active"><a href="<?php echo site_url('super/super/post?act=active')?>">Active</a></li>
						<li id="draft"><a href="<?php echo site_url('super/super/post?act=draft')?>">draft</a></li>
					</ul>
					<br/>
					<div class="tab-content">

						<!--active-->
						<div class="tab-pane active" id="active">
							
							<table class="table table-hover">
								<thead>
									<tr>
										<td><strong>No</strong></td>
										<td><strong>Judul</strong></td>
										<td><strong>Author</strong></td>
										<td><strong>Tgl Buat</strong></td>
										<td><strong>Tgl Edit</strong></td>
										<td></td>
									</tr>
								</thead>
								<tbody>
									<?php 
									$n = 1;
									foreach($view as $v) { ?>
									<tr>
										<td><?php echo $n?></td>
										<td><?php echo $v['title']?></td>
										<td><?php echo $v['author']?></td>
										<td><?php echo $v['tgl_buat']?></td>
										<td><?php echo $v['tgl_edit']?></td>
										<td>
											<?php
												//encode id as url
											$enc = base64_encode(base64_encode($v['id']));
											$id = str_replace('=', '', $enc);
												//judul post
											$judul = str_replace(' ', '_', $v['title'])
											?>
											<a class="btn btn-xs btn-default" title="edit" href="<?php echo site_url('super/super/edit_post?id='.$v['id'])?>"><span class="glyphicon glyphicon-pencil"></span></a> 
											<a class="btn btn-xs btn-default" title="delete" href="<?php echo site_url('super/super/delete_post?id='.$v['id'])?>"><span class="glyphicon glyphicon-trash"></span></a>
											<a target="_blank" class="btn btn-xs btn-default" title="view" href="<?php echo site_url('publik/read/'.$id.'/'.$judul)?>"><span class="glyphicon glyphicon-chevron-right"></span></a>
										</td>
									</tr>
									<?php $n++; } ?>
								</tbody>
							</table>
						</br>
						<div style="padding:10px; border:2px solid #E6E6E6; font-size:15px"><center><?php echo $page ?> </center></div>
						</br>
				</div>
				<!--end of active-->

				

				<!--start modal-->
				<div class="modal fade" id="addpost" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								<h4 class="modal-title">Add Post</h4>
							</div>
							<div class="modal-body">
								<form method="POST" action="<?php echo site_url('super/super/add_post')?>">
									<div class="form-group">
										<label for="exampleInputEmail1">Judul</label>
										<input name="title" type="text" class="form-control" id="exampleInputEmail1" required>
									</div>
									<div class="form-group">
										<label for="exampleInputEmail1">News</label>
										<textarea name="content" type="text" rows="10" class="form-control" id="exampleInputEmail1" required></textarea>
									</div>



								</div>
								<div class="modal-footer">
									<button type="submit" name="btn_post" class="btn btn-default">Post</button>								
									<button type="submit" name="btn_draft" class="btn btn-default">Draft</button>
								</div>
							</form>

						</div><!-- /.modal-content -->
					</div><!-- /.modal-dialog -->
				</div><!-- /.modal -->
				<!--end of modal-->


			</div>
		</div>
	</div>
</div>



</div>