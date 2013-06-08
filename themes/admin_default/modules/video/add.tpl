<!-- BEGIN: main -->
<!-- BEGIN: err -->
<div class="quote" style="width:780px;">
	<blockquote class="error">
		<span>{ERR}</span>
	</blockquote>
</div>
<div class="clear">
</div>
<br/>
<!-- END: err -->
<table class="tab1">
	<thead>
		<tr>
			<td colspan="2">{LANG.add}</td>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td style="background:#eee;">
				<form id="formAdd" name="formAdd" method="post" action="">
					<table style="width:100%; border:0" cellpadding="0" cellspacing="0">
						<tr>
							<td style="background:#eee;" width="100">{LANG.album_name}</td>
							<td style="background:#eee;"><input type="text" name="name" id="name" style="width:100%;" value="{DATA.name}"/></td>
						</tr>
					</table>
                    <table style="border:0" cellpadding="0" cellspacing="0">
                        <tr>
							<td style="background:#eee;" width="100" valign="middle">{LANG.album_img}</td>
							<td style="background:#eee;" valign="middle">
                            	<input style="width: 400px;" name="pic_path" id="pic_path" type="text" value="{DATA.path_img}"/>
                            </td>
                            <td style="background:#eee;" valign="middle">
                            <input value="{LANG.select_pic}" name="selectimg" type="button"/>
                            </td>
                            <td style="background:#eee;" valign="middle">
                            	<!-- BEGIN: img -->
                                <img src="{IMGS}" alt="" height="60px"/>
                                <!-- END: img -->
                            </td>
						</tr>
					</table>
					<table style="width:100%; border:0;" cellpadding="0" cellspacing="0">
						<tr>
							<td style="background:#eee;">{LANG.description}</td>
						</tr>
                        <tr align="center">
							<td><textarea name="description" id="description" style="width:100%; height:200px;">{DATA.description}</textarea></td>
						</tr>
					</table>
                    <table style="width:100%; border:0;" cellpadding="0" cellspacing="0">
						<tr>
							<td style="background:#eee;" width="80px">{LANG.album_active}</td>
							<td style="background:#eee;"><input type="checkbox" name="active" value="1" {CKECK}/></td>
						</tr>
					</table>
					<table style="width:100%; border:0;" cellpadding="0" cellspacing="0">
						<tr align="center">
							<td style="background:#eee;">
								<input type="submit" name="add_new" id="add_new" value="{LANG.save_album}" />
                                <input type="hidden" name="add" id="add" value="1">
                                <input type="hidden" name="{NV_NAME}" id="{NV_NAME}" value="{MOD_NAME}">
                                <input type="hidden" name="{NV_OP}" id="{NV_OP}" value="{OP}">
							</td>
						</tr>
					</table>
				</form>
			</td>
		</tr>
	</tbody>
</table>
<script type="text/javascript">
	$("input[name=selectimg]").click(function()
	{
		var area = "pic_path"; // return value area
		var type = "image";
		var path = "{PATH}";
		nv_open_browse_file("{BROWSER}");
		return false;
	});
</script>
<!-- END: main -->
