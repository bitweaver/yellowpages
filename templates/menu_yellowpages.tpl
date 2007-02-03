{strip}
	<ul>
		{if $gBitUser->hasPermission( 'bit_p_read_yellowpages')}
			<li><a class="item" href="{$smarty.const.YELLOWPAGES_PKG_URL}index.php">{tr}YellowPagess Home{/tr}</a></li>
		{/if}
		{if $gBitUser->hasPermission( 'bit_p_read_yellowpages')  || $gBitUser->hasPermission( 'bit_p_remove_yellowpages' ) }
			<li><a class="item" href="{$smarty.const.YELLOWPAGES_PKG_URL}list_yellowpagess.php">{tr}List YellowPagess{/tr}</a></li>
		{/if}
		{if $gBitUser->hasPermission( 'bit_p_create_yellowpages' ) || $gBitUser->hasPermission( 'bit_p_edit_yellowpages' ) }
			<li><a class="item" href="{$smarty.const.YELLOWPAGES_PKG_URL}edit.php">{tr}Create YellowPages{/tr}</a></li>
		{/if}
	</ul>
{/strip}
