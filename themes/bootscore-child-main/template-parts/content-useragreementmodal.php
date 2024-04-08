<?php
/**
 * Template part for displaying the CE User Agreement Modal
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Comics_Experience_2022
 */

?>

<!-- Modal -->
<div class="modal fade" id="userAgreementModal" tabindex="-1" aria-labelledby="userAgreementModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Comics Experience User Agreement</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?php get_template_part( 'template-parts/content', 'useragreement' ); ?>
            </div>
        </div>
    </div>
</div>