<?php include(TEMPLATE_PATH."/header.php"); ?>

<div class='row'>
	<div class="col-lg-6">
		<div class='alert alert-info'>
			Recente artikelen
		</div>

		<table class='table table-hover'>
			<thead>
				<tr>
					<th class='col-lg-1'>#</th>
					<th class='col-lg-10'>Titel</th>
					<th class='col-lg-1'>Links</th>
				</tr>
			</thead>

			<tbody>
				<?php foreach($recent as $article) { ?>
					<tr>
						<td class='col-lg-1'><span class="label label-danger"><?php echo $article['decorrespondent_id']; ?></span></td>
						<td class='col-lg-10'><a href='/article/<?php echo($article['decorrespondent_id']); ?>'><?php echo explode("/", $article['url'])[4]; ?></a></td>
						<td class='col-lg-1'><span class='badge pull-right'><?php echo($article['count']); ?></span></td>
					</tr>
				<?php } ?>
			</thead>
		</table>
	</div>

	<div class="col-lg-6">
		<div class='alert alert-info'>
			Meest populaire artikelen
		</div>	

		<table class='table table-hover'>
			<thead>
				<tr>
					<th class='col-lg-1'>#</th>
					<th class='col-lg-10'>Titel</th>
					<th class='col-lg-1'>Links</th>
				</tr>
			</thead>

			<tbody>
				<?php foreach($populair as $article) { ?>
					<tr>
						<td class='col-lg-1'><span class="label label-danger"><?php echo $article['decorrespondent_id']; ?></span></td>
						<td class='col-lg-10'><a href='/article/<?php echo($article['decorrespondent_id']); ?>'><?php echo explode("/", $article['url'])[4]; ?></a></td>
						<td class='col-lg-1'><span class='badge pull-right'><?php echo($article['count']); ?></span></td>
					</tr>
				<?php } ?>
			</thead>
		</table>
	</div>
</div>

<?php include(TEMPLATE_PATH."/footer.php"); ?>
