<?php

class Orders extends Controller {

	function __construct() {
		parent::Controller ();
		require_once (APPPATH . 'controllers/default_constructor.php');
		require_once (APPPATH . 'controllers/admin/default_constructor.php');

	}
	function Orders() {
		parent::Controller ();
		require_once (APPPATH . 'controllers/default_constructor.php');
		require_once (APPPATH . 'controllers/admin/default_constructor.php');

	}

	function index() {
		$this->template ['functionName'] = strtolower ( __FUNCTION__ );

		$this->load->vars ( $this->template );

		$layout = $this->load->view ( 'admin/layout', true, true );
		$primarycontent = '';
		$secondarycontent = '';

		$primarycontent = $this->load->view ( 'admin/orders/index', true, true );

		$nav = $this->load->view ( 'admin/orders/subnav', true, true );
		$primarycontent = $nav . $primarycontent;

		//$secondarycontent = $this->load->view ( 'admin/content/sidebar', true, true );
		$layout = str_ireplace ( '{primarycontent}', $primarycontent, $layout );
		$layout = str_ireplace ( '{secondarycontent}', $secondarycontent, $layout );
		//$this->load->view('welcome_message');
		$this->output->set_output ( $layout );
	}
	function ajax_json_edit_orders() {
		$this->template ['functionName'] = strtolower ( __FUNCTION__ );
		$this->cart_model->orderSave ( $_POST );
		$this->core_model->cacheDelete ( 'cache_group', 'cart' );
		exit ();
	}

	function ajax_json_edit_order_item() {
		$this->template ['functionName'] = strtolower ( __FUNCTION__ );
		$this->cart_model->itemAdd ( $_POST );
		$this->core_model->cacheDelete ( 'cache_group', 'cart' );
		exit ();
	}

