
<script src="<?php echo base_url('assets/plugins/excanvas.min.js')?>"></script>

<script src="<?php echo base_url('assets/plugins/jquery-1.10.1.min.js')?>" type="text/javascript"></script>

<script src="<?php echo base_url('assets/plugins/flot/jquery.flot.js')?>"></script>

<script type="text/javascript">
    $(document).ready(function(){

            var arrayOfPHPData = <?php echo json_encode($year_graph) ?>;
//            arrayOfDataJS = new Array();
        $.plot($("#placeholder"), arrayOfPHPData, options);
    });
</script>

<div id="placeholder"> hello</div>