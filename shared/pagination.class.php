<?php

class eidir_pagination {
	private $wpdb,$tablename,$totalPage,$totalLines,$pageRequested;
	private $page,$sort;
	
	function __construct($tablename,$wpdb) {
		$this->page=EIDIR_PAGINATION;
		$this->sort=EIDIR_PAGINATION_SORT;
		$this->tablename=$tablename;
		$this->wpdb=$wpdb;
	}
	function query($fields="*",$where="") {
		$this->pageRequested=(isset($_REQUEST["pageno"])? $_REQUEST["pageno"]:'0');
		$startPage=$this->pageRequested*$this->page;
		$sql1="SELECT count(*) as count FROM  $this->tablename $where";
 		$this->totalLines=$this->wpdb->get_row($sql1)->count;

 		if ($this->totalLines%$this->page != 0) {
			$this->totalPage=intval($this->totalLines/$this->page)+1;
		}
		else {
			$this->totalPage=intval($this->totalLines/$this->page);
		}
 		$sql2="SELECT $fields FROM  $this->tablename $where LIMIT $startPage,$this->page";
 		$rows = $this->wpdb->get_results($sql2);
 		return $rows;
		
	}
	protected function urlForPagination($newPageNo=0) {
		parse_str($_SERVER['QUERY_STRING'], $result_array);
		unset($result_array['pageno']);
		$result_array['pageno']=$newPageNo;
		return http_build_query($result_array);
	}
	function generateLinkForAdmin() {
		echo '<ul class="pagination">';
		$y=0;
		for ($x=0;$x<$this->totalPage;$x++) {
			if ($this->pageRequested == $x) {
				echo '<li class="button"><b>'.++$y.'</b></li>';
			}
			else {
				echo '<li class="button"><a href="'.admin_url().'admin.php?'.$this->urlForPagination($x).'">'.++$y.'</a></li>';
			}
  			
		}
		echo '</ul>';
	}
	function generateLink() {
		$current_url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		$current_url_without_questionmark = substr( $current_url, 0, strrpos( $current_url, "?"));
		
		echo '<ul class="pagination">';
		$y=0;
		for ($x=0;$x<$this->totalPage;$x++) {
			if ($this->pageRequested == $x) {
				echo '<li><a href="javascript:void(0)">'.++$y.'</a></li>';
			}
			else {
				echo '<li><a href="'.$current_url_without_questionmark.'?'.$this->urlForPagination($x).'">'.++$y.'</a></li>';
			}
  			
		}
		echo '</ul>';
	}
	function returnOutputAsArray() {

	}



}