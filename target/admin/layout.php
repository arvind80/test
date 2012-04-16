<style>
.ui-tabs-vertical { width: 55em; }
.ui-tabs-vertical .ui-tabs-nav { padding: .2em .1em .2em .2em; float: left; width: 12em;background-color: #9E9698;min-height: 500px; }
.ui-tabs-vertical .ui-tabs-nav li { clear: left; width: 100%; border-bottom-width: 1px !important; border-right-width: 0 !important; margin: 0 -1px .2em 0; }
.ui-tabs-vertical .ui-tabs-nav li a { display:block; }
.ui-tabs-vertical .ui-tabs-nav li.ui-tabs-selected { padding-bottom: 0; padding-right: .1em; border-right-width: 1px; border-right-width: 1px; }
.ui-tabs-vertical .ui-tabs-panel { padding: 2em; float: left; width: 40em;}
.ui-button .ui-button-text {
    width: 116px;
}
</style>
<script>
	
    $(document).ready(function() {
        $("#tabs").tabs().addClass('ui-tabs-vertical ui-helper-clearfix');
        $("#tabs li").removeClass('ui-corner-top').addClass('ui-corner-left');
    });


</script>
