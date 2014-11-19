<script type="text/javascript">
	$(window).scroll(function() {    
		if($(window).scrollTop() > 55) {
			//$("#afterscroll").show();
			$("#base-heading").hide();
			$("#ki-logo").show();
			$("#beforescroll").addClass('fixed-miniheader');
		//scroll to load more
		} else { //not scrolling
			//$("#afterscroll").hide();
			$("#base-heading").show();
			$("#ki-logo").hide();
			$("#beforescroll").removeClass('fixed-miniheader');
		}
		//load more competition
		if($(window).scrollTop() >= $(document).height() - $(window).height() - 200) {
	      q = $('#keyword').val();//keyword
	      cat = $('#cat').val();//value
	      if(q == '' && cat == 0){ //no search and sort
	      	more_competition();//load more competition
	      } else {
	      	searchKompetisi_more(q,cat);//
	      }	      
	  } 
	});

	$(document).ready(function(){
		$('#loader').show();
		lattestCompetition();
	});

	function lattestCompetition(){ //lattest 10 competition
		$('#loader').show();	
		$.ajax({
			url:'<?php echo site_url('json/jelajah');?>',
			dataType:'json',
			timeout:10000,//1000ms
			data:{act:'terbaru'},
			success:function(data){
				jelajah = '';
				$.each(data, function(i,n){
					jelajah='<tr id="'+n['id']+'">'+
					'<td>'+
					'<p style="font-size:18px"><a class="title" data-toggle="tooltip" title="Kompetisi indonesia" href="'+n['link']+'">'+n['judul']+'</a></p>'+
					'<p>'+n['sortdesc']+'</p>'+
					'<p class="jelajah-detail">Penyelenggara '+n['penyelenggara']+' / '+n['mainkat']+'  / oleh <a href="'+n['authorlink']+'">'+n['oleh']+'</p>'+
					'</td>'+
					'<td style="width:100px">'+
					'<center style="margin-top:20px">'+
					'<p class="jelajah-detail jelajah-ikon" class="value_hadiahtotal"><span class="glyphicon glyphicon-calendar"></span></p>'+
					'<p class="value_total jelajah-value">'+
					n['deadline']+
					'</p>'+
					'</center>'+
					'</td>'+
					'<td style="width:100px">'+
					'<center style="margin-top:20px">'+
					'<p class="jelajah-detail jelajah-ikon" class="value_hadiahtotal"><span class="glyphicon glyphicon-eye-open"></span></p>'+
					'<p class="jelajah-value">'+n['views']+'</p></center>'+
					'</td>'+
					'<td style="width:100px">'+
					'<center style="margin-top:20px">'+
					'<p class="jelajah-detail jelajah-ikon" class="value_hadiahtotal">Rp</p>'+
					'<p class="jelajah-value">'+
					n['total']+
					'</center>'+
					'</td>'+
					'<td>'+
					'<a href="'+n['link']+'" style="margin-top:30px" type="button" class="btn btn-default"><span class="glyphicon glyphicon-chevron-right"></span></a>'+
					'</td>'+
					'</tr>';
					jelajah = jelajah+'';
					$('#content-jelajah').append(jelajah);
					$('#loader').hide();
				});
			},
			error:function(){
				$('#content-jelajah').append('<div class="alert alert-warning fade in">'+
					'<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>'+
					'Tidak ada kompetisi lagi <strong><a href="<?php echo site_url("jelajah")?>">jelajah</a></strong>.'+
					'</div>');
				$('#loader').hide();
			}
			});
	}

	function more_competition(){//load more 10 competitions
		$('#loader').show();	
		lastid = $('#content-jelajah tbody tr').last().attr('id');//get last id
		$.ajax({
			url:'<?php echo site_url('json/jelajah');?>',
			dataType:'json',
			timeout:10000,//1000ms
			data:{act:'more',lastid:lastid},
			success:function(data){
				jelajah = '';
				$.each(data, function(i,n){
					jelajah='<tr id="'+n['id']+'">'+
					'<td>'+
					'<p style="font-size:18px"><a class="title" data-toggle="tooltip" title="Kompetisi indonesia" href="'+n['link']+'">'+n['judul']+'</a></p>'+
					'<p>'+n['sortdesc']+'</p>'+
					'<p class="jelajah-detail">Penyelenggara '+n['penyelenggara']+' / '+n['mainkat']+'  / oleh <a href="'+n['authorlink']+'">'+n['oleh']+'</p>'+
					'</td>'+
					'<td style="width:100px">'+
					'<center style="margin-top:20px">'+
					'<p class="jelajah-detail jelajah-ikon" class="value_hadiahtotal"><span class="glyphicon glyphicon-calendar"></span></p>'+
					'<p class="value_total jelajah-value">'+
					n['deadline']+
					'</p>'+
					'</center>'+
					'</td>'+
					'<td style="width:100px">'+
					'<center style="margin-top:20px">'+
					'<p class="jelajah-detail jelajah-ikon" class="value_hadiahtotal"><span class="glyphicon glyphicon-eye-open"></span></p>'+
					'<p class="jelajah-value">'+n['views']+'</p></center>'+
					'</td>'+
					'<td style="width:100px">'+
					'<center style="margin-top:20px">'+
					'<p class="jelajah-detail jelajah-ikon" class="value_hadiahtotal">Rp</p>'+
					'<p class="jelajah-value">'+
					n['total']+
					'</center>'+
					'</td>'+
					'<td>'+
					'<a href="'+n['link']+'" style="margin-top:30px" type="button" class="btn btn-default"><span class="glyphicon glyphicon-chevron-right"></span></a>'+
					'</td>'+
					'</tr>';
					jelajah = jelajah+'';
					$('#content-jelajah').append(jelajah);
					$('#loader').hide();
				});
},
error:function(){
			//alert('gagal load kompetisi');
		}
	});
}

	function searchKompetisi(){ //search and sort competition
		$('#top-loader').show();
		keyword = $('#keyword').val();
		cat = $('#cat').val();
		$('#content-jelajah').html('');//mengkosongkan content jelajah	
		$.ajax({
			url:'<?php echo site_url('json/jelajah');?>',
			dataType:'json',
			timeout:10000,//1000ms
			data:{act:'search',q:keyword,cat:cat},
			success:function(data){
				jelajah = '';
				$.each(data, function(i,n){
					jelajah='<tr id="'+n['id']+'">'+
					'<td>'+
					'<p style="font-size:18px"><a class="title" data-toggle="tooltip" title="Kompetisi indonesia" href="'+n['link']+'">'+n['judul']+'</a></p>'+
					'<p>'+n['sortdesc']+'</p>'+
					'<p class="jelajah-detail">Penyelenggara '+n['penyelenggara']+' / '+n['mainkat']+'  / oleh <a href="'+n['authorlink']+'">'+n['oleh']+'</p>'+
					'</td>'+
					'<td style="width:100px">'+
					'<center style="margin-top:20px">'+
					'<p class="jelajah-detail jelajah-ikon" class="value_hadiahtotal"><span class="glyphicon glyphicon-calendar"></span></p>'+
					'<p class="value_total jelajah-value">'+
					n['deadline']+
					'</p>'+
					'</center>'+
					'</td>'+
					'<td style="width:100px">'+
					'<center style="margin-top:20px">'+
					'<p class="jelajah-detail jelajah-ikon" class="value_hadiahtotal"><span class="glyphicon glyphicon-eye-open"></span></p>'+
					'<p class="jelajah-value">'+n['views']+'</p></center>'+
					'</td>'+
					'<td style="width:100px">'+
					'<center style="margin-top:20px">'+
					'<p class="jelajah-detail jelajah-ikon" class="value_hadiahtotal">Rp</p>'+
					'<p class="jelajah-value">'+
					n['total']+
					'</center>'+
					'</td>'+
					'<td>'+
					'<a href="'+n['link']+'" style="margin-top:30px" type="button" class="btn btn-default"><span class="glyphicon glyphicon-chevron-right"></span></a>'+
					'</td>'+
					'</tr>';
					jelajah = jelajah+'';
					$('#content-jelajah').append(jelajah);
					$('#top-loader').hide();
				});
},
error:function(){

}
});
}

	function searchKompetisi_more(x,y){ //search and sort competition more
		//x = keyword | y = cat
		$('#loader').show();
		lastid = $('#content-jelajah tbody tr').last().attr('id');//get last id
		keyword = $('#keyword').val();
		cat = $('#cat').val();
		$.ajax({
			url:'<?php echo site_url('json/jelajah');?>',
			dataType:'json',
			timeout:10000,//1000ms
			data:{act:'searchmore',q:x,cat:y,lastid:lastid},
			success:function(data){
				jelajah = '';
				$.each(data, function(i,n){
					jelajah='<tr id="'+n['id']+'">'+
					'<td>'+
					'<p style="font-size:18px"><a class="title" data-toggle="tooltip" title="Kompetisi indonesia" href="'+n['link']+'">'+n['judul']+'</a></p>'+
					'<p>'+n['sortdesc']+'</p>'+
					'<p class="jelajah-detail">Penyelenggara '+n['penyelenggara']+' / '+n['mainkat']+'  / oleh <a href="'+n['authorlink']+'">'+n['oleh']+'</p>'+
					'</td>'+
					'<td style="width:100px">'+
					'<center style="margin-top:20px">'+
					'<p class="jelajah-detail jelajah-ikon" class="value_hadiahtotal"><span class="glyphicon glyphicon-calendar"></span></p>'+
					'<p class="value_total jelajah-value">'+
					n['deadline']+
					'</p>'+
					'</center>'+
					'</td>'+
					'<td style="width:100px">'+
					'<center style="margin-top:20px">'+
					'<p class="jelajah-detail jelajah-ikon" class="value_hadiahtotal"><span class="glyphicon glyphicon-eye-open"></span></p>'+
					'<p class="jelajah-value">'+n['views']+'</p></center>'+
					'</td>'+
					'<td style="width:100px">'+
					'<center style="margin-top:20px">'+
					'<p class="jelajah-detail jelajah-ikon" class="value_hadiahtotal">Rp</p>'+
					'<p class="jelajah-value">'+
					n['total']+
					'</center>'+
					'</td>'+
					'<td>'+
					'<a href="'+n['link']+'" style="margin-top:30px" type="button" class="btn btn-default"><span class="glyphicon glyphicon-chevron-right"></span></a>'+
					'</td>'+
					'</tr>';
					jelajah = jelajah+'';
					$('#content-jelajah').append(jelajah);
					$('#loader').hide();
				});
},
error:function(){
	$('#content-jelajah').append('<tr><div class="alert alert-warning fade in">'+
		'<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>'+
		'Kompetisi tidak ditemukan, kembali ke <strong><a href="<?php echo site_url("jelajah")?>">jelajah</a></strong>.'+
		'</div></tr>');
}
});

}
</script>

