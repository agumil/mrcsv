<?php $this->extend('layout/master'); ?>

<?php $this->section('title'); ?>
<title>Result | CSV Extractor</title>
<?php $this->endSection(); ?>

<?php $this->section('head-scripts'); ?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.2/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/datetime/1.1.1/css/dataTables.dateTime.min.css">
<?php $this->endSection(); ?>

<?php $this->section('content'); ?>
<div class="container">
    <div class="col-sm-2 mb-3 pt-3">
        <a href="<?php echo site_url('file/print'); ?>" class="btn btn-success" target="_blank">Cetak PDF</a>
    </div>
    <div class="col-12">
        <table border="0" cellspacing="5" cellpadding="5" class="d-flex justify-content-between">
            <tbody>
                <tr>
                    <td>Minimum date:</td>
                    <td><input type="text" id="min" name="min" placeholder="Start"></td>
                    <td>Maximum date:</td>
                    <td><input type="text" id="max" name="max" placeholder="End"></td>
                </tr>
            </tbody>
        </table>
        <table id="myTable" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <?php for($i = 0; $i < $col_length; $i++): ?>
                    <?php if ($data[0][$i] === null) continue; ?>
                    <th><?php echo $data[0][$i]; ?></th>
                    <?php endfor ?>
                </tr>
            </thead>
            <tbody>
                    <?php for($x = 1; $x < $row_length; $x++): ?>
                    <tr>
                        <?php for($y = 0; $y < $col_length; $y++): ?>
                        <?php if ($data[0][$y] === null) continue; ?>
                        <td><?php echo $data[$x][$y]; ?></td>
                        <?php endfor ?>
                    </tr>
                    <?php endfor ?>
            </tbody>
        </table>
    </div>
</div>
<?php $this->endSection(); ?>

<?php $this->section('body-scripts'); ?>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.11.2/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.2/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script src="https://cdn.datatables.net/datetime/1.1.1/js/dataTables.dateTime.min.js"></script>


<script>
    var minDate, maxDate;
    
    // Custom filtering function which will search data in column four between two values
    $.fn.dataTable.ext.search.push(
        function( settings, data, dataIndex ) {
            var min = minDate.val();
            var max = maxDate.val();
            var date = new Date( data[10] / 1000000 );
    
            if (
                ( min === null && max === null ) ||
                ( min === null && date <= max ) ||
                ( min <= date   && max === null ) ||
                ( min <= date   && date <= max )
            ) {
                return true;
            }
            return false;
        }
    );
    
    $(document).ready(function() {
        // Create date inputs
        minDate = new DateTime($('#min'), {
            format: 'DD/MM/YYYY'
        });
        maxDate = new DateTime($('#max'), {
            format: 'DD/MM/YYYY'
        });
    
        // DataTables initialisation
        var table = $('#myTable').DataTable();
    
        // Refilter the table
        $('#min, #max').on('change', function () {
            table.draw();
        });
    });
</script>
<?php $this->endSection(); ?>