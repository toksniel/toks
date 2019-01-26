<link rel="stylesheet" href="<?php echo base_url();?>assets/md/css/bootstrap.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/md/css/mdb.min.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/md/css/style.css">
<script src="<?php echo base_url();?>assets/md/js/jquery-3.2.1.min.js"></script>
<script src="<?php echo base_url();?>assets/md/js/popper.min.js"></script>
<script src="<?php echo base_url();?>assets/md/js/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assets/md/js/mdb.min.js"></script>
<script src="<?php echo base_url();?>assets/jquery/Chart.min.js"></script>
<script src="<?php echo base_url();?>assets/jquery/Chart.js"></script>
<section class="dashboard-counts section-padding" >
    <div class="container-fluid">
        <div class="row">

            <div class="col-lg-4">
                <div class="card"> 
                    <a href="<?php echo site_url();?>Inventory/inventoryComponents">
                        <div class="card-body text-center btn-outline-primary rounded" >
                            <h1><i class="fa fa-cog" aria-hidden="true"></i><br> <ruby>Component<rt>____</rt></ruby></h1>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <a href="<?php echo site_url();?>Inventory/inventoryRawMat">
                        <div class="card-body text-center btn-outline-success rounded" >
                            <h1><i class="fa fa-cogs" aria-hidden="true"></i><br> <ruby>Raw Material<rt>____</rt></ruby></h1>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <a href="<?php echo site_url();?>Inventory/inventoryConsumable">
                        <div class="card-body text-center btn-outline-danger rounded" >
                            <h1><i class="fa fa-eyedropper" aria-hidden="true"></i><br> <ruby>Consumable<rt>____</rt></ruby></h1>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
        <div class="col-lg-4">
                <div class="card">
                    <a href="<?php echo site_url();?>Inventory/bomManufacture">
                        <div class="card-body text-center btn-outline-warning rounded" >
                            <h1><i class="fa fa-puzzle-piece" aria-hidden="true"></i><br> <ruby>Manufacture<rt>____</rt></ruby></h1>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <a href="<?php echo site_url();?>Inventory/bomList">
                        <div class="card-body text-center btn-outline-info rounded" >
                            <h1><i class="fa fa-list-ol" aria-hidden="true"></i><br><ruby>Production List<rt>____</rt></ruby></h1>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <a href="<?php echo site_url();?>Inventory/inventorySupplierList">
                        <div class="card-body text-center btn-outline-dark rounded" >
                            <h1><i class="fa fa-truck" aria-hidden="true"></i><br><ruby>Supplier<rt>____</rt></ruby></h1>
                        </div>
                    </a>
                </div>
            </div>
        </div>
   <br><hr>

</section>