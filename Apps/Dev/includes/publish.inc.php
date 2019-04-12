<div class="modal fade" id="publishAppModal" tabindex="-1" role="dialog" aria-labelledby="publishAppModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg shadow" role="document">
    
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="publishAppModalLabel"><i class="fa fa-shipping-fast"></i> Publish to Marketplace</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body py-3">

          <?php
          
          if(file_exists("Apps/MarketPublisher/publish-external.inc.php")){
            include_once("Apps/MarketPublisher/publish-external.inc.php");
          }
          else{
            ?>
            Download the Marketplace Publisher app to publish your apps to the Marketplace!
            <?php
          }
          
          ?>

        </div>
      
    </div>
  </div>
</div>