	function ajax_json_get_orders() {
		global $cms_db_tables;
		if ($_POST ['oper'] == 'del') {

		} else {
			$table = $cms_db_tables ['table_cart_orders'];
			$page = $_REQUEST ['page']; // get the requested page


			$limit = $_REQUEST ['rows']; // get how many rows we want to have into the grid
			$sidx = $_REQUEST ['sidx']; // get index row - i.e. user click to sort
			$sord = $_REQUEST ['sord']; // get the direction


			$start = $limit * ($page - 1); // do not put $limit*($page - 1)
			$end = $limit * $page; // do not put $limit*($page - 1)
			if ($start < 0) {
				$start = 0;
			}

			if (! $sidx) {
				$sidx = 1;
			}
			$wh = "";
			$searchOn = Strip ( $_REQUEST ['_search'] );
			$the_item_ids_from_search_array = array ();
			if ($searchOn == 'true') {
				$search_array = $this->core_model->mapArrayToDatabaseTable ( $table, $_REQUEST );
				if (is_array ( $search_array )) {
					$qwery = '';
					$i = 0;
					foreach ( $search_array as $key => $val ) {
						$qwery .= "  AND " . $key . "  LIKE  '%" . $val . "%'  ";
					}
					if (strval ( $qwery ) != '') {
						$q = " select id from $table where id is not null  $qwery";
						//var_Dump($q);
						$q = $this->core_model->dbQuery ( $q );
						if (! empty ( $q )) {
							foreach ( $q as $sresult ) {
								$some_id = $sresult ['id'];
								$the_item_ids_from_search_array [] = $some_id;
							}
						}
					}
				}

			}

			$limits_array = array ();
			$limits_array [0] = $start;
			$limits_array [1] = $end;

			if ($sidx != false and $sord != false) {
				$order_by_array = array ();
				$order_by_array [0] = $sidx;
				$order_by_array [1] = $sord;
			} else {
				$order_by_array = false;
			}

			$this->template ['functionName'] = strtolower ( __FUNCTION__ );

			$items_conf = array ();
			$items_conf ['order_completed'] = 'y';
			
			$items = $this->cart_model->itemsOrders ( $items_conf, $limits_array, false, $order_by_array, false, false, $ids = $the_item_ids_from_search_array );
			$items_count = $this->cart_model->itemsOrders ( $items_conf, $limits_array = false, false, $order_by_array, false, false, $ids = $the_item_ids_from_search_array, $count_only = true );

			header ( "Content-type: text/xml;charset=utf-8" );

			$s = "<?xml version='1.0' encoding='utf-8'?>";
			$s .= "<rows>";
			$s .= "<page>" . $page . "</page>";
			$s .= "<total>" . ceil ( $items_count / $_REQUEST ['rows'] ) . "</total>";
			$s .= "<records>" . $items_count . "</records>";

			$i = 0;
			foreach ( $items as $item ) {
				$order_items = array ();
				$order_items ['order_id'] = $item ['order_id'];
				$order_items ['order_completed'] = 'y';
				//$amount = $this->cart_model->cartSumByParams ( 'price', $order_items );
				//$qty = $this->cart_model->cartSumByParams ( 'qty', $order_items );
				//$amount = $amount*$qty;


				$items_conf1 = array ();
				$items_conf1 ['order_completed'] = 'y';
				$items_conf1 ['order_id'] = $item ['order_id'];
				$items1 = $this->cart_model->itemsGet ( $items_conf1 );
				$amount = 0;
				foreach ( $items1 as $i1 ) {
					$amount += (floatval ( $i1 ['qty'] * $i1 ['price'] ));
				}
				if ($item ['currency_code'] == '') {
					$item ['currency_code'] = 'EUR';
				}

				//$item ['id'] = $item ['order_id'];
				$s .= "<row id='" . $item ['id'] . "'>";
				$s .= "<cell>" . $item ['order_id'] . "</cell>";
				//$s .= "<cell>" . $item['customercode']. "</cell>";
				$s .= "<cell>" . $item ['created_on'] . "</cell>";
				$s .= "<cell>" . $item ['sid'] . "</cell>";
				$s .= "<cell>" . $amount . "</cell>";
								
				$s .= "<cell>" . substr_replace($item ['cardholdernumber'],"######",0,strlen($item ['cardholdernumber'])-4) . "</cell>";
				$s .= "<cell>" . $item ['promo_code'] . "</cell>";
				$s .= "<cell>" . $item ['bname'] . "</cell>";
				$s .= "<cell>" . $item ['bemailaddress'] . "</cell>";
				$s .= "<cell>" . $item ['scountry'] . "</cell>";
				$s .= "<cell>" . $item ['bcity'] . "</cell>";
				$s .= "<cell>" . $item ['bstate'] . "</cell>";
				$s .= "<cell>" . $item ['bzipcode'] . "</cell>";
				
				$s .= "<cell>" . $item ['baddress1'] . "</cell>";
				$s .= "<cell><![CDATA[" . $item ['id'] . "]]></cell>";
				$s .= "</row>";

				$i ++;
			}

			$s .= "</rows>";
			echo $s;
		}
		exit ();

	}

