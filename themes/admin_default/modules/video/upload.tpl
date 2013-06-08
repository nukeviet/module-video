<!-- BEGIN: main -->
<!-- BEGIN: err -->
<div class="quote" style="width: 780px;">
<blockquote class="error"><span>{ERR}</span></blockquote>
</div>
<div class="clear"></div>
<!-- END: err -->
<form method="post" name="add_pic">
<table class="tab1">
	<thead>
		<tr>
			<td colspan="2">{LANG.add_pic}</td>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td style="width: 150px; background: #eee;">{LANG.pic_name}</td>
			<td style="background: #eee;"><input name="name"
				style="width: 470px;" value="{DATA.name}" type="text"></td>
		</tr>
		<tr>
			<td style="background: #eee;">{LANG.album}</td>
			<td style="background: #eee;"><select name="album">
				<option value="0"></option>
				<!-- BEGIN: album -->
				<option value="{albumid}"{SELECT}>{name}</option>
				<!-- END: album -->
			</select></td>
		</tr>
		<tr>
			<td style="width: 150px; background: #eee;">{LANG.pic_path}</td>
			<td style="background: #eee;"><input style="width: 300px;"
				name="pic_path" id="pic_path" value="{DATA.path}" type="text"
				readonly="readonly"> <input value="{LANG.select_pic}"
				name="selectimg" type="button"></td>
		</tr>
		<tr>
			<td style="width: 150px; background: #eee;">{LANG.v_path}</td>
			<td style="background: #eee;"><input style="width: 300px;"
				name="v_path" id="v_path" value="{DATA.v_path}" type="text"> <input
				value="{LANG.select_vid}" name="selectvid" type="button"></td>
		</tr>
		<tr>
			<td style="background: #eee;">{LANG.description}</td>
			<td style="background: #eee;">{EDITOR} <!--
					<textarea cols="70" rows="8" name="description">{DATA.description}</textarea> -->
			</td>
		</tr>
		<tr>
			<td colspan="2" align="center" style="background: #eee;"><input
				name="confirm" value="{LANG.save_album}" type="submit"> <input
				type="hidden" name="add" id="add" value="1"> <input type="hidden"
				name="{NV_NAME}" id="{NV_NAME}" value="{MOD_NAME}"> <span
				name="notice"
				style="float: right; padding-right: 50px; color: red; font-weight: bold;"></span>
			</td>
		</tr>
	</tbody>
</table>
</form>
<script type="text/javascript">
	$("input[name=selectimg]").click(function()
	{
		var area = "pic_path"; // return value area
		var type = "image";
		var path = "{PATH}";
		nv_open_browse_file("{BROWSER}");
		return false;
	});

	$("input[name=selectvid]").click(function()
	{
		var area = "v_path"; // return value area
		var type = "all";
		var path = "{PATH_V}";
		nv_open_browse_file("{BROWSER}");
		return false;
	});
</script>
<!-- END: main -->
