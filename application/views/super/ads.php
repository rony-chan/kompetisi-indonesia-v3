<?php 
 echo $script2; //script untuk atur class active 
?>
<br/>
<div class="row-fluid">
	<?php $this->load->view('super/menu/sidebar') //load the sidebar ?>
	<div class="col-md-10">		
		<div class="panel panel-default">
			<div class="panel-heading">Ads</div>
			<div class="panel-body">
				<h3>Unread Ads </h3>
				<a href="#" class="btn btn-default">Setup Ads Type</a>
				<div class="tabbable" > <!-- Only required for left/right tabs -->
					<ul class="nav nav-tabs" id="myTab">
						<li id="active"><a href="#">Unread</a></li>
						<li id="waiting"><a href="#">Waiting</a></li>
						<li id="active"><a href="#">Active</a></li>
						<li id="expired"><a href="#">Expired</a></li>
					</ul>
					<br/>
					<div class="tab-content">
						<!--active-->
						<div class="tab-pane active" id="active">							
							<table class="table table-hover">
								<thead>
									<tr>
										<td><strong>No</strong></td>
										<td><strong>Id Req</strong></td>
										<td><strong>Req Date</strong></td>
										<td><strong>By</strong></td>
										<td><strong>Startdate</strong></td>
										<td><strong>Enddate</strong></td>
										<td><strong>Status</strong></td>
										<td><strong>Payment</strong></td>
										<td></td>
									</tr>
								</thead>
								<tbody>
									<td>x</td>
									<td>x</td>
									<td>x</td>
									<td>x</td>
									<td>x</td>
									<td>x</td>
									<td>x</td>
									<td>x</td>
									<td>
										<a class="btn btn-default btn-xs" href="#">view</a>
										<a class="btn btn-default btn-xs" href="#">set banned</a>
									</td>
								</tbody>
							</table>
						</div>
						</br>
						<!-- pagination -->
						</br>
						<!--end of active-->
					</div>
				</div>
			</div>
		</div>



	</div>