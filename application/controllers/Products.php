<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	class Products extends CI_Controller
	{
	public $access =  0;
	public $groupID = 0;
	public $readonly = 7;
	public $readandwrite = 77;
	public $fullaccess = 777;
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Query_progOne');
		if($this->session->has_userdata('userSession')){
			$sesuserID = $this->session->userdata['userSession']['user_ID'];
			$systemRole = $this->Query_progOne->getone("tblUsers"," uniqueId = '$sesuserID' ", "sytemRole");
			$this->groupID = $this->session->userdata['userSession']['user_groupId']; 
			$this->access = $this->Query_progOne->checkAccess($systemRole,'Products') ;
			
		}else{
			redirect(base_url() . 'Home','refresh');
		}
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
			$data['systemData'] =  $this->Query_progOne->countData('tblSystem',"");
			$data['compData'] =  $this->Query_progOne->countData('tblComponent',"");
			$data['matData'] =  $this->Query_progOne->countData('tblMaterial',"");
			$this->load->view('reusable/header');
			$this->load->view('reusable/sidebar');
			$this->load->view('products/prodboard',$data);
			$this->load->view('reusable/footer');
		}else{
			redirect(base_url('Welcome/msger'),'refresh');
		}
	}
	public function barriers(){
		if( ( $this->access >= $this->readonly ) || ( $this->groupID <= 2 ) ){
			$data['systemData'] =  $this->Query_progOne->fetchData('tblSystem',"");
			$this->load->view('reusable/header');
			$this->load->view('reusable/sidebar');
			$this->load->view('products/barriers',$data);
			$this->load->view('reusable/footer');
		}else{
			redirect(base_url('Welcome/msger'),'refresh');
		}
	}
	public function barriers_view(){
		if( ( $this->access >= $this->readonly ) || ( $this->groupID <= 2 ) ){
			$sysCode = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
			$data['systemData'] =  $this->Query_progOne->fetchData('tblSystem',"sysCode = '$sysCode' ");
			$data['syscomp'] =  $this->Query_progOne->fetchData('tblSysComp',"systemCode = '$sysCode' AND componentClass='N/A' ");
			$data['components'] = $this->Query_progOne->fetchData('tblSysComp,tblComponent',
				" (systemCode = '$sysCode') AND (size = componentHeight OR size = componentWidth)
				AND tblComponent.componentClass = tblSysComp.componentClass 
				"
			);

			$data['compMAT'] = $this->Query_progOne->fetchSorted('tblSysComp,tblComponent,tblCompMat',
				" (systemCode = '$sysCode') AND (size = componentHeight OR size = componentWidth)
				AND tblComponent.componentClass = tblSysComp.componentClass 
				AND tblComponent.componentCode = tblCompMat.componentCode
				"
				,"tblComponent.componentCode"
				,"asc"
			);
			$this->load->view('reusable/header');
			$this->load->view('reusable/sidebar');
			$this->load->view('products/barriers_view',$data);
			$this->load->view('reusable/footer');
		}else{
			redirect(base_url('Welcome/msger'),'refresh');
		}
	}
	public function barrier_new(){
		if( ( $this->access >= $this->readandwrite ) || ( $this->groupID <= 2 ) ){
			$data['systypedd']=  $this->Query_progOne->fetchData('tblBarrierdroplist',"dropCat = 'sysType' ");
			$data['syscatdd']=  $this->Query_progOne->fetchData('tblBarrierdroplist',"dropCat = 'sysCat' ");
			$data['classdd']=  $this->Query_progOne->fetchData('tblBarrierdroplist',"dropCat = 'classDrop' ");
			$data['attribdd']=  $this->Query_progOne->fetchData('tblBarrierdroplist',"dropCat = 'attribDrop' ");
			$data['matdd']=  $this->Query_progOne->fetchData('tblMaterial',"");
			$this->load->view('reusable/header');
			$this->load->view('reusable/sidebar');
			$this->load->view('products/barrier_new',$data);
			$this->load->view('reusable/footer');
		}else{
			$this->barriers();
		}
	}
	public function barriers_edit(){
		if( ( $this->access >= $this->readandwrite ) || ( $this->groupID <= 2 ) ){
			$sysCode = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
			$data['systemData'] =  $this->Query_progOne->fetchData('tblSystem',"sysCode = '$sysCode' ");
			$data['syscomp'] =  $this->Query_progOne->fetchData('tblSysComp,tblBarrierdroplist',"systemCode = '$sysCode' AND dropVal = componentClass");
			$data['sysmat'] = 
			$this->Query_progOne->fetchData('tblSysComp,tblMaterial',
			"systemCode = '$sysCode' AND materialCode = sysMat ");
			$data['systypedd']=  $this->Query_progOne->fetchData('tblBarrierdroplist',"dropCat = 'sysType' ");
			$data['syscatdd']=  $this->Query_progOne->fetchData('tblBarrierdroplist',"dropCat = 'sysCat' ");
			$data['classdd']=  $this->Query_progOne->fetchData('tblBarrierdroplist',"dropCat = 'classDrop' ");
			$data['attribdd']=  $this->Query_progOne->fetchData('tblBarrierdroplist',"dropCat = 'attribDrop' ");
			$data['matdd']=  $this->Query_progOne->fetchData('tblMaterial',"");
			$this->load->view('reusable/header');
			$this->load->view('reusable/sidebar');
			$this->load->view('products/barrier_edit',$data);
			$this->load->view('reusable/footer');
		}else{
			$this->barriers();
		}
	}
	public function materials(){
		if( ( $this->access >= $this->readonly ) || ( $this->groupID <= 2 ) ){
			$data['matList']=  $this->Query_progOne->fetchData('tblMaterial',"");
			$this->load->view('reusable/header');
			$this->load->view('reusable/sidebar');
			$this->load->view('products/materials',$data);
			$this->load->view('reusable/footer');
		}else{
			redirect(base_url('Welcome/msger'),'refresh');
		}
	}
	public function components(){
		if( ( $this->access >= $this->readonly ) || ( $this->groupID <= 2 ) ){
			$data['compList']=  $this->Query_progOne->fetchData('tblComponent',"");
			$this->load->view('reusable/header');
			$this->load->view('reusable/sidebar');
			$this->load->view('products/components',$data);
			$this->load->view('reusable/footer');

		}else{
			redirect(base_url('Welcome/msger'),'refresh');
		}
	}
	public function components_new(){
		if( ( $this->access >= $this->readandwrite ) || ( $this->groupID <= 2 ) ){
			$data['classdd']=  $this->Query_progOne->fetchData('tblBarrierdroplist',"dropCat = 'classDrop' ");
			$data['fabList'] = $this->Query_progOne->fetchData('tblComponent_fabrication',"");
			$this->load->view('reusable/header');
			$this->load->view('reusable/sidebar');
			$this->load->view('products/components_new',$data);
			$this->load->view('reusable/footer');
		}else{
			$this->components();
		}	
	}
	public function components_edit(){
		if( ( $this->access >= $this->readandwrite ) || ( $this->groupID <= 2 ) ){
			$compCode = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
			$data['compData']=  $this->Query_progOne->fetchData('tblComponent',"componentCode = '$compCode' ");
			$data['cmatData'] = $this->Query_progOne->fetchData('tblCompMat,tblMaterial',"componentCode = '$compCode' AND tblMaterial.materialCode = tblCompMat.materialCode ");
			$data['fabList'] = $this->Query_progOne->fetchData('tblComponent_fabrication',"");
			$data['persistentFabList'] = $this->Query_progOne->fetchData('tblComponent_compfab,tblComponent_fabrication',"cf_compID ='$compCode' AND cf_fabId = fabID ");
			$this->load->view('reusable/header');
			$this->load->view('reusable/sidebar');
			$this->load->view('products/components_edit',$data);
			$this->load->view('reusable/footer');
		}else{
			$this->components();
		}
	}
