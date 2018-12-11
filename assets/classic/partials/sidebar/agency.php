<?php
/**
 * Agency sidebar.
 *
 * @since 3.5.0
 * @package    realhomes
 * @subpackage classic
 */

?>

<div class="span3 sidebar-wrap">

<!-- Sidebar -->
<aside class="sidebar">
	<?php
		if ( ! dynamic_sidebar( 'agency-sidebar' ) ) :
		endif;
	?>
</aside>
<!-- End Sidebar -->

</div>
