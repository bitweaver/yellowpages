<div class="floaticon">
	{if $lock}
		{biticon ipackage="wiki" iname="locked" iexplain="locked"}{$info.editor|userlink}
	{/if}

	{if $print_page ne 'y'}
		{if $bit_p_edit eq 'y' or $page eq 'SandBox' and !$lock}
			<a href="edit.php?yellowpages_id={$gContent->mInfo.yellowpages_id}" {if $beingEdited eq 'y'}{popup_init src="`$smarty.const.THEMES_PKG_URL`overlib.js"}{popup text="$semUser" width="-1"}{/if}>{biticon ipackage=liberty iname="edit" iexplain="edit"}</a>
		{/if}

		{if $user and $gBitSystemPrefs.package_notepad eq 'y' and $bit_p_notepad eq 'y'}
			<a title="{tr}Save{/tr}" href="index.php?page={$page|escape:"url"}&amp;savenotepad=1">{biticon ipackage="wiki" iname="save" iexplain="save"}</a>
		{/if}

		{if $bit_p_remove eq 'y'}
			<a title="{tr}remove this page{/tr}" href="remove_yellowpages.php?yellowpages_id={$gContent->mInfo.yellowpages_id}">{biticon ipackage=liberty iname="delete" iexplain="delete"}</a>
		{/if}
	{/if}<!-- end print_page -->
</div><!-- end .floaticon -->

<div class="header">
	<h1>{$gContent->mInfo.title|default:"YellowPages"}</h1>
	<h2>{$gContent->mInfo.description}</h2>
</div><!-- end .header -->