// -------------------------------material xml--------------------------------------------- //
	public function materialsxml(){
		$request = $this->input->post('xmlRequest');
		if($request =='modalmatDATA'){
			$filter = $this->input->post('xmlFilter');
			if($filter==''){
				$data['matList']=  $this->Query_progOne->fetchData('tblMaterial',"");
			}else{
				$data['matList']=  $this->Query_progOne->fetchData('tblMaterial',"materialCode LIKE '$filter%'");
			}
			if(!empty($data['matList'])){
				foreach ($data['matList'] as $key => $value) {
					echo "<tr>";
						echo '<td>'.$value->materialCode.'</td>';
						echo '<td>'.$value->materialName.'</td>';
						echo '<td><button class="btn btn-sm btn-default paper " onclick="getMatCode('."'".$value->materialCode."','".$value->materialName."',".$value->phPrice.",".$value->dePrice.')">+</button></td>';
					echo "</tr>";
				}
			}
		}
		if($request =='refreshdata'){
			$data['matList']=  $this->Query_progOne->fetchData('tblMaterial',"");
			if(!empty($data['matList'])){
				$ctr = 0;
				foreach ($data['matList'] as $key => $value) {
					$ctr++;
					echo '<tr onclick="optionHide(); show('.$ctr.');">';
						echo 
							'<td>
								<button 
								class="btn btn-sm btn-warning fas fa-edit hider show'.$ctr.'"
								data-toggle="modal" data-target="#edit"
								onclick="update('."'".$value->materialCode."','".$value->materialName."'".')"
								>
								</button>

								<button 
								class="btn btn-sm btn-danger fa fa-trash hider show'.$ctr.'"
								data-toggle="modal" data-target="#myModal" 
								onclick="del('."'".$value->materialCode."'".')">
								</button> 
								'.$value->materialCode.' 
							</td>';
						echo '<td>'.$value->materialName.'</td>';
					echo '</tr>';
				}
			}else{
				echo "No data Available";
			}
		}
		if( ( $this->access >= $this->readandwrite ) || ( $this->groupID <= 2 ) ){
			if($request =='update'){
				$materialCode =  $this->input->post('xmlMatcode');
				$materialName =  $this->input->post('xmlMatname');
				$deCost =  $this->input->post('xmlDEmat');
				$phCost =  $this->input->post('xmlPHmat');
				$fields = array(					
					'materialCode' => $materialCode,
					'materialName' => $materialName,
					'dePrice' =>$deCost,
					'phPrice' => $phCost
				);		
				$this->Query_progOne->changeData('tblMaterial',$fields,"materialCode = '$materialCode'");
			}
			if($request =='insert'){
				$materialCode =  $this->input->post('xmlMatcode');
				$materialName =  $this->input->post('xmlMatname');
				$deCost =  $this->input->post('xmlDEmat');
				$phCost =  $this->input->post('xmlPHmat');
				$fields = array(					
					'materialCode' => $materialCode,
					'materialName' => $materialName,
					'dePrice' =>$deCost,
					'phPrice' => $phCost
				);			
				$this->Query_progOne->createData('tblMaterial',$fields);
			}
		}
		if( ( $this->access >= $this->fullaccess ) || ( $this->groupID <= 2 ) ){
			if($request =='delete'){
				$materialCode =  $this->input->post('xmlMatcode');
				$materialName =  $this->input->post('xmlMatname');
				$this->Query_progOne->deleteData('tblMaterial',"materialCode = '$materialCode'");
			}
		}	
	}