	function ajax_json_get_items_for_order_id() {
		global $cms_db_tables;
		$table = $cms_db_tables ['table_cart'];

		$page = $_REQUEST ['page']; // get the requested page
		$limit = $_REQUEST ['rows']; // get how many rows we want to have into the grid
		$sidx = $_REQUEST ['sidx']; // get index row - i.e. user click to sort
		$sord = $_REQUEST ['sord']; // get the direction
		if (! $sidx) {
			$sidx = 1;
		}

		$wh = "";
		$searchOn = Strip ( $_REQUEST ['_search'] );
		$the_item_ids_from_search_array = array ();
		if ($searchOn == 'true') {
			$searchstr = Strip ( $_REQUEST ['filters'] );
			$wh = constructWhere ( $searchstr );

			if (strval ( $wh ) != '') {
				$q = " select id from $table where id is not null  $wh";
				//var_Dump($q);
				$q = $this->core_model->dbQuery ( $q );
				if (! empty ( $q )) {
					foreach ( $q as $sresult ) {
						$some_id = $sresult ['id'];
						$the_item_ids_from_search_array [] = $some_id;
					}
				}
			}
			//var_dump($the_item_ids_from_search_array);
		}

		//ORDER BY ".$sidx." ".$sord. " LIMIT ".$start." , ".$limit;


		$this->template ['functionName'] = strtolower ( __FUNCTION__ );
		$id = $this->core_model->getParamFromURL ( 'id' );
		$items_conf = array ();
		$items_conf ['id'] = intval ( $id );
		//$items_conf ['order_completed'] = 'y';
		//$order = $this->cart_model->itemsOrders ( $items_conf );
		//$order = $this->core_model->dbQuery("SELECT * from firecms_cart_orders where sid='a7a82e994be6eb4e198355111f37ed3f'");
		//$order = $order [0];
		//$order_id = $order ['sid'];

		$items_conf = array ();
		$items_conf ['order_completed'] = 'y';
		$items_conf ['sid'] = $order_id;
		
		$query =<<<STR
		SELECT fc.*,fo.order_id as order_id,fo.id orderid  from {$cms_db_tables ['table_cart']} fc 
		inner join {$cms_db_tables ['table_cart_orders']} fo on (fc.sid=fo.sid)
		where fo.id='{$id}' AND fc.order_completed='y' and fo.transactionid is not null
		 AND fo.order_id=fc.order_id; 	
STR;
		$items = $this->core_model->dbQuery($query);
		header ( "Content-type: text/xml;charset=utf-8" );

		$s = "<?xml version='1.0' encoding='utf-8'?>";
		$s .= "<rows>";
		$s .= "<page>" . $page . "</page>";
		$s .= "<total>" . count ( $items ) . "</total>";
		$s .= "<records>" . count ( $items ) . "</records>";

		$i = 0;
		foreach ( $items as $item ) {
			//$item ['id'] = $item ['sid'];
			$s .= "<row id='" . $item ['orderid'] .':'.$item ['id'] . "'>";	
			//$s .= "<cell>" . $item ['sku'] . "</cell>";
			$s .= "<cell>" . $item ['created_on'] . "</cell>";
			$s .= "<cell>" . $item ['item_name'] . "</cell>";
			$s .= "<cell>" . $item ['qty'] . "</cell>";
			$s .= "<cell>" . $item ['price'] . "</cell>";
			$s .= "<cell>" . floatval ( $item ['qty'] * $item ['price'] ) . "</cell>";
			$s .= "<cell>" . floatval ( $item ['weight'] ) . "</cell>";
			$s .= "<cell>" . floatval ( $item ['qty'] * $item ['weight'] ) . "</cell>";
			//$s .= "<cell>" . $item ['size'] . "</cell>";
			//$s .= "<cell>" . trim ( $item ['colors'] ) . "</cell>";
			//$s .= "<cell>" . $item ['sid'] . "</cell>";

			$s .= "<cell>" . $item ['id'] . "</cell>";
			$s .= "</row>";

			$i ++;
		}

		$s .= "</rows>";
		echo $s;

		exit ();

	}

	function ajax_json_get() {
		
		$this->template ['functionName'] = strtolower ( __FUNCTION__ );

		$items_conf = array ();
		$items_conf ['order_completed'] = 'y';
		$items = $this->cart_model->itemsGet ();

		header ( "Content-type: text/xml;charset=utf-8" );

		$s = "<?xml version='1.0' encoding='utf-8'?>";
		$s .= "<rows>";
		$s .= "<page>" . 1 . "</page>";
		$s .= "<total>" . count ( $items ) . "</total>";
		$s .= "<records>" . count ( $items ) . "</records>";

		$i = 0;
		foreach ( $items as $item ) {
			$item ['id'] = rand ();
			$s .= "<row id='" . $item ['id'] . "'>";
			$s .= "<cell>" . $item ['id'] . "</cell>";
			$s .= "<cell>" . $item ['id'] . "</cell>";
			$s .= "<cell>" . $item ['id'] . "</cell>";
			$s .= "<cell>" . $item ['id'] . "</cell>";
			$s .= "<cell>" . $item ['id'] . "</cell>";
			$s .= "<cell><![CDATA[" . $item ['id'] . "]]></cell>";
			$s .= "</row>";

			$i ++;
		}

		$s .= "</rows>";
		echo $s;

		exit ();
	}

