{* $Header: /cvsroot/bitweaver/_bit_yellowpages/templates/list_yellowpagess.tpl,v 1.3 2010/02/09 17:21:22 wjames5 Exp $ *}
<div class="floaticon">{bithelp}</div>

<div class="listing yellowpages">
	<div class="header">
		<h1>{tr}YellowPages Records{/tr}</h1>
	</div>

	<div class="body">
		{form id="checkform"}
{strip}
{* can't use strip for the entire page due to javascript later on *}
			<input type="hidden" name="offset" value="{$control.offset|escape}" />
			<input type="hidden" name="sort_mode" value="{$control.sort_mode|escape}" />

			<table class="data">
				<tr>
					{if $gBitSystem->isFeatureActive( 'yellowpages_list_yellowpages_id' ) eq 'y'}
						<th>{smartlink ititle="YellowPages Id" isort=yellowpages_id offset=$control.offset iorder=desc idefault=1}</th>
					{/if}

					{if $gBitSystem->isFeatureActive( 'yellowpages_list_title' ) eq 'y'}
						<th>{smartlink ititle="Title" isort=title offset=$control.offset}</th>
					{/if}

					{if $gBitSystem->isFeatureActive( 'yellowpages_list_description' ) eq 'y'}
						<th>{smartlink ititle="Description" isort=description offset=$control.offset}</th>
					{/if}

					{if $gBitSystem->isFeatureActive( 'yellowpages_list_data' ) eq 'y'}
						<th>{smartlink ititle="Text" isort=data offset=$control.offset}</th>
					{/if}

					{if $gBitUser->hasPermission( 'bit_p_remove_yellowpages' )}
						<th>{tr}Actions{/tr}</th>
					{/if}
				</tr>

				{section name=changes loop=$list}
					<tr class="{cycle values="even,odd"}">
						{if $yellowpages_list_yellowpages_id eq 'y'}
							<td><a href="{$smarty.const.YELLOWPAGES_PKG_URL}index.php?yellowpages_id={$list[changes].yellowpages_id|escape:"url"}" title="{$list[changes].yellowpages_id}">{$list[changes].yellowpages_id|truncate:20:"...":true}</a></td>
						{/if}

						{if $yellowpages_list_title eq 'y'}
							<td>{$list[changes].title}</td>
						{/if}

						{if $yellowpages_list_description eq 'y'}
							<td>{$list[changes].description}</td>
						{/if}

						{if $yellowpages_list_data eq 'y'}
							<td>{$list[changes].data}</td>
						{/if}

						{if $gBitUser->hasPermission( 'bit_p_remove_yellowpages' )}
							<td class="actionicon">
								{smartlink ititle="Edit" ifile="edit.php" ibiticon="liberty/edit" yellowpages_id=$list[changes].yellowpages_id}
								<input type="checkbox" name="checked[]" title="{$list[changes].title}" value="{$list[changes].yellowpages_id|escape}" />
							</td>
						{/if}
					</tr>
				{sectionelse}
					<tr class="norecords"><td colspan="16">
						{tr}No records found{/tr}
					</td></tr>
				{/section}
			</table>
{/strip}

			{if $gBitUser->hasPermission( 'bit_p_remove_yellowpages' )}
				<div style="text-align:right;">
					<script type="text/javascript">//<![CDATA[
						// check / uncheck all.
						document.write("<label for=\"switcher\">{tr}Select All{/tr}</label> ");
						document.write("<input name=\"switcher\" id=\"switcher\" type=\"checkbox\" onclick=\"BitBase.switchCheckboxes(this.form.id,'checked[]','switcher')\" /><br />");
					//]]></script>

					<select name="submit_mult" onchange="this.form.submit();">
						<option value="" selected="selected">{tr}with checked{/tr}:</option>
						{if $gBitUser->hasPermission( 'bit_p_remove_yellowpages' )}
							<option value="remove_yellowpagess">{tr}remove{/tr}</option>
						{/if}
					</select>

					<script type="text/javascript">//<![CDATA[
					// Fake js to allow the use of the <noscript> tag (so non-js-users kenn still submit)
					//]]></script>

					<noscript>
						<div><input type="submit" value="{tr}Submit{/tr}" /></div>
					</noscript>
				</div>
			{/if}
		{/form}
	</div><!-- end .body -->

	{libertypagination}
	{minifind sort_mode=$sort_mode}
</div><!-- end .admin -->