// -------------------------------material xml--------------------------------------------- //
//- -------------------------- fabric -----------------------------------------/
	public function fabXml(){		
	$request = $this->input->post('xmlRequest');
	$fabID  = $this->input->post('fabID');
	$compID = $this->input->post('compCode');
	$valueMultiplier = $this->input->post('valueMultiplier');
	$fields = array(					
		'cf_compID' => $compID,
		'cf_fabId' => $fabID,
		'cf_basisValue' => $valueMultiplier
	);	
	$this->Query_progOne->createData('tblComponent_compfab',$fields);
	}
//- -------------------------- fabric -----------------------------------------/
// -------------------------------component xml--------------------------------------------- //		
	public function compxml(){
		$request = $this->input->post('xmlRequest');

		if($request =='refreshdata'){
			$data['compList']=  $this->Query_progOne->fetchData('tblComponent',"");
			if(!empty($data['compList'])){
				$ctr=0;
				foreach ($data['compList'] as $key => $value) {
					$ctr++;
					echo '<tr onclick="optionHide(); show('.$ctr.');">';
						echo '
						<td> 
							<a href="'.base_url().'Products/components_edit/'.$value->componentCode.'" 
								class="btn btn-warning btn-sm fas fa-edit hider show'.$ctr.'">
							</a>
							<button 
								class="btn btn-danger btn-sm fa fa-trash hider show'.$ctr.'"
								data-toggle="modal" data-target="#myModal" 
								onclick="del('."'".$value->componentCode."'".')">
							</button> 
							'.$value->componentCode.' 
						</td>';
						echo '<td>'.$value->componentClass.'</td>';
						echo '<td>'.$value->componentWidth.'</td>';
						echo '<td>'.$value->componentHeight.'</td>';
					echo '</tr>';
				}
			}else{
				echo "<td> No data Available. </td>";
			}
		}
		if( ( $this->access >= $this->readandwrite ) || ( $this->groupID <= 2 ) ){
			if($request =='insertComp'){
				$componentCode =  $this->input->post('xmlCompcode');
				$componentClass = $this->input->post('xmlCompclass');
				$componentWidth = $this->input->post('xmlCompwidth');
				$componentWidthUnit = $this->input->post('xmlCompwidthUnit');
				$componentHeight = $this->input->post('xmlCompheight');
				$componentHeightUnit = $this->input->post('xmlCompheightUnit');
				$compName = $this->input->post('xmlCname');
				$compDEcost = $this->input->post('xmlDE');
				$fields = array(					
					'componentCode' => $componentCode,
					'componentClass' => $componentClass,
					'componentWidth' => $componentWidth,
					'componentWidthUnit' => $componentWidth,
					'componentHeight' => $componentHeight,
					'componentHeightUnit' => $componentHeight,
					'dePrice' => $compDEcost,
					'componentName' => $compName
				);	
				$data['check']=$this->Query_progOne->fetchData('tblComponent',"componentCode = '$componentCode' ");
				if(!empty($data['check'])){
					$this->Query_progOne->changeData('tblComponent',$fields,"componentCode = '$componentCode' ");
					$this->Query_progOne->deleteData('tblCompMat',"componentCode = '$componentCode' ");
					$this->Query_progOne->deleteData('tblComponent_compfab',"cf_compID = '$componentCode' ");
				}else{
					$this->Query_progOne->createData('tblComponent',$fields);
				}
			}
			if($request == 'insertCompmat'){
				$componentCode =  $this->input->post('xmlCompmatcode');
				$materialCode  =  $this->input->post('xmlCmat');
				$materialSize  =  $this->input->post('xmlCmatsize');
				$materialUnit  =  $this->input->post('xmlCmatunit');
				$materialQty  =  $this->input->post('xmlCmatqty');

				$fields = array(					
					'componentCode' => $componentCode,
					'materialCode' => $materialCode,
					'materialSize' => $materialSize,
					'materialUnit' => $materialUnit,
					'materialQty' => $materialQty
				);	
				$this->Query_progOne->createData('tblCompMat',$fields);
			}
		}
		if( ( $this->access >= $this->fullaccess ) || ( $this->groupID <= 2 ) ){
			if($request =='delete'){
				$componentCode =  $this->input->post('xmlCompcode');
				$this->Query_progOne->deleteData('tblComponent',"componentCode = '$componentCode'");
				$this->Query_progOne->deleteData('tblCompMat',"componentCode = '$componentCode'");
				$this->Query_progOne->deleteData('tblComponent_compfab',"cf_compID = '$componentCode'");
			}

			if($request=='delmata'){
				$componentCode =  $this->input->post('xmlCompmatcode');
				$materialCode  =  $this->input->post('xmlCmat');
				$this->Query_progOne->deleteData('tblCompMat',"componentCode = '$componentCode' AND materialCode = '$materialCode' ");
			}
		}
	}
