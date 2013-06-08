<!-- BEGIN: main -->
<div
	style="text-align: left; font-family: Arial, Helvetica, sans-serif; font-size: 14px; font-weight: bolder; color: rgb(243, 100, 0);">
<img width="6" height="6" style="vertical-align: middle;"
	src="{IMGP}navi.gif" alt=""> <a href="{URL_VV}" title="{VID_NAME}"><u>{VID_NAME}</u></a>
({NUM_VVIEW} {LANG.view})</div>
<br />
<div style="text-align: center;"><object id="player"
	classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" name="player"
	width="400" height="315">
	<param name="movie" value="{NV_BASE_SITEURL}images/player.swf" />
	<param name="allowfullscreen" value="true" />
	<param name="allowscriptaccess" value="always" />
	<param name="flashvars" value="file={URL_V}&image={URL_PP}" />
	<embed type="application/x-shockwave-flash" id="player2" name="player2"
		src="{NV_BASE_SITEURL}images/player.swf" width="400" height="315"
		allowscriptaccess="always" allowfullscreen="true"
		flashvars="file={URL_V}&image={URL_PP}" /></object></div>
<br />
<br />
<table cellspacing="4" cellpadding="4"
	style="width: 98%; border-top: solid 1px #cccccc; border-bottom: solid 1px #cccccc;">
	<tbody>
		<tr>
			<td>
			<div>{VID_DES}</div>
			</td>
		</tr>
	</tbody>
</table>
<br />
<br />
<!-- BEGIN: rvid -->
<div
	style="text-align: left; font-family: Arial, Helvetica, sans-serif; font-size: 14px; font-weight: bolder; color: rgb(243, 100, 0);">
<img width="6" height="6" style="vertical-align: middle;"
	src="{IMGP}navi.gif" alt=""> {LANG.related_video}</div>
<table cellspacing="4" cellpadding="4" style="width: 98%;">
	<tbody>
		<!-- BEGIN: vid -->
		<tr>
			<td
				style="font-family: Arial, Helvetica, sans-serif; font-size: 13px; border-style: dashed; border-width: 0px 0px 1px; border-color: rgb(128, 128, 128); width: 90%;">
			<a href="{URL_VID}" title="Xem video clip">{NAME}</a></td>
			<td
				style="border-style: dashed; border-width: 0px 0px 1px; border-color: rgb(128, 128, 128); white-space: nowrap;">[
			{LANG.viewed}: {VID_VIEW}]</td>
			<td
				style="border-style: dashed; border-width: 0px 0px 1px; border-color: rgb(128, 128, 128); width: 20px;">
			<a href="{URL_VID}" title="{NAME}"><img width="20" height="20"
				style="border-width: 0px;" src="{IMGP}mediaview.gif" alt="{NAME}"></a></td>
		</tr>
		<!-- END: vid -->
	</tbody>
</table>
<br>
<!-- END: rvid -->
<!-- BEGIN: rabl -->
<div
	style="text-align: left; font-family: Arial, Helvetica, sans-serif; font-size: 14px; font-weight: bolder; color: rgb(243, 100, 0);">
<img width="6" height="6" style="vertical-align: middle;"
	src="{IMGP}navi.gif" alt=""> {LANG.other_cat}</div>
<table cellspacing="4" cellpadding="4" style="width: 98%;">
	<tbody>
		<!-- BEGIN: abl -->
		<tr>
			<td
				style="font-family: Arial, Helvetica, sans-serif; font-size: 13px; border-width: 0px 0px 1px; border-color: rgb(128, 128, 128); width: 90%;">
			<a href="{URL_AB}" title="{AB_DES}"><span
				style="font-weight: bold; text-decoration: underline;">{TITLE_ALBUM}</span>
			({NUM_PHOTO} video) ({NUM_VIEW} {LANG.view})</a></td>
		</tr>
		<!-- END: abl -->
	</tbody>
</table>
<br>
<!-- END: rabl -->
<!-- END: main -->