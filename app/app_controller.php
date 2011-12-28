<?php
//print_r($_SESSION);
class AppController extends Controller
{
/*add all healpers and components here , no need to add seperately */
//***********method to check the admin session**********************************
	function checkAdminSession()
	{
		if (@$_SESSION['user_id']=="")
		{			
			$this->redirect('/admin/index');
		}
	}
	function adminprev() {
		if($_SESSION['type']==1 ) {
			$this->redirect('/admin/noprev');
		}	
	}	
	function _paginate_leads($criteria) {
		//$options = array ('resultsPerPage' => '100','privateParams' = 'show'); );
		$order='desc';
		$page='5';
		
		list($order,$limit,$page) = $this->Pagination->init($criteria);
		$leads = $this->Boxtype->findAll($criteria, NULL, $order, $limit, $page);
		//echo $leads;
		return $leads;
	}
function nav($pages, $prev = null, $next = null, $escape_text = true)
  {
    $nav = '';
    if ($this->_pageDetails['total'] > $this->_pageDetails['show']) {

      $prev = $this->prevPage($prev, $escape_text);
      $next = $this->nextPage($next, $escape_text);

      if ($this->_pageDetails['page'] > 1) {
        $nav .= $prev." ";
      }
      $nav .= $pages;
      $npages = (int)($this->_pageDetails['total'] / $this->_pageDetails['show']);
      $r = $this->_pageDetails['total'] % $this->_pageDetails['show'];
      if ($r) { $npages++; }
      if ($this->_pageDetails['page'] < $npages) {
        $nav .= " ".$next;
      }
    }
    return $nav;
  }   
	function mainlayout() {
		$this->layout = "frontend";
	}  
	function adminlayout() {	  
		$this->layout="";
	}
	function blanklayout() {	  
		$this->layout="";
	}
	function chkblanksession() {
		$userid=@$_SESSION['userid'] ;
		if($userid=="") {
			$this->redirect('/user/newuser');		
		}	
	}	
	function chklogincounter() {
		$login_counter=$_SESSION['login_counter'] ;
		if($login_counter<=0) {
			$this->redirect('/user/noaccess');
		}
	}	
	function chkusertype() {
		$usertype=$_SESSION['usertype'] ;		
		if($usertype!="P") {			
			$this->redirect('/user/noaccess');
		}	
		else {
			$userid=@$_SESSION['userid'] ;
			$chkvalid_sql="SELECT * FROM tbl_users WHERE id=".$userid." AND membership_exipre_date>='".date("Y-m-d")."' AND payment_status='Y'";
			$chknumr=mysql_query($chkvalid_sql);
			if(mysql_num_rows($chknumr)<=0) {
				$this->redirect('/user/membershipexpire');
			}
		}
	}	
} #End of app_controller
?>