	function ajax_delete_item_from_order() {
		global $cms_db_tables;
		$id = intval ( $_POST ['id'] );
		if ($id == 0) {
			exit ( 'id cannot be zero of cource' );
		} else {
			//$this->cart_model->itemDeleteById ( $id, $check_session = false, $only_uncompleted_orders = false );
			$this->core_model->deleteDataById($cms_db_tables ['table_cart'],$id,true);
			exit ( 'deleted' );
		}

	}

	function ajax_delete_order() {
		$id = intval ( $_POST ['id'] );
		if ($id == 0) {
			exit ( 'id cannot be zero of cource' );
		} else {
			$this->cart_model->orderDeleteById ( $id );
			exit ( 'deleted' );
		}

	}

	function promo_codes() {
		$this->template ['functionName'] = strtolower ( __FUNCTION__ );

		$this->load->vars ( $this->template );

		$layout = $this->load->view ( 'admin/layout', true, true );
		$primarycontent = '';
		$secondarycontent = '';

		$primarycontent = $this->load->view ( 'admin/orders/promo_codes', true, true );

		$nav = $this->load->view ( 'admin/orders/subnav', true, true );
		$primarycontent = $nav . $primarycontent;

		//$secondarycontent = $this->load->view ( 'admin/content/sidebar', true, true );
		$layout = str_ireplace ( '{primarycontent}', $primarycontent, $layout );
		$layout = str_ireplace ( '{secondarycontent}', $secondarycontent, $layout );
		//$this->load->view('welcome_message');
		$this->output->set_output ( $layout );
	}

	function ajax_json_get_promo_codes() {
		global $cms_db_tables;
		if ($_POST ['oper'] == 'del') {

		} else {
			$table = $cms_db_tables ['table_cart_promo_codes'];
			$page = $_REQUEST ['page']; // get the requested page


			$limit = $_REQUEST ['rows']; // get how many rows we want to have into the grid
			$sidx = $_REQUEST ['sidx']; // get index row - i.e. user click to sort
			$sord = $_REQUEST ['sord']; // get the direction


			$start = $limit * ($page - 1); // do not put $limit*($page - 1)
			$end = $limit * $page; // do not put $limit*($page - 1)
			if ($start < 0) {
				$start = 0;
			}

			if (! $sidx) {
				$sidx = 1;
			}
			$wh = "";
			$searchOn = Strip ( $_REQUEST ['_search'] );
			$the_item_ids_from_search_array = array ();
			if ($searchOn == 'true') {
				$search_array = $this->core_model->mapArrayToDatabaseTable ( $table, $_REQUEST );
				if (is_array ( $search_array )) {
					$qwery = '';
					$i = 0;
					foreach ( $search_array as $key => $val ) {
						$qwery .= "  AND " . $key . "  LIKE  '%" . $val . "%'  ";
					}
					if (strval ( $qwery ) != '') {
						$q = " select id from $table where id is not null  $qwery";
						//var_Dump($q);
						$q = $this->core_model->dbQuery ( $q );
						if (! empty ( $q )) {
							foreach ( $q as $sresult ) {
								$some_id = $sresult ['id'];
								$the_item_ids_from_search_array [] = $some_id;
							}
						}
					}
				}

			}

			$limits_array = array ();
			$limits_array [0] = $start;
			$limits_array [1] = $end;

			if ($sidx != false and $sord != false) {
				$order_by_array = array ();
				$order_by_array [0] = $sidx;
				$order_by_array [1] = $sord;
			} else {
				$order_by_array = false;
			}

			$this->template ['functionName'] = strtolower ( __FUNCTION__ );

			$items_conf = array ();
			//$items_conf ['order_completed'] = 'y';
			$items = $this->cart_model->promoCodesGet ( $items_conf, $limits_array, false, $order_by_array, false, false, $ids = $the_item_ids_from_search_array );
			$items_count = $this->cart_model->promoCodesGet ( $items_conf, $limits_array = false, false, $order_by_array, false, false, $ids = $the_item_ids_from_search_array, $count_only = true );

			header ( "Content-type: text/xml;charset=utf-8" );

			$s = "<?xml version='1.0' encoding='utf-8'?>";
			$s .= "<rows>";
			$s .= "<page>" . $page . "</page>";
			$s .= "<total>" . ceil ( $items_count / $_REQUEST ['rows'] ) . "</total>";
			$s .= "<records>" . $items_count . "</records>";

			$i = 0;
			foreach ( $items as $item ) {
				$item ['id'] = $item ['id'];
				$s .= "<row id='" . $item ['id'] . "'>";
				$s .= "<cell>" . $item ['promo_code'] . "</cell>";
				$s .= "<cell>" . $item ['created_on'] . "</cell>";
				$s .= "<cell>" . $item ['amount_modifier'] . "</cell>";
				$s .= "<cell>" . $item ['amount_modifier_type'] . "</cell>";
				$s .= "<cell>" . $item ['description'] . "</cell>";
				$s .= "<cell><![CDATA[" . $item ['id'] . "]]></cell>";
				$s .= "</row>";
				$i ++;
			}

			$s .= "</rows>";
			echo $s;
		}
		exit ();

	}

