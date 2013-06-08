<!-- BEGIN: main -->
<script type="text/javascript"
	src="{NV_BASE_SITE}js/shadowbox/shadowbox.js"></script>
<link rel="stylesheet" type="text/css"
	href="{NV_BASE_SITE}js/shadowbox/shadowbox.css" />
<script type="text/javascript">
Shadowbox.init();
</script>
<table width="100%" style="margin-top: 5px">
	<tr>
		<td align="right">Albums <select name="albums" onChange="" id="albums">
			<!-- BEGIN: albums -->
			<option value="{id}"{SELECT}>{name}</option>
			<!-- END: albums -->
		</select></td>
	</tr>
</table>
<table class="tab1">
	<thead>
		<tr>
			<td width="20px"></td>
			<td width="63px">{LANG.order}</td>
			<td width="100px" align="center">{LANG.img_title}</td>
			<td>{LANG.img_name}</td>
			<td width="100px" align="center">{LANG.album_feature}</td>
		</tr>
	</thead>
	<!-- BEGIN: row -->
	<tbody{class}>
		<tr>
			<td align="center"><input type='checkbox' class='filelist'
				value="{id}"></td>
			<td><!-- BEGIN: sel --> <select class="sel_w" style="width: 60px;"
				id="{SEL_W}">
				<!-- BEGIN: sel_op -->
				<option {SELECT} value="{VAL}">{VAL}</option>
				<!-- END: sel_op -->
			</select> <!-- END: sel --></td>
			<td align="center"><a href="{SRC_LAGE}" title="{DES}"
				rel="shadowbox[miss]"><img src="{SRC}" alt="" height="40" /></a></td>
			<td>{name}</td>
			<td align="center"><span class="edit_icon"><a class='editfile'
				href="{URL_EDIT}">{LANG.edit}</a></span>&nbsp;-&nbsp; <span
				class="delete_icon"><a class='delfile' href="{URL_DEL_ONE}">{LANG.album_delete}</a></span>
			</td>
		</tr>
	</tbody>
	<!-- END: row -->
</table>
<table class="tab1">
	<tfoot>
		<tr>
			<td><span> <a href='javascript:void(0);' id='checkall'>{LANG.album_checkall}</a>&nbsp;&nbsp;
			<a href='javascript:void(0);' id='uncheckall'>{LANG.album_uncheckall}</a>&nbsp;&nbsp;
			</span> <span class="add_icon"> <a class='addfile' href="{LINK_ADD}">{LANG.album_add}</a>&nbsp;&nbsp;
			</span> <span class="delete_icon"> <a id='delfilelist'
				href="javascript:void(0);">{LANG.album_delete}</a> </span></td>
			<td align="right">{PAGES}</td>
		</tr>
	</tfoot>
</table>
<script type='text/javascript'>
$(function(){
$('#checkall').click(function(){
	$('input:checkbox').each(function(){
		$(this).attr('checked','checked');
	});
});
$('#uncheckall').click(function(){
	$('input:checkbox').each(function(){
		$(this).removeAttr('checked');
	});
});
$('#delfilelist').click(function(){
	if (confirm("{LANG.album_del_confirm}"))
	{
		var listall = [];
		$('input.filelist:checked').each(function(){
			listall.push($(this).val());
		});
		if (listall.length<1){
			alert("{LANG.del_img_error}");
			return false;
		}
		$.ajax({
			type: 'POST',
			url: '{URL_DEL}',
			data:'listall='+listall,
			success: function(data){
				alert(data);
				window.location='{URL_DEL_BACK}';
			}
		});
	}
});
$('a[class="delfile"]').click(function(event){
	event.preventDefault();
	if (confirm("{LANG.album_del_confirm}"))
	{
		var href= $(this).attr('href');
		$.ajax({
			type: 'POST',
			url: href,
			data:'',
			success: function(data){
				alert(data);
				window.location='{URL_DEL_BACK}';
			}
		});
	}
});


$('#albums').change(function(){
	var method = $("select[name=albums]").val();
	document.location = "{URL_RE}" + method;
});


		$('.sel_w').change(function(event)

		{
			$.ajax(
			{
				type: "POST",
				url: "index.php?nv=albums&op=sort_img",
				data: "old=" + $(this).attr('id') + "&new=" + $(this).val() + "&aid=" + $('#albums').val(),
				success: function(data)
				{
					//alert('Change data from ' + $(this).attr('id') + ' to ' + $(this).val());
					alert(data);
					window.location = 'index.php?nv=albums&op=listimg&idb=' + $('#albums').val();
				}
			});
		});


});
</script>
<!-- END: main -->