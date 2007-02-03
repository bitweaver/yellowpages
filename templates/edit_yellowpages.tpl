{* $Header: /cvsroot/bitweaver/_bit_yellowpages/templates/edit_yellowpages.tpl,v 1.1 2007/02/03 19:56:56 spiderr Exp $ *}
{strip}
<div class="floaticon">{bithelp}</div>

{* Check to see if there is an editing conflict *}
{if $editpageconflict == 'y'}
	<script language="javascript" type="text/javascript">
		<!-- Hide Script
			alert("{tr}This page is being edited by {$semUser}{/tr}. {tr}Proceed at your own peril{/tr}.")
		//End Hide Script-->
	</script>
{/if}

<div class="admin yellowpages">
	{if $preview}
		<h2>Preview {$gContent->mInfo.title}</h2>
		<div class="preview">
			{include file="bitpackage:yellowpages/yellowpages_display.tpl" page=`$gContent->mInfo.yellowpages_id`}
		</div>
	{/if}

	<div class="header">
		<h1>
			{if $gContent->mInfo.yellowpages_id}
				{tr}{tr}Edit{/tr} {$gContent->mInfo.title}{if $gContent->mInfo.page_alias}&nbsp;( {$gContent->mInfo.page_alias} ){/if}{/tr}
			{else}
				{tr}Create New Record{/tr}
			{/if}
		</h1>
	</div>

	<div class="body">
		{form enctype="multipart/form-data" id="edityellowpagesform"}
			{legend legend="Edit/Create YellowPages Record"}
				<input type="hidden" name="yellowpages_id" value="{$gContent->mInfo.yellowpages_id}" />

				<div class="row">
					{formlabel label="Title" for="title"}
					{forminput}
						<input type="text" size="60" maxlength="200" name="title" id="title" value="{if $preview}{$gContent->mInfo.title}{else}{$gContent->mInfo.title}{/if}" />
					{/forminput}
				</div>

				{if $gBitSystemPrefs.feature_wiki_description eq 'y'}
					<div class="row">
						{formlabel label="Description" for="description"}
						{forminput}
							<input size="60" type="text" name="description" id="description" value="{$gContent->mInfo.description|escape}" />
							{formhelp note="Brief description of the page."}
						{/forminput}
					</div>
				{/if}

				{include file="bitpackage:liberty/edit_format.tpl"}

				{if $gBitSystemPrefs.package_smileys eq 'y'}
					{include file="bitpackage:smileys/smileys_full.tpl"}
				{/if}

				{if $gBitSystemPrefs.package_quicktags eq 'y'}
					{include file="bitpackage:quicktags/quicktags_full.tpl"}
				{/if}

				<div class="row">
					{forminput}
						<textarea id="{$textarea_id}" name="data" rows="{$rows|default:20}" cols="{$cols|default:50}">{$gContent->mInfo.data|escape}</textarea>
					{/forminput}
				</div>

				<div class="row submit">
					<input type="submit" name="preview" value="{tr}preview{/tr}" /> 
					<input type="submit" name="save_yellowpages" value="{tr}Save{/tr}" />
				</div>
			{/legend}
		{/form}
	</div><!-- end .body -->
</div><!-- end .yellowpages -->

{/strip}
