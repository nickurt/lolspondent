<?php include(TEMPLATE_PATH."/header.php"); ?>

<div class='row'>
	<div class='col-lg-12'>
		<div class='alert alert-info'>
			Links<span class="badge pull-right"><?php echo count($links->rowCount()); ?></span>
		</div>	
	</div>

 	<div class="col-lg-12">
		<ul class='list-unstyled'>
			<?php foreach($links as $link) { ?>
				<li>
					<a target='_blank' href='<?php echo $link['url']; ?>'>
						<?php echo $link['url']; ?>
					</a>

					<span class='label label-success pull-right'>
						<?php echo $link['hash']; ?>
					</span>
				</li>
			<?php } ?>
		</ul>
	</div>
</div>

<?php include(TEMPLATE_PATH."/footer.php"); ?>