<section id="beforescroll" class="mini-header">
	<div class="container">
		<div class="row">
			<a style="display:none" id="ki-logo" href="<?php echo site_url();?>"><img class="small-icon" style="float:left" alt="kompetisi indonesia small icon" src="<?php echo base_url('images/icon/ki-small-icon.png')?>"></a>
			<div class="md-col-12">
				<div class="row">
					<div id="sort-kompetisi" class="form-inline">
						<div class="col-lg-5">
							<div class="form-group">						
								<input id="keyword" type="text" class="input-sm form-control" value="<?php if(isset($_GET['q'])) echo $_GET['q'];//jika set pencarian ?>"  placeholder="Cari Kompetisi">					
							</div>
							<div class="form-group">
								<select id="cat" class="input-sm form-control">
									<option value="0">Semua Kategori</option>
									<?php foreach ($kategori as $kat) { ?>
									<option value="<?php echo $kat['id_main_kat']?>"><?php echo $kat['main_kat']?></option>
									<?php } ?>
								</select>
							</div>			
							<div class="form-group">
								<button onclick="searchKompetisi()" class="input-sm form-control btn btn-default" >Cari</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	

	<div class="container">
		<div class="col-md-12">
			<br/>
			<div class="ms-col-12">
				<table style="display:none;background-color:#fff" id="top-loader" class="list-kompetisi table table-hover">
					<tr style="background-color: rgb(245, 245, 245);padding: 10px;">
						<td colspan="5">
							<center style="color: rgb(177, 170, 170);">
								<img src="<?php echo base_url('dist/ajax-loader.gif')?>"/> load content
							</center>
						</td>			 		
					</tr>
				</table>
				<table id="content-jelajah" style="background-color:#fff" id="list" class="list-kompetisi table table-hover">
				</table>
				<table style="display:none;background-color:#fff" id="loader" class="list-kompetisi table table-hover">
					<tr style="background-color: rgb(245, 245, 245);padding: 10px;">
						<td colspan="5">
							<center style="color: rgb(177, 170, 170);">
								<img src="<?php echo base_url('dist/ajax-loader.gif')?>"/> load content
							</center>
						</td>			 		
					</tr>
				</table>

			</div>

		</div> <!--end of coll md-->
	</div>

	<a style="color:#fff" href="#">
		<div class="back-to-top">
			<h3><span class="glyphicon glyphicon-chevron-up"></span></h3>
		</div>
	</a>