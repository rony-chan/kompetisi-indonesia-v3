<br/>
<div class="row-fluid">
	<div class="col-md-2">
		<h3>Edit Post</h3>	
	</div>
	<div class="col-md-5">
		<form method="post" action="<?php echo site_url('super/super/btn_edit_post')?>" role="form">
			<input type="hidden" name="id" value="<?php echo $post['id'] ?>">
			<div class="form-group">
				<label for="exampleInputEmail1">Judul</label>
				<input name="title" type="text" class="form-control" id="exampleInputEmail1" value="<?php echo $post['title'] ?>" placeholder="Enter email">
			</div>
			<div class="form-group">
				<label for="exampleInputPassword1">Konten</label>
				<textarea name="content" rows="5" class="form-control" id="exampleInputPassword1" placeholder="Password">
					<?php echo $post['content'] ?>
				</textarea>
			</div>
			<hr/>
			<button type="submit" name="btn_post" class="btn btn-default">Post</button>								
			<button type="submit" name="btn_draft" class="btn btn-default">Draft</button>
		</form>
	</div>
</div>