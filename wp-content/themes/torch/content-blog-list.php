<div class="breadcrumb-box">
            <?php torch_get_breadcrumb();?>
        </div>
<div class="blog-list">
			<div class="container">
				<div class="row">
					<div class="col-md-9">
						<section class="blog-main text-center" role="main">
						
                           <?php 
							
							if ( have_posts() ) :
							?>
                            <div class="blog-list-wrap">
                    <?php while ( have_posts() ) : the_post(); 
					    get_template_part("content","article");
					?>
                   <?php endwhile;?>
                   </div>
                   <?php endif;?>
                            		<div class="list-pagition text-center">
							<?php if(function_exists("torch_native_pagenavi")){torch_native_pagenavi("echo",$wp_query);}?>
							</div>
						</section>
					</div>
                    <div class="col-md-3">
						<aside class="blog-side left text-left">
							<div class="widget-area">
						<?php get_sidebar("category");?>
                        		
							</div>
						</aside>
					</div>
				</div>
			</div>	
		</div>