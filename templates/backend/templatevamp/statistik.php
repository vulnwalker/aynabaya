<?php get_template('header');?>

<div class="main">
	<div class="main-inner">
		<div class="container">
			<div class="row">

					<div class="span12">
					<div class="widget">
						<div class="widget-header">
							<i class="icon-signal"></i><h3> Visitor Statistik (Grafis Perhari)</h3>
						</div>
						<div class="widget-content">
							<canvas id="area-chart" class="chart-holder" height="250" width="1120"> </canvas>
						</div>
					</div>
					</div>
			</div>

			<div class="row">
				<div class="span7">
					<div class="widget">
						<div class="widget-header">
							<i class="icon-eye-open"></i><h3> Daftar 30 Visitor Terbaru </h3>
						</div>
						<div class="widget-content">
							<table id="tbl-visitor-30" class="table table-striped table-bordered table-statistic">
								<thead>
									<tr>
										<th width="18%">Waktu</th>
										<th width="35%">Visitor</th>
										<th width="5%">System</th>
										<th width="42%">Resource</th>
									</tr>
								</thead>
								<tbody>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<div class="span5">
					<div class="widget">
						<div class="widget-header">
							<i class="icon-time"></i><h3> Statistik Perjam Hari Ini</h3>
						</div>
						<div class="widget-content">
							<table id="tbl-visitor-jam" class="table table-striped table-bordered table-statistic">
								<thead>
									<tr>
										<th width="25%">Time</th>
										<th width="30%">Visitor</th>
										<th width="45%">Chart</th>
									</tr>
								</thead>
								<tbody></tbody>
							</table>
						</div>
					</div>

					<div class="widget">
						<div class="widget-header">
							<i class="icon-calendar"></i><h3> Statistik Perhari</h3>
						</div>
						<div class="widget-content">
							<table id="tbl-visitor-hari" class="table table-striped table-bordered table-statistic">
								<thead>
									<tr>
										<th width="25%">Date</th>
										<th width="30%">Visitor</th>
										<th width="45%">Chart</th>
									</tr>
								</thead>
								<tbody></tbody>
							</table>
						</div>
					</div>


				</div>
			</div>
		<!-- /row --> 
		</div>
	<!-- /container --> 
	</div>
<!-- /main-inner --> 
</div>
<!-- /main -->

<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Visitor Statistik</h3>
  </div>

  <div class="modal-body">
	<ul class="list-group list-statistic">
		<li class="list-group-item"><span class="label-statistic">Tanggal</span> <span class="value-statistic pull-right" id="visitor_date">...</span></li>
		<li class="list-group-item"><span class="label-statistic">ISP</span> <span class="value-statistic pull-right" id="visitor_isp">...</span></li>
		<li class="list-group-item"><span class="label-statistic">Negara</span> <span class="value-statistic pull-right" id="visitor_country">...</span></li>
		<li class="list-group-item"><span class="label-statistic">Provinsi</span> <span class="value-statistic pull-right" id="visitor_region">...</span></li>
		<li class="list-group-item"><span class="label-statistic">Kota</span> <span class="value-statistic pull-right" id="visitor_city">...</span></li>
		<li class="list-group-item"><span class="label-statistic">Referer</span> <span class="value-statistic pull-right" id="visitor_referer">...</span></li>
		<li class="list-group-item"><span class="label-statistic">IP Address</span> <span class="value-statistic pull-right" id="visitor_IP">...</span></li>
		<li class="list-group-item"><span class="label-statistic">Browser</span> <span class="value-statistic pull-right" id="visitor_browser">...</span></li>
		<li class="list-group-item"><span class="label-statistic">OS</span> <span class="value-statistic pull-right" id="visitor_os">...</span></li>
		
	</ul>
  </div>


</div>
<?php get_template('footer');?>
