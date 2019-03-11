<div class="left
	<?php if ($page === 1 || $page === 2 || $page === 3 || $page === 4 || $page === 6) {?> col-md-3 <?php } ?>
	<?php if ($page === 5) {?> col-md-2 <?php } ?>
	"
	style="
	position: relative;
	display: inline-block;
	height: 100%;
	padding: 0;
	margin: 0;
	vertical-align: top;
	">
	<div class="table-wrapper" style="
		display: table;
		position: absolute;
		top: 0;
		right: 0;
		height: 100%;
		width: 100%;
	">
		<div class="table-cell-wrapper" style="
			display: table-cell;
			vertical-align: middle;
			<?php if ($page === 2 || $page === 3 || $page === 4 || $page === 5 || $page === 6) {?> padding-left: 27pt; <?php } ?>
		">
			<div class="text" style="
				font-size: 20pt;
				line-height: 24pt;
				font-weight: 500;
				color: #58667B;
				padding: 0;
				margin: 0;
			">
				<?php if ($page === 1) {?> We simply respect <?php } ?>
				<?php if ($page === 2) {?> All room <?php } ?>
				<?php if ($page === 3) {?> Press <?php } ?>
				<?php if ($page === 4) {?> Our valued <?php } ?>
				<?php if ($page === 5) {?> Our sister <?php } ?>
				<?php if ($page === 6) {?> Have a visit <?php } ?>
			</div>
			<div class="text" style="
				font-size: 20pt;
				line-height: 24pt;
				font-weight: 500;
				color: #58667B;
				padding: 0;
				margin: 0 0 30pt 0;
			">
				<?php if ($page === 1) {?> what makes us unique<span class="dot">.</span> <?php } ?>
				<?php if ($page === 2) {?> One Solution<span class="dot">.</span> <?php } ?>
				<?php if ($page === 3) {?> and reviews<span class="dot">.</span> <?php } ?>
				<?php if ($page === 4) {?> Clients<span class="dot">.</span> <?php } ?>
				<?php if ($page === 5) {?> concerns<span class="dot">.</span> <?php } ?>
				<?php if ($page === 6) {?> to our store<span class="dot">.</span> <?php } ?>
			</div>
			<?php if ($page === 1 || $page === 6) {?>
				<button class="left-btn" style="
					height: 28pt;
					border-radius: 14pt;
					border: thin solid #D7494D;
					font-size: 8pt;
					font-weight: 400;
					letter-spacing: 2.4px;
					line-height: 9.5pt;
					text-align: center;
					padding: 10pt 17pt 10pt calc(2.4px + 17pt);
					margin: 0;
				" onclick="
				<?php if ($page === 1) {?>$('#pages-container').moveTo(2)<?php } ?>
				<?php if ($page === 6) {?>window.open('https://www.google.com/maps/place/Block+%23+J,+15+Rd+No+27,+Dhaka+1212/')<?php } ?>
				">
					<?php if ($page === 1) {?> EXPLORE <?php } ?>
					<?php if ($page === 6) {?> DIRECTION <?php } ?>
				</button>
			<?php } ?>
		</div>
	</div>
</div>