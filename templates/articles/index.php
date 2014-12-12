<?php include(TEMPLATE_PATH."/header.php"); ?>

<div class='row'> 
	<div class='col-lg-12'>
		<div class='alert alert-info'>
			Artikelen<span class="badge pull-right"><?php echo $pages->rowCount(); ?></span>
		</div>	
	</div>

 	<div class="col-lg-12">
		<table class='table table-hover'>
			<thead>
				<tr>
					<th class='col-lg-1'>#</th>
					<th class='col-lg-10'>Titel</th>
					<th class='col-lg-1'>Links</th>
				</tr>
			</thead>

			<tbody>
				<?php foreach($articles as $article) { ?>
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

<div>
	<ul class="pager">
		<?php if($page_info['prev_page'] >= 1) { ?>
			<li class="previous"><a href="/article/page/<?php echo $page_info['prev_page'] ?>">Nieuwer</a></li>
		<?php } ?>

		<?php if($page_info['next_page'] <= $page_info['max_pages']) { ?>
	  		<li class="next"><a href="/article/page/<?php echo $page_info['next_page'] ?>">Ouder</a></li>
	  	<?php } ?>
	</ul>
</div>

<?php include(TEMPLATE_PATH."/footer.php"); ?>