// -------------------------------component xml--------------------------------------------- //

// -------------------------------barrier xml--------------------------------------------- //
	public function systemXml(){
		$request = $this->input->post('xmlRequest');
		if( ( $this->access >= $this->readandwrite ) || ( $this->groupID <= 2 ) ){
			if($request=="insertBar"){
				$sysCode = $this->input->post('xmlsystemCode');
				$sysWidth = $this->input->post('xmlsystemWidth');
				$sysHeight = $this->input->post('xmlsystemHeight');
				$sysType = $this->input->post('xmlsystemType');
				$sysCategory = $this->input->post('xmlsystemCat');
				$data['checkExits'] = $this->Query_progOne->fetchData('tblSystem',"sysCode = '$sysCode' ");
				$fields = array(					
					'sysCode' => $sysCode,
					'sysWidth' => $sysWidth,
					'sysHeight' => $sysHeight,
					'sysType' => $sysType,
					'sysCategory' => $sysCategory
				);	
				if(!empty($data['checkExits'])){
					$this->Query_progOne->changeData('tblSystem',$fields,"sysCode = '$sysCode' ");
				}else{
					$this->Query_progOne->createData('tblSystem',$fields);
				}
			}
			if($request=="insertSyscomp"){
				$systemCode = $this->input->post('xmlsystemCode');
				$componentClass = $this->input->post('xmlsyscompclass');
				$quantity = $this->input->post('xmlsyscompqty');
				$attributeDimension = $this->input->post('xmlsyscompattrib');
				$size  = $this->input->post('xmlsyscompsize');
				$sysMat = $this->input->post('xmlsyscompmaterial');
				$fields = array(					
					'systemCode' => $systemCode,
					'componentClass' => $componentClass,
					'quantity' => $quantity,
					'attributeDimension' => $attributeDimension,
					'size' => $size,
					'sysMat' => $sysMat
				);	
				$this->Query_progOne->createData('tblSysComp',$fields);
			}
		}
		if( ( $this->access >= $this->fullaccess ) || ( $this->groupID <= 2 ) ){
			if($request=='delsyscomp'){
				$sysCompID =  $this->input->post('xmlGet');
				$this->Query_progOne->deleteData('tblSysComp',"sysCompID = '$sysCompID' ");
			}
			if($request=='delsysNsyscomp'){
				$systemCode =  $this->input->post('xmlGet');
				$this->Query_progOne->deleteData('tblSysComp',"systemCode = '$systemCode' ");
				$this->Query_progOne->deleteData('tblSystem',"sysCode = '$systemCode' ");
			}
		}
	}
// -------------------------------barrier xml--------------------------------------------- //
}//           