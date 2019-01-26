<section class="dashboard-counts section-padding" >
    <div class="container-fluid">
        <div class="paper container-fluid  ">
            <br>
            <div><h1>Manufacturing Orders</h1></div><hr>
            <div class="form-group row">
                <div class="col-sm-2">
                    <label for="">&nbsp;</label><br>
                    <input type="button" class="btn btn-outline-primary rounded" value="Calculate" id="calculate">
                </div>
            </div>
            <hr>
            <div>
                <table class="table table-hover" id="myTable">
                    <thead>
                        <th width="5%">#</th>
                        <th>Material Name</th>
                        <th>Material Length</th>
                        <th>Unit</th>
                        <th>Quantity</th>
                    </thead>
                    <tbody id="this_tdata_modal">
                    </tbody>
                </table>
            </div>
            <br><input type="button" class="btn btn-outline-success rounded" value="Save for Production" id="save"><br><br>
        </div>
    </div>
</section>