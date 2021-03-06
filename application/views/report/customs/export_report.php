<script>
    $(document).ready(function() {
        var area_width = $('#report_customs').width() - 20;
        //$('#table-wrapper').width(area_width);
        $("#scroll_div").scroll(function(){
            $('#header_title').scrollLeft($(this).scrollLeft());
	});

    });

    function exportFile(file_type) {
        if (file_type == 'EXCEL') {
            $("#frmResults").attr('action', "<?php echo site_url("/report_customs/export_to_excel"); ?>");
        } else {
            $("#frmResults").attr('action', "<?php echo site_url("/report_customs/export_to_pdf"); ?>");
        }
        $("#frmResults").submit();
    }
</script>
<style>
    td.group{
        background:#E6F1F6;
    }
    tr.reject_row{
        color:red;
    }
</style>
<style>
    .Tables_wrapper{
        clear: both;
        height: auto;
        position: relative;
        width: 100%;
    }
    .table_report{
        table-layout: fixed;
        margin-left: 0;
        max-width: none;
        width: 100%;
        border-bottom-left-radius: 0 !important;
        border-bottom-right-radius: 0 !important;
        border-top-right-radius: 0 !important;
        margin-bottom: 0 !important;
    }

    .table_report tbody {
            width: 1000px;
            overflow: auto;
    }

    .table_report th {
        padding: 3px 5px;
        background: -moz-linear-gradient(center top , #013953, #002232) repeat scroll 0 0 transparent !important;
        background: -webkit-gradient(linear, center top, center bottom, from(#A64B00), to(#FF7400)) !important;
        border-left: 1px solid #D0D0D0 !important;
        border-radius: 0 0 0 0 !important;
        color : white !important;
    }

    table.table_report tr:nth-child(odd) td{
        background-color: #E2E4FF;
    }

    table.table_report tr:nth-child(even) td{
        background-color: #FFFFFF;
    }

    table.table_report td {
        border-right: 1px solid #D0D0D0;
        padding: 3px 5px;
    }

    table.table_report td {
        border-right: 1px solid #D0D0D0;
        padding: 3px 5px;
    }
    .Tables_wrapper .ui-toolbar {
        padding: 5px 5px 0;
        overflow: hidden;
    }

</style>
<form  method="post" target="_blank" id="frmResults">
    <input type="hidden" name="fdate" value="<?php echo $search['fdate']; ?>" />
    <input type="hidden" name="tdate" value="<?php echo $search['tdate']; ?>" />
    <input type="hidden" name="customs_entry" value="<?php echo $search['customs_entry']; ?>" />
    <input type="hidden" name="eor" value="<?php echo $search['eor']; ?>" />
    <input type="hidden" name="invoice" value="<?php echo $search['invoice']; ?>" />
    <div class='Tables_wrapper'>
        <div class=" fg-toolbar ui-toolbar ui-widget-header ui-corner-tl ui-corner-tr ui-helper-clearfix">
            <div id="defDataTable2_length" class="dataTables_length">
                <?php echo $display_items_per_page?>
            </div>
            <div class="dataTables_filter" id="defDataTable2_filter">
                <label>
                    <!--Search: <input type="text" aria-controls="defDataTable2">-->
                </label>
            </div>
        </div>
        <div id="table-wrapper" style="width: 100%;">
            <div style="width: 100%; overflow-x: hidden;">
                <table class ='well table_report' cellpadding="0" cellspacing="0" border="0" aria-describedby="defDataTable_info" style="max-width: none">
                    <thead>
                        <tr>
                            <th style="width:60px;"><?php echo _lang("no"); ?></th><!--????????????????????????-->
                            <th style="width:100px;"><?php echo _lang("customs_entry"); ?></th><!--??????????????????????????????/????????????-->
                            <th style="width:100px;"><?php echo _lang("invoice_no"); ?></th><!--?????????????????? INVOICE ??????????????????????????????????????????????????????????????????-->
                            <th style="width:100px;"><?php echo _lang("dispatch_date"); ?></th><!--???????????????????????????/???????????????????????????-->
                            <th style="width:100px;"><?php echo _lang("product_code"); ?></th><!--??????????????????????????????/????????????????????????-->
                            <th style="width:200px;"><?php echo _lang("product_name"); ?></th><!--????????????????????????????????????????????????-->
                            <th style="width:80px;"><?php echo _lang("dispatch_qty"); ?></th><!--??????????????????-->
                            <th style="width:100px;"><?php echo _lang("unit"); ?></th>   <!--????????????????????????-->
                            <th style="width:80px;"><?php echo _lang("all_price"); ?></th> <!--??????????????????-->
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        if(empty($data)):
                            echo "<tr><td align=center colspan=9><b>No Data Available.</b></td></tr>";
                        else:
                            $all_sum_receive = 0;
                            $all_sum_price = 0;
                            foreach ($data as $keyProduct => $datas) {
                                $i = 0;
                                ?>                          
                                <tr style="font-weight:bold;"><td style="background-color:#BBBBBB;">#</td><td style="background-color:#BBBBBB;text-align:left;" colspan=8>CE No.<?php echo $datas[0]['Doc_Refer_CE']; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;EOR: <?php echo $datas[0]['EOR_Name']; ?></td></tr>    
                                <?php
                                $sum_receive = 0;
                                $sum_price = 0;
                                foreach ($datas as $key => $value) {
                                    $i++;
                                    ?>
                                    <tr>
                                        <td><?php echo $i ?></td>
                                        <td>&nbsp;</td>
                                        <td><?php echo $value["Invoice_No"]; ?></td>
                                        <td><?php echo $value["Dispatch_Date"]; ?></td>
                                        <td><?php echo $value["Product_Code"]; ?></td>
                                        <td align="left"><?php echo $value["Product_NameEN"]; ?></td>
                                        <td align="right"><?php echo set_number_format($value["Dispatch_Qty"]); ?></td>
                                        <td><?php echo $value["unit"]; ?></td>
                                        <td align="right"><?php echo set_number_format($value["price"])." ".$value["unit_price"]; ?></td>
                                    </tr>
                                    <?php
                                    $sum_receive+=$value["Dispatch_Qty"]; //????????? receive qty ???????????????????????? group
                                    $sum_price+=$value["price"]; //????????????????????????????????????????????? group


                                    $all_sum_receive+=$value["Dispatch_Qty"]; //????????? receive qty ?????????????????????
                                    $all_sum_price+=$value["price"]; //??????????????????????????????????????????
                                 }

                                 echo "<tr><td colspan=5>&nbsp;</td><td>Total</td><td align=right>".set_number_format($sum_receive)."</td><td>&nbsp;</td><td align=right>".set_number_format($sum_price)." ".$value["unit_price"]."</td></tr>";
                             }
                             echo "<tr><td colspan=5>&nbsp;</td><td><b>All Total</b></td><td align=right><b>".set_number_format($all_sum_receive)."</b></td><td>&nbsp;</td><td align=right><b>".set_number_format($all_sum_price)."</b></td></tr>";
                         endif;
                         ?>
                    </tbody>

                    <tfoot>

                    </tfoot>

                </table>
            </div>
         </div>
    </div>
    <div id="pagination" class="fg-toolbar ui-toolbar ui-widget-header ui-corner-bl ui-corner-br ui-helper-clearfix">
        <div class="dataTables_info" id="defDataTable2_info">Showing <?php echo $low+1 ?> to <?php echo $show_to ?> of <?php echo $items_total;?> entries</div>
        <div style="padding:3px;"class="dataTables_paginate fg-buttonset ui-buttonset fg-buttonset-multi ui-buttonset-multi paging_full_numbers" id="defDataTable2_paginate">
            <?php echo $pagination?>
        </div>
    </div>
</form>