	function ajax_json_edit_promo_code() {
		$this->template ['functionName'] = strtolower ( __FUNCTION__ );
		$this->cart_model->promoCodeSave ( $_POST );
		$this->core_model->cacheDelete ( 'cache_group', 'cart' );
		exit ();
	}
	function ajax_delete_promo_code() {
		$id = intval ( $_POST ['id'] );
		if ($id == 0) {
			exit ( 'id cannot be zero of cource' );
		} else {
			$this->cart_model->promoCodeDeleteById ( $id );
			exit ( 'deleted' );
		}

	}

	function shipping_cost() {
		$this->template ['functionName'] = strtolower ( __FUNCTION__ );

		$this->load->vars ( $this->template );

		$layout = $this->load->view ( 'admin/layout', true, true );
		$primarycontent = '';
		$secondarycontent = '';

		$primarycontent = $this->load->view ( 'admin/orders/shipping_cost', true, true );

		$nav = $this->load->view ( 'admin/orders/subnav', true, true );
		$primarycontent = $nav . $primarycontent;

		//$secondarycontent = $this->load->view ( 'admin/content/sidebar', true, true );
		$layout = str_ireplace ( '{primarycontent}', $primarycontent, $layout );
		$layout = str_ireplace ( '{secondarycontent}', $secondarycontent, $layout );
		//$this->load->view('welcome_message');
		$this->output->set_output ( $layout );
	}

