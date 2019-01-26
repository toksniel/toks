<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inventory extends CI_Controller {
    
    public $access =  0;
	public $groupID = 0;
	public $readonly = 7;
	public $readandwrite = 77;
	public $fullaccess = 777;
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Query_progOne');
		$this->load->model('Queries');
		if($this->session->has_userdata('userSession')){
			$sesuserID = $this->session->userdata['userSession']['user_ID'];
			$systemRole = $this->Query_progOne->getone("tblUsers"," uniqueId = '$sesuserID' ", "sytemRole");
			$this->groupID = $this->Query_progOne->getone("tblUsers"," uniqueId = '$sesuserID' ", "userGroupID");
			$this->access = $this->Query_progOne->checkAccess($systemRole,'Contacts');
		}else{
			redirect(base_url() . 'Home','refresh');
		}
    }	
    //------Dashboard
    public function mainDash(){
        $this->load->view('reusable/header');
        $this->load->view('reusable/sidebar');
        $this->load->view('inventory/inventoryMain');
        $this->load->view('reusable/footer');
    }public function deliveryDash(){
        $this->load->view('reusable/header');
        $this->load->view('reusable/sidebar');
        $this->load->view('inventory/deliveryNoteDash');
        $this->load->view('reusable/footer');
    }
    //------ list and adding stocks for components
      public function inventoryComponents(){      
        $data['components'] = $this->Queries->getAllRecord('tblInventory_Components',"");
        $this->load->view('reusable/header');
        $this->load->view('reusable/sidebar');
        $this->load->view('inventory/inventoryComponents', $data);
        $this->load->view('reusable/footer');
    }
    //------ list and adding stocks for raw materials
    public function inventoryRawMat(){
        $data['rawMats'] = $this->Queries->getAllRecord("tblInventory_RawMaterial ORDER BY 'rawID'","");
        $this->load->view('reusable/header');
        $this->load->view('reusable/sidebar');
        $this->load->view('inventory/inventoryRawMat', $data);
        $this->load->view('reusable/footer');
    }
    public function viewMat(){
        
        $rawID = $this->input->get('ajaxRawID');
        $query = $this->Queries->getAllRecord("tblInventory_RawMaterial","rawID ='$rawID'");
        if(!empty($query)){
        foreach($query as $key => $value){
            $rawName = $value->rawMatName;
            $rawQty = $value->rawMatQuantity;
            echo  $rawName;
            echo '<span hidden id="qtyy">'.$rawQty.'</span>';
            echo '<script> var qty = $("#qtyy").text()</script>';
        }
    }
    }
    public function viewConsumable(){
        $consIDs = $this->input->get('ajaxConsID');
        $query = $this->Queries->getAllRecord("tblInventory_Consumable","consID ='$consIDs'");
        if(!empty($query)){
            foreach($query as $key => $value){
                $consName = $value->consName;
                $consQty = $value->consQuantity;
                echo  $consName;
                echo '<span hidden id="qtys">'.$consQty.'</span>';
                echo '<script> var qty = $("#qtys").text()</script>';
            }
        }
    }
    //------list and adding stocks for consumables
    public function inventoryConsumable(){
        $data['consumable'] = $this->Queries->getAllRecord('tblInventory_Consumable',"");
        $this->load->view('reusable/header');
        $this->load->view('reusable/sidebar');
        $this->load->view('inventory/inventoryConsumable', $data);
        $this->load->view('reusable/footer');
    }
    //------list and adding stocks for consumables
    public function inventorySupplierList(){
        $data['supplier'] = $this->Queries->getAllRecord('tblInventory_Supplier',"");
        $this->load->view('reusable/header');
        $this->load->view('reusable/sidebar');
        $this->load->view('inventory/inventorySupplier', $data);
        $this->load->view('reusable/footer');
    }
    //------adding new component
    public function addComponent(){
        $this->load->view('reusable/header');
        $this->load->view('reusable/sidebar');
        $this->load->view('inventory/inventoryAddNewComp');
        $this->load->view('reusable/footer');
    }
    //------adding new raw mat
    public function addRawMat(){
        $this->load->view('reusable/header');
        $this->load->view('reusable/sidebar');
        $this->load->view('inventory/inventoryAddNewRaw');
        $this->load->view('reusable/footer');
    }
    //------adding new consumables
    public function addConsumable(){
        $this->load->view('reusable/header');
        $this->load->view('reusable/sidebar');
        $this->load->view('inventory/inventoryAddNewConsumable');
        $this->load->view('reusable/footer');
    }
    //------add new Supplier
    public function addSupplier(){
        $this->load->view('reusable/header');
        $this->load->view('reusable/sidebar');
        $this->load->view('inventory/addNewSupplier');
        $this->load->view('reusable/footer');
    }
    //------ajax saving new Component
    public function ajaxAddNewComponent(){
        $this->load->model('Query_progOne');
        $componentCode = $this->input->get('ajaxCode');
        $componentName = $this->input->get('ajaxName');
        $componentUnit = $this->input->get('ajaxUnit');
        $componentStock = $this->input->get('ajaxStock');
        $componentQty = $this->input->get('ajaxQty');
        $fields= array(
            'compItemCode' => $componentCode,
            'compName' => $componentName,
            'compUnit' => $componentUnit,
            'compLowStock' => $componentStock,
            'compQuantity' => $componentQty
        );
        $this->Query_progOne->createData('tblInventory_Components',$fields);
    } 
    //------ajax saving new raw material
    public function ajaxAddNewRawMat(){
        $this->load->model('Query_progOne');
        $materialName = $this->input->get('ajaxName');
        $materialUnit = $this->input->get('ajaxUnit');
        $materialStock = $this->input->get('ajaxStock');
        $materialQty = $this->input->get('ajaxQty');
        $fields= array(
            'rawMatName' => $componentName,
            'rawMatUnit' => $componentUnit,
            'rawMatLowStock' => $componentStock,
            'rawMatQuantity' => $componentQty
        );
        $this->Query_progOne->createData('tblInventory_RawMaterial',$fields);
    }
    //------ajax saving new consumable
    public function ajaxAddNewConsumable(){
        $this->load->model('Query_progOne');
        $consumableName = $this->input->get('ajaxName');
        $consumableUnit = $this->input->get('ajaxUnit');
        $consumableStock = $this->input->get('ajaxStock');
        $consumableQty = $this->input->get('ajaxQty');
        $fields= array(
            'consName' => $consumableName,
            'consUnit' => $consumableUnit,
            'consLowQty' => $consumableStock,
            'consQuantity' => $consumableQty
        );
        $this->Query_progOne->createData('tblInventory_Consumable',$fields);
    }
    //------ajax saving new supplier
    public function ajaxAddNewSupplier(){
        $this->load->model('Query_progOne');
        $supplierName = $this->input->get('ajaxName');
        $supplierCompany = $this->input->get('ajaxCompany');
        $supplierEmail = $this->input->get('ajaxEmail');
        $supplierPhone = $this->input->get('ajaxPhone');
        $fields= array(
            'supplierName' => $supplierName,
            'supplierCompany' => $supplierCompany,
            'supplierEmail' => $supplierEmail,
            'supplierPhone' => $supplierPhone
        );
        $this->Query_progOne->createData('tblInventory_Supplier',$fields);
    }
    //------update stocks raw material
    public function ajaxUpdateRawMat(){
        $rawID = $this->input->get('ajaxRawID');
        $rawQty = $this->input->get('ajaxRawMatQty');
        $fields = array(
            'rawMatQuantity'=>$rawQty
        );
        $this->Query_progOne->changeData("tblInventory_RawMaterial",$fields,"rawID='$rawID'");
    }
    //------update stocks consumable
     public function ajaxUpdateConsumable(){

        $consID = $this->input->get('ajaxConsID');
        $consQty = $this->input->get('ajaxConsQty');
        $fields = array(
            'consQuantity'=>$consQty
        );
        $this->Query_progOne->changeData("tblInventory_Consumable",$fields,"consID='$consID'");
    }
    //------update components stock
    public function ajaxUpdateComponents(){
        $compID = $this->input->get('ajaxCompID');
        $z = $this->input->get('ajaxQty');
        $query = $this->Queries->getAllRecord('tblInventory_Components',"componentUID='$compID'");
        foreach($query as $key => $value){
            $x = $value->compQuantity;
        }
        $compQty = $z+$x;
        $fields = array(
            'compQuantity'=>$compQty
        );
        $this->Query_progOne->changeData("tblInventory_Components",$fields,"componentUID='$compID'");
    }
    public function ajaxDeductRawMats(){
        $getID = $this->input->get('ajaxProdId');
        $query = $this->Query_progOne->fetchQuery("SELECT * FROM tblInventory_Production WHERE tblInventory_Production.listProdID =  '$getID'");
        $query2 = $this->Query_progOne->fetchQuery("SELECT * FROM tblInventory_RawMaterial WHERE tblInventory_RawMaterial.rawID = '$getID' ");
        foreach($query as $key => $value){
            $rawID = $value->matName;
            echo ', '.$rawID;
            
        }
       
             $this->Query_progOne->changeData("tblInventory_RawMaterial",$fields,"rawID='$rawMatID'  "); 
    }
    //------bom manufacture
    public function bomManufacture(){
        $data['componentList'] = $this->Queries->getAllRecord('tblInventory_Components',"");
        $data['matList'] = $this->Queries->getAllRecord('tblInventory_RawComponentMerge,tblInventory_RawMaterial',"tblInventory_RawMaterial.rawID = tblInventory_RawComponentMerge.rawID AND tblInventory_RawComponentMerge.compID = '1' ORDER BY tblInventory_RawMaterial.rawID ");
        $this->load->view('reusable/header');
        $this->load->view('reusable/sidebar');
        $this->load->view('inventory/inventoryBOM/inventoryBOMManufacture',$data);
        $this->load->view('reusable/footer');
    }
    //------bom list
    public function bomList(){
        $data['list'] = $this->Query_progOne->fetchQuery("SELECT * FROM tblInventory_ListProduction,tblInventory_Production,tblInventory_Components WHERE tblInventory_Production.listProdID = tblInventory_ListProduction.listProductionID AND  tblInventory_ListProduction.compID = tblInventory_Components.componentUID AND recStat = '1'  GROUP BY listProdID");
        $this->load->view('reusable/header');
        $this->load->view('reusable/sidebar');
        $this->load->view('inventory/inventoryBOM/inventoryBOMList',$data);
        $this->load->view('reusable/footer');
    }
    //------ajax get material Data
    public function getMatData(){
        $this->load->model('Query_progOne');
        $request = $this->input->post('ajaxRes');
        $dropID = $this->input->post('ajaxDropID');
        $compQty = $this->input->post('ajaxQty');
        if($request == 'getData'){
            if($dropID != ""){
                $data['matLists'] = $this->Query_progOne->fetchData('tblInventory_RawComponentMerge,tblInventory_RawMaterial'," tblInventory_RawMaterial.rawID = tblInventory_RawComponentMerge.rawID AND tblInventory_RawComponentMerge.compID = '$dropID' GROUP BY tblInventory_RawComponentMerge.rawID "); 
            }
            if(!empty($data['matLists'])){
                $matID = "";
                $matName="";
                $matQuantity="";
                $matUnit="";
                $x=0;
                foreach($data['matLists'] as $key => $value){
                    $x++;
                    $matID= $value->rawID;
                    $matName = $value->rawMatName;
                    $matLength = $value->defaultLength * $compQty;
                    $matUnit = $value->rawMatUnit;
                    $matQuantity = $value->quantityMat * $compQty;
                    echo '<tr>';
                    //echo'<td>'.$x.'</td>';
                        echo'<td>'.$matID.'</td>';
                        echo'<td>'.$matName.'</td>';
                        echo'<td>'.$matLength.'</td>';
                        echo'<td>'.$matUnit.'</td>';
                        echo'<td>'.$matQuantity.'</td>';
                    echo'</tr>';
                }
            }else{
                echo '<tr><td colspan="4" style="text-align:center; color:red;"><h1> No data found...  </h1><td></tr>';
            }
        }
    }
    // list  of mat for prod list
    public function getMatForListProd(){
        $this->load->model('Query_progOne');
        $request = $this->input->post('ajaxRes');
        $dropID = $this->input->post('ajaxID');
        $compQty = $this->input->post('ajaxQty');
        $x=0;
        if($request == 'getData'){
            if($dropID != ""){
                $data['matLists'] = $this->Query_progOne->fetchQuery("SELECT * FROM tblInventory_RawComponentMerge,tblInventory_RawMaterial WHERE tblInventory_RawMaterial.rawID = tblInventory_RawComponentMerge.rawID AND tblInventory_RawComponentMerge.compID = '$dropID' GROUP BY tblInventory_RawComponentMerge.rawID");
            }else{
                echo 'No data';
            }
            if(!empty($data['matLists'])){
                
                foreach($data['matLists'] as $key => $value){
                    $x+=1;
                    $matName = $value->rawMatName;
                    echo '<tr>';
                    echo '<td>'.$x.'</td>';
                    echo '<td>'.$matName.'</td>';
                    echo '</tr>';
                }
            }
        }
    }
    //------done Products
    public function ajaxDoneProducts(){
        $listProdID = $this->input->get('ajaxID');
        $fields = array(
            'listFlag'=>0
        );
        $this->Query_progOne->changeData("tblInventory_ListProduction",$fields,"listProductionID='$listProdID'");
    }
    //------done Products UNDO
    public function ajaxUndoProducts(){
        $listProdID = $this->input->get('ajaxID');
        $fields = array(
            'listFlag'=>1
        );
        $this->Query_progOne->changeData("tblInventory_ListProduction",$fields,"listProductionID='$listProdID'");
    }
      //------delete Products
      public function ajaxArchiveProducts(){
        $listProdID = $this->input->get('ajaxID');
        $fields = array(
            'recStat'=>0
        );
        $this->Query_progOne->changeData("tblInventory_ListProduction",$fields,"listProductionID='$listProdID'");
    }
    //------ajaxSave to prod
    public function ajaxGetLastID(){
        $listID="";
        $countArr = "";
        $arrays=$this->Query_progOne->fetchQuery("SELECT * FROM tblInventory_Production WHERE flag = 1 ORDER BY rawID ");
        $countArr = count($arrays);
        $listID = $this->Queries->getLastID();
       
        if($countArr == 0){
                $listID = 1 ;
            echo $listID;
        } else{
            $data2['list2']=$this->Query_progOne->fetchQuery("SELECT listProdID FROM tblInventory_Production ORDER BY listProdID DESC LIMIT 1");
            $arr = "";
            $sub = "";
            $listID=""; 
            foreach($data2['list2'] as $key => $value){
                $arr = $value->listProdID;
                $listID = $arr +1;
                echo $listID; 
            }
        }
    }
    //------saving to production
    public function saveToProduction(){
        $this->load->model('Query_progOne');
        //$listID2 = $this->input->get('ajaxlistID');
        $prodCompID =$this->input->get('ajaxprodCompID');
        $listID = $this->input->get('ajaxLastID');
        $pordMatID =$this->input->get('ajaxprodMatID');
        $prodMatName =$this->input->get('ajaxprodMatName');
        $prodMatLength =$this->input->get('ajaxprodMatLength'); 
        $prodMatUnit =$this->input->get('ajaxprodMatUnit');
        $prodMatQuantity =$this->input->get('ajaxprodMatQuantity');
        $prodMatPerPiece =$this->input->get('ajaxprodPcsQuantity');
        $fields = array(
            'compID'=>$prodCompID,
            'listProdID'=>$listID,
            'rawID'=>$pordMatID,
            'matName'=>$prodMatName,
            'matLength'=>$prodMatLength,
            'matUnit'=>$prodMatUnit,
            'matQuantity'=>$prodMatQuantity,
            'perPiece'=>$prodMatPerPiece
        );
        $this->Query_progOne->createData('tblInventory_Production',$fields);
    }
    //---add to prod List
    public function saveToProductionList(){
        $prodID =$this->input->get('ajaxProductID');
        $compID =$this->input->get('ajaxCompID');
        $quant =$this->input->get('ajaxQty');
        $fields = array(
            'prodID'=>$prodID,
            'compID'=>$compID,
            'quantity'=>$quant
        );
        $this->Query_progOne->createData('tblInventory_ListProduction',$fields);
    }
    public function ajaxGetLastListProdID(){
        $arrays=$this->Query_progOne->fetchQuery("SELECT listProdID FROM tblInventory_Production WHERE flag = 1 ORDER BY listProdID DESC LIMIT 1");
        foreach($arrays as $key =>$value){
            echo $value->listProdID;
        }
    }
    public function getCompID(){
        $idComp = $this->input->get('ajaxCompID');
        $qtyComp = $this->input->get('ajaxQty');
        $get = $this->Query_progOne->fetchQuery("SELECT * FROM tblInventory_Components WHERE componentUID = $idComp ");
        foreach($get as $key => $value){
        }
    }
    public function ajaxInsertMerging(){
        $rawID =$this->input->get('ajaxrawID');
        $compID =$this->input->get('ajaxcompID');
        $length =$this->input->get('ajaxlength');
        $qty =$this->input->get('ajaxqty');
        $fields = array(
            'rawID'=>$rawID,
            'compID'=>$compID,
            'defaultLength'=>$length,
            'quantityMat'=>$qty
        );
        $this->Query_progOne->createData('tblInventory_RawComponentMerge',$fields);
    }
    public function ajaxInsertRaw(){
        $rawCode =$this->input->get('ajaxrawCode');
        $rawName =$this->input->get('ajaxrawName');
        $rawUnit =$this->input->get('ajaxrawUnit');

        $fields = array(
            'rawMatCode'=>$rawCode,
            'rawMatName'=>$rawName,
            'rawMatUnit'=>$rawUnit
        );
        $this->Query_progOne->createData('tblInventory_RawMaterial',$fields);
    }
    public function ajaxCons(){
        $consCode =$this->input->get();
        $consName =$this->input->get();
        $consUnit =$this->input->get();
    }



    //--------------to be continue------------------------------------------
    public function merging(){
        $this->load->view('reusable/header');
        $this->load->view('reusable/sidebar');
        $this->load->view('insertMerging');
        $this->load->view('reusable/footer');
    }
    public function rawss(){
        $this->load->view('reusable/header');
        $this->load->view('reusable/sidebar');
        $this->load->view('insertRaw');
        $this->load->view('reusable/footer');
    }
    public function consumablessdsss(){
        $this->load->view('reusable/header');
        $this->load->view('reusable/sidebar');
        $this->load->view('insConsumable');
        $this->load->view('reusable/footer');
    }






    //newwwwwwwww-------------------------------------------
    // adding delivery]

    public function deliveryRecipt(){
        $this->load->view('reusable/header');
        $this->load->view('reusable/sidebar');
        $this->load->view('inventory/version3/deliveryNote');
        $this->load->view('reusable/footer');
    }
    public function deliveryList(){
        $data['list'] = $this->Query_progOne->fetchQuery("SELECT * FROM tblInventory_Delivery GROUP BY groupID");
        $this->load->view('reusable/header');
        $this->load->view('reusable/sidebar');
        $this->load->view('inventory/version3/deliveryList',$data);
        $this->load->view('reusable/footer');
    }
    public function deliveryListView(){
        $id = $this->input->get('ajaxID');
        $query = $this->Query_progOne->fetchQuery('SELECT * FROM tblInventory_Delivery,tblInventory_DeliveryFreights WHERE tblInventory_Delivery.groupID = "'.$id.'" AND tblInventory_DeliveryFreights.groupID = "'.$id.'" ORDER BY tblInventory_DeliveryFreights.groupID ');
        foreach($query as $key => $value){
            $name = $value->itemName;
            $qty = $value->itemQuantity;
            $length = $value->itemLenght;
            $price = $value->itemBasePrice;
            $from = $value->itemDeliveryFrom;
            
            echo'
                <tr>
                    <td>'.$name.'</td>
                    <td>'.$qty.'</td>
                    <td>'.$length.'</td>
                    <td style="text-align:center;">'.number_format($price,2).'</td>
                </tr>
            ';
        }
    }

    public function deliveryListViewFreight(){
        $id = $this->input->get('ajaxID');

        $query2 = $this->Query_progOne->fetchQuery('SELECT * FROM tblInventory_DeliveryFreights WHERE tblInventory_DeliveryFreights.groupID = "'.$id.'"  ');
        if(!empty($query2)){
            foreach($query2 as $key => $value){
                $pack = $value->pack;
                $packPrice = $value->packPrice;
                $saFreight = $value->saFreight;
                $saFrieghtPrice = $value->saFreightPrice;
               
                echo'<hr>
                <table class="table">
                    <thead class=""><th colspan="3">Shipping Fees<th></thead>
                        <tbody>
                        <tr>
                            <td colspan="3">'.$pack.'</td>
                            <td style="text-align:center;">'.number_format($packPrice,2).'</td>
                        </tr>
                        <tr>
                            <td colspan="3">'.$saFreight.'</td>
                            <td style="text-align:center;">'.number_format($saFrieghtPrice,2).'</td>
                        </tr>
                      ';
            }
        }
        if(!empty($query2)){
            foreach($query2 as $key => $value){
             
                $landFreight = $value->landFreight;
                $landFreightPrice = $value->landFreightPrice;
                if($landFreightPrice+="0" &&  $landFreight==""){
                echo'
            
                            <td colspan="3">'.$landFreight.'</td>
                            <td style="text-align:center;">'.number_format($landFreightPrice,2).'</td>
                        </tr>
                    </tbody>
                </table>';
            }}
        }
    }
    public function deliveryListViewTotal(){
        $id = $this->input->get('ajaxID');
        $query3 = $this->Query_progOne->fetchQuery('SELECT * FROM tblInventory_Delivery WHERE tblInventory_Delivery.groupID = "'.$id.'"  ');
        foreach($query3 as $key => $value){
            $price = $value->itemBasePrice;
            $from = $value->itemDeliveryFrom;
            $dates = $value->itemDeliveryDate;
            $x[] = $price;
        }
        $sum4 = array_sum($x);
        $query4 = $this->Query_progOne->fetchQuery('SELECT * FROM tblInventory_DeliveryFreights WHERE tblInventory_DeliveryFreights.groupID = "'.$id.'"  ');
        foreach($query4 as $key => $value){
            $packPrice = $value->packPrice;
            $saFrieghtPrice = $value->saFreightPrice;
            $landFreightPrice = $value->landFreightPrice;
            $pa[] = $packPrice;
            $sa[] = $saFrieghtPrice;
            $la[] = $landFreightPrice;
        }
            $sum1 = array_sum($pa);
            $sum2 = array_sum($sa);
            $sum3 = array_sum($la);
            $total = (float)$sum1 + (float)$sum2 + (float)$sum3 + (float)$sum4;

       echo'<hr>
       <table class="table">
        <thead></thead>
            <tbody>
            <t>
            <td>From: '.$from.'</td>
            <td>Date: '.$dates.' </td>
            <td style="text-align:right;"><h4>Total:</h4></td>
            <td style="text-align:center;"><h4>&#x20b1; '.number_format($total,2).'</h4></td>
            </tr>
            </tbody>
       </table>';
    }
    public function listOfNew(){
        $data['list'] = $this->Query_progOne->fetchQuery("SELECT * FROM tblInventory_Delivery GROUP BY groupID");
        $data['list2'] = $this->Query_progOne->fetchQuery("SELECT * FROM tblInventory_Delivery");
        $this->load->view('reusable/header');
        $this->load->view('reusable/sidebar');
        $this->load->view('inventory/version2/listOfNew',$data);
        $this->load->view('reusable/footer');
    }
    // commiting
    public function commit(){
        $data['current'] = $this->Query_progOne->fetchQuery("SELECT * FROM tblInventory_Components");
        $data['comm' ] = $this->Query_progOne->fetchQuery("SELECT * FROM tblInventory_Delivery,tblInventory_Components WHERE tblInventory_Delivery.itemCode = tblInventory_Components.compItemCode AND tblInventory_Delivery.recStat = 1");
        $this->load->view('reusable/header');
        $this->load->view('reusable/sidebar');
        $this->load->view('inventory/version2/commiting',$data);
        $this->load->view('reusable/footer');
    }
    public function distribute(){
        $data['current'] = $this->Query_progOne->fetchQuery("SELECT * FROM tblInventory_Delivery ");
        if(!empty($data['current'])){
            foreach($data['current'] as $key => $value){
                $shipping = $value->deliveryShippingFee;
                $price = $value->pricePHP;
                echo $shipping.',';
                echo $price.'_';
            }
        }
    }
    public function getDeli(){
        $this->load->model('Query_progOne');
        $request = $this->input->post('ajaxRes');
        $groupID= $this->input->post('ajaxID');
      
        $x=0;
        $totalBasePrice=0;
        $totalPercent=0;
        $per =0;
        if($request == 'getData'){
            if($groupID != ""){
                $data['codeItem'] = $this->Query_progOne->fetchQuery("SELECT * FROM tblInventory_Delivery,tblInventory_RawMaterial WHERE tblInventory_Delivery.groupID = '$groupID' AND tblInventory_RawMaterial.rawMatCode = tblInventory_Delivery.itemCode");
                $data['codeItem2'] = $this->Query_progOne->fetchQuery("SELECT * FROM tblInventory_Delivery,tblInventory_RawMaterial WHERE tblInventory_Delivery.groupID = '$groupID' AND tblInventory_RawMaterial.rawMatCode = tblInventory_Delivery.itemCode LIMIT 1");
            }else{
                echo 'No data';
            }
            if(!empty($data['codeItem2'])){
                foreach($data['codeItem2'] as $key => $value){
                   $ship = $value->deliveryShippingFee;
                }
            } 
            if(!empty($data['codeItem'])){
                foreach($data['codeItem'] as $key => $value){
                   $ship = $value->deliveryShippingFee;
                }
            } 
            if(!empty($data['codeItem'])){
                foreach($data['codeItem'] as $key => $value){
                    $suggested = $value->pricePHP;
                    $totalBasePrice=$totalBasePrice += $suggested;
                }
                foreach($data['codeItem'] as $key => $value){
                    $x+=1;
                    //calculation
                    $code = $value->rawMatName;
                    $current = $value->rawMatPrice;

                    $suggested =  $value->pricePHP;
                    
                    $divide = $value->pricePHP / $totalBasePrice;
                    $muliply =  $divide * 100;
                    $totalPercent += $muliply;
                    $convert =  $totalPercent /100;
                    $addTotal = $suggested*$convert;
                    echo' 
                        <div class="col-lg-12"></div>    
                        <div class="col-lg-1">
                            <input type="text" class="form-control" value="'.$x.'" disabled>
                        </div>
                        <div class="col-lg-3">
                            <input type="text" class="form-control" value="'.$code.'" disabled>
                        </div>
                        <div class="col-lg-2">
                            <input type="text" class="form-control" value="'.$current.'" disabled>
                        </div>
                        <div class="col-lg-2">
                            <input type="text" class="form-control" value="'.$suggested.'" disabled id="suggest">
                        </div>
                        <div class="col-lg-2">
                            <input type="text" class="form-control" value="'.$muliply.'">
                        </div>
                        <div class="col-lg-2">
                            <input type="text" class="form-control" value="'.$addTotal.'">
                        </div>
                        <br><br>
                    ';
                }
                echo'<div class="col-lg-2">Shippine Fee</div>';
                echo'<div class="col-lg-3"><input type="text" value="'.$ship.'"disabled></div>';
                echo'<div class="col-lg-3" style="text-align:right;">Total</div>';
                if($totalPercent >=99){
                    echo'<div class="col-lg-2"><input type="text" class="form-control" value="'.$totalPercent.'"></div>';
                
                }
                elseif($totalPercent <= 101){
                    echo'<div class="col-lg-2"><input type="text" class="form-control bg-danger text-white" value="'.$totalPercent.'"></div>';
                
                }
                else{
                    echo'<div class="col-lg-2"><input type="text" class="form-control" value="'.$totalPercent.'"></div>';
                
                }
                echo'<div class="col-lg-2"></div>';
              
            }
        }
    }
    public function ajaxSavingDelivery(){
        $this->load->model('Query_progOne');
        $charge = $this->input->get('ajaxCharge');
        $from = $this->input->get('ajaxFrom');
        $itemCode = $this->input->get('ajaxItemCode'); 
        $quantity = $this->input->get('ajaxQuantity');
        $pricePH = $this->input->get('ajaxPricePH');
        $fields=array(
            'deliveryShippingFee'=>$charge,
            'deliveryFrom'=>$from,
            'itemCode'=>$itemCode,
            'deliveryQuantity'=>$quantity,
            'pricePHP'=>$pricePH
        );
        $this->Query_progOne->createData('tblInventory_Delivery',$fields);
    }
    public function ajaxGetLastID2(){
        $listID="";
        $countArr = "";
        $arrays=$this->Query_progOne->fetchQuery("SELECT * FROM tblInventory_Delivery WHERE recStat = 1 ORDER BY deliveryID ");
        $countArr = count($arrays);
        $listID = $this->Queries->getLastID();
       
        if($countArr == 0){
                $listID = 1 ;
            echo $listID;
        } else{
            $data2['list2']=$this->Query_progOne->fetchQuery("SELECT groupID FROM tblInventory_Delivery ORDER BY groupID DESC LIMIT 1");
            $arr = "";
            $sub = "";
            $listID=""; 
            foreach($data2['list2'] as $key => $value){
                $arr = $value->groupID;
                    $listID = $arr +1;
                    echo $listID; 
            }
           
        }
    }
    public function inquiry_s3(){
		if( ( $this->access >= $this->readandwrite ) || ( $this->groupID <= 2 ) ){
			$inqID = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
			$entryNum =  $this->input->post('AX_entryNum');
			$entryName = $this->input->post('AX_entryName');
			$entyHeight = $this->input->post('AX_entyHeight');
			$entryWidth = $this->input->post('AX_entryWidth');
            $status = $this->input->post('Ax_stat');
            $ids = $this->input->post('Ax_id');
            $dateNow = $this->input->post('Ax_date');
            $pack = $this->input->post('Ax_pack');
            $packPrice = $this->input->post('Ax_packPrice');
            $saFreight = $this->input->post('Ax_saFreight');
            $saFrieghtPrice = $this->input->post('Ax_saFreightPrice');
            $lFreight = $this->input->post('Ax_lFreight');
            $lFreightPrice =  $this->input->post('Ax_lfreightPrice');
            $billinqID = $inqID;
			$fields2 = array(
				//'deliveryShippingFee' => $entryNum,
				'itemCode' => $entryName,
				'pricePHP' => $entryWidth,
				'deliveryQuantity' => $entyHeight,
                'deliveryFrom' => $status,
                'groupID'=>$ids,
                'date'=>$dateNow
				);
            $this->Query_progOne->createData('tblInventory_Delivery',$fields2);
		}
    }
    public function saveDeliveryNote(){
        $deliName = $this->input->get('ajaxName');
        $deliQty = $this->input->get('ajaxQty');
        $deliLength = $this->input->get('ajaxLeng');
        $deliBase = $this->input->get('ajaxBase');
        $deliDate = $this->input->get('ajaxDate');
        $deliFrom = $this->input->get('ajaxFrom');
        $deliID = $this->input->get('ajaxID');
        $fields = array(
            'itemName'=>$deliName,
            'itemQuantity'=>$deliQty,
            'itemLenght'=>$deliLength,
            'itemBasePrice'=>$deliBase,
            'itemDeliveryFrom'=>$deliFrom,
            'itemDeliveryDate'=>$deliDate,
            'groupID'=>$deliID
        );
        $this->Query_progOne->createData('tblInventory_Delivery',$fields);
    }
    public function saveOtherFees(){
        $groupID = $this->input->post('ajaxGroupID');
        $pack = $this->input->post('ajaxPack');
        $packPrice = $this->input->post('ajaxPackPrice');
        $saFreight = $this->input->post('ajaxSaFreight');
        $saFrieghtPrice = $this->input->post('ajaxSaFreightPrice');
        $lFreight = $this->input->post('ajaxLandFreight');
        $lFreightPrice =  $this->input->post('ajaxLandFreightPrice');
        $fields = array(
            'groupID'=>$groupID,
            'pack'=>$pack,
            'packPrice'=>$packPrice,
            'saFreight'=>$saFreight,
            'saFreightPrice'=>$saFrieghtPrice,
            'landFreight'=>$lFreight,
            'landFreightPrice'=>$lFreightPrice
        );
        $this->Query_progOne->createData('tblInventory_DeliveryFreights',$fields);
    }
    public function receivedDelivery(){
        $id = $this->input->post('ajaxID');
        if($id == 'getss'){
           $this->Query_progOne->changeData("tblInventory_Delivery",$fields,"rawID='$rawID'");
        }
    }

    //-------------------------------------------------------------Latest delivery Note
    public function noteDelivery(){
        $data['rawMats'] = $this->Queries->getAllRecord('tblInventory_RawMaterial',"");
        $data['currency'] = $this->Queries->getAllRecord('tblCurrency',"");
        $this->load->view('reusable/header');
        $this->load->view('reusable/sidebar');
        $this->load->view('inventory/deliveryNoteLatest/deliveryNote',$data);
        $this->load->view('reusable/footer'); 
    }
    public function requestForm(){
       // $data['rawMats'] = $this->Queries->getAllRecord('tblInventory_RawMaterial',"");
        $data['rawMats'] =$this->Query_progOne->fetchQuery("SELECT * FROM tblInventory_RawMaterial  ");

        $this->load->view('reusable/header');
        $this->load->view('reusable/sidebar');
        $this->load->view('inventory/materialForm/requestForm',$data);
        $this->load->view('reusable/footer'); 
    }
}