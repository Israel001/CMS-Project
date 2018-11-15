<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        
        <!-- Modal Content -->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Modal Delete Box</h4>
            </div>
            <div class="modal-body">
                <h3>Are you sure you want to delete this post?</h3>
            </div>
            <div class="modal-footer">
               <form action="posts.php" method="post">
                   <input type="hidden" name="post_id" class="modal_delete_link">
                   <input type="submit" class="btn btn-danger" value="Confirm" name="delete">
                   <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
               </form>
            </div>
        </div>
        
    </div>
</div>