	function ajax_json_get_shipping_costs() {
		global $cms_db_tables;
		if ($_POST ['oper'] == 'del') {

		} else {
			$table = $cms_db_tables ['table_cart_orders_shipping_cost'];
			$page = $_REQUEST ['page']; // get the requested page


			$limit = $_REQUEST ['rows']; // get how many rows we want to have into the grid
			$sidx = $_REQUEST ['sidx']; // get index row - i.e. user click to sort
			$sord = $_REQUEST ['sord']; // get the direction


			$start = $limit * ($page - 1); // do not put $limit*($page - 1)
			$end = $limit * $page; // do not put $limit*($page - 1)
			if ($start < 0) {
				$start = 0;
			}

			if (! $sidx) {
				$sidx = 1;
			}
			$wh = "";
			$searchOn = Strip ( $_REQUEST ['_search'] );
			$the_item_ids_from_search_array = array ();
			if ($searchOn == 'true') {
				$search_array = $this->core_model->mapArrayToDatabaseTable ( $table, $_REQUEST );
				if (is_array ( $search_array )) {
					$qwery = '';
					$i = 0;
					foreach ( $search_array as $key => $val ) {
						$qwery .= "  AND " . $key . "  LIKE  '%" . $val . "%'  ";
					}
					if (strval ( $qwery ) != '') {
						$q = " select id from $table where id is not null  $qwery";
						//var_Dump($q);
						$q = $this->core_model->dbQuery ( $q );
						if (! empty ( $q )) {
							foreach ( $q as $sresult ) {
								$some_id = $sresult ['id'];
								$the_item_ids_from_search_array [] = $some_id;
							}
						}
					}
				}

			}

			$limits_array = array ();
			$limits_array [0] = $start;
			$limits_array [1] = $end;

			if ($sidx != false and $sord != false) {
				$order_by_array = array ();
				$order_by_array [0] = $sidx;
				$order_by_array [1] = $sord;
			} else {
				$order_by_array = false;
			}

			$this->template ['functionName'] = strtolower ( __FUNCTION__ );

			$items_conf = array ();
			//$items_conf ['order_completed'] = 'y';
			$items = $this->cart_model->shippingCostsGet ( $items_conf, $limits_array, false, $order_by_array, false, false, $ids = $the_item_ids_from_search_array );
			$items_count = $this->cart_model->shippingCostsGet ( $items_conf, $limits_array = false, false, $order_by_array, false, false, $ids = $the_item_ids_from_search_array, $count_only = true );

			header ( "Content-type: text/xml;charset=utf-8" );

			$s = "<?xml version='1.0' encoding='utf-8'?>";
			$s .= "<rows>";
			$s .= "<page>" . $page . "</page>";
			$s .= "<total>" . ceil ( $items_count / $_REQUEST ['rows'] ) . "</total>";
			$s .= "<records>" . $items_count . "</records>";

			$i = 0;
			foreach ( $items as $item ) {
				$item ['id'] = $item ['id'];
				$s .= "<row id='" . $item ['id'] . "'>";
				$s .= "<cell>" . $item ['created_on'] . "</cell>";
				$s .= "<cell>" . $item ['is_active'] . "</cell>";
				$s .= "<cell>" . $item ['ship_to_continent'] . "</cell>";
				$s .= "<cell>" . $item ['shiping_cost_per_item'] . "</cell>";
				$s .= "<cell><![CDATA[" . $item ['id'] . "]]></cell>";
				$s .= "</row>";
				$i ++;
			}

			$s .= "</rows>";
			echo $s;
		}
		exit ();

	}
	function ajax_json_edit_shipping_costs() {
		$this->template ['functionName'] = strtolower ( __FUNCTION__ );
		$this->cart_model->shippingCostsSave ( $_POST );
		$this->core_model->cacheDelete ( 'cache_group', 'cart' );
		exit ();
	}

	function ajax_delete_shipping_costs() {
		$id = intval ( $_POST ['id'] );
		if ($id == 0) {
			exit ( 'id cannot be zero of cource' );
		} else {
			$this->cart_model->shippingCostsDeleteById ( $id );
			exit ( 'deleted' );
		}

	}

	function currencies() {
		$this->template ['functionName'] = strtolower ( __FUNCTION__ );

		$this->load->vars ( $this->template );

		$layout = $this->load->view ( 'admin/layout', true, true );
		$primarycontent = '';
		$secondarycontent = '';

		$primarycontent = $this->load->view ( 'admin/orders/currency', true, true );

		$nav = $this->load->view ( 'admin/orders/subnav', true, true );
		$primarycontent = $nav . $primarycontent;

		//$secondarycontent = $this->load->view ( 'admin/content/sidebar', true, true );
		$layout = str_ireplace ( '{primarycontent}', $primarycontent, $layout );
		$layout = str_ireplace ( '{secondarycontent}', $secondarycontent, $layout );
		//$this->load->view('welcome_message');
		$this->output->set_output ( $layout );
	}

