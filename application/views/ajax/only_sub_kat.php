<div class="form-group">
	<label for="subkategori" class="col-lg-2 control-label">*Sub Kategori</label>
	<div class="col-lg-10">
		<select name="subkategori" class="form-control" id="subkategori" required>
			<?php foreach ($sub_kat as $sk) { ?>
			<option value="<?php echo $sk['id_sub_kat']?>" ><?php echo $sk['sub_kat']?></option>
			<?php } ?>
		</select>
	</div>
</div>