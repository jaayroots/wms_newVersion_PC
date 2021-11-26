<!-- file element showEstBalance for show modal Product Est. balance Detail : add by kik : 06-11-2013 -->

<script>

// Add function showProductEstInbound by kik : 06-11-2013
    function showProductEstInbound(Product_Code,Product_Lot,Product_Serial,Product_Mfd,Product_Exp) {
                
        var dataSet = {Product_Code: Product_Code,Product_Lot: Product_Lot,Product_Serial: Product_Serial,Product_Mfd: Product_Mfd,Product_Exp: Product_Exp};
        $.post('<?php echo site_url() . "/balance/showProductEstInboundForInventory" ?>', dataSet, function(data) {
//            alert(data);
            $('#estDetail #myModalLabel').html(Product_Code + ' : Product Est. balance Detail');
            $("#estDetail .modal-body").html(data);

            $('#estDetail .modal-body #defDataTable').dataTable({
                "bJQueryUI": true,
                "bAutoWidth": false,
                "bSort": false,
                "oSearch": {},
                "bRetrieve": true,
                "bDestroy": true,
                "sPaginationType": "full_numbers",
                "aoColumnDefs": [
                             {"sWidth": "5%", "sClass": "center", "aTargets": [0]},
                             {"sWidth": "15%", "sClass": "left_text", "aTargets": [1]},
                             {"sWidth": "30%", "sClass": "left_text", "aTargets": [2]},
                             {"sWidth": "30%", "sClass": "left_text", "aTargets": [3]},
                             {"sWidth": "10%", "sClass": "right_text", "aTargets": [4]}, 
                ]
            });
            $('#estDetail').modal('show');
        }, "html");

    }
    // End function showProductEstInbound by kik : 06-11-2013
    
    
</script>
<style>
    #estDetail{
        width: 80%!important;	/* SET THE WIDTH OF THE MODAL */
        top:47%!important;
        margin-left: -40%!important;
                
    }
    
</style>

<div style="min-height:500px;padding:5px 10px;" id="estDetail" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
        <h3 id="myModalLabel"></h3>

    </div>
    <div class="modal-body"></div>
    <div class="modal-footer">
        <div style="float:left;">
        </div>
        <div style="float:right;">            
            <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
        </div>
    </div>
</div>