	function ajax_json_get_currencies() {
		global $cms_db_tables;
		if ($_POST ['oper'] == 'del') {

		} else {
			$table = $cms_db_tables ['table_cart_currency'];
			$page = $_REQUEST ['page']; // get the requested page


			$limit = $_REQUEST ['rows']; // get how many rows we want to have into the grid
			$sidx = $_REQUEST ['sidx']; // get index row - i.e. user click to sort
			$sord = $_REQUEST ['sord']; // get the direction


			$start = $limit * ($page - 1); // do not put $limit*($page - 1)
			$end = $limit * $page; // do not put $limit*($page - 1)
			if ($start < 0) {
				$start = 0;
			}

			if (! $sidx) {
				$sidx = 1;
			}
			$wh = "";
			$searchOn = Strip ( $_REQUEST ['_search'] );
			$the_item_ids_from_search_array = array ();
			if ($searchOn == 'true') {
				$search_array = $this->core_model->mapArrayToDatabaseTable ( $table, $_REQUEST );
				if (is_array ( $search_array )) {
					$qwery = '';
					$i = 0;
					foreach ( $search_array as $key => $val ) {
						$qwery .= "  AND " . $key . "  LIKE  '%" . $val . "%'  ";
					}
					if (strval ( $qwery ) != '') {
						$q = " select id from $table where id is not null  $qwery";
						//var_Dump($q);
						$q = $this->core_model->dbQuery ( $q );
						if (! empty ( $q )) {
							foreach ( $q as $sresult ) {
								$some_id = $sresult ['id'];
								$the_item_ids_from_search_array [] = $some_id;
							}
						}
					}
				}

			}

			$limits_array = array ();
			$limits_array [0] = $start;
			$limits_array [1] = $end;

			if ($sidx != false and $sord != false) {
				$order_by_array = array ();
				$order_by_array [0] = $sidx;
				$order_by_array [1] = $sord;
			} else {
				$order_by_array = false;
			}

			$this->template ['functionName'] = strtolower ( __FUNCTION__ );

			$items_conf = array ();
			//$items_conf ['order_completed'] = 'y';
			$items = $this->cart_model->currenciesGet ( $items_conf, $limits_array, false, $order_by_array, false, false, $ids = $the_item_ids_from_search_array );
			$items_count = $this->cart_model->currenciesGet ( $items_conf, $limits_array = false, false, $order_by_array, false, false, $ids = $the_item_ids_from_search_array, $count_only = true );

			header ( "Content-type: text/xml;charset=utf-8" );

			$s = "<?xml version='1.0' encoding='utf-8'?>";
			$s .= "<rows>";
			$s .= "<page>" . $page . "</page>";
			$s .= "<total>" . ceil ( $items_count / $_REQUEST ['rows'] ) . "</total>";
			$s .= "<records>" . $items_count . "</records>";

			$i = 0;
			foreach ( $items as $item ) {
				$item ['id'] = $item ['id'];
				$s .= "<row id='" . $item ['id'] . "'>";

				$s .= "<cell>" . $item ['currency_from'] . "</cell>";
				$s .= "<cell>" . $item ['currency_to'] . "</cell>";
				$s .= "<cell>" . $item ['currency_rate'] . "</cell>";
				$s .= "<cell><![CDATA[" . $item ['id'] . "]]></cell>";
				$s .= "</row>";
				$i ++;
			}

			$s .= "</rows>";
			echo $s;
		}
		exit ();

	}
	function ajax_json_edit_currency() {
		$this->template ['functionName'] = strtolower ( __FUNCTION__ );
		$this->cart_model->currencySave ( $_POST );
		$this->core_model->cacheDelete ( 'cache_group', 'cart' );
		exit ();
	}

	function ajax_delete_currency() {
		$id = intval ( $_POST ['id'] );
		if ($id == 0) {
			exit ( 'id cannot be zero of cource' );
		} else {
			$this->cart_model->currencyDeleteById ( $id );
			exit ( 'deleted' );
		}

	}

}

