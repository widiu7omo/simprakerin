<div class="header bg-primary pb-6">
	<div class="container-fluid">
		<div class="header-body">
			<div class="row align-items-center py-4">
				<div class="col-lg-6 col-7">
					<h6 class="h2 text-white d-inline-block mb-0"><?php echo ucfirst($this->uri->segment(1)); ?></h6>
					<nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
						<ol class="breadcrumb breadcrumb-links breadcrumb-dark">
							<li class="breadcrumb-item"><a href="<?php echo site_url() ?>"><i
										class="fas fa-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="<?php echo site_url() ?>">SIMPrakerin</a></li>
                            
                            <li class="breadcrumb-item 
                            <?php echo $this->uri->segment(2)?'"><a href="'.site_url($this->uri->segment(1)).'">'.ucfirst($this->uri->segment(1)).'</a>': 'active" aria-current="page">'.ucfirst($this->uri->segment(1))?></li>
							<?php if($this->uri->segment(2)): ?>
							<li class="breadcrumb-item active" aria-current="page"><?php echo ucfirst($this->uri->segment(2)); ?></li>
							<?php endif; ?>
						</ol>
					</nav>
				</div>
				<div class="col-lg-6 col-5 text-right">
					<a href="#" class="btn btn-sm btn-neutral">New</a>
					<a href="#" class="btn btn-sm btn-neutral">Filters</a>
				</div>
			</div>
		</div>
	</div>
</div>
