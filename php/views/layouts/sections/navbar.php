<nav class="navigation">
	<section class="container">
		<a class="navigation-title float-left" href="<?= url ('/') ?>">
			<h1 class="title">White Circle</h1>
		</a>
		
		<ul class="navigation-list float-right">
			<?php if (Authentication::isLoggedIn()): ?>
				<li class="navigation-item">
					<a class="navigation-link" href="#popover-administration" data-popover>Admin</a>
					<div class="popover" id="popover-administration">
						<ul class="popover-list">
							<li class="popover-label">Admin</li>
							<li class="popover-item"><a class="popover-link" href="<?= url('/Administration/Reports/Latest')     ?>" title="">Users</a></li>
							<li class="popover-label">Reports</li>
							<li class="popover-item"><a class="popover-link" href="<?= url('/Administration/Reports/Latest')     ?>" title="">Latest</a></li>
							<li class="popover-item"><a class="popover-link" href="<?= url('/Administration/Reports/Visible')    ?>" title="">Visible</a></li>
							<li class="popover-item"><a class="popover-link" href="<?= url('/Administration/Reports/Unconfirmed')?>" title="">Unconfirmed</a></li>
							<li class="popover-item"><a class="popover-link" href="<?= url('/Administration/Reports/Fixed')      ?>" title="">Fixed bugs</a></li>
							<li class="popover-item"><a class="popover-link" href="<?= url('/Administration/Reports/All')        ?>" title="">Search / View all</a></li>
						</ul>
					</div>
				</li>
				
				<li class="navigation-item">
					<a class="navigation-link" href="#popover-account" data-popover><?=Authentication::getUser()->getUsername()?></a>
					<div class="popover" id="popover-account">
						<ul class="popover-list">
							<li class="popover-item"><a class="popover-link" href="<?= url('/User/Manage') ?>" title="Password">Change Password</a></li>
							<li class="popover-item"><a class="popover-link" href="<?= url('/User/Logout') ?>" title="Logout">Logout</a></li>
						</ul>
					</div>
				</li>
			<?php else: ?>
				<li class="navigation-item">
					<a class="navigation-link" href="<?= url('/Authentication/Login') ?>">Login</a>
				</li>
			<?php endif; ?>
		</ul>
	</section>
</nav>