{strip}
	<ul>
		{if $gBitUser->hasPermission( 'p_read_yellowpages')}
			<li><a class="item" href="{$smarty.const.YELLOWPAGES_PKG_URL}index.php">{tr}YellowPages Home{/tr}</a></li>
		{/if}
		{if $gBitUser->hasPermission( 'p_read_yellowpages')  || $gBitUser->hasPermission( 'p_remove_yellowpages' ) }
			<li><a class="item" href="{$smarty.const.YELLOWPAGES_PKG_URL}list_yellowpages.php">{tr}List YellowPages{/tr}</a></li>
		{/if}
		{if $gBitUser->hasPermission( 'p_create_yellowpages' ) || $gBitUser->hasPermission( 'p_edit_yellowpages' ) }
			<li><a class="item" href="{$smarty.const.YELLOWPAGES_PKG_URL}edit.php">{tr}Create YellowPages{/tr}</a></li>
		{/if}
	</ul>
{/strip}
