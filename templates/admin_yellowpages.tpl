{strip}
{form}
	{jstabs}
		{jstab title="Home YellowPages"}
			{legend legend="Home YellowPages"}
				<input type="hidden" name="page" value="{$page}" />
				<div class="row">
					{formlabel label="Home YellowPages (main yellowpages)" for="homeYellowPages"}
					{forminput}
						<select name="homeYellowPages" id="homeYellowPages">
							{section name=ix loop=$yellowpagess}
								<option value="{$yellowpagess[ix].yellowpages_id|escape}" {if $yellowpagess[ix].yellowpages_id eq $home_yellowpages}selected="selected"{/if}>{$yellowpagess[ix].title|truncate:20:"...":true}</option>
							{sectionelse}
								<option>{tr}No records found{/tr}</option>
							{/section}
						</select>
					{/forminput}
				</div>

				<div class="row submit">
					<input type="submit" name="homeTabSubmit" value="{tr}Change preferences{/tr}" />
				</div>
			{/legend}
		{/jstab}

		{jstab title="List Settings"}
			{legend legend="List Settings"}
				<input type="hidden" name="page" value="{$page}" />
				{foreach from=$formYellowPagesLists key=item item=output}
					<div class="row">
						{formlabel label=`$output.label` for=$item}
						{forminput}
							{html_checkboxes name="$item" values="y" checked=`$gBitSystemPrefs.$item` labels=false id=$item}
							{formhelp note=`$output.note` page=`$output.page`}
						{/forminput}
					</div>
				{/foreach}

				<div class="row submit">
					<input type="submit" name="listTabSubmit" value="{tr}Change preferences{/tr}" />
				</div>
			{/legend}
		{/jstab}
	{/jstabs}
{/form}
{/strip}
