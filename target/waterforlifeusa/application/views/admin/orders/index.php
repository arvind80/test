<script type="text/javascript">


function orders_delete_item_from_order($subgrid_id, $itemids){
var del_item_from_order_url = '<?php print site_url('admin/orders/ajax_delete_item_from_order') ?>';
var where_to= confirm("Are you sure you want to delete? This cannot be undone!");
 if (where_to== true)
 {
		$item_ids = $itemids.split(':');
		$item_id = $item_ids[1];
	   var su=jQuery("#"+$subgrid_id).delRowData($itemids);
		if(su) {
		$.post(del_item_from_order_url, { id: $item_id },
		  function(data){
			//alert("Data Deleted: " + $item_id);  
		  });
		} 
 }
}

function orders_delete_order_and_all_items($order_id){
		var del_order_url = '<?php print site_url('admin/orders/ajax_delete_order') ?>';
		var where_to= confirm("Are you sure you want to delete this order? This cannot be undone!");
		if (where_to== true)
		{
		   var su=jQuery("#orders_table").delRowData($order_id);
			if(su) {
			$.post(del_order_url, { id: $order_id },
			  function(data){
				//alert("Data Loaded: " + data);  
			  });
			} 
		}
}




jQuery(document).ready(function(){ 
 var orders_tablelastsel2;
  var orders_tablelastsel3;
  var orders_tablelastsel4;
  
  
  jQuery("#orders_table").jqGrid({
    url:'<?php print site_url('admin/orders/ajax_json_get_orders') ?>',
    datatype: 'xml',
    mtype: 'POST', 
	editable: true,
    colNames:[ 'Order id','Created on' , 'Sid','Amount','Card Number','Promo code','Name', 'Email','Country','City','State','Zip','Address1', 'Edit'],
    colModel :[ 
	  {name:'order_id', index:'order_id', editable: false , width:100 }, 
	  {name:'created_on', index:'created_on', editable:false,  width:80},
	  {name:'sid', index:'sid', editable: true ,  hidden:true }, 
	  {name:'amount', index:'amount', sortable: false, search: false, editable: false , width:55 }, 
	  
	  {name:'cardholdernumber', index:'cardholdernumber', sortable: true, search: true, editable: false , width:70 }, 
	  {name:'promo_code', index:'promo_code', sortable: false, search: true, editable: false , width:55 }, 
      {name:'name', index:'name', editable: true , edittype:'textarea', width:55 }, 
      {name:'bemailaddress', index:'email', width:80,  editable:true, edittype:'textarea'}, 
      {name:'scountry', index:'country', width:40,  editable:true, edittype:'textarea'}, 
      {name:'scity', index:'city', width:40, editable:true, edittype:'textarea'}, 
	  {name:'state', index:'state', width:25, editable:true, edittype:'textarea'}, 
	  {name:'szip', index:'zip', width:25, editable:true, edittype:'textarea'}, 
      {name:'saddress1', index:'address1', width:100,  editable:true, edittype:'textarea',sortable:false}  ,
	  {name:'act',sortable:false,index:'act', search:false , width:30,sortable:false}  
    ],
   
    pager: 'orders_table_pager12',  
    emptyrecords: "Nothing to display",
	viewrecords: true,
	editurl: "<?php print site_url('admin/orders/ajax_json_edit_orders') ?>",
    rowNum:100,
    rowList:[100,200,300],
    sortname: 'created_on',
    sortorder: 'desc',
    viewrecords: true,
    caption: 'Orders',
	subGrid: true,
    subGridRowExpanded: function(subgrid_id, row_id) { 
    // we pass two parameters
    // subgrid_id is a id of the div tag created within a table
    // the row_id is the id of the row
    // If we want to pass additional parameters to the url we can use
    // the method getRowData(row_id) - which returns associative array in type name-value
    // here we can easy construct the following
       var subgrid_table_id;
       subgrid_table_id = subgrid_id+"_t";
	   var pager_id = "p_"+subgrid_table_id;
       jQuery("#"+subgrid_id).html("<table id='"+subgrid_table_id+"' class='scroll sub-table'></table><div id='"+pager_id+"' class='scroll'></div>");
       jQuery("#"+subgrid_table_id).jqGrid({										   
          url:"<?php print site_url('admin/orders/ajax_json_get_items_for_order_id/id:') ?>"+row_id,
          datatype: "xml",
		  mtype: 'POST', 
		  editable: true,
		  editurl: "<?php print site_url('admin/orders/ajax_json_edit_order_item') ?>",
          colNames:[ 'Created on' ,'Item name', 'QTY','Single price', 'Total price', 'Sigle weight' , 'Total weight' ,'act'],
          colModel: [ 
		  	   
			  {name:'created_on', index:'created_on', editable:false,  width:120},
			  {name:'item_name', index:'item_name', editable:true, edittype:'text', width:250}, 
			  {name:'qty', index:'qty', width:50,  editable:true, edittype:'text'},  
			  {name:'price', index:'price', width:120,  editable:true, edittype:'text'}, 
			  {name:'total', index:'total', sortable:false, width:140,  editable:false,  search:false,  edittype:'text'}, 
			  {name:'weight', index:'weight', width:80,  editable:true, edittype:'text'}, 
			  {name:'weight_total', sortable:false, index:'weight_total', width:100,  search:false,   editable:false, edittype:'text'}, 
			  {name:'act',index:'act', sortable:false, search:false,  width:75}
			 
          ],
		       
			loadComplete: function(){ 
			var ids = jQuery("#"+subgrid_table_id).getDataIDs();			
				for(var i=0;i<ids.length;i++){
					var cl = ids[i];
					div = "<div id='"+cl+i+"'>";
					be = "<input type='image' title='Edit' src='"+orders_edit_icon+"' value='Edit' onclick=jQuery('#"+subgrid_table_id+"').editRow("+cl+"); />"; 
					se = "<input type='image' title='Save' src='"+orders_save_icon+"' value='Save' onclick=jQuery('#"+subgrid_table_id+"').saveRow("+cl+"); />"; 
					de = "<input type='image' title='Delete' src='"+orders_delete_icon+"'  value='Delete' onclick=javascript:orders_delete_item_from_order('"+subgrid_table_id+"','"+cl+"'); />"; 
					div += "</div>";
					jQuery("#"+subgrid_table_id).setRowData(cl,{act:be +se + de + div});
					//jQuery("#"+subgrid_table_id).navGrid("#"+pager_id,{edit:false,add:false,del:false});
					}	
					
				},
				subGridRowColapsed: function(subgrid_id, row_id) {
					// this function is called before removing the data
					//var subgrid_table_id;
					subgrid_table_id = subgrid_id+"_t";
					jQuery("#"+subgrid_table_id).remove();
				},   
	  
			height: '100%',
			rowNum:20000,
			
			autowidth: false,
			rownumbers: true,
			pager: "#"+pager_id,
			footerrow : false,
			userDataOnFooter : false	,
			multipleSearch:true,
			sortname: 'created_on',
			sortorder: "desc" 
       }).navGrid("#"+pager_id,{view:false, del:false,edit:false,add:false,del:false,refresh:false}, 
			{edit:false}, //  default settings for edit
			{add:false}, //  default settings for add
			{del:false},  // delete instead that del:false we need this
			{
			 multipleSearch:true,
			 caption: "Search now...",
			 Find: "Find",
			 Reset: "Reset",
			 closeAfterSearch:true,
			 sopt:  ['eq'],
			// odata : ['equal'],
			 groupOps: [ { op: "AND", text: "all" } ], //for now the grid and Microweber only works with AND statement not with OR
			 matchText: " match",
			 rulesText: " rules"
		   	}, // search options
			{} /* view parameters*/

		) // end navGrid
   },// end of  subGridRowExpanded
	loadComplete: function(){
		var ids = jQuery("#orders_table").getDataIDs();
		for(var i=0;i<ids.length;i++){ 
			var cl = ids[i];
			adr = 'orderinfo/id/' + ids[i];
			adrups = 'ups_order/id/' + ids[i];
			ue = "<input type='image' title='UPS order' src='"+orders_ups_icon+"' value='UPS' onclick=window.document.open('" +adrups + "','UPS','toolbar=0,location=0,directories=0,status=1,menubar=0,scrollbars=1,resizable=0,width=550,height=600') />";
			ie = "<input type='image' title='All order info' src='"+orders_view_icon+"' value='Info' onclick=window.document.open('" +adr + "','InfoOrder','toolbar=0,location=0,directories=0,status=1,menubar=0,scrollbars=1,resizable=0,width=550,height=600') />"; 
			be = "<input type='image' title='Edit order' src='"+orders_edit_icon+"' value='Edit' onclick=jQuery('#orders_table').editRow("+cl+"); />"; 
			se = "<input type='image' title='Save' src='"+orders_save_icon+"' value='Save'  onclick=jQuery('#orders_table').saveRow("+cl+"); />"; 
			de = "<input type='image' title='Delete' src='"+orders_delete_icon+"' value='Delete' onclick=javascript:orders_delete_order_and_all_items('"+cl+"'); />"; 
			jQuery("#orders_table").setRowData(ids[i],{act:ue+ie+be+se+de})
		}	
	},
	 
	autowidth: true, 
	viewrecords: true,
	footerrow : true,
	pgbuttons: true,
	pginput: true,
	multipleSearch:true,
	height: '100%'

  }).filterToolbar({autosearch:true});     
  
  
  /*.navGrid('#orders_table_pager12',
{view:true, del:true,edit:true,add:true,del:false,refresh:true}, //options
{height:280,reloadAfterSubmit:false}, // edit options
{height:280,reloadAfterSubmit:false}, // add options
{reloadAfterSubmit:false}, // del options
{
	multipleSearch:true,
	closeAfterSearch:true,
	sopt:  ['eq'],
	groupOps: [ { op: "AND", text: "all" } ], //for now the grid and Microweber only works with AND statement not with OR
	matchText: " match",
	rulesText: " rules"

}, // search options
{height:250,jqModal:false,closeOnEscape:true} // view options
)*/
  
  


}); 
</script>

<table id="orders_table" width="100%" class="scroll" cellpadding="0" cellspacing="0">
</table>
<div id="orders_table_pager12"></div>
<div id="orders_table_search" class="scroll" style="text-align:left;"></div>
