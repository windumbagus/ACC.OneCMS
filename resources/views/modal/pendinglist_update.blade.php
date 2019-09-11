<!-- Modal ADD -->
<div class="modal fade" id="pendinglist_update_modal" tabindex="-1" role="dialog" 
aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="box box-info">
                    <div class="box-header">
                        <i class="fa fa-database"></i>
                        <h3 class="box-title">Update Pending List</h3>
                    </div>
                    <div class="box-body">
                        <form id="form-pedinglist-update" action="#" method="post"> 
                        @csrf	
                        <div class="form-group">
                            <label>Foto Profile:</label><br>
                            <img style="width: 150px; height: 200px;" name="pendinglist_Profile_update_data" alt=""/><br>
                        </div>
                        <div class="form-group">
                            <label>Name :</label>
                            <input type="text" class="form-control" name="pendinglist_Name_update_data" readonly>
                        </div>
                        <div class="form-group">
                            <label>Username :</label>
                            <input type="text" class="form-control" name="pendinglist_Username_update_data" readonly>
                        </div>
                        <div class="form-group">
                            <label>Email:</label>
                            <input type="text" class="form-control" name="pendinglist_Email_update_data" readonly>
                        </div>
                        <div class="form-group">
                            <label>Mobile Phone:</label>
                            <input type="text" class="form-control" name="pendinglist_MobilePhone_update_data" readonly>
                        </div>
                        <div class="form-group">
                            <label>Last Login:</label>
                            <input type="text" class="form-control" name="pendinglist_Last_Login_update_data" readonly>
                        </div>
                        <div class="form-group">
                            <label>Is Active:</label>
                            <input type="text" class="form-control" name="pendinglist_Is_Active_update_data"
                            placeholder="Is Active" readonly>
                        </div>
                        <div class="form-group">
                            <label>Tanggal Lahir:</label>
                            <input type="text" class="form-control" name="pendinglist_TanggalLahir_update_data" readonly>
                        </div>
                        <div class="form-group">
                            <label>Status:</label>
                            <input type="text" class="form-control" name="pendinglist_Status_update_data" readonly>
                        </div>
                        <div class="form-group">
                            <label>Status No HP:</label>
                            <input type="text" class="form-control" name="pendinglist_StatusNoHP_update_data" readonly>
                        </div>
                        <div class="form-group">
                            <label>Subscribe:</label>
                            <input type="text" class="form-control" name="pendinglist_Subscribe_update_data" readonly>
                        </div>
                        <div class="form-group">
                            <label>Foto KTP:</label><br>
                            <img style="width: 150px; height: 200px;" name="pendinglist_KTP_update_data" alt=""/><br>
                        </div>
                        <div class="form-group">
                            <label>Foto NPWP:</label><br>
                            <img style="width: 150px; height: 200px;" name="pendinglist_NPWP_update_data" alt=""/><br>
                        </div>
                        <div class="form-group">
                            <label>Foto KK:</label><br>
                            <img style="width: 150px; height: 200px;" name="pendinglist_KK_update_data" alt=""/><br>
                        </div>
                        <div class="form-group">
                            <label>Reason:</label>
                            <input type="text" class="form-control" name="pendinglist_Reason_update_data"
                            placeholder="Reason">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="close-modal">Close</button>		
            </div>
        </form>			
        </div>
    </div>
</div>

<Script>
    $(function() {
        $('#close-modal').click(function() {
        $('#view-rejected').modal('hide');
        $('#form-pedinglist-update')[0].reset();  
        });      
    });
</Script>
