{* $Header$ *}
{strip}
<div class="floaticon">{bithelp}</div>

<div class="edit yellowpages">
	<div class="header">
		<h1>{tr}Edit/Create New Record{/tr}</h1>
	</div>

	<div class="body">
		{form legend="Edit/Create YellowPages Record"}
			<input type="hidden" name="yellowpages_id" value="{$gContent->getField('yellowpages_id')}" />

			<div class="row">
				{formlabel label="Title" for="title"}
				{forminput}
					<input type="text" size="50" maxlength="160" name="title" id="title" value="{$gContent->getField('title')}" />
				{/forminput}
			</div>

			<div class="row">
				{formlabel label="Name" for="firstname"}
				{forminput}
					<input type="text" size="30" maxlength="160" name="firstname" id="firstname" value="{$gContent->getField('firstname')}" />
				{/forminput}
			</div>

			<div class="row">
				{formlabel label="Last Name" for="lastname"}
				{forminput}
					<input type="text" size="30" maxlength="160" name="lastname" id="lastname" value="{$gContent->getField('lastname')}" />
				{/forminput}
			</div>

			<div class="row">
				{formlabel label="Address" for="address_1"}
				{forminput}
					<input type="text" size="30" maxlength="160" name="address_1" id="address_1" value="{$gContent->getField('address_1')}" /><br />
					<input type="text" size="30" maxlength="160" name="address_2" id="address_2" value="{$gContent->getField('address_2')}" />
				{/forminput}
			</div>

			<div class="row">
				{formlabel label="City" for="city"}
				{forminput}
					<input type="text" size="30" maxlength="160" name="city" id="city" value="{$gContent->getField('city')}" />
				{/forminput}
			</div>

			<div class="row">
				{formlabel label="Region" for="region"}
				{forminput}
					<input type="text" size="30" maxlength="160" name="region" id="region" value="{$gContent->getField('region')}" />
				{/forminput}
			</div>

			<div class="row">
				{formlabel label="Postal Code" for="postal_code"}
				{forminput}
					<input type="text" size="16" maxlength="16" name="postal_code" id="postal_code" value="{$gContent->getField('postal_code')}" />
				{/forminput}
			</div>

			<div class="row">
				{formlabel label="Country" for="country"}
				{forminput}
					{html_options name=country values=$countries output=$countries selected=$gContent->getField('country')}
				{/forminput}
			</div>

			<div class="row">
				{formlabel label="email" for="email"}
				{forminput}
				<label><input type="text" size="30" maxlength="160" name="email1" id="email1" value="{$gContent->getField('email1')}" /> {tr}Main email address{/tr}</label><br />
				<label><input type="text" size="30" maxlength="160" name="email2" id="email2" value="{$gContent->getField('email2')}" /> {tr}Alternate email address{/tr}</label>
				{/forminput}
			</div>

			<div class="row">
				{formlabel label="Homepage" for="url"}
				{forminput}
					{tr}Display name{/tr}: <input type="text" size="20" maxlength="160" name="url_title" id="url_title" value="{$gContent->getField('url_title')}" /><br />
					<input type="text" size="50" maxlength="250" name="url" id="url" value="{$gContent->getField('url')}" />
				{/forminput}
			</div>

			<div class="row">
				{formlabel label="Instant Messaging ID" for="im_id"}
				{forminput}
					<input type="text" size="20" maxlength="32" name="im_id" id="im_id" value="{$gContent->getField('im_id')}" /><br />
					{html_options name=im_type values=$imTypes output=$imTypes selected=$gContent->getField('im_type')}
				{/forminput}
			</div>

			{textarea}{$gContent->getField('data')}{/textarea}

			<div class="row submit">
				<input type="submit" name="save_yellowpages" value="{tr}Save{/tr}" />
			</div>
		{/form}
	</div><!-- end .body -->
</div><!-- end .yellowpages -->

{/strip}
