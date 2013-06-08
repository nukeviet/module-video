<!-- BEGIN: main -->
<table class="tab1">
	<thead>
		<tr>
			<td width="20px"></td>
			<td width="63px">{LANG.order}</td>
			<td>{LANG.album_name}</td>
			<td>{LANG.album_active}</td>
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
			<td><a href="{LINK_ALBUM}">{name}</a></td>
			<td width="50px" align="center"><a href="{URL_ACTIVE}" class="active">{active}</a>
			</td>
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
			<td><span><a href='javascript:void(0);' id='checkall'>{LANG.album_checkall}</a>&nbsp;&nbsp;<a
				href='javascript:void(0);' id='uncheckall'>{LANG.album_uncheckall}</a>&nbsp;&nbsp;</span>
			<span class="add_icon"><a class='addfile' href="{LINK_ADD}">{LANG.album_add}</a>&nbsp;&nbsp;</span>
			<span class="delete_icon"><a id='delfilelist'
				href="javascript:void(0);">{LANG.album_delete}</a></span></td>
		</tr>
	</tfoot>
</table>
<script type='text/javascript'>
	$(function()
	{
		$('#checkall').click(function()
		{
			$('input:checkbox').each(function()
			{
				$(this).attr('checked', 'checked');
			});
		});
		$('#uncheckall').click(function()
		{
			$('input:checkbox').each(function()
			{
				$(this).removeAttr('checked');
			});
		});
		$('#delfilelist').click(function()
		{
			if (confirm("{LANG.album_del_confirm}"))
			{
				var listall = [];
				$('input.filelist:checked').each(function()
				{
					listall.push($(this).val());
				});
				if (listall.length < 1)
				{
					alert("{LANG.album_error_file}");
					return false;
				}
				$.ajax(
				{
					type: 'POST',
					url: '{URL_DEL}',
					data: 'listall=' + listall,
					success: function(data)
					{
						alert(data);
						window.location = '{URL_DEL_BACK}';
					}
				});
			}
		});
		$('a[class="delfile"]').click(function(event)
		{
			event.preventDefault();
			if (confirm("{LANG.album_del_confirm}"))
			{
				var href = $(this).attr('href');
				$.ajax(
				{
					type: 'POST',
					url: href,
					data: '',
					success: function(data)
					{
						alert(data);
						window.location = '{URL_DEL_BACK}';
					}
				});
			}
		});

		$('a[class="active"]').click(function(event)
		{
			event.preventDefault();
			if (confirm("{LANG.album_active_confirm}"))
			{
				var href = $(this).attr('href');
				$.ajax(
				{
					type: 'POST',
					url: href,
					data: '',
					success: function(data)
					{
						//alert(data);
						window.location = '{URL_DEL_BACK}';
					}
				});
			}
		});

		$('.sel_w').change(function(event)

		{
			$.ajax(
			{
				type: "POST",
				url: "index.php?nv=albums&op=sort",
				data: "old=" + $(this).attr('id') + "&new=" + $(this).val(),
				success: function(data)
				{
					//alert('Change data from ' + $(this).attr('id') + ' to ' + $(this).val());
					alert(data);
					window.location = 'index.php?nv=albums';
				}
			});
		});
	});
</script>
<!-- END: main -->
