<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	class ProductsV2 extends CI_Controller
	{
        public $access =  0;
        public $groupID = 0;
        public $readonly = 7;
        public $readandwrite = 77;
        public $fullaccess = 777;
        public function __construct(){
            parent::__construct();
            $this->load->model('Query_progOne');
        }
        public function index(){
            if( ( $this->access >= $this->readonly ) || ( $this->groupID <= 2 ) ){
                $this->home();
            }else{
                redirect(base_url('Welcome/msger'),'refresh');
            }
        }
        public function home(){
            if( ( $this->access >= $this->readonly ) || ( $this->groupID <= 2 ) ){
                $this->load->model('Query_progOne');
                $this->load->view('reusable/header');
                $this->load->view('reusable/sidebar');
                $this->load->view('products_v2/productsDashboard');
                $this->load->view('reusable/footer');
            }else{
                redirect(base_url('Welcome/msger'),'refresh');
            }
        }
        public function basicMaterialList(){
            $this->load->model('Query_progOne');
            $data['mats']  =  $this->Query_progOne->fetchData('TABLEmaterial',"");
            $this->load->view('reusable/header');
            $this->load->view('reusable/sidebar');
            $this->load->view('products_v2/productsList/materialList',$data);
            $this->load->view('reusable/footer');
        }
        public function matDimImage(){
            $id = $this->input->get('ajaxID');
            $this->load->model('Query_progOne');
            $data['matImageDim'] =$this->Query_progOne->fetchQuery("SELECT * FROM TABLEdimproperties WHERE TABLEdimproperties.propID = '$id'");
            if(!empty($data['matImageDim'])){
                foreach($data['matImageDim'] as $key => $value){
                    echo '<img src="'.base_url($value->propImage).'">';
                    echo '<input type="text">';
                }
            }
        }
        public function componentList(){
            $this->load->model('Query_progOne');
            $data['mats']  =  $this->Query_progOne->fetchData('TABLEcomponent',"");
            $this->load->view('reusable/header');
            $this->load->view('reusable/sidebar');
            $this->load->view('products_v2/productsList/componentList',$data);
            $this->load->view('reusable/footer');
        }
        public function fabricationList(){
            $this->load->model('Query_progOne');
            $data['fabs']  =  $this->Query_progOne->fetchData('TABLEfabrication',"");
            $this->load->view('reusable/header');
            $this->load->view('reusable/sidebar');
            $this->load->view('products_v2/productsList/fabricationList',$data);
            $this->load->view('reusable/footer');
        }
        public function barrierSystemList(){
            $this->load->model('Query_progOne');
            $data['fabs']  =  $this->Query_progOne->fetchData('TABLEbarriersystem',"");
            $this->load->view('reusable/header');
            $this->load->view('reusable/sidebar');
            $this->load->view('products_v2/productsList/barrierSystemList',$data);
            $this->load->view('reusable/footer');
        }
        public function serviceList(){
            $this->load->model('Query_progOne');
            $data['serviceList']  =  $this->Query_progOne->fetchData('TABLEservice',"");
            $this->load->view('reusable/header');
            $this->load->view('reusable/sidebar');
            $this->load->view('products_v2/productsList/serviceList',$data);
            $this->load->view('reusable/footer');
        }
        public function compMatList(){
            $id = $this->input->get('ajaxID');
            $this->load->model('Query_progOne');
            $data['compMats'] =$this->Query_progOne->fetchQuery("SELECT * FROM TABLEcompmat,TABLEmaterial WHERE TABLEcompmat.cmComp = '$id' AND TABLEmaterial.matCode = TABLEcompmat.cmMat ");
            if(!empty( $data['compMats'])){
                foreach($data['compMats'] as $key => $value){
                    echo '<tr>
                        <td>'.$value->cmMat.'</td>
                        <td>'.$value->matName.'</td>
                        <td>'.$value->cmSize.'</td>
                        <td>'.$value->cmQty.'</td>
                    </tr>';
                }
            }
        }
        public function savingNewFabrication(){
            $fabCode = $this->input->get('ajaxCode');
            $fabName = $this->input->get('ajaxName');
            $fabCost = $this->input->get('ajaxCost');
            $fabUnit = $this->input->get('ajaxUnit');
            $fields = array(
                'fabID'=>$fabCode,
                'fabName'=>$fabName,
                'fabCost'=>$fabCost,
                'fabUnit'=>$fabUnit
            );
            print_r($fields);
            //$this->Query_progOne->createData('TABLEfabrication',$fields);
        }
        public function ajaxSavingMaterial(){
            $this->load->model('Query_progOne');
            $matCode = $this->input->get('ajaxCode');
            $matName = $this->input->get('ajaxName');
            $matDesc = $this->input->get('ajaxDesc');
            $matBase = $this->input->get('ajaxBaseUnit');
            $matWeight = $this->input->get('ajaxWeight');
            $matPrice = $this->input->get('ajaxPrice');
            $fields=array(
               'matCode'=>$matCode,
               'matName'=>$matName,
               'matDescription'=>$matDesc,
               'matBaseUnit'=>$matBase,
               'matUnitPrice'=>$matPrice,
               'matUnitWeight'=>$matWeight
               
            );
            //$this->Query_progOne->createData('TABLEmaterial',$fields);
        }
        public function dimensions(){
            $this->load->model('Query_progOne');
            $data['matUnit'] =  $this->Query_progOne->fetchData('TABLEproductsdroplist',"dropCat = 'unitsL' ");
            $data['matUnitV'] =  $this->Query_progOne->fetchData('TABLEproductsdroplist',"dropCat = 'unitsV' ");
            $id = $this->input->get('ajaxID');
            if($id == 'cub'){
                echo'<br>
                        <div class="row">
                            <div class="col-sm-3">

                            </div>
                            <div class="col-sm-6" align="center">
                                <img src="'.base_url().'assets/prods/abc.png" val="asd" align="center">
                            </div>
                            <div class="col-sm-3">

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                <label>Width</label>
                                <input type="text" class="form-control dimensionsssss" id="widthD">
                            </div>
                            <div class="col-sm-3">
                                <label>Unit</label>
                                <select id="widthUnitD" class="form-control units">';
                                echo'<option value="0" disabled selected>Select Unit</option>';
                                foreach($data['matUnit'] as $key => $value){
                                    
                                    echo'<option value="'.$value->dropVal.'">'.$value->dropName.'</>';
                                }
                            echo'</select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                <label>Length</label>
                                <input type="text" class="form-control dimensionsssss" id="lengthD">
                            </div>
                            <div class="col-sm-3">
                                <label>Unit</label>
                                <select id="lengthUnitD" class="form-control units">';
                                echo'<option value="0" disabled selected>Select Unit</option>';
                                foreach($data['matUnit'] as $key => $value){
                                    echo'<option value="dropVal">'.$value->dropName.'</>';
                                }
                            echo'</select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                <label>Height</label>
                                <input type="text" class="form-control dimensionsssss" id="heightD">
                            </div>
                            <div class="col-sm-3">
                                <label>Unit</label>
                                <select id="heightUnitD" class="form-control units">';
                                echo'<option value="0" disabled selected>Select Unit</option>';
                                    foreach($data['matUnit'] as $key => $value){
                                        echo'<option value="dropVal">'.$value->dropName.'</>';
                                    }
                                echo'</select>
                            </div>
                        </div>
                        <hr>';
            }
            if($id == 'bol'){
                echo'<br>
                        <div class="row">
                            <div class="col-sm-3">
                            </div>
                            <div class="col-sm-6" align="center">
                                <img src="'.base_url().'assets/prods/mnl.png" val="asd" align="center">
                            </div>
                            <div class="col-sm-3">

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                <label>Thread Count</label>
                                <input type="text" class="form-control dimensionsssss" id="threadCountD">
                            </div>
                            <div class="col-sm-3">
                                <label>Unit</label>
                                <select id="threadCountUnitD" class="form-control">';
                                    foreach($data['matUnit'] as $key => $value){
                                        echo'<option value="dropVal">'.$value->dropName.'</>';
                                    }
                                echo'</select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                <label>Length</label>
                                <input type="text" class="form-control dimensionsssss" id="threadLengthD">
                            </div>
                            <div class="col-sm-3">
                                <label>Unit</label>
                                <select id="threadLengthUnitD" class="form-control">';
                                    foreach($data['matUnit'] as $key => $value){
                                        echo'<option value="dropVal">'.$value->dropName.'</>';
                                    }
                                echo'</select>
                            </div>
                        </div>
                        <hr>';
            }
            if($id == 'dow'){
                echo'<br>
                <div class="row">
                    <div class="col-sm-3">
                    </div>
                    <div class="col-sm-6" align="center">
                        <img src="'.base_url().'assets/prods/mnl2.png" val="asd" align="center">
                    </div>
                    <div class="col-sm-3">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <label>Thread Count</label>
                        <input type="text" class="form-control dimensionsssss" id="threadCount2D">
                    </div>
                    <div class="col-sm-3">
                        <label>Unit</label>
                        <select id="threadCountUnit2D" class="form-control">';
                            foreach($data['matUnit'] as $key => $value){
                                echo'<option value="dropVal">'.$value->dropName.'</>';
                            }
                        echo'</select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <label>Length</label>
                        <input type="text" class="form-control dimensionsssss" id="threadLength2D">
                    </div>
                    <div class="col-sm-3">
                        <label>Unit</label>
                        <select id="threadLengthUnit2D" class="form-control">';
                            foreach($data['matUnit'] as $key => $value){
                                echo'<option value="dropVal">'.$value->dropName.'</>';
                            }
                        echo'</select>
                    </div>
                </div>
                <hr>';
            }
            if($id == 'bss'){
                echo'<br>
                <div class="row">
                    <div class="col-sm-3">
                    </div>
                    <div class="col-sm-6" align="center">
                        <img src="'.base_url().'assets/prods/al.png" val="asd" align="center">
                    </div>
                    <div class="col-sm-3">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <label>Area</label>
                        <input type="text" class="form-control dimensionsssss" id="baseAreaD">
                    </div>
                    <div class="col-sm-3">
                        <label>Unit</label>
                        <select id="baseAreaUnitD" class="form-control">';
                            foreach($data['matUnit'] as $key => $value){
                                echo'<option value="dropVal">'.$value->dropName.'</>';
                            }
                        echo'</select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <label>Length</label>
                        <input type="text" class="form-control dimensionsssss" id="baseLengthD">
                    </div>
                    <div class="col-sm-3">
                        <label>Unit</label>
                        <select id="baseLengthUnitD" class="form-control">';
                            foreach($data['matUnit'] as $key => $value){
                                echo'<option value="dropVal">'.$value->dropName.'</>';
                            }
                        echo'</select>
                    </div>
                </div>
                <hr>';
            }
            if($id == 'bsl'){
                echo'<br>
                <div class="row">
                    <div class="col-sm-3">
                    </div>
                    <div class="col-sm-6" align="center">
                        <img src="'.base_url().'assets/prods/dl.png" val="asd" align="center">
                    </div>
                    <div class="col-sm-3">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <label>Diameter</label>
                        <input type="text" class="form-control dimensionsssss" id="beadDiameterD">
                    </div>
                    <div class="col-sm-3">
                        <label>Unit</label>
                        <select id="beadAreaUnitD" class="form-control">';
                            foreach($data['matUnit'] as $key => $value){
                                echo'<option value="dropVal">'.$value->dropName.'</>';
                            }
                        echo'</select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <label>Length</label>
                        <input type="text" class="form-control dimensionsssss" id="beadLengthD">
                    </div>
                    <div class="col-sm-3">
                        <label>Unit</label>
                        <select id="beadLengthUnitD" class="form-control">';
                            foreach($data['matUnit'] as $key => $value){
                                echo'<option value="dropVal">'.$value->dropName.'</>';
                            }
                        echo'</select>
                    </div>
                </div>
                <hr>';
            }
            if($id == 'vol'){
                echo'<br>
                <div class="row">
                    <div class="col-sm-3">
                    </div>
                    <div class="col-sm-6" align="center">
                        <img src="'.base_url().'assets/prods/vol.png" val="asd" align="center">
                    </div>
                    <div class="col-sm-3">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <label>Volume</label>
                        <input type="text" class="form-control dimensionsssss" id="volD">
                    </div>
                    <div class="col-sm-3">
                        <label>Unit</label>
                        <select id="volUnitD" class="form-control">';
                            foreach($data['matUnitV'] as $key => $value){
                                echo'<option value="dropVal">'.$value->dropName.'</>';
                            }
                        echo'</select>
                    </div>
                </div>
                <hr>';
            }
            if($id == 'was'){
                echo'<br>
                <div class="row">
                    <div class="col-sm-3">
                    </div>
                    <div class="col-sm-6" align="center">
                        <img src="'.base_url().'assets/prods/dida.png" val="asd" align="center">
                    </div>
                    <div class="col-sm-3">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <label>Inner Diameter</label>
                        <input type="text" class="form-control dimensionsssss" id="innderDiameterD">
                    </div>
                    <div class="col-sm-3">
                        <label>Unit</label>
                        <select id="innderDiameterUnitD" class="form-control">';
                            foreach($data['matUnit'] as $key => $value){
                                echo'<option value="dropVal">'.$value->dropName.'</>';
                            }
                        echo'</select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <label>Length</label>
                        <input type="text" class="form-control dimensionsssss" id="outerDiameterD">
                    </div>
                    <div class="col-sm-3">
                        <label>Unit</label>
                        <select id="outerDiameterUnitD" class="form-control">';
                            foreach($data['matUnit'] as $key => $value){
                                echo'<option value="dropVal">'.$value->dropName.'</>';
                            }
                        echo'</select>
                    </div>
                </div>
                <hr>';
            }
            if($id == 'nut'){
                echo'<br>
                <div class="row">
                    <div class="col-sm-3">
                    </div>
                    <div class="col-sm-6" align="center">
                        <img src="'.base_url().'assets/prods/nut.png" val="asd" align="center">
                    </div>
                    <div class="col-sm-3">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <label>Inner Diameter</label>
                        <input type="text" class="form-control dimensionsssss" id="nutDiaD">
                    </div>
                    <div class="col-sm-3">
                        <label>Unit</label>
                        <select id="innderDiameterUnitD" class="form-control">';
                            foreach($data['matUnit'] as $key => $value){
                                echo'<option value="dropVal">'.$value->dropName.'</>';
                            }
                        echo'</select>
                    </div>
                </div>
                <hr>';
            }
        }
        public function materialsCreate(){
            $this->load->model('Query_progOne');
            $data['dims']  =  $this->Query_progOne->fetchData('TABLEdimproperties',"");
            $this->load->view('reusable/header');
            $this->load->view('reusable/sidebar');
            $this->load->view('products_v2/materials',$data);
            $this->load->view('reusable/footer');
        }
        public function componentsCreate(){
            $this->load->model('Query_progOne');
            $data['mats']  =  $this->Query_progOne->fetchData('TABLEmaterial',"");
            $data['fabs']  =  $this->Query_progOne->fetchData('TABLEFabrication',"");
            $data['drops']  =  $this->Query_progOne->fetchData('TABLEproductsdroplist',"dropCat = 'compClass'");
            $this->load->view('reusable/header');
            $this->load->view('reusable/sidebar');
            $this->load->view('products_v2/component',$data);
            $this->load->view('reusable/footer');
        }
        public function createBarrier(){
            $this->load->model('Query_progOne');
            $data['drops']  =  $this->Query_progOne->fetchData('TABLEproductsdroplist',"dropCat = 'barrierType'");
            $this->load->view('reusable/header');
            $this->load->view('reusable/sidebar');
            $this->load->view('products_v2/barrierSystem',$data);
            $this->load->view('reusable/footer');
        }
        public function fabricationCreate(){
            $this->load->view('reusable/header');
            $this->load->view('reusable/sidebar');
            $this->load->view('products_v2/fabrication');
            $this->load->view('reusable/footer');
        }
        public function serviceCreate(){
            $this->load->view('reusable/header');
            $this->load->view('reusable/sidebar');
            $this->load->view('products_v2/service');
            $this->load->view('reusable/footer');
        }
        public function matList(){
            $this->load->model('Query_progOne');
    		$request = $this->input->post('xmlRequest');
		    if($request =='modalmatDATA'){
			    $filter = $this->input->post('xmlFilter');
                if($filter==''){
                    $data['matList']=  $this->Query_progOne->fetchData('TABLEmaterial',"");
                }else{
                    $data['matList']=  $this->Query_progOne->fetchData('TABLEmaterial',"matCode LIKE '%$filter%'");
                }
                if(!empty($data['matList'])){
                    foreach ($data['matList'] as $key => $value) {
                        echo "<tr>";
                            echo '<td>'.$value->matCode.'</td>';
                            echo '<td>'.$value->matName.'</td>';
                            echo '<td><button class="btn btn-sm btn-default paper " onclick="getMatCode('."'".$value->matCode."','".$value->matName."',".$value->matUnitPrice.",'".$value->matBaseUnit."'".')">+</button></td>';
                        echo "</tr>";
                    }
                }
            }
        }
        public function fabList(){
            $this->load->model('Query_progOne');
            $request = $this->input->post('xmlRequest');
            if($request =='modalmatDATA2'){
                $filter = $this->input->post('xmlFilter');
                if($filter==''){
                    $data['fabList']=  $this->Query_progOne->fetchData('TABLEFabrication',"");
                }else{
                    $data['fabList']=  $this->Query_progOne->fetchData('TABLEFabrication',"fabName LIKE '%$filter%'");
                }
                if(!empty($data['fabList'])){
                    foreach ($data['fabList'] as $key => $value) {
                        echo "<tr>";
                            echo '<td>'.$value->fabName.'</td>';
                            echo '<td>'.$value->fabCost.'</td>';
                            echo '<td>'.$value->fabUnit.'</td>';
                            echo '<td><button class="btn btn-sm btn-default paper " onclick="getFabCode('."'".$value->fabID."','".$value->fabName."',".$value->fabCost.",'".$value->fabUnit."'".')">+</button></td>';
                        echo "</tr>";
                    }
                }
            }
        }
        public function autoChange(){
            $val = $this->input->get('ajaxPass');

            $this->load->model('Query_progOne');
            $data['change']  =  $this->Query_progOne->fetchData('TABLEproductsdroplist',"dropVal = '$val' ");
            if(!empty($data['change'])){
                foreach($data['change'] as $key => $value){
                    echo $value->dropUnit;
                }
            }
            
        }
        public function ajaxSaveMatDim(){
           /*  $lengthD = $this->input->get('');
            $widthD = $this->input->get('');
            $heightD = $this->input->get('');
            $widthD = $this->input->get('');
            //bolt
            $threadCountDa = $this->input->get('');
            $threadLengthD = $this->input->get('');
            //dowel
            $threadCount2D = $this->input->get('');
            $threadLength2D = $this->input->get('');
            //base seal
            $baseAreaD = $this->input->get('');
            $baseLengthD = $this->input->get('');
            //bead seal
            $beadDiameterD = $this->input->get('');
            $beadLengthD = $this->input->get('');
            //volume
            $volD = $this->input->get('');
            //washer
            $innderDiameterD = $this->input->get('');
            $outerDiameterD = $this->input->get('');
            //nut
            $nutDiaD = $this->input->get('');*/
        }
        public function ajaxSavingComponent(){
            $compCode = $this->input->get('ajaxCode');
            $compName = $this->input->get('ajaxName');
            $compClass = $this->input->get('ajaxClass');
            $compDesc = $this->input->get('ajaxDesc');
            $compBasisVal = $this->input->get('ajaxBaseVal');
            $compBasisUnit = $this->input->get('ajaxBaseUnit');
            $compPrice = $this->input->get('ajaxPrice');
            //---to be discussed
            $fields = array(
                'compID'=>$compCode,
                'compName'=>$compName,
                'compDescription'=>$compDesc,
                'compClass'=>$compClass,
                'compRelDimanesion'=>$compBasisVal,
                'compRelativeDimSize'=>$compBasisUnit,
                'compPrice'=>$compPrice
            );
            //$this->Query_progOne->createData('TABLEcomponent',$fields);
        }
        public function ajaxSavingCompMat(){
            $comCode = $this->input->get('ajaxCompCode');
            $matCode = $this->input->get('ajaxMatCode');
            $matSize = $this->input->get('ajaxMatSize');
            $matQty = $this->input->get('ajaxmatQty');
            $matPrice = $this->input->get('ajaxPrice');
            $matWaste = $this->input->get('ajaxWaste');
            $fields = array(
                'cmComp'=>$comCode,
                'cmMat'=>$matCode,
                'cmSize'=>$matSize,
                'cmQty'=>$matQty,
                'cmWaste'=>$matWaste
            );
            //$this->Query_progOne->createData('TABLEcompmat',$fields);
        }
        public function ajaxSavingFabrication(){
            $fabCode = $this->input->get('ajaxFabName');
            $fabSize = $this->input->get('ajaxSize');
            $compCode = $this->input->get('ajaxCompCode');
            $fields = array(
                'cfComp'=>$compCode,
                'cfFab'=>$fabCode,
                'cfSize'=>$fabSize
            );
            //$this->Query_progOne->createData('TABLEcompfabrication',$fields);
        }
        public function ajaxSavingService(){
            $this->load->model('Query_progOne');
            $serviceCode = $this->input->get('ajaxServiceCode');
            $serviceName = $this->input->get('ajaxServiceName');
            $serviceDesc = $this->input->get('ajaxServiceDescription');
            $serviceTotal = $this->input->get('ajaxServiceTotal');
            $fields = array(
                'serviceCode'=>$serviceCode,
                'serviceName'=>$serviceName,
                'serviceDesc'=>$serviceDesc,
                'serviceTotal'=>$serviceTotal
            );
            $this->Query_progOne->createData('TABLEservice',$fields);
        }
        public function ajaxServiceBreak(){
            $this->load->model('Query_progOne');
            $breakDesc = $this->input->get('ajaxBreakDesc');
            $breakVal = $this->input->get('ajaxBreakVal');
            $breakCost = $this->input->get('ajaxBreakCost');
            $breakUnit = $this->input->get('ajaxBreakUnit');
            $serviceCode = $this->input->get('ajaxServiceCode');
            echo $breakDesc;
            echo $breakVal;
            echo $breakCost;
            echo $breakUnit;
            echo  $serviceCode    ;
            $fields = array(
                'serviceBreakDesc'=>$breakDesc,
                'serviceBreakVal'=>$breakVal,
                'serviceBreakCost'=>$breakCost,
                'serviceBreakUnit'=>$breakUnit,
                'serviceCode'=>$serviceCode
            );
            $this->Query_progOne->createData('TABLEservicebreak',$fields);
        }
        public function ajaxGetServiceBreakdown(){
            $id =  $this->input->get('ajaxID');
            $data['breakDown']=  $this->Query_progOne->fetchData('TABLEservicebreak',"serviceCode='$id'");
            if(!empty($data['breakDown'])){
                foreach($data['breakDown'] as $key => $value){
                    echo'<tr>
                            <td>'.$value->serviceBreakDesc.'</td>
                            <td>'.$value->serviceBreakVal.'</td>
                            <td>'.$value->serviceBreakCost.'</td>
                            <td>'.$value->serviceBreakUnit.'</td>
                        </tr>';
                }
            }
        }
        public function sysCompList(){
            $this->load->model('Query_progOne');
    		$request = $this->input->post('xmlRequest');
		    if($request =='modalmatDATA'){
			    $filter = $this->input->post('xmlFilter');
                if($filter==''){
                    $data['sysCompList']=  $this->Query_progOne->fetchData('TABLEproductsdroplist',"dropCat='compClass'");
                }else{
                    $data['sysCompList']=  $this->Query_progOne->fetchData('TABLEproductsdroplist',"compName LIKE '%$filter%'");
                }
                if(!empty($data['sysCompList'])){
                    foreach ($data['sysCompList'] as $key => $value) {
                        echo "<tr>";
                            echo '<td>'.$value->dropName.'</td>';
                            echo '<td><button class="btn btn-sm btn-default paper " onclick="getSysCompCode('."'".$value->dropVal."','".$value->dropName."','".$value->dropUnit."','".$value->dropVal."'".')">+</button></td>';
                        echo "</tr>";
                    }
                }
            }
        }
        public function savingBarrierSystem(){
            $this->load->model('Query_progOne');
            $sysCode = $this->input->get('ajaxSysCode');
            $sysName = $this->input->get('ajaxSysName');
            $sysPrice = $this->input->get('ajaxSysPrice');
            $sysConfig = $this->input->get('ajaxSysConfig');
            $sysCate = $this->input->get('ajaxSysCate');
            $sysDesc = $this->input->get('ajaxSysDesc');
            $sysWeight = $this->input->get('ajaxSysWeight');
            $sysHeight = $this->input->get('ajaxSysHeight');
            $sysWidth = $this->input->get('ajaxSysWidth');
            $sysLength = $this->input->get('ajaxSysLength');
            $fields = array(
                'barCode'=>$sysCode,
                'barName'=>$sysName,
                'barConfig'=>$sysConfig,
                'barCategory'=>$sysCate,
                'barDescription'=>$sysDesc,
                'barPrice'=>$sysPrice,
                'barHeight'=>$sysHeight,
                'barWeight'=>$sysWeight,
                'barWidth'=>$sysWidth,
                'barLegth'=>$sysLength
            );
             //$this->Query_progOne->createData('TABLEbarriersystem',$fields);
        }
        public function savingBarrierComp(){
            $this->load->model('Query_progOne');
            $barSysCode = $this->input->get('ajaxBarSysCode');
            $compCode = $this->input->get('ajaxCompCode');
            $compName = $this->input->get('ajaxCompName');
            $compClass = $this->input->get('ajaxCompClass');
            $compSize = $this->input->get('ajaxCompSize');
            $compUnit = $this->input->get('ajaxCompUnit');
            $compQty = $this->input->get('ajaxCompQty');
            $fields = array(
                'barSysCode'=>$barSysCode,
                'barCompCode'=>$compCode,
                'barCompClass'=>$compClass,
                'barCompSize'=>$compSize,
                'barCompUnit'=>$compUnit,
                'barCodeQty'=>$compQty
            );
            //$this->Query_progOne->createData('TABLEbarriercompsys',$fields);
        }
        public function savingBarrierMat(){
            $this->load->model('Query_progOne');
            $barSysCode = $this->input->get('ajaxBarSysCode');
            $matCode = $this->input->get('ajaxMatCode');
            $matName = $this->input->get('ajaxMatName');
            $matSize = $this->input->get('ajaxMatSize');
            $matUnit = $this->input->get('ajaxMatUnit');
            $matQty = $this->input->get('ajaxMatQty');
            $fields = array(

                'barCodeSys'=>$barSysCode,
                'barMatCode'=>$matCode,
                'barMatSize'=>$matSize,
                'barMatUNit'=>$matUnit,
                'barMatQty'=>$matQty
                
            );
            //$this->Query_progOne->createData('TABLEbarmatsys',$fields);
        }
        public function materialEdit(){
            $id = $this->input->get('ajaxid');
            $this->load->model('Query_progOne');
            $data['mats']  =  $this->Query_progOne->fetchData('TABLEmaterial',"matID=' $id '");
            $this->load->view('reusable/header');
            $this->load->view('reusable/sidebar');
            $this->load->view('products_v2/productEdit/materialEdit',$data);
            $this->load->view('reusable/footer');
        }
        public function componentEdit(){
            $this->load->model('Query_progOne');
            $id = $this->input->get('ajaxID');
            echo $id;
            $data['mats']  =  $this->Query_progOne->fetchData('TABLEmaterial',"");
            $data['fabs']  =  $this->Query_progOne->fetchData('TABLEFabrication',"");
            $data['drops']  =  $this->Query_progOne->fetchData('TABLEproductsdroplist',"dropCat = 'compClass'");
            $data['comps']  =  $this->Query_progOne->fetchData('TABLEcomponent',"compID='RS-ABLN1000'");
            $data['compMat'] = $this->Query_progOne->fetchData('TABLEcomponent,TABLEcompmat,TABLEmaterial',"compID='RS-ABLN1000' AND cmComp = 'RS-ABLN1000' AND matCode =cmMat");
            $this->load->view('reusable/header');
            $this->load->view('reusable/sidebar');
            $this->load->view('products_v2/productEdit/componentEdit',$data);
            $this->load->view('reusable/footer');
        }



        //questionable creating system
        public function sysCompCreateQuestionable(){
            $this->load->model('Query_progOne');
            $data['drops']  =  $this->Query_progOne->fetchData('TABLEproductsdroplist',"dropCat = 'barrierType'");
            $this->load->view('reusable/header');
            $this->load->view('reusable/sidebar');
            $this->load->view('products_v2/barrierSystemQuestionable',$data);
            $this->load->view('reusable/footer');
        }
        public function sysCompListQuestionable(){
            $this->load->model('Query_progOne');
    		$request = $this->input->post('xmlRequest');
		    if($request =='modalmatDATA'){
			    $filter = $this->input->post('xmlFilter');
                if($filter==''){
                    $data['sysCompList']=  $this->Query_progOne->fetchData('TABLEcomponent',"");
                }else{
                    $data['sysCompList']=  $this->Query_progOne->fetchData('TABLEcomponent',"compName LIKE '%$filter%'");
                }
                if(!empty($data['sysCompList'])){
                    foreach ($data['sysCompList'] as $key => $value) {
                        echo "<tr>";
                            echo '<td>'.$value->compName.'</td>';
                            echo '<td><button class="btn btn-sm btn-default paper " onclick="getSysCompCode('."'".$value->compID."','".$value->compName."','".$value->compUnit."',".$value->dropVal."'".$value->compPrice."'".')">+</button></td>';
                        echo "</tr>";
                    }
                }
            }
        }
        public function matListQuestionable(){
            $this->load->model('Query_progOne');
    		$request = $this->input->post('xmlRequest');
		    if($request =='modalmatDATA'){
			    $filter = $this->input->post('xmlFilter');
                if($filter==''){
                    $data['matList']=  $this->Query_progOne->fetchData('TABLEmaterial',"");
                }else{
                    $data['matList']=  $this->Query_progOne->fetchData('TABLEmaterial',"matCode LIKE '%$filter%'");
                }
                if(!empty($data['matList'])){
                    foreach ($data['matList'] as $key => $value) {
                        echo "<tr>";
                            echo '<td>'.$value->matCode.'</td>';
                            echo '<td>'.$value->matName.'</td>';
                            echo '<td><button class="btn btn-sm btn-default paper " onclick="getMatCode('."'".$value->matCode."','".$value->matName."',".$value->matUnitPrice.",'".$value->matBaseUnit."'".')">+</button></td>';
                        echo "</tr>";
                    }
                }
            }